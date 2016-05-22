<?php
class Memcachedriver{
    private $memcache = null;

    public function __construct($config)
    {
        $this->memcache = new Memcached;
        $this->add_server($config);
    }

    public function __destructor()
    {
        $this->close;
    }

    public  function connect($host, $port=11211, $expire=1)
    {
        return $this->memcache->connect($host, $port, $expire);
    }

    public function add_server($config)
    {
        extract($config);
        return $this->memcache->addServer($host, $port);
    }

    public function add($key, $var, $expire=10)
    {
        return $this->memcache->add($key, $var, $expire);
    }

    public function set($key, $var, $expire=10)
    {
        return $this->memcache->set($key, $var, $expire);
    }

    public function setMulit($key, $var, $expire=10)
    {
        return $this->memcache->setMulit($key, $var, $expire);
    }

    public function get($key)
    {
        return $this->memcache->get($key);
    }

    public function getMulit($key)
    {
        return $this->memcache->getMulit($key);
    }

    public function delete($key, $expire=1)
    {
        return $this->memcache->delete($key, $expire);
    }

    public function deleteMulit($key, $expire=1)
    {
        return $this->memcache->deleteMulit($key, $expire);
    }

    public function flush()
    {
        return $this->memcache->flush();
    }

    public function close()
    {
        return $this->memcache->close();
    }

    public function replace($key, $var, $expire=1)
    {
        return $this->memcache->replace($key, $var, $expire);
    }

    public function getversion()
    {
        return $this->memcache->getVersion();
    }

    public function getstats($type="items")
    {
        return $this->memcache->etStats();
    }

    public function append($key = NULL, $value = NULL)
    {
        return $this->memcache->append($key, $value);
    }

    public function setCompressThreshold($threshold, $min_saveings=0.2)
    {
        return $this->memcache->set_compress_threshold($threshold, $min_saveings);
    }

    public function getServerStatus($host, $port=11211)
    {
        return $this->memcache->get_server_status($host, $port);
    }

    public function getExtendedStats($type='', $slabid=0, $limit=100)
    {
        return $this->memcache->get_extended_stats($type, $slabid, $limit);
    }
}
