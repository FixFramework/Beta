<?php

namespace System\Console;

class FIX_Console
{

    /**
     * @return bool
     */
    private static function isConsole(){

        return FIX_URL === "console" ? true : false;

    }

    /**
     * @param $args
     * @return null|void
     */
    private static function systemStop($args){

        return   self::isConsole() ? die(self::controlCommands($args)) : null;

    }

    /**
     * @param $args
     * @return mixed|string
     */
    private static function controlCommands($args){

        count($args) >! 0 ? exit("php fix help | Komutunu yazını.") : null;

        $Memory__   = new FIX_Memory($args);

        $Function__ = $args[1];

        if(method_exists($Memory__, $Function__)) :

            unset($args[0],$args[1]);

            return call_user_func_array(array($Memory__, $Function__), $args);

        else:

            return "Command not found";

        endif;

    }

    /**
     * @param string $args
     * @return null|void
     */
    public static function run($args = ""){

       return isset($_SERVER['argv']) ? self::systemStop($_SERVER['argv']) : null;

    }

}