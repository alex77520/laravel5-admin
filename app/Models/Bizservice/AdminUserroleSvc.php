<?php
namespace App\Models\Bizservice;

use App\Models\Dao\AdminUserroleDao;
class AdminUserroleSvc extends BaseSvc
{/*{{{*/
    private $_adminuserroledao;

    public function __construct()
    {/*{{{*/
        $this->_adminuserroledao = new AdminUserroleDao();
    }/*}}}*/

    public function getAdminUserroleDao()
    {
        return $this->_adminuserroledao;
    }

    public function getRow($cond = array())
    {
        return $this->_adminuserroledao->getRow($cond);
    }

    public function add($data)
    {
        $ret = $this->_adminuserroledao->add($data);
        return $ret ? true : false;
    }

    public function del($data = array())
    {
        $ret = $this->_adminuserroledao->del($data);
        return $ret ? true : false;
    }


}/*}}}*/ 
