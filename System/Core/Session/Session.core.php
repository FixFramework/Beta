<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Core\Session;


class Session
{

    /**
     * @return bool
     */
    public static function start(){

        return session_start(); ob_start();

    }

    /**
     * @return bool
     */
    public static function finish(){

        return session_destroy();

    }

    /**
     * @return bool
     */
    public static function isSession($_PARAMS = null){

        return isset($_SESSION[$_PARAMS]);

    }


    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function add($key,$value){

        return $_SESSION[$key] = $value;

    }

    /**
     * @param $key
     * @return mixed
     */
    public static function view($key){

        return $_SESSION[$key];

    }

    /**
     * @return array
     */
    public static function sessionhistory(){

        $old_sessionid = session_id();
            session_regenerate_id();
        $new_sessionid = session_id();

        return [ $old_sessionid, $new_sessionid ];

    }

    /**
     * @param array $array
     */
    public static function set(array $array){

        if(is_array($array)){

            foreach ($array as $key => $val) {

               self::add($key,$val);

            }

        }

    }


}