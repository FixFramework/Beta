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


}