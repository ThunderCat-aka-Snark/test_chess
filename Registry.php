<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TC
 * Date: 17.09.13
 * Time: 23:17
 * To change this template use File | Settings | File Templates.
 */

class Registry {

    private static $storage = array();

    public static function set($key, $value) {
        self::$storage[$key] = $value;
        return true;
    }

    public static function get($key) {
        return self::$storage[$key];
    }
}