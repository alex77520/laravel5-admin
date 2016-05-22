<?php

namespace App\Models\Dao;

use DB;
class AdminUsergroupDao extends BaseDao
{

    protected $table = 'admin_user_group';

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

    public function add($data = array())
    {
        return $this->insert($data);
    }

    public function del($gid, $userIds = array())
    {
        return $this->whereIn('user_id', $userIds)->where('group_id', '=', $gid)->delete();
    }

    public function isLeader($uid, $gid) {
        $r = $this
            ->where('user_id', '=', $uid)
            ->where('group_id', '=', $gid)
            ->where('is_leader', '=', '1')
            ->first();
        if ($r) return true;
        return false;
    }
}
