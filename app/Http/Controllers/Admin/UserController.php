<?php

namespace App\Http\Controllers\Admin;

use Request;
use Auth;
use App\Models\Bizservice\AdminUserSvc;
use App\Models\Bizservice\AdminGroupSvc;
use Config;
use Redirect;
use Validator;
use Response;

class UserController extends BaseController
{
    private $_adminUserSvc = null;
    private $_adminGroupSvc = null;

    public function __construct()
    {
        parent::__construct();
        $this->_adminUserSvc = new AdminUserSvc();
//        $this->_adminGroupSvc = new AdminGroupSvc();
    }

    public function account()
    {
        $page = Request::input('page', 1);
        $per_page = Config::get('admin.user_account.per_page');
        $account_status = Config::get('admin.user.status');

        $list = $this->_adminUserSvc->userList($account_status, array(array('status', '!=', '-1')), $page, $per_page);
//        $cnt = $this->_adminUserSvc->userListCnt(array(array('status', '!=', '-1')));

        $action = $this->action('user', 'account');
        return view('user.account.main')
            ->with('action', $action)
            ->with('users', $list);
    }

    public function opeAccount()
    {
        $op = Request::input('op', FALSE);
        if (!$op) return $this->json(false);

        $data = Request::input('data', array());
        switch ($op) {
            case 'add':
                return $this->_addAccount($data);
            case 'edit':
                return $this->_editAccount($data);
            case 'lock':
                return $this->_lockAccount($data);
            case 'delete':
                return $this->_deleteAccount($data);
            default:
                return $this->json(false);
        }
    }

    public function _deleteAccount($data = array())
    {
        if (!isset($data['id'])) return $this->json(false);

        $user = $this->_adminUserSvc->getRow(array(array('id', '=', $data['id'])));
        if (!$user) return $this->json(false);

        $loginUserId = Auth::user()->id;
        if($loginUserId){
            return $this->json($this->_adminUserSvc->deleteAccount($data, $loginUserId));
        }

        return $this->json(false);
    }

    public function _lockAccount($data = array()) {
        if (!isset($data['id'])) return $this->json(false);

        $user = $this->_adminUserSvc->getRow(array(array('id', '=', $data['id'])));
        if (!$user) return $this->json(false);

        $loginUserId = Auth::user()->id;
        if($loginUserId){
            return $this->json($this->_adminUserSvc->lockAccount($data, $loginUserId));
        }

        return $this->json(false);
    }

    public function _editAccount($data = array()) {
        if (!isset($data['id'])) return $this->json(false);
        $user = $this->_adminUserSvc->getRow(array(array('id', '=', $data['id'])));
        if (!$user) return $this->json(false);

        $rule = array(
//            'username'	=>		'required|between:4,64|alpha_num_point|unique:users,username,'.$user->id,
            'username'	=>		array(
                'required',
                'between:4,64',
                'regex:/^([a-z0-9\.])+$/i',
                'unique:admin_users,username,'.$user->id
            ),
            'nickname' 	=> 		'max:64',
            'email'		=>		'email',
            'mobile'	=>		'numeric',
        );
        $message = array(
            'username.required'	=>	'用户名必须提供',
            'username.between'	=>	'用户名长度限制为4到64字节',
            'username.unique'	=>	'用户名不唯一',
            'nickname.max'		=>	'显示名超过最大长度',
            'email.email'		=>	'邮件格式非法',
            'mobile.numeric'	=>	'手机格式中只能包含数字',
        );
        $val = Validator::make($data, $rule, $message);
        if ($val->fails()) return $this->json($val->errors()->all());

        return $this->json($this->_adminUserSvc->editAccount($data));
    }

    public function _addAccount($data = array())
    {
        $rule = array(
            'username'	=>		array(
                'required',
                'between:4,64',
                'regex:/^([a-z0-9\.])+$/i',
                'unique:admin_users'
                ),
            'nickname' 	=> 		'max:64',
            'email'		=>		'email',
            'mobile'	=>		'numeric',
        );
        $message = array(
            'username.required'	=>	'用户名必须提供',
            'username.between'	=>	'用户名长度限制为4到64字节',
            'username.unique'	=>	'用户名已存在',
            'nickname.max'		=>	'显示名超过最大长度',
            'email.email'		=>	'邮件格式非法',
            'mobile.numeric'	=>	'手机格式中只能包含数字',
        );
        $val = Validator::make($data, $rule, $message);
        if ($val->fails()) return $this->json($val->errors()->all());



        return $this->json($this->_adminUserSvc->addAccount($data));
    }

    public function group()
    {
        $this->_adminGroupSvc = new AdminGroupSvc();

        $page = Request::input('page', 1);
        $per_page = Config::get('admin.user_group.per_page');

        $list = $this->_adminGroupSvc->groupList(Auth::user()->id,array(), $page, $per_page);

        $action = $this->action('user', 'group');
        return view('user.group.main')
            ->with('action', $action)
            ->with('groups', $list);
    }

    public function opeGroup()
    {
        $op = Request::input('op', FALSE);
        if (!$op) return $this->json(false);

        $data = Request::input('data', array());
        switch ($op) {
            case 'add':
                return $this->_groupAdd($data);
                break;
            case 'edit':
                return $this->_groupEdit($data);
                break;
            case 'delete':
                return $this->_groupDelete($data);
                break;
            case 'member':
                return $this->_groupMember($data);
                break;
            case 'foreigner':
                return $this->_groupForeigner($data);
                break;
            case 'join':
                return $this->_groupJoin($data);
                break;
            case 'depart':
                return $this->_groupDepart($data);
                break;
            case 'lead':
                return $this->_groupLead($data);
                break;
            default:
                return $this->json(false);
        }
    }

    public function _groupAdd($data = array())
    {
        $rule = array(
            'groupname'		=>		'required|between:2,64|unique:admin_groups',
            'description'   => 		'max:1024',
        );
        $message = array(
            'groupname.required'    =>	'组名必须提供',
            'groupname.between'		=>	'组名长度限制为2到64字节',
            'groupname.unique'		=>	'用户名已存在',
            'description.max'		=>	'显示名超过最大长度',
        );
        $val = Validator::make($data, $rule, $message);
        if ($val->fails()) return $this->json($val->errors()->all());

        $this->_adminGroupSvc = new AdminGroupSvc();
        return $this->json($this->_adminGroupSvc->groupAdd($data));
    }

    public function _groupEdit($data = array())
    {
        $this->_adminGroupSvc = new AdminGroupSvc();

        if (!isset($data['id'])) return $this->json(false);
        $group = $this->_adminGroupSvc->getRow(array(array('id', '=', $data['id'])));
        if (!$group) return $this->json(false);

        $rule = array(
            'groupname'		=>		'required|between:2,64|unique:admin_groups,groupname,'.$group->id,
            'description'   => 		'max:1024',
        );
        $message = array(
            'groupname.required'    =>	'组名必须提供',
            'groupname.between'		=>	'组名长度限制为2到64字节',
            'groupname.unique'		=>	'用户名已存在',
            'description.max'		=>	'显示名超过最大长度',
        );
        $val = Validator::make($data, $rule, $message);
        if ($val->fails()) return $this->json($val->errors()->all());

        return $this->json($this->_adminGroupSvc->groupEdit($data));
    }

    public function _groupDelete($data = array())
    {
        $this->_adminGroupSvc = new AdminGroupSvc();

        if (!isset($data['id'])) return $this->json(false);

        $group = $this->_adminGroupSvc->getRow(array(array('id', '=', $data['id'])));
        if (!$group) return $this->json(false);

        return $this->json($this->_adminGroupSvc->groupDelete($group));
    }

    public function _groupMember($data = array())
    {
        $this->_adminGroupSvc = new AdminGroupSvc();

        if (!isset($data['id'])) return Response::json(array());
        $group = $this->_adminGroupSvc->getRow(array(array('id', '=', $data['id'])));
        if (!$group) return Response::json(array());

        return Response::json($this->_adminGroupSvc->groupMembers($group->id));
    }

    public function _groupForeigner($data = array())
    {
        $this->_adminGroupSvc = new AdminGroupSvc();

        if (!isset($data['id'])) return Response::json(array());
        $group = $this->_adminGroupSvc->getRow(array(array('id', '=', $data['id'])));
        if (!$group) return Response::json(array());

        return Response::json($this->_adminGroupSvc->foreigners($group));
    }

    public function _groupJoin($data = array())
    {
        $this->_adminGroupSvc = new AdminGroupSvc();

        if (!isset($data['group_id'])) return $this->json(false);
        $group = $this->_adminGroupSvc->getRow(array(array('id', '=', $data['group_id'])));
        if (!$group) return $this->json(false);

        if (!isset($data['user_id'])) return $this->json(false);
        if (!is_array($data['user_id'])) return $this->json(false);

        return $this->json($this->_adminGroupSvc->groupJoin($group->id, $data['user_id']));
    }

    public function _groupDepart($data = array())
    {
        $this->_adminGroupSvc = new AdminGroupSvc();

        if (!isset($data['group_id'])) return $this->json(false);
        $group = $this->_adminGroupSvc->getRow(array(array('id', '=', $data['group_id'])));
        if (!$group) return $this->json(false);

        if (!isset($data['user_id'])) return $this->json(false);
        if (!is_array($data['user_id'])) return $this->json(false);

        return $this->json($this->_adminGroupSvc->groupDepart($group->id, $data['user_id']));
    }

    public function _groupLead($data = array())
    {
        $this->_adminGroupSvc = new AdminGroupSvc();

        if (!isset($data['group_id'])) return $this->json(false);
        $group = $this->_adminGroupSvc->getRow(array(array('id', '=', $data['group_id'])));
        if (!$group) return $this->json(false);

        if (!isset($data['user_id'])) return $this->json(false);

        return $this->json($this->_adminGroupSvc->groupLead($group->id, $data['user_id']));
    }

    public function startpage()
    {
        $start_page = Request::input('start_page');
        $_adminusersvc = new AdminUserSvc();
        $cond = array('id' => Auth::user()->id);
        $update = array('start_page' => $start_page);
        $ret = $_adminusersvc->updateData($cond, $update);
//        $ret = $_adminusersvc->getAdminUserDao()->where('id', '=', Auth::user()->id)->update(array('start_page'=>$start_page));
        if($ret){
            return $this->json(true);
        }

        return $this->json(false);
    }
}
