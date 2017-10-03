<?php

namespace System\Console;

use System\Core\Json\Json;
use System\Error\FIX_Error;
use System\Fix\Creator;
use System\Router\FIX_Router;
use System\Core\Benchmark\Benchmark;

class FIX_ConsoleMemory {


    public static function help(...$args){ return "Çok Yakında"; }



    /**
     * @return string
     */
    public static function benchmark(){

        return Benchmark::run();

    }

}