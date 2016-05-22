<?php

namespace App\Models\Dao;

use DB;
class AdminModuleDao extends BaseDao
{

    protected $table = 'admin_modules';

    /**
     * 得到所有的模块名
     * @return array
     */
    public function getAllModule()
    {
        $info = array();
        $sql = "SELECT DISTINCT module from ".$this->getPreName().'_'.$this->table;
        $ret  = DB::select($sql);
        foreach ($ret as $item){
            $info[] = $item->module;
        }
        return $info;
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

    public function getRow($module, $action)
    {
        return DB::table($this->table)->where('module' , '=', $module)->where('action', '=', $action)->first();
    }

    public function getSingle($cond = array())
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

    public function allStaticActionGroup() {
        $ret = array();
        foreach ($this->all() as $m) {
            if ($m->module_type == config('admin.module.static')) {
                $ret[$m->module][] = $m;
            }
        }
        return $ret;
    }

    public function allDynamicActionGroup() {
        $ret = array();
        foreach ($this->all() as $m) {
            if ($m->module_type == config('admin.module.dynamic')) {
                $ret[$m->module][] = $m;
            }
        }
        return $ret;
    }
    //获取公司相关的权限   -- 角色因公司不同而不同
    public function allCompanyGroup() {
        $ret = array();
        foreach ($this->all() as $m) {
            if ($m->module_type == config('admin.module.company')) {
                $ret[$m->module][] = $m;
            }
        }
        return $ret;
    }

    public function moduleList($condition = array(), $page = 1, $per_page = 20, $order_by = array()) {
        $ret = $this;
        foreach ($condition as $c) {
            $ret = $ret->where($c[0], $c[1], $c[2]);
        }

        foreach ($order_by as $k => $v) {
            $ret = $ret->orderBy($k,$v);
        }
        return $ret->paginate($per_page, array('*'), 'page', $page);
    }

    /**
     * Module list by module
     *
     * @return array
     */
    public function modulesGroupBy() {
        return $this->groupBy('module')->orderBy('id', 'asc')->lists('module_cn', 'module');
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
