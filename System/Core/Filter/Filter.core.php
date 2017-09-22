<?php

namespace System\Core\Filter;


class Filter
{

    /**
     * @param null $_htmlClean
     * @return bool|string
     */
    public static function htmlClear($_htmlClean = null){

        return isset($_htmlClean)  ? strip_tags($_htmlClean) : false;

    }



    /**
     * @param null $_strRepeat
     * @return bool|string
     */
    public static function strRepeat($_strRepeat = null){

        return isset($_strRepeat)  ? str_repeat($_strRepeat) : false;

    }


    /**
     * @param null $_wordCount
     * @return bool|mixed
     */
    public static function wordCount($_wordCount = null){

        return isset($_wordCount)  ? str_word_count($_wordCount) : false;

    }


    /**
     * @return bool
     */
    public static function post(){

        return $_POST  ? true : false;

    }


    /**
     * @param null $_postData
     * @return bool
     */
    public static function postData($_postData = null,$_XssFilter = false){

        return isset($_POST[$_postData])  ? $_XssFilter ? self::xss($_POST[$_postData]) : $_POST[$_postData] : false;

    }

    /**
     * @return bool
     */
    public static function get(){

        return $_GET ? true : false;

    }

    /**
     * @param bool $_Xss
     * @return mixed
     */
    public static function xss($_Xss = false){

        return filter_var($_Xss, FILTER_SANITIZE_STRING);

    }

    /**
     * @param null $_getData
     * @return bool
     */
    public static function getData($_getData = null){

        return isset($_GET[$_getData])  ? $_GET[$_getData] : false;

    }


    /**
     * @param null $_Pattern
     * @param null $_Repeatter
     * @param null $_Data
     * @return bool
     */
    public static function strReplace($_Pattern = null, $_Repeatter = null, $_Data = null){

        return isset($_strRepeat) and isset($_Repeatter) and isset($_Data)  ? str_replace($_Pattern,$_Repeatter,$_Data) : false;

    }



}