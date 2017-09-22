<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Fix;


class Fix
{


    public static function show(){

        $data["title"]          = "Fix Framework";
        $data["hood"]           = "Fix Framework";
        $data["subtitle"]       = "Feature New Platform | © 2016 ";

        View::render( "Fix/Fix", $data );

    }


    /**
     *
     */
    public static function maintenance(){

        $data["title"]          = "Maintenance Mode";
        $data["hood"]           = "Maintenance Mode";
        $data["subtitle"]       = "Old Cotton Cargo | © 2017 ";

        View::render( "Fix/Fix", $data );

    }

    /**
     * @param array $_Request
     */
    public static function error($_Request = []){

        $data["title"]          = "Error Debug";
        $data["debug"]          = $_Request;

        View::render( "Error/Error", $data );

    }


    /**
     * @param null $target
     * @param int $sec
     * @return string
     */
    public static function htmlheader($target = null, $sec = 0){

        echo "<meta http-equiv='refresh' content='{$sec};URL={$target}'>";

    }


}