<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */


namespace System\Fix;

class View
{


    /**
     * @param null $View
     * @param array $data
     * @return bool
     */
    public static function render($View = null, array $data = []){

        if(file_exists(FIX_SYS_DIR. FIX_SLASH. FIX_SYS_VIEWS_DIR. FIX_SLASH . $View . FIX_CORE_EXTENSIONS)){

            include(FIX_SYS_DIR. FIX_SLASH . FIX_SYS_VIEWS_DIR. FIX_SLASH . $View . FIX_CORE_EXTENSIONS);

        } else { return false; }

    }


}