<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Core\Hidestring;


class Hidestring
{


    /**
     * @param null $String
     * @param int $Start
     * @param int $End
     * @return string
     */
    public static function render($String = null, $Start = 0, $End = 0,$Separator = "*"){

        $After  = mb_substr($String, 0, $Start, "utf8");
        $Repeat = str_repeat($Separator, $End);
        $Before = mb_substr($String, ($Start + $End), strlen($String), "utf8");

        return $After.$Repeat.$Before;

    }


}