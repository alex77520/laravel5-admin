<?php

namespace App\Models\Dao;

use DB;
use Config;
class AdminRoleDao extends BaseDao
{

    protected $table = 'admin_roles';

    public function users() {
        return $this->belongsToMany('App\Models\Dao\AdminUserDao', 'admin_user_role', 'role_id', 'user_id');
    }


    public function permissions() {
        return $this->hasMany('App\Models\Dao\AdminPermissionDao', 'role_id');
    }

    public function getRow($cond = array())
    {
        $ret = $this;
        if(count($cond) != 0){

            foreach ($cond as $c) {
                $ret = $ret->where($c[0], $c[1], $c[2]);
            }
            return $ret->first();
        }
        return array();
    }

    public function getAll()
    {
        return $this->get();
    }

    public function superRole() {
        $role = Config::get('admin.role.super_role.role');
        return $this->where('role', '=', $role)->first();
    }

    public function ownRole($username) {
        return $this->where('owner', '=', $username)->get();
    }

    public function del($cond = array())
    {
        $ret = $this;
        if(count($cond) != 0){
            foreach ($cond as $c) {
                $ret = $ret->where($c[0], $c[1], $c[2]);
            }
            return $ret->delete();
        }
    }
}
