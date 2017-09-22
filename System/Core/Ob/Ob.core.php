<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Core\Ob;


class Ob
{

    /**
     * @return bool
     */
    public static function start($_Params = null){

        return ob_start($_Params);

    }

    /**
     * @return bool
     */
    public static function end(){

        return ob_end_flush();

    }


    /**
     * @return bool
     */
    public static function clean(){

        return ob_end_clean();

    }




}