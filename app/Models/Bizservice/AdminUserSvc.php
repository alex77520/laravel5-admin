<?php
namespace App\Models\Bizservice;

use App\Models\Bizservice\AdminRoleSvc;
use App\Models\Bizservice\AdminUserroleSvc;
use App\Models\Bizservice\AdminUsergroupSvc;
use App\Models\Bizservice\AdminGroupSvc;
use App\Models\Dao\AdminUserDao;
use Config;
use Hash;

class AdminUserSvc extends BaseSvc
{/*{{{*/
    private $_adminuserdao;
    private $_adminrolesvc;
    private $_adminuserrolesvc;
    private $_adminusergroupsvc;
    private $_admingroupsvc;

    public function __construct()
    {/*{{{*/
        $this->_adminuserdao = new AdminUserDao();
        $this->_adminrolesvc = new AdminRoleSvc();
        $this->_adminuserrolesvc = new AdminUserroleSvc();
        $this->_adminusergroupsvc = new AdminUsergroupSvc();
//        $this->_admingroupsvc = new AdminGroupSvc();
    }/*}}}*/

    public function getAdminUserDao()
    {
        return $this->_adminuserdao;
    }

    public function updateData($cond, $update)
    {
        return $this->_adminuserdao->updateData($cond, $update);
    }
    public function getRow($cond = array())
    {
        return $this->_adminuserdao->getRow($cond);
    }

    public function userList($account_status, $condition = array(), $page = 1, $per_page = 20)
    {
        $list = $this->_adminuserdao->userList($condition, $page, $per_page);
        if(!empty($list)) {
            foreach($list as $k => $u) {
                $list[$k]->status = $account_status[$u->status];
                $groups = $this->_adminuserdao->find($u->id)->groups()->get();
                $group = array();
                if(empty($groups)) {
                    $list[$k]->groupname = '';
                } else {
                    foreach($groups as $g) {
                        $group[] = $g->groupname;
                    }
                    $list[$k]->groupname = implode(',', $group);
                }
            }
        }
        return $list;
    }

    public function userListCnt($condition = array())
    {
        return $this->_adminuserdao->userListCnt($condition);
    }

    public function addAccount($data = array())
    {
        $data['password'] = Hash::make($data['username']);
        $user = $this->_adminuserdao->create($data);

        $role = $this->_adminrolesvc->getRow(array(array('role', '=', Config::get('admin.role.default_role.role'))));
        $role_id = $role->id;

        if($this->_adminuserrolesvc->getAdminUserroleDao()->where('user_id', '=', $user->id)->where('role_id', '=',
            $role_id)->count()){
            return true;
        }

        $this->_adminuserrolesvc->getAdminUserroleDao()->insert(array('user_id'=> $user->id, 'role_id'=>$role_id));
        return true;
    }

    public function editAccount($data = array())
    {
        if(count($data) == 0) return false;

        $cond = array('id' => $data['id']);
        $update = array(
            'username' => $data['username'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'mobile' => $data['mobile']
        );

        $ret = $this->updateData($cond, $update);
        if($ret)
            return true;

        return false;
    }

    public function lockAccount($data = array(), $loginUserId)
    {
        if(count($data) == 0) return false;

        $user = $this->_adminuserdao->find($loginUserId);

        if($this->canLead($user, $data['id'])){
            $cond = array('id' => $data['id']);
            $update = array(
                'status' => 0
            );
            $ret = $this->updateData($cond, $update);
            if($ret)
                return true;

            return false;
        }

        return false;
    }

    public function deleteAccount($data = array(), $loginUserId)
    {
        if(count($data) == 0) return false;

        $user = $this->_adminuserdao->find($loginUserId);

        if($this->canLead($user, $data['id'])){
            $cond = array('id' => $data['id']);
            $update = array(
                'status' => -1
            );
            $ret = $this->updateData($cond, $update);
            if($ret)
                return true;

            return false;
        }

        return false;
    }


    public function canLead($user, $leadedUserId) {
        if ($this->isSuper($user)) return true;
        foreach ($this->ownGroup($user) as $g) {
            if ($this->isMember($g, $leadedUserId)) return true;
        }
        return false;
    }

    public function isSuper($user) {
        $super_role = $this->_adminrolesvc->superRole();
        foreach ($user->roles as $r) {
            if ($r->id == $super_role->id) return true;
        }
        return false;
    }

    public function isAccessRole($user, $role) {
        if ($this->isSuper($user)) return true;
        if ($user->username == $role->owner) return true;
        return false;
    }

    public function isSuperId($user) {
        $super_ids = Config::get('admin.role.super_role_id');
        foreach ($user->roles as $r) {
            if (in_array($r->id, $super_ids)) return true;
        }
        return false;
    }

    public function isMember($group, $leadedUserId) {
        $r = $this->_adminusergroupsvc->getRow(
            array(
                array('user_id', '=', $leadedUserId),
                array('group_id', '=', $group->id)
            )
        );
        if(count($r) > 0)return true;
        return false;
    }

    public function ownPermission($user)
    {
        $ownPermission = array();
        $roles = $user->roles;
        if(count($roles) > 0){
            foreach($user->roles as $role){
                $permissions = $role->permissions;
                if(count($permissions) > 0){
                    foreach($permissions as $permission){
                        $ownPermission[] = $permission->module_id;
                    }
                }
            }
        }
        return $ownPermission;
    }

    public function ownRole($user)
    {
        $ownRole = array();
        if($user){
            $roles = $user->roles;
            if(count($roles) > 0){
                foreach($roles as $role){
                    $ownRole[] = $role->id;
                }
            }
        }
        return $ownRole;
    }

    function ownGroup($user) {
        if ($this->isSuper($user)) {
//            return $this->_admingroupsvc->getAll();
            return (new AdminGroupSvc())->getAll();
        } else {
            $group = array();
            foreach ($user->groups as $g) {
                $tmpGroup = $this->_adminusergroupsvc->getRow(
                    array(
                        array('user_id', '=', $user->id),
                        array('group_id', '=', $g->id),
                        array('is_leader', '=', 1)
                    )
                );
                if(count($tmpGroup) > 0) $group[] = $g;
            }
        }
        return $group;
    }
}/*}}}*/ 
