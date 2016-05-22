<?php
namespace App\Models\Bizservice;

use App\Models\Dao\AdminPermissionDao;
class AdminPermissionSvc extends BaseSvc
{/*{{{*/
    private $_adminPermissionDao;

    public function __construct()
    {/*{{{*/
        $this->_adminPermissionDao = new AdminPermissionDao();
    }/*}}}*/

    public function getAdminPermissionDao()
    {
        return $this->_adminPermissionDao;
    }

    public function getRow($cond = array())
    {
        return $this->_adminPermissionDao->getRow($cond);
    }


    public function add($data = array())
    {
        $ret = $this->_adminPermissionDao->insert($data);
        return $ret ? true : false;
    }

    public function del($data = array())
    {
        $ret = $this->_adminPermissionDao->del($data);
        return $ret ? true : false;
    }

}/*}}}*/ 
