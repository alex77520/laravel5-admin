<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Redirect;
use Request;
use Validator;
use Illuminate\Http\Request as L_Q;
use App\Models\Bizservice\AdminUserSvc;
use App\Models\Bizservice\AdminRoleSvc;
use App\Models\Bizservice\AdminModuleSvc;
use App\Models\Bizservice\AdminPermissionSvc;
use App\Models\Bizservice\AdminUserroleSvc;

class PrivilegeController extends BaseController
{

    private $_adminUserSvc = null;
    private $_adminRoleSvc = null;
    private $_adminModuleSvc = null;
    private $_adminPermissionSvc = null;
    private $_adminUserroleSvc = null;


    public function __construct()
    {
        parent::__construct();
    }

    public function role()
    {
        set_time_limit(0);

        $this->_adminUserSvc = new AdminUserSvc();
        $this->_adminRoleSvc = new AdminRoleSvc();
        $this->_adminModuleSvc = new AdminModuleSvc();

        if($this->_adminUserSvc->isSuper(self::$user)){
            $isSuper = true;
            $loginUserPermissions = array();
            $roles = $this->_adminRoleSvc->roleListAll();
        }else{
            $isSuper = false;
            $loginUserPermissions = $this->_adminUserSvc->ownPermission(self::$user);
            $roles = $this->_adminRoleSvc->roleList(self::$user);
        }

        $action = $this->action('privilege', 'role');
        $role = $this->_adminRoleSvc->getRow(array(array('id', '=', Request::input('role', false))));
        $rolePermission = $this->_adminRoleSvc->ownPermission($role);

        if (!$role or !$this->_adminUserSvc->isAccessRole(self::$user, $role)) {
            $role = null;
        }

        $allStaticModule = $this->_adminModuleSvc->allStaticActionGroup();
        $allDynamicModule = $this->_adminModuleSvc->allDynamicActionGroup();

        //公司权限
        $allCompanyModule = $this->_adminModuleSvc->allCompanyGroup();
        return view('privilege.role.main')
            ->with('action', $action)
            ->with('roles', $roles)
//            ->with('user', self::$user)
            ->with('role', $role)
            ->with('allStaticModule', $allStaticModule)
            ->with('allDynamicModule', $allDynamicModule)
            ->with('allCompanyModule', $allCompanyModule)
            ->with('isSuper', $isSuper)
            ->with('loginUserPermissions', $loginUserPermissions)
            ->with('rolePermission', $rolePermission)
            ->render();
    }

    public function opeRole() {

        $op= Request::input('op', FALSE);
        if (!$op) return $this->json(false);

        $data = Request::input('data', array());
        switch ($op) {
            case 'add':
                return $this->_roleAdd($data);
                break;
            case 'delete':
                return $this->_roleDelete($data);
                break;
            case 'grant':
                return $this->_grant($data);
                break;
            case 'revoke':
                return $this->_revoke($data);
                break;
            default:
                return $this->json(false);
        }
    }

    public function _roleAdd($data = array())
    {
        $rule = array(
            'role'			=>		'required|between:2,64|unique:admin_roles',
            'description'   => 		'max:1024',
            'owner'			=>		'between:4,64',
        );
        $message = array(
            'role.required'		=>		'必须提供角色名',
            'role.between'		=>		'角色名称长度限制在2和64字节之间',
            'role.unique'		=> 		'角色名不唯一',
            'description.max'	=>		'描述长度必须小于1024字节',
        );
        $val = Validator::make($data, $rule, $message);
        if ($val->fails()) return $this->json($val->errors()->all());

        $this->_adminRoleSvc = new AdminRoleSvc();
        $data['owner'] = self::$user->username;
        return $this->json($this->_adminRoleSvc->roleAdd($data));
    }

    public function _roleDelete($data = array())
    {
        $this->_adminRoleSvc = new AdminRoleSvc();

        if (!isset($data['id'])) return $this->json(false);
        $role = $this->_adminRoleSvc->getRow(array(array('id', '=', $data['id'])));
        if(!$role)return $this->json(false);

        return $this->json($this->_adminRoleSvc->roleDelete($data['id']));

    }

    public function _grant($data = array())
    {
        $this->_adminModuleSvc = new AdminModuleSvc();
        $this->_adminRoleSvc = new AdminRoleSvc();
        $this->_adminPermissionSvc = new AdminPermissionSvc();

        $rule = array(
            'role_id'		=>		'required|numeric',
            'module_id'	 	=> 		'required|numeric',
            'node_type'		=>		'required|numeric',
            'node_id'		=>		'required|numeric',
        );

        $val = Validator::make($data, $rule);
        if ($val->fails()) return $this->json(false);
        $module = $this->_adminModuleSvc->getSingle(array(array('id', '=', $data['module_id'])));
        if (!$module) return $this->json(false);
        if (!self::$user) return $this->json(false);
        if (!$role = $this->_adminRoleSvc->getRow(array(array('id', '=', $data['role_id'])))) return $this->json(false);

        return $this->json($this->_adminPermissionSvc->add($data));
    }

    public function _revoke($data = array())
    {
        $this->_adminModuleSvc = new AdminModuleSvc();
        $this->_adminRoleSvc = new AdminRoleSvc();
        $this->_adminPermissionSvc = new AdminPermissionSvc();

        if(!isset($data['role_id']) || !isset($data['module_id']) || !isset($data['node_id']) || !isset($data['node_type']))return $this->json(false);

        $module = $this->_adminModuleSvc->getSingle(array(array('id', '=', $data['module_id'])));
        if (!$module) return $this->json(false);
        if (!self::$user) return $this->json(false);
        if (!$role = $this->_adminRoleSvc->getRow(array(array('id', '=', $data['role_id'])))) return $this->json(false);

        return $this->json($this->_adminPermissionSvc->del(
            array(
                array('role_id', '=', $data['role_id']),
                array('module_id', '=', $data['module_id']),
                array('node_id', '=', $data['node_id']),
                array('node_type', '=', $data['node_type'])
            )
        ));

    }

    public function grant()
    {
        $this->_adminUserSvc = new AdminUserSvc();
        $this->_adminRoleSvc = new AdminRoleSvc();

        $current = $this->_adminUserSvc->getRow(array(array('id', '=', Request::input('u', 0))));
        $currentOwnRole = array();
        if($current)$currentOwnRole = $this->_adminUserSvc->ownRole($current);

        $groups = $this->_adminUserSvc->ownGroup(self::$user);
        $action = $this->action('privilege', 'grant');
        if($this->_adminUserSvc->isSuper(self::$user)){
            $roles = $this->_adminRoleSvc->roleListAll();
        }else{
            $roles = $this->_adminRoleSvc->roleList(self::$user);
        }

        return view('privilege.grant.main')
            ->with('current', $current)
            ->with('currentOwnRole', $currentOwnRole)
//            ->with('user', self::$user)
            ->with('groups', $groups)
            ->with('roles', $roles)
            ->with('action', $action)
            ->render();
    }

    public function opeGrant()
    {
        $op = Request::input('op', '');

        $data = Request::input('data', array());
        switch ($op) {
            case 'revoke':
                return $this->_roleRevokeUser($data);
                break;
            case 'grant':
                return $this->_roleGrantUser($data);
                break;
            default:
                return $this->json(false);
                break;
        }
    }

    public function _roleRevokeUser($data)
    {
        $this->_adminUserSvc = new AdminUserSvc();
        $this->_adminRoleSvc = new AdminRoleSvc();
        $this->_adminUserroleSvc = new AdminUserroleSvc();

        if (!isset($data['user_id']) || !isset($data['role_id'])) return $this->json(false);
        if(!$user = $this->_adminUserSvc->getRow(array(array('id', '=', $data['user_id']))))return $this->json(false);
        if(!$role = $this->_adminRoleSvc->getRow(array(array('id', '=', $data['role_id']))))return $this->json(false);

        $cond =array(
            array('user_id', '=', $user->id),
            array('role_id', '=', $role->id)
        );
        if(!$this->_adminUserroleSvc->getRow($cond)){
            return $this->json(true);
        }

        return $this->json($this->_adminUserroleSvc->del($cond));
    }

    public function _roleGrantUser($data)
    {
        $this->_adminUserSvc = new AdminUserSvc();
        $this->_adminRoleSvc = new AdminRoleSvc();
        $this->_adminUserroleSvc = new AdminUserroleSvc();

        if (!isset($data['user_id']) || !isset($data['role_id'])) return $this->json(false);
        if(!$user = $this->_adminUserSvc->getRow(array(array('id', '=', $data['user_id']))))return $this->json(false);
        if(!$role = $this->_adminRoleSvc->getRow(array(array('id', '=', $data['role_id']))))return $this->json(false);

        if($this->_adminUserroleSvc->getRow(
            array(
                array('user_id', '=', $user->id),
                array('role_id', '=', $role->id)
            )
        )){
            return $this->json(true);
        }

        return $this->json($this->_adminUserroleSvc->add($data));

    }

    public function view(L_Q $request) {
        $this->_adminUserSvc = new AdminUserSvc();
        $this->_adminRoleSvc = new AdminRoleSvc();
        $this->_adminModuleSvc = new AdminModuleSvc();


        $current = $this->_adminUserSvc->getRow(array(array('id', '=', Request::input('u', 0))));
        $currentRolePermission = array();
        if($current)$currentRolePermission = $this->_adminUserSvc->ownPermission($current);
//        $currentOwnRole = array();
//        if($current)$currentOwnRole = $this->_adminUserSvc->ownRole($current);

        $groups = $this->_adminUserSvc->ownGroup(self::$user);
        $action = $this->action('privilege', 'view');
        $allStaticModule = $this->_adminModuleSvc->allStaticActionGroup();
        $allDynamicModule = $this->_adminModuleSvc->allDynamicActionGroup();
        //公司权限
        $allCompanyModule = $this->_adminModuleSvc->allCompanyGroup();
        return view('privilege.view.main')
            ->with('user', self::$user)
            ->with('current', $current)
            ->with('currentRolePermission', $currentRolePermission)
            ->with('groups', $groups)
            ->with('allStaticModule', $allStaticModule)
            ->with('allCompanyModule', $allCompanyModule)
            ->with('action', $action);
    }
}
