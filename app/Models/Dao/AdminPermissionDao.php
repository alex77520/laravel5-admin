<?php

namespace App\Models\Dao;

use DB;
class AdminPermissionDao extends BaseDao
{

    protected $table = 'admin_permissions';

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
