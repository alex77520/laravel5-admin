<?php
namespace App\Models\Bizservice;

use App\Models\Dao\AdminUsergroupDao;
class AdminUsergroupSvc extends BaseSvc
{/*{{{*/
    private $_adminusergroupdao;

    public function __construct()
    {/*{{{*/
        $this->_adminusergroupdao = new AdminUsergroupDao();
    }/*}}}*/

    public function getAdminUsergroupDao()
    {
        return $this->_adminusergroupdao;
    }

    public function getRow($cond = array())
    {
        return $this->_adminusergroupdao->getRow($cond);
    }


}/*}}}*/ 
