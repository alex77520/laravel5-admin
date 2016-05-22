<?php

//use Route;
//use Redirect;
//use Auth;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


//web  auth
Route::group(['middleware' => 'web'], function () {
    Route::auth();

//    Route::get("/", function(){
//        if (!Auth::check()) return Redirect::to('auth/login');
//
//        $user = Auth::user();
//        $start_page = trim($user->start_page);
//        if ($start_page) {
//            return Redirect::to(str_replace('#', '/', $start_page));
//        }
//
//        return Redirect::to('personal/profile');
//    });

    Route::get('/home', 'HomeController@index');
    Route::get('/', 'HomeController@index');
    Route::get('home/welcome', 'HomeController@welcome');
    Route::get('auth/login', 'Admin\Auth\AuthController@getLogin');
    Route::post('auth/login', 'Admin\Auth\AuthController@postLogin');
    Route::any('auth/logout', 'Admin\Auth\AuthController@getLogout');

    //测试
    Route::get('privilege/role', 'Admin\PrivilegeController@role');
    Route::get('privilege/grant', 'Admin\PrivilegeController@grant');
    Route::get('privilege/view', 'Admin\PrivilegeController@view');

    Route::any('privilege/operole', 'Admin\PrivilegeController@opeRole');


    Route::any('privilege/operole', 'Admin\PrivilegeController@opeRole');
    Route::any('privilege/opegrant', 'Admin\PrivilegeController@opeGrant');
    Route::any('user/group', 'Admin\UserController@group');
    Route::any('user/account', 'Admin\UserController@account');
    Route::any('user/opeaccount', 'Admin\UserController@opeAccount');
    Route::any('user/opegroup', 'Admin\UserController@opeGroup');
    //
    Route::any('module/modulelist', 'Admin\ModuleController@modulelist');
    Route::any('module/opemodulelist', 'Admin\ModuleController@opeModuleList');

    Route::any('personal/profile', 'Admin\PersonalController@profile');
    Route::any('personal/changepw', 'Admin\PersonalController@changepw');
    Route::any('personal/setchangepw', 'Admin\PersonalController@setChangepw');
    Route::any('personal/setprofile', 'Admin\PersonalController@setProfile');

//    //
//    Route::controller('personal', 'Admin\PersonalController');
//    Route::controller('module', 'Admin\ModuleController');
//    Route::controller('user', 'Admin\UserController');

});

//use App\Services\Routes as RoutesManager;
//
//$routesManager = new RoutesManager();
//$routesManager->admin()->www();

//DB::listen(
//    function($sql, $binding, $time){
//        //Log::useDailyFiles(storage_path().'/logs/sql/sql.log');
//        Log::info($sql .'       '. json_encode($binding) .'         '. $time);
//
//    }
//);



