<?php

namespace App\Models\Dao;

use DB;
class AdminGroupDao extends BaseDao
{

    protected $table = 'admin_groups';

    protected $fillable = ['groupname', 'description'];

    public function users()
    {
        return $this->belongsToMany('App\Models\Dao\AdminUserDao', 'admin_user_group', 'group_id', 'user_id');
    }

//    public function groups() {
//        return $this->belongsToMany('App\Models\Dao\AdminGroupDao', 'admin_user_group', 'user_id', 'group_id');
//    }

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

    public function groupList($condition = array(), $page = 1, $per_page = 20) {
        $ret = $this;
        foreach ($condition as $c) {
            $ret = $ret->where($c[0], $c[1], $c[2]);
        }
        return $ret->paginate($per_page, array('*'), 'page', $page);
    }

    public function groupMembers($gid) {
        $admin_users = $this->getPreName().'_users';
        $admin_user_group = $this->getPreName().'_admin_user_group';
        $sql = "select u.id, u.username, u.nickname, ug.is_leader from ".$admin_users." as u, ".$admin_user_group." as ug where u.id =
ug.user_id and ug.group_id = ".$gid;
        return DB::select($sql);
    }

    public function foreigners($group) {
        $members = $group->users;
        $members_id = array();
        foreach ($members as $m) $members_id[] = $m->id;

        return DB::table('users')->whereNotIn('id', $members_id)->get(array('id', 'username'));
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

}
