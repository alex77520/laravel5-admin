<?php

namespace App\Http\Controllers\Admin;

use Request;
use Auth;
use App\Models\Bizservice\AdminUserSvc;
use Validator;
use Hash;
use Redirect;

class PersonalController extends BaseController
{

    public function __construct()
    {
//        parent::__construct();
    }

    public function index()
    {
        return Redirect::to('personal/profile');
    }


    public function profile()
    {
        $action = $this->action('personal', 'profile');
        return view('personal.profile')->with('action', $action)->with('user', Auth::user());
    }

    public function changepw()
    {
        $action = $this->action('personal', 'changepw');
        return view('personal.changepw')->with('action', $action)->with('user', Auth::user());
    }

    public function setProfile()
    {
        $_adminusersvc = new AdminUserSvc();
        $rule = array(
            'nickname' 	=> 		'max:64',
            'email'		=>		'email',
            'mobile'	=>		'numeric',
        );
        $message = array(
            'nickname.max'		=>	'显示名超过最大长度',
            'email.email'		=>	'邮件格式非法',
            'mobile.numeric'	=>	'手机格式中只能包含数字',
        );
        // validate
        $data = Request::all();

        $val = Validator::make($data, $rule, $message);
        if ($val->fails()) {
            return $this->json($val->errors()->all());
        }

        $cond = array('id' => Auth::user()->id);
        $update = array(
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'mobile' => $data['mobile']
        );
        $arr = array(
            'code' => 2,
            'msg' => '到此一游！！'
        );

        $ret = $_adminusersvc->updateData($cond, $update);
        //return $this->json($update);
        if($ret){
            return $this->json(true);
        }

        return $this->json(false);
    }

    public function setChangepw()
    {
        $_adminusersvc = new AdminUserSvc();
        $rule = array(
            'oldpassword' 	    => 		'required',
            'newpassword'		=>		'required|between:8,32',
            'confirmpassword'	=>		'required|same:newpassword',
        );
        $message = array(
            'oldpassword.required'		=>	'原密码不能为空',
            'newpassword.required'		=>	'新密码不能为空',
            'confirmpassword.required'	=>	'确认密码不能为空',
            'newpassword.between'       =>  '密码长度限制为8到32',
            'confirmpassword.same'      =>  '新密码与确认密码不符',
        );
        // validate
        $data = Request::all();

        $val = Validator::make($data, $rule, $message);
        if ($val->fails()) {
            return $this->json($val->errors()->all());
        }

        if(!Hash::check($data['oldpassword'], Auth::user()->password)) {
            $error = array('原密码不正确');
            return $this->json($error);
        }

        $cond = array('id' => Auth::user()->id);
        $update = array(
            'password' => Hash::make($data['newpassword'])
        );
        $ret = $_adminusersvc->updateData($cond, $update);
        if($ret){
            return $this->json(true);
        }

        return $this->json(false);

    }
}
