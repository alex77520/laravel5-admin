<?php
namespace App\Models\Bizservice;

use App\Models\Dao\AdminRoleDao;
use App\Models\Dao\AdminUserDao;
use App\Models\Dao\AdminUserroleDao;
use App\Models\Dao\AdminPermissionDao;
class AdminRoleSvc extends BaseSvc
{/*{{{*/
    private $_adminroledao;
    private $_adminUserDao;
    private $_adminUserroleDao;
    private $_adminPermissionDao;

    public function __construct()
    {/*{{{*/
        $this->_adminroledao = new AdminRoleDao();
    }/*}}}*/


    public function getRow($cond = array())
    {
        return $this->_adminroledao->getRow($cond);
    }

    public function superRole()
    {
        return $this->_adminroledao->superRole();
    }

    public function ownPermission($role)
    {
        $ownPermission = array();
        if($role){
            $permissions = $role->permissions;
            if(count($permissions) > 0){
                foreach($permissions as $permission){
                    $ownPermission[] = $permission->module_id;
                }
            }
        }

        return $ownPermission;

    }

    /**
     * all role list group by user
     * return array format
     * array(array('user' => $user, 'role' => array($role1, $role2, ...)))
     * @return array
     */
    public function roleListAll() {
        $this->_adminUserDao = new AdminUserDao();

        $ret = array();
        $roles = $this->_adminroledao->getAll();
        foreach ($roles as $role) {
            $user = $this->_adminUserDao->getRow(array(array('username', '=', $role->owner)));
            if($user){
                $ret[$role->owner]['role'][] = $role;
                $ret[$role->owner]['user'] = $user;
            }else{
                if($role->owner == config('admin.user.super_user.username')){
                    $ret[$role->owner]['role'][] = $role;
//                    $ret[$role->owner]['user'] = (new AdminUserDao())->fill(config('admin.user.super_user'));
//                    $ret[$role->owner]['user'] = $this->_adminUserDao->getRow(array(array('id', '=', config('admin.user
                    $ret[$role->owner]['user']['username'] = $role->owner;
                }
            }
        }
        return $ret;
    }

    public function roleList($user) {
        return array(array('user' => $user, 'role' => $this->_adminroledao->ownRole($user->username)));
    }

    public function roleAdd($data = array())
    {
        $role = $this->_adminroledao->insert($data);
        return $role ? true : false;
    }

    public function roleDelete($roleId)
    {
        if(!$roleId)return false;

        $this->_adminUserroleDao = new AdminUserroleDao();
        $this->_adminPermissionDao = new AdminPermissionDao();

        $this->_adminroledao->del(array(array('id', '=', $roleId)));
        $this->_adminUserroleDao->del(array(array('role_id', '=', $roleId)));
        $this->_adminPermissionDao->del(array(array('role_id', '=', $roleId)));
        return true;
    }
}/*}}}*/ 
