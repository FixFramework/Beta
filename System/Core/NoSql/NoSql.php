<?php

namespace System\Core\NoSql;


class NoSql
{

    protected static $_Select = "";
    protected static $_Insert = "";
    protected static $_Delete = "";
    protected static $_Update = "";


    public static function Start(){

        return new self();

    }

    public function Select($_Select = ""){

        self::$_Select = $_Select;
        return $this;

    }



    public function run(){

        return self::$_Select;

    }

}