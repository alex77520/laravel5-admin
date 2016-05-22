<?php
namespace App\Models\Bizservice;

use App\Models\Dao\AdminModuleDao;
use App\Models\Dao\AdminPermissionDao;
class AdminModuleSvc extends BaseSvc
{/*{{{*/
    private $_adminmoduledao;
    private $_adminPermissionDao;

    public function __construct()
    {/*{{{*/
        $this->_adminmoduledao = new AdminModuleDao();
    }/*}}}*/

    public function getAdminModuleDao()
    {
        return $this->_adminmoduledao;
    }

    public function updateData($cond, $update)
    {
        return $this->_adminmoduledao->updateData($cond, $update);
    }

    public function getAllModule()
    {
        return $this->_adminmoduledao->getAllModule();
    }

    public function getRow($module, $action)
    {
        return $this->_adminmoduledao->getRow($module, $action);
    }

    public function getSingle($cond = array())
    {
        return $this->_adminmoduledao->getSingle($cond);
    }

    public function allStaticActionGroup()
    {
        return $this->_adminmoduledao->allStaticActionGroup();
    }

    public function allDynamicActionGroup()
    {
        return $this->_adminmoduledao->allDynamicActionGroup();
    }
    //获取所有的公司权限
    //allCompanyGroup
    public function allCompanyGroup()
    {
        return $this->_adminmoduledao->allCompanyGroup();
    }



    public function moduleList($condition = array(), $page = 1, $per_page = 20, $order_by = array())
    {
        return $this->_adminmoduledao->moduleList($condition, $page, $per_page, $order_by);
    }

    public function modulesGroupBy()
    {
        return $this->_adminmoduledao->modulesGroupBy();
    }

    public function moduleAdd($data)
    {
        $module = $this->_adminmoduledao->insert($data);
        return $module ? true : false;
    }

    public function moduleEdit($data)
    {
        if(count($data) == 0) return false;

        $cond = array('id' => $data['id']);
        $update = array(
            'module'        => $data['module'],
            'module_cn'     => $data['module_cn'],
            'action'        => $data['action'],
            'action_cn'     => $data['action_cn'],
            'module_type'   => $data['module_type'],
            'description'   => $data['description'],
            'order_by'      => $data['order_by'],
            'gname'         => $data['gname'],
        );

        $ret = $this->updateData($cond, $update);

        return $ret ? true : false;
    }

    public function moduleDelete($mId)
    {
        if(!$mId)return false;

        $this->_adminPermissionDao = new AdminPermissionDao();

        $this->_adminmoduledao->del(array(array('id', '=', $mId)));
        $this->_adminPermissionDao->del(array(array('module_id', '=', $mId)));
        return true;
    }
}/*}}}*/
