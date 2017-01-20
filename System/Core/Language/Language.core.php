<?php

namespace System\Core\Language;


class Language
{

    public static $browserlanguage = "";


    public static function fix(){

        return new self();

    }

    /**
     * @return string
     */
    public static function getlanguage(){

        self::$browserlanguage = substr(
            $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            0,
            2
        );

        return self::$browserlanguage;

    }


}