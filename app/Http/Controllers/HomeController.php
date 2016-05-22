<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Bizservice\AdminUserSvc;
use App\Models\Bizservice\AdminRoleSvc;
use App\Models\Bizservice\AdminModuleSvc;
use App\Models\Bizservice\AdminPermissionSvc;
use App\Models\Bizservice\AdminUserroleSvc;
use App\Models\Dao\AdminUserDao;
use Auth;
//use Redirect;
class HomeController extends BaseController
{
    private $_adminUserSvc = null;
    private $_adminRoleSvc = null;
    private $_adminModuleSvc = null;
    private $_adminPermissionSvc = null;
    private $_adminUserroleSvc = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        echo date('H:i:s', time());
//        $is_login = Auth::check();
//        var_dump($is_login);
//        if (!$is_login){
//            return redirect()->guest('auth/login');
//        } else {
//            echo "登陆状态";
//        }
        $this->_adminUserSvc = new AdminUserSvc();
        $this->_adminRoleSvc = new AdminRoleSvc();
        $this->_adminModuleSvc = new AdminModuleSvc();

        $user = Auth::user();
        $current = $this->_adminUserSvc->getRow(array(array('id', '=', $user->id)));
        $currentRolePermission = array();
        if($current)$currentRolePermission = $this->_adminUserSvc->ownPermission($current);
        $currentOwnRole = array();
        if($current)$currentOwnRole = $this->_adminUserSvc->ownRole($current);

        $allStaticModule = $this->_adminModuleSvc->allStaticActionGroup();

        //共享数据
        view()->share('currentRolePermission',$currentRolePermission);
        view()->share('allStaticModule',$allStaticModule);
        view()->share('currentOwnRole',$currentOwnRole);
        view()->share('user',$user);
        return view('index');
    }

    //登陆成功之后的第一次默认的请求，----首页显示的信息
    public function welcome ()
    {
        return "well done,请点击左侧的导航条的链接试试吧 <br > <br >!!-_-!!";
    }
}
