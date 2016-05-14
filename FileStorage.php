<?php


class FileStorage extends Storage{

    /**
     * @var string
     */
    private $storeDir;
    /**
     * @var string
     */
    private $fileExt = "sav";

    /**
     *
     */
    public function __construct(){
        $this->storeDir = $_SERVER["DOCUMENT_ROOT"]."/save";
    }


    /**
     * @param $key
     * @param $val
     * @return int
     */
    public function set($key,$val){
        $fileName = $this->getFileName($key);
        $f = fopen($fileName,'w+');
        $res = fwrite($f,$val);
        return $res;
    }

    /**
     * @param $key
     * @return bool|string
     */
    public function get($key){
        $fileName = $this->getFileName($key);
        if($this->ttl > 0){
            if(time()- filectime($fileName) > $this->ttl){
                unlink($fileName);
                return $res = false;
            }
        }
        $f = fopen($fileName,'r');
        if($f !== false){
            $res = fgets($f);
        }
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

    /**
     * @param $key
     * @return string
     */
    private function getFileName($key){
        return $fileName = $this->storeDir."/$key.$this->fileExt";
    }

} 