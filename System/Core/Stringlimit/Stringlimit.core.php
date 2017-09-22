<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Core\Stringlimit;


class Stringlimit
{


    /**
     * @param null $String
     * @param int $Start
     * @param string $Separator
     * @return string
     */
    public static function convert($String = null,$Start = 0,$Separator = "..."){

        $count = strlen($String);
        if($count > $Start){
            $Limited	 = mb_substr($String,0,$Start, "utf-8");
            $Limited	.= $Separator;
        }else if (($count == $Start) or ($count <= $Start)){
            $Limited     = $String.$Separator;
        }
        return $Limited;

    }

}