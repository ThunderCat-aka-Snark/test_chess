<?php

require "Storage.php";
require "/predis/autoloader.php";
Autoloader::register();

/**
 * Class Redis
 */
class Redis extends Storage{

    /**
     * @var PredisClient
     */
    private $ds;

    /**
     *
     */
    public function __construct(){
        parent::__construct();
        try {
            $this->ds = new PredisClient();
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $key
     * @param $val
     * @return mixed
     */
    public function set($key,$val){
        $res = $this->ds->set($key,$val);
        if($this->ttl > 0){
            $this->ds->expire($key,$this->ttl);
        }
        return $res;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key){
        $res = $this->ds->get($key);
        return $res;

    }

    /**
     * @param $key
     * @param $val
     * @return mixed
     */
    public function update($key,$val){
        $res = $this->ds->set($key,$val);
        return $res;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function del($key){
        $res = $this->ds->del($key);
        return $res;
    }




} 