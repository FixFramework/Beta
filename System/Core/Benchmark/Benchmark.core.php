<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */

namespace System\Core\Benchmark;

class Benchmark {

    /**
     * @param int $count
     * @return string
     */
    private static function test_Math($count = 140000) {

        $time_start = microtime(true);
        $mathFunctions = array("abs", "acos", "asin", "atan", "bindec", "floor", "exp", "sin", "tan", "pi", "is_finite", "is_nan", "sqrt");
        foreach ($mathFunctions as $key => $function) {
            if (!function_exists($function)) unset($mathFunctions[$key]);
        }
        for ($i=0; $i < $count; $i++) {
            foreach ($mathFunctions as $function) {
                $r = call_user_func_array($function, array($i));
            }
        }
        return number_format(microtime(true) - $time_start, 3);
    }


    /**
     * @param int $count
     * @return string
     */
    private static function test_StringManipulation($count = 130000) {
        $time_start = microtime(true);
        $stringFunctions = array("addslashes", "chunk_split", "metaphone", "strip_tags", "md5", "sha1", "strtoupper", "strtolower", "strrev", "strlen", "soundex", "ord");
        foreach ($stringFunctions as $key => $function) {
            if (!function_exists($function)) unset($stringFunctions[$key]);
        }
        $string = "the quick brown fox jumps over the lazy dog";
        for ($i=0; $i < $count; $i++) {
            foreach ($stringFunctions as $function) {
                $r = call_user_func_array($function, array($string));
            }
        }
        return number_format(microtime(true) - $time_start, 3);
    }


    /**
     * @param int $count
     * @return string
     */
    private static function test_Loops($count = 19000000) {
        $time_start = microtime(true);
        for($i = 0; $i < $count; ++$i);
        $i = 0; while($i < $count) ++$i;
        return number_format(microtime(true) - $time_start, 3);
    }


    /**
     * @param int $count
     * @return string
     */
    private static function test_IfElse($count = 9000000) {
        $time_start = microtime(true);
        for ($i=0; $i < $count; $i++) {
            if ($i == -1) {
            } elseif ($i == -2) {
            } else if ($i == -3) {
            }
        }
        return number_format(microtime(true) - $time_start, 3);
    }

    /**
     * @param bool|true $echo
     * @return string
     */
    public static function run ($echo = true) {
        $total = 0;
        $server = (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '?') . '@' . (isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '?' );
        $methods = get_class_methods(new benchmark());
        $line = str_pad("-",38,"-");
        $return = "<pre>$line\n|".str_pad("FIX FRAMEWORK BENCHMARK ",36," ",STR_PAD_BOTH)."|\n$line\nStart : ".date("Y-m-d H:i:s")."\nServer : $server\nPHP version : ".PHP_VERSION."\nPlatform : ".PHP_OS. "\n$line\n";

        if (is_array($methods) || is_object($methods))
        {
            foreach ($methods as $method) {
                if (preg_match('/^test_/', $method)) {
                    $total += $result = self::$method();
                    $return .= str_pad($method, 25) . " : " . $result ." sec.\n";
                }
            }
        }

        $return .= str_pad("-", 38, "-") . "\n" . str_pad("Total time:", 25) . " : " . $total ." sec.</pre>";
        if ($echo) echo $return;
        return $return;
    }

}


	
