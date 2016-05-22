<?php
/**
 * Descripetion of this file.
 *
 * @package zb
 * @author taocheng<cheng.tao@kuwo.cn>
 */
namespace App\Models\Integration;
use App\Services\CurlResponse;

class Utilsareas
{/*{{{*/
    /**
     * 字符串截取函数.
     *
     * @param string $str
     * @param int $len
     * @param string $ext
     * @return string
     */
    public static function substr($str, $len, $ext = '...')
    {/*{{{*/
        $length = strlen($str);
        if($length <= $len)
        {
            return $str;
        }
        return mb_strcut($str, 0, $len - strlen($ext)) . $ext;
    }/*}}}*/

    /**
     * 以某个字段为KEY重建数组.
     *
     * @param array $arr
     * @param $key
     * @return array
     */
    public static function indexPull(Array $arr, $key)
    {/*{{{*/
        $ret = array();
        foreach($arr as $info)
        {
            if(isset($info[$key]))
            {
                $ret[$info[$key]] = $info;
            }
        }
        return $ret;
    }/*}}}*/

    /**
     * 取出数组中的某个字段信息.
     *
     * @param array $arr
     * @param $key
     * @return array
     */
    public static function arrayDump(Array $arr, $key)
    {/*{{{*/
        $ret = array();
        foreach($arr as $info)
        {
            if(isset($info[$key]))
            {
                $ret[] = $info[$key];
            }
        }
        return $ret;
    }/*}}}*/

    /**
     * 按某一字段合并数组.
     *
     * @param array $arr1
     * @param array $_
     * @param string $key
     * @return bool|mixed
     */
    public static function arrayMergeByKey(Array $arr1, Array $_, $key='id')
    {/*{{{*/
        $args = func_get_args();
        $key = array_pop($args);
        if(!is_string($key)) return false;
        $arr = array_shift($args);

        foreach($args as &$info)
        {
            $info = self::indexPull($info, $key);
        }

        foreach($arr as $k => &$info)
        {
            $id = $info[$key];
            $tmp = array();
            foreach($args as $v)
            {
                if(!isset($v[$id]))
                {
                    unset($arr[$k]);
                    continue;
                }
                $tmp = array_merge($tmp, $v[$id]);
            }
            $info = array_merge($info, $tmp);
        }
        return $arr;
    }/*}}}*/

    static public function toGbk($s)
    {/*{{{*/
        if(is_array($s))
        {
            return array_map('self::toGbk', $s);
        }
        return iconv('utf-8', 'gbk', $s);
    }/*}}}*/

    static public function toUtf8($s)
    {/*{{{*/
        if(is_array($s))
        {
            return array_map('self::toUtf8', $s);
        }
        return iconv('gbk', 'utf-8', $s);
    }/*}}}*/

    /**
     * 生成翻页代码.
     *
     * @param $total
     * @param $page_id
     * @param $pagesize
     * @param $url
     * @return string
     */
    public static function getPageHtml($total, $page_id, $pagesize = 18, $url = '')
    {/*{{{*/
        $pages      = ceil($total / $pagesize);
        $arr_return = array();
        if($page_id > 1) {
            $arr_return[]   = '<a href="'.$url.($page_id-1).'" class="prev"><em>«上一页</em></a>';
        } else {
            $arr_return[]   = '<a href="javascript:void(0);" class="prev page-blank"><em>«上一页</em></a>';
        }

        if(1 == $page_id) {
            $arr_return[]   = '<span class="cur"><em>1</em></span>';
        } else {
            $arr_return[]   = '<a href="'.$url.'1'.'"><em>1</em></a>';
        }
        $start  = ($page_id - 2);
        if(($pages - $page_id) < 4)
        {
            $start  = ($pages - 4);
        }
        if($start < 2)
        {
            $start  = 2;
        }
        $end    = $start + 4;
        if($end > $pages) {
            $end    = $pages - 1;
        }
        $out_page_id    = $start;
        for($i=1; $i<6; $i++) {
            if($out_page_id == $pages) {
                break;
            }
            if($out_page_id > $end) {
                break;
            }
            if($i == 1) {
                if($out_page_id != 2) {
                    //$arr_return[] = '<span class="page-numbers dots">&hellip;</span>';
                    $arr_return[]   = '<a href="javascript:void(0);" class="page-blank"><em>...</em></a>';
                } else {
                    $i++;
                }
            }

            if($out_page_id == $page_id) {
                $arr_return[]   = '<span class="cur"><em>'.$out_page_id.'</em></span>';
            } else {
                $arr_return[]   = '<a href="'.$url.$out_page_id.'"><em>'.$out_page_id.'</em></a>';
            }
            $out_page_id++;

        }
        //exit;
        if($out_page_id<$pages) {
            //$arr_return[]     = '<span class="page-numbers dots">&hellip;</span>';
            $arr_return[]   = '<a href="javascript:void(0);" class="page-blank"><em>...</em></a>';
        }
        if($pages > 1) {
            if($pages == $page_id) {
                $arr_return[]   = '<span class="cur"><em>'.$pages.'</em></span>';
            } else {
                $arr_return[]   = '<a href="'.$url.$pages.'"><em>'.$pages.'</em></a>';
            }
        }
        if($page_id < $pages) {
            $arr_return[]       = '<a href="'.$url.($page_id+1).'" class="next"><em>下一页»</em></a>';
        } else {
            $arr_return[]   = '<a href="javascript:void(0);" class="next page-blank"><em>下一页»</em></a>';
        }

        $str_return = implode('', $arr_return);
        if($pages < 2)
        {
            $str_return = "";
        }
        return '<div class="page"><fieldset><legend>分页</legend>'.$str_return.'</fieldset></div>';
    }/*}}}*/

    /**
     * Valid Email
     * @access  public
     * @param   string
     * @return  bool
     */
    public static function valid_email($str)
    {/*{{{*/
        return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? false : true;
    }/*}}}*/

    /**
     * 字符串转义.
     * @param $obj
     * @return string
     */
    public static function htmlspecialchars($obj)
    {/*{{{*/
        if(is_string($obj))
        {
            return htmlspecialchars($obj);
        }
        else if(is_array($obj))
        {
            foreach($obj as &$v)
            {
                $v = self::htmlspecialchars($v);
            }
        }
        return $obj;
    }/*}}}*/

    public static function curl_query($pushurl = '', $data = '')
    {/*{{{*/
        $max_retry_times = 3;//curl 重试次数
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_URL, $pushurl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        $errno = curl_errno($ch);
        $retrys = 0;
        while($errno && $retrys < $max_retry_times)
        {
            ++$retrys;
            $result = curl_exec($ch);
            $errno = curl_errno($ch);
            if (!$errno) break;
        }
        curl_close($ch);
        return $result;
    }/*}}}*/ 

}/*}}}*/
