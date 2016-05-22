<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bizservice\AdminModuleSvc;
//use Illuminate\Http\Request;
use Request;
use App\Http\Controllers\Controller;
use Auth;
use Response;
//use Session;
use App\Models\Dao\AdminUserDao;
abstract class BaseController extends Controller
{
    public static $user = null;
    private $_adminModuleSvc = null;
    private $_adminUserDao = null;

    public function __construct()
    {
//        self::$user = ($request->user()) ? $request->user() : null;
        self::$user = (Auth::user()) ? Auth::user() : null;
        if (!empty(self::$user)) {
            $this->_adminUserDao = new AdminUserDao();
            $user_dao = $this->_adminUserDao->getRow(array(array('id', '=', self::$user->id)));
            self::$user = $user_dao;
        }
        $this->_adminModuleSvc = new AdminModuleSvc();
    }

    public function action($module, $action) {
        return (new AdminModuleSvc())->getRow($module, $action);
    }

    public function json($error){
        if ($error === TRUE) {
            return Response::json(
                array(
                    'code'=> 0,
                    'msg' => '成功'
                ));
        }

        if ($error === FALSE) {
            return Response::json(
                array(
                    'code'=> 1,
                    'msg' => array(array('失败')),
                ));
        }
        if (is_object($error)) {
            return Response::json(
                array(
                    'code'=> 1,
                    'msg' => $error->messages
                ));
        }
        if (is_string($error)) {
            return Response::json(
                array(
                    'code'=> 1,
                    'msg' => $error
                ));
        }
        if (is_array($error)) {
            return Response::json(
                array(
                    'code'=> 1,
                    'msg' => array($error)
                ));
        }
    }
}
