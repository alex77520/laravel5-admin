<?php
class Cachebase{
    private $m = null;

    public function __construct($cachename, $config = array())
    {
        if(!$this->$m instanceof $cachename.'driver')
        {
            $this->$m = new $cachename.'driver'($config);
        }
    }

    public function add_server($configServer)
    {
        return $this->$m->addserver($configServer);
    }

    public function add($key = null, $value = null, $expiration = 0)
    {
        return $this->$m->add($key, $value, $expiration);
    }

    public function addmulti($key, $expiration = 0)
    {
        foreach($key as $multi)
        {
            $result[$multi['key']] = $this->$m->add($multi['key'], $multi['value'], $expiration);
        }
        return $result;
    }

    public function set($key = null, $value = null, $expiration = 0)
    {
        return  $this->$m->set($key, $value, $expiration);
    }

    public function setmulti($key, $expiration = 0)
    {
        return $this->$m->setMulti($key, $expiration);
    }

    public function get($key = null)
    {
        return $this->$m->get($key);
    }

    public function getmulti($key = null)
    {
        return $this->$m->getMulti($key);
    }

    public function delete($key, $expiration = 0)
    {

        return $this->$m->delete($key, $expiration);
    }

    public function deletemulti($key, $expiration = 0)
    {

        return $this->$m->deletemulti($key, $expiration);
    }

    public function replace($key = null, $value = null, $expiration = 0)
    {
        return $this->$m->replace($key, $value, $expiration);
    }

    public function replacemulti($key = null, $expiration = 0)
    {
        foreach ($key as $multi)
        {
            $result[$multi['key']] = $this->$m->replace($multi['key'], $multi['value'], $expiration);
        }
        return $result;
    }

    public function flush()
    {
        return $this->$m->flush();
    }

    public function getversion()
    {
        return $this->$m->getversion();
    }

    public function getstats($type="items")
    {
        return $this->$m->getstats();
    }

    public function append($key = null, $value = null)
    {
        return $this->$m->append($key, $value);
    }
}
