<?php

namespace System\Console;

use System\Core\Json\Json;
use System\Error\FIX_Error;
use System\Fix\Creator;
use System\Router\FIX_Router;
use System\Core\Benchmark\Benchmark;
use System\Fix\ConsoleCreator;

class FIX_Memory {


    /**
     * @param array ...$args
     * @return string
     */
    public static function help(...$args){

        return "Fix Framework Yardım Alanı";

    }


    /**
     * @param array ...$Params
     * @return string
     */
    public static function creator(...$Params){

       count($Params) !== 3 ? exit("Parametreleri boş bırakmayınız.") : null;

        $__Creator =
            ConsoleCreator::CreateFolder(
            [
                "app"               => $Params[0],
                "controller"        => $Params[1],
                "function"          => $Params[2],
                "error"             => "/",
                "url"               => "url",
                "method"            => "get",
                "dbserver"           => null,
                "dbusername"        => null,
                "dbpassword"        => null,
                "dbtable"           => null
            ]
        );

        $Text   = FIX_EOL;

        foreach ($__Creator as $key => $item) { $Text .= $item[0].FIX_EOL; }

        return FIX_EOL.$Text;

    }

    /**
     * @return string
     */
    public static function benchmark(){

        return Benchmark::run();

    }

}