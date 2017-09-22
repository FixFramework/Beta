<?php

namespace System\Core\Is;

class Is
{

    /**
     * @param null $Email
     * @return mixed
     */
    public static function is_email($Email = null){

        return filter_var($Email, FILTER_VALIDATE_EMAIL);

    }


    /**
     * @param null $Ip
     * @return mixed
     */
    public static function is_ip($Ip = null){

        return filter_var($Ip, FILTER_VALIDATE_IP);

    }


    /**
     * @param null $Int
     * @return mixed
     */
    public static function is_int($Int = null){

        return filter_var($Int, FILTER_VALIDATE_INT);

    }


    /**
     * @param null $Url
     * @return mixed
     */
    public static function is_url($Url = null){

        return filter_var($Url, FILTER_VALIDATE_URL);

    }


    /**
     * @param null $Regex
     * @return mixed
     */
    public static function is_regexp($Regex = null){

        return filter_var($Regex, FILTER_VALIDATE_REGEXP);

    }


    /**
     * @param null $Mac
     * @return mixed
     */
    public static function is_mac($Mac = null){

        return filter_var($Mac, FILTER_VALIDATE_MAC);

    }


    /**
     * @param null $Float
     * @return mixed
     */
    public static function is_float($Float = null){

        return filter_var($Float, FILTER_VALIDATE_FLOAT);

    }


    /**
     * @param null $Ipv4
     * @return mixed
     */
    public static function is_ipv4($Ipv4 = null){

        return filter_var($Ipv4, FILTER_FLAG_IPV4);

    }


    /**
     * @param null $Boolean
     * @return mixed
     */
    public static function is_boolean($Boolean = null){

        return filter_var($Boolean, FILTER_VALIDATE_BOOLEAN);

    }


    /**
     * @param array|null $array
     * @return bool
     */
    public static function is_array(array $array = null){

        return is_array($array);

    }

    /**
     * @param null $Object
     * @return bool
     */
    public static function is_object($Object = null){

        return is_object($Object);

    }

    /**
     * @param null $Numeric
     * @return bool
     */
    public static function is_numeric($Numeric = null){

        return is_numeric($Numeric);

    }

    /**
     * @param null $Dir
     * @return bool
     */
    public static function is_dir($Dir = null){

        return is_dir($Dir);

    }

    /**
     * @param null $File
     * @return bool
     */
    public static function is_file($File = null){

        return is_file($File);

    }

    /**
     * @param null $File
     * @return bool
     */
    public static function file_exists($File = null){

        return file_exists($File);

    }


    /**
     * @param null $Method
     * @return bool
     */
    public static function request_method($Method = null){

        return $_SERVER["REQUEST_METHOD"] == $Method ? true : false;

    }
}