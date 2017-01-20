<?php

namespace System\Fix;


class Fix
{


    public static function show(){


        $data["title"]          = "Fix Framework V2";
        $data["hood"]           = "Fix Framework V2";
        $data["subtitle"]       = "Feature New Platform | © 2016 ";

        View::render( "Fix", $data );


    }


}