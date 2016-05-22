<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Dao\AdminModuleDao;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Dao\AdminRoleDao', 'admin_user_role', 'user_id', 'role_id');
    }

    public function groups() {
        return $this->belongsToMany('App\Models\Dao\AdminUsergroupDao', 'admin_user_group', 'user_id', 'group_id');
    }

//    public function static_action_group() {
//        $ret = array();
//        $module_id = array();
//        foreach ($this->_adminuserdao->roles as $r) {
//            foreach ($r->permissions as $p) {
//                $_adminModuleDao = new AdminModuleDao();
//                $module = $_adminModuleDao->find($p->module_id);
//                if ($module AND
//                    $module->module_type == Config::get('admin.module.static') AND
//                    !in_array($module->id,$module_id)) {
//                    $ret[$module->module][$module->order_by] = $module;
//                    $module_id[] = $module->id;
//                }
//            }
//        }
//        $sort = array();
//        foreach ($ret as $k => $v) {
//            $first = array_pop($v);
//            ksort($ret[$k]);
//            $sort[$first->order_by] = $ret[$k];
//        }
//        ksort($sort);
//        return $sort;
//    }
}
