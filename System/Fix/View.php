<?php
/**
 * Created by PhpStorm.
 * User: cengiz
 * Date: 10.1.2017
 * Time: 21:43
 */

namespace System\Fix;


class View
{


    /**
     * @param null $View
     * @param array $data
     * @return bool
     */
    public static function render($View = null, array $data = []){

        if(file_exists( FIX_SYS_DIR  . FIX_SYS_VIEWS_DIR . $View . FIX_CORE_EXTENSIONS )){

           include(FIX_SYS_DIR  . FIX_SYS_VIEWS_DIR . $View . FIX_CORE_EXTENSIONS);

        } else { return false; }

    }



}