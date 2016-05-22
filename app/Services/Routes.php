<?php

namespace App\Services;

use Route;
use Redirect;
use Auth;
/**
 * 系统路由
 *
 * 注：大部分的路由及控制器所执行的动作来说，
 *
 * 你需要返回完整的 Illuminate\Http\Response 实例或是一个视图
 *
 */
class Routes
{
    private $adminDomain;

    private $wwwDomain;

    /**
     * 初始化，取得配置
     *
     * @access public
     */
    public function __construct()
    {
        $this->adminDomain = config('sys.sys_admin_domain');
        $this->wwwDomain = config('sys.sys_live_domain');
    }

    /**
     * 后台的通用路由
     *
     * 覆盖通用的路由一定要带上别名，且別名的值为module.class.action
     *
     * 即我们使用别名传入了当前请求所属的module,controller和action
     *
     * <code>
     *     Route::get('index-index.html', ['as' => 'module.class.action', 'uses' => 'Admin\IndexController@index']);
     * </code>
     *
     * @access public
     */
    public function admin()
    {
        Route::group(['domain' => $this->adminDomain], function()
        {
            $key = 'admin';

            // Authentication Routes...
            Route::get('auth/login', 'Admin\Auth\AuthController@getLogin');
            Route::post('auth/login', 'Admin\Auth\AuthController@postLogin');
            Route::get('auth/logout', 'Admin\Auth\AuthController@getLogout');

            Route::get("/", function(){
                if (!Auth::check()) return Redirect::to('auth/login');

                $user = Auth::user();
                $start_page = trim($user->start_page);
                if ($start_page) {
                    return Redirect::to(str_replace('#', '/', $start_page));
                }

                return Redirect::to('personal/profile');
            });


            Route::group(['middleware' => 'auth'], function() use($key){
//                Route::get('personal/profile','Admin\PersonalController@getProfile');

                Route::any('{class}/{action}', ['as' => $key, function($class, $action)
                {
                    $class = 'App\\Http\\Controllers\\Admin\\'.ucfirst(strtolower($class)).'Controller';
                    if(class_exists($class))
                    {
                        $classObject = new $class();
                        if(method_exists($classObject, $action))
                        {
                            $return = call_user_func(array($classObject, $action));
                            return $return;
                        }
                    }
                    return abort(404);
                }])->where(['class' => '[0-9a-z]+', 'action' => '[0-9a-z]+']);

            });
//            Route::group(['middleware' => ['csrf']], function()
//            {
//                Route::get('/', 'Admin\Foundation\LoginController@index');
//                Route::controller('login', 'Admin\Foundation\LoginController', ['getOut' => 'foundation.login.out']);
//            });
//
//            Route::group(['middleware' => ['auth', 'acl', 'alog']], function()
//            {
//                Route::any('{module}-{class}-{action}.html', ['as' => 'common', function($module, $class, $action)
//                {
//                    $class = 'App\\Http\\Controllers\\Admin\\'.ucfirst(strtolower($module)).'\\'.ucfirst(strtolower($class)).'Controller';
//                    if(class_exists($class))
//                    {
//                        $classObject = new $class();
//                        if(method_exists($classObject, $action)) return call_user_func(array($classObject, $action));
//                    }
//                    return abort(404);
//                }])->where(['module' => '[0-9a-z]+', 'class' => '[0-9a-z]+', 'action' => '[0-9a-z]+']);
//            });
        });
        return $this;
    }

    /**
     * 这里必须要返回一个Illuminate\Http\Response 实例而非一个视图
     *
     * 原因是因为csrf中需要响应的必须为一个response
     *
     * @access public
     */
    public function www()
    {
        Route::get('live/{id?}', array('as' => 'live', 'uses' => 'Home\IndexController@show'));
        $key = 'home';
        Route::group(['domain' => $this->wwwDomain], function() use ($key)
        {
            Route::any('{class}/{action}', ['as' => $key, function($class, $action)
            {
                $class = 'App\\Http\\Controllers\\Home\\'.ucfirst(strtolower($class)).'Controller';
                if(class_exists($class))
                {
                    $classObject = new $class();
                    if(method_exists($classObject, $action))
                    {
                        return call_user_func(array($classObject, $action));
                    }
                }
                return abort(404);
            }])->where(['class' => '[0-9a-z]+', 'action' => '[0-9a-z]+']);
        });
        return $this;
    }

}
