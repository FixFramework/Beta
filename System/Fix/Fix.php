<?php

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
     * @param null $target
     * @param int $sec
     * @return string
     */
    public static function htmlheader($target = null, $sec = 0){

        echo "<meta http-equiv='refresh' content='{$sec};URL={$target}'>";

    }


}