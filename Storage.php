<?php

abstract class  Storage {

    /**
     * @var string
     */
    protected  $pass;
    /**
     * @var int
     */
    protected  $storageId;
    /**
     * @var int
     */
    protected  $ttl = 0;

    /**
     *
     */
    public function __construct(){
        $this->pass = "";
        $this->ttl = 0;
        $this->storageId = 0;
    }

    /**
     * @param $key
     * @param $val
     * @return mixed
     */
    abstract function set($key,$val);

    /**
     * @param $key
     * @return mixed
     */
    abstract function get($key);

    /**
     * @param $key
     * @param $val
     * @return mixed
     */
    abstract function update($key,$val);

    /**
     * @param $key
     * @return mixed
     */
    abstract function del($key);

    /**
     * @return int
     */
    public function getTTL(){
        return $this->ttl;
    }

} 