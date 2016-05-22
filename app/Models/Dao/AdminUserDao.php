<?php

namespace App\Models\Dao;

use DB;
class AdminUserDao extends BaseDao
{

    protected $table = 'users';

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['username', 'nickname', 'password','email', 'mobile'];


    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Dao\AdminRoleDao', 'admin_user_role', 'user_id', 'role_id');
    }

    public function groups() {
        return $this->belongsToMany('App\Models\Dao\AdminGroupDao', 'admin_user_group', 'user_id', 'group_id');
    }

    public function updateData($cond, $update)
    {
        $ret = $this;
        if(count($cond) != 0 && count($update) != 0){

            foreach($cond as $ckey=>$cvalue){
                $ret = $ret->where($ckey, '=', $cvalue);
            }
            return $ret->update($update);
        }
    }

    public function userList($condition = array(), $page = 1, $per_page = 20) {
        $ret = $this;
        foreach ($condition as $c) {
            $ret = $ret->where($c[0], $c[1], $c[2]);
        }
//        $this->skip(($page - 1) * $per_page);
//        $this->take($per_page);

//        return $this->get(array('id', 'username', 'nickname', 'mobile', 'email', 'last', 'last_ip', 'status', 'start_page'));
        return $ret->paginate($per_page, array('id', 'username', 'nickname', 'mobile', 'email', 'last', 'last_ip', 'status', 'start_page'), 'page', $page);
    }

//    public function userListCnt($condition = array()) {
//        foreach ($condition as $c) {
//            $this->where($c[0], $c[1], $c[2]);
//        }
//        return $this->count();
//    }

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

}
