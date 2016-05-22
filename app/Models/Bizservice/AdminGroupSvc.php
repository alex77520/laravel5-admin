<?php
namespace App\Models\Bizservice;

use App\Models\Dao\AdminGroupDao;
use App\Models\Dao\AdminUsergroupDao;
use App\Models\Dao\AdminUserDao;
use App\Models\Bizservice\AdminUserSvc;
class AdminGroupSvc extends BaseSvc
{/*{{{*/
    private $_admingroupdao;
    private $_adminUsergroupDao;
    private $_adminUserDao;
    private $_adminUserSvc;

    public function __construct()
    {/*{{{*/
        $this->_admingroupdao = new AdminGroupDao();
        $this->_adminUserSvc = new AdminUserSvc();
    }/*}}}*/

    public function getAdminGroupDao()
    {
        return $this->_admingroupdao;
    }

    public function updateData($cond, $update)
    {
        return $this->_admingroupdao->updateData($cond, $update);
    }

    public function getRow($cond = array())
    {
        return $this->_admingroupdao->getRow($cond);
    }

    public function getAll()
    {
        return $this->_admingroupdao->get();
    }

    public function groupList($loginUserId, $condition = array(), $page = 1, $per_page = 20)
    {
        $user = $this->_adminUserSvc->getRow(array(array('id', '=', $loginUserId)));
        if($this->_adminUserSvc->isSuperId($user) || $this->_adminUserSvc->isSuper($user)){
            return $this->_admingroupdao->groupList($condition, $page, $per_page);
        }

        return $user->groups;
    }

    public function groupMembers($gid)
    {
        return $this->_admingroupdao->groupMembers($gid);
    }

    public function groupAdd($data = array())
    {
        $group = $this->_admingroupdao->create($data);

        if($group) return true;

        return false;
    }

    public function groupEdit($data = array())
    {
        if(count($data) == 0) return false;

        $cond = array('id' => $data['id']);
        $update = array(
            'groupname' => $data['groupname'],
            'description' => $data['description']
        );

        $ret = $this->updateData($cond, $update);
        if($ret)
            return true;

        return false;
    }

    public function groupDelete($group = null)
    {
        if($group){
            if($group->delete()){
                return true;
            }

            return false;
        }

    }

    public function foreigners($group)
    {
        $ret = $this->_admingroupdao->foreigners($group);
        return $ret;
    }

    public function groupJoin($gid, $userIds = array())
    {
        $this->_adminUsergroupDao = new AdminUsergroupDao();
        $this->_adminUserDao = new AdminUserDao();

        $insertData = array();
        foreach($userIds as $userId){
            if(!$this->_adminUserDao->find($userId))continue;
            if($this->_adminUsergroupDao->getRow(
                array(
                    array('user_id', '=', $userId),
                    array('group_id', '=', $gid)
                )
            )){
                continue;
            }

            $insertData[] = array('user_id'=>$userId, 'group_id'=>$gid);
        }

        if(count($insertData) > 0){
            $ret = $this->_adminUsergroupDao->add($insertData);
            return $ret ? true : false;
        }
        return false;
    }

    public function groupDepart($gid, $userIds = array())
    {
        $this->_adminUsergroupDao = new AdminUsergroupDao();
        $this->_adminUserDao = new AdminUserDao();

        $deletedUserIds = array();
        foreach($userIds as $userId){
            if(!$this->_adminUserDao->find($userId))continue;
            $deletedUserIds[] = $userId;
        }

        if(count($deletedUserIds) > 0){
            $ret = $this->_adminUsergroupDao->del($gid, $deletedUserIds);
            return $ret ? true : false;
        }

        return false;
    }

    public function groupLead($gid, $userId)
    {
        $this->_adminUsergroupDao = new AdminUsergroupDao();
        $this->_adminUserDao = new AdminUserDao();

        if($this->_adminUserDao->find($userId)){
            $cond = array('user_id' => $userId, 'group_id' => $gid);
            if($this->_adminUsergroupDao->isLeader($userId, $gid)){
                $update = array('is_leader' => 0);
            }else{
                $update = array('is_leader' => 1);
            }

            $ret = $this->_adminUsergroupDao->updateData($cond, $update);

            return $ret ? true : false;
        }

        return false;
    }
}/*}}}*/ 
