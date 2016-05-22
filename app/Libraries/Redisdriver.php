<?php

class Redis{

    private $redis = null;


    public function __construct($config) {
        $this->redis = new Redis();
        $this->redis->connect($config['host'], $config['port']);
        return $this->redis;
    }

    public function connect($config)
    {
        extract($config);
        return $this->redis->connect($host = '', $port = '');

    }

    public function set($key, $value, $timeOut) {
        $value = json_encode($value, TRUE);
        $retRes = $this->redis->set($key, $value);
        if ($timeOut > 0) $this->redis->setTimeout($key, $timeOut);
        return $retRes;
    }

    public function get($key) {
        $result = $this->redis->get($key);
        return json_decode($result, TRUE);
    }


    public function delete($key) {
        return $this->redis->delete($key);
    }

    public function flushAll() {
        return $this->redis->flushAll();
    }

    public function push($key, $value ,$right = true) {
        $value = json_encode($value);
        return $right ? $this->redis->rPush($key, $value) : $this->redis->lPush($key, $value);
    }

    public function pop($key , $left = true) {
        $val = $left ? $this->redis->lPop($key) : $this->redis->rPop($key);
        return json_decode($val);
    }

    public function increment($key) {
        return $this->redis->incr($key);
    }

    public function decrement($key) {
        return $this->redis->decr($key);
    }

    public function exists($key) {
        return $this->redis->exists($key);
    }

    public function redis() {
        return $this->redis;
    }

    public function close()
    {
        return $this->redis->close();
    }
}