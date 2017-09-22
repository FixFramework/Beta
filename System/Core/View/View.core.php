<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Core\View;


use System\Error\FIX_Error;
use System\Router\FIX_Router;

class View
{

    /**
     * @param null $View
     * @param array $data
     * @param null $Application
     * @return bool
     */
    public static function render($View = null, array $data = [], $Application = null){

        $Application ? $Application = $Application: $Application = FIX_Router::appMultipleStatus();

        if(file_exists( FIX_APP_DIR . FIX_SLASH . $Application . FIX_SLASH . FIX_APP_VIEWS_DIR. FIX_SLASH . $View . FIX_CORE_EXTENSIONS )){

            extract($data);

            include( FIX_APP_DIR . FIX_SLASH . $Application . FIX_SLASH . FIX_APP_VIEWS_DIR. FIX_SLASH . $View . FIX_CORE_EXTENSIONS );

        } else { die(FIX_Error::fix()->Custom("View","Not Found ( ".$View." ) View File","404","error")->run()); }

    }

}
