<?php
/**
 * Created by PhpStorm.
 * User: cengiz
 * Date: 3.1.2017
 * Time: 20:39
 */

namespace System\Core;


class View
{

    /**
     * @param null $View
     * @param array $data
     * @param null $Application
     * @return bool
     */
    public static function render($View = null, array $data = [], $Application = null){

        $Application ? $Application = $Application: $Application = FIX_URL;

        if(file_exists( FIX_APP_DIR . $Application . FIX_SLASH . FIX_APP_VIEWS_DIR . $View . FIX_CORE_EXTENSIONS )){

            include( FIX_APP_DIR . $Application . FIX_SLASH . FIX_APP_VIEWS_DIR . $View . FIX_CORE_EXTENSIONS );

        } else { return false; }

    }

}
