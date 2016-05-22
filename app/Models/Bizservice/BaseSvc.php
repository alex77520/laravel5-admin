<?php

namespace App\Models\Bizservice;
use App\Models\Integration\Utilsareas;

class BaseSvc
{/*{{{*/
    
    //protected $_userinfo;
    //
    //protected $_userSvc;

    //public function getUidInfo($uid)
    //{
    //    $this->_userSvc = new UserSvc();
    //    $this->_userinfo = $this->_userSvc->getInfoById($uid, $uid); 
    //    return  $this->_userinfo; 
    //} 
   
    //private $_obj = (object) array();

    protected function returnobj()
    {
        return (object) array();
    }


    protected function objtoarray($obj)
    {
        return json_decode(json_encode($obj), true);
    }

    protected  function utils()
    {
        $utils = new Utilsareas();
        return $utils;
    }

    protected function list_sort_by($list, $field, $sortby = 'asc')
    {
        if (is_array($list))
        {
            $refer = $resultSet = array();
            foreach ($list as $i => $data)
            {
                $refer[$i] = &$data[$field];
            }
            switch ($sortby)
            {
                case 'asc': // 正向排序
                    asort($refer);
                    break;
                case 'desc': // 逆向排序
                    arsort($refer);
                    break;
                case 'nat': // 自然排序
                    natcasesort($refer);
                    break;
            }
            foreach ($refer as $key => $val)
            {
                $resultSet[] = &$list[$key];
            }
            return $resultSet;
        }
        return false;
    }

    protected function RankSort($arr)
    {
        foreach ($arr as $key => &$value)
        {
            $value['ranksort'] = $key+1;
        }
        return $arr;
    }


}/*}}}*/
