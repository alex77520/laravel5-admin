<?php

namespace App\Services;

use Redis;

class RedisDriver
{/*{{{*/

    var $connection = null;
    var $reporterror = true;
    var $logerrors = true;
    var $errorpath = '';
    var $usetime = true;

    /**
     * 初始化
     * @param $params
     */
    public function __construct($params)
    {/*{{{*/
        //$this->errorpath = QFrameConfig::getConfig( 'LOG_PATH' );
        $this->config_connect($params);
        return true;
    }/*}}}*/

    public function __call($func, $params)
    {/*{{{*/
        return call_user_func_array(array($this->connection, $func), $params);
    }/*}}}*/

    public function config_connect($params)
    {/*{{{*/
        $this->connect($params['host'], $params['port'], $params['timeout'], $params['auth']);
    }/*}}}*/

    public function connect($hostname, $port, $timeout, $auth)
    {/*{{{*/
        $pagestarttime = microtime();
        $port = $port ? $port : 9341;
        $this->connection = new Redis();
        $result = false;
        try{
            $result = $this->connection->connect($hostname, $port, $timeout);
            $this->connection->auth($auth);
        }catch(Exception $e){
            //$err_log = "redis error\tconnect\t".$e->getMessage() . "\t" . $hostname . "\t" . $port;
            //LogSvc::getBizErrLog()->log($err_log);
        }
        $this->write_use_time($pagestarttime, "", "Connect REDIS:[$hostname:$port]");
        return $result;
    }/*}}}*/

    public function set($key, $value, $exprire = 0)
    {/*{{{*/
        if(!$exprire)
        {
            $res = $this->connection->set($key, $value);
        }
        else
        {
            $res = $this->connection->setex($key, $exprire, $value);
        }

        $pagestarttime = microtime();
        $this->write_use_time($pagestarttime, "set :".$key."->".$value, __FUNCTION__);
        return $res;
    }/*}}}*/

    public function get($key)
    {/*{{{*/
        $pagestarttime = microtime();
        $res = $this->connection->get($key);
        if('nil' === $res){
            return false;
        }
        $this->write_use_time($pagestarttime, "get :".$key, __FUNCTION__);
        return $res;
    }/*}}}*/

    public function mset($params)
    {/*{{{*/
        if(!is_array($params)){
            return false;
        }
        $arr = array();
        foreach($params as $k=>$v){
            $arr[$k] = $v;
        }
        return $this->connection->mset($arr);
    }/*}}}*/

    public function delete($key)
    {/*{{{*/
        return $this->connection->delete($key);
    }/*}}}*/

    public function mget($params)
    {/*{{{*/
        return $this->connection->mget($params);
    }/*}}}*/

    private function key_exists($key)
    {/*{{{*/
        if($this->connection->exists($key)){
            return true;
        }else{
            return false;
        }
    }/*}}}*/

    public function list_queue($op, $key, $value='')
    {/*{{{*/
        $pagestarttime = microtime();
        if(empty($op)) return false;
        switch ($op) {
            case 'lpush':
                $result = $this->connection->lPush($key, $value);
                break;
            case 'rpush':
                $result = $this->connection->rPush($key, $value);
                break;
            case 'lpop':
                $result = $this->connection->lPop($key);
                break;
            case 'rpop':
                $result = $this->connection->rPop($key);
                break;;
            case 'blpop':
                $result = $this->connection->blPop($key, 1);
                break;
            case 'brpop':
                $result = $this->connection->brPop($key, 1);
                break;
            default:
                return false;
        }
        $this->write_use_time($pagestarttime, $op." :".$key."->".$value, __FUNCTION__);
        return $result;
    }/*}}}*/

    public function lpush($key, $value)
    {/*{{{*/
        $result = $this->connection->lPush($key, $value);
        return $result;
    }/*}}}*/
    public function rpush($key, $value)
    {/*{{{*/
        $result = $this->connection->rPush($key, $value);
        return $result;
    }/*}}}*/
    public function lpop($key)
    {/*{{{*/
        $result = $this->connection->lPop($key);
        return $result;
    }/*}}}*/
    public function rpop($key)
    {/*{{{*/
        $result = $this->connection->rPop($key);
        return $result;
    }/*}}}*/
    public function lrange($key, $s = 0, $e = -1)
    {
        return $this->connection->lRange($key, $s, $e);
    }
    public function blpop($key, $timeout=1)
    {/*{{{*/
        $result = $this->connection->blPop($key, $timeout);
        return $result;
    }/*}}}*/

    public function brpop($key, $timeout=1)
    {/*{{{*/
        $result = $this->connection->brPop($key, $timeout);
        return $result;
    }/*}}}*/

    public function hgetall($key)
    {/*{{{*/
        $result = $this->connection->hgetall($key);
        return $result;
    }/*}}}*/

    public function zadd($key, $value)
    {/*{{{*/
        array_unshift($value, $key);
        return call_user_func_array(array($this->connection, 'zadd'), $value);
    }/*}}}*/

    public function zrem($key, $value)
    {/*{{{*/
        return $this->connection->zrem($key, $value);
    }/*}}}*/

    public function zscore($key, $value)
    {/*{{{*/
        return $this->connection->zscore($key, $value);
    }/*}}}*/

    public function zrevrangebyscore($key, $offset, $nums)
    {/*{{{*/
        return $this->connection->zrevrangebyscore($key, '+inf', '-inf', array('withscores' => false, 'limit' => array($offset, $nums)));
    }/*}}}*/


    private function halt($errortext = '')
    {/*{{{*/
        if ($this->logerrors) {
            $this->write_logs("redis_error_".date("Ymd").".log", $errortext);
        }
    }/*}}}*/

    public function srandmember($key, $num)
    {
        return $this->connection->srandmember($key, $num);
    }

    private function write_use_time($pagestarttime, $msg, $ext = "")
    {/*{{{*/
        if (false === $this->usetime)
        {
            return false;
        }
        $starttime = explode(' ', $pagestarttime);
        $endtime = explode(' ', microtime());
        $totaltime = $endtime[0] - $starttime[0] + $endtime[1] - $starttime[1];
        $usedtime = number_format($totaltime, 5);
        $outStr = "Redis used times \t".$usedtime."\tSQL:".$msg."\t".$ext."\t".getenv('REMOTE_ADDR')."\t".date("Y-m-d H:i:s")."\n";
        $this->write_logs("redis_used_time_".date("Ymd").".log", $outStr);
        return true;
    }/*}}}*/

    private function write_logs($filename, $str)
    {/*{{{*/
        return true;//暂关闭log启用logsvc
        $str = trim($str);
        if (strlen($str) == 0)
        {
            return false;
        }
        $thisfile = $this->errorpath;
        $thisfile .= $filename;
        //@error_log($str."\n", 3, $thisfile);
        return true;
    }/*}}}*/
}/*}}}*/
