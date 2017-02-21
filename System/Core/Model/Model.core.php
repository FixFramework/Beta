<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Core\Model;

use System\Error\FIX_Error;
use System\Router\FIX_Router;

class Model
{


    /**
     * @param null $Model
     * @param null $Application
     * @return bool
     */
    public static function get($Model = null, $Application = null){

        $Application ? $Application = $Application: $Application = FIX_Router::appDedection();

        if(file_exists( $Application . FIX_SLASH . FIX_APP_MODEL_DIR. FIX_SLASH . $Model . FIX_CORE_EXTENSIONS )){

            include( $Application . FIX_SLASH . FIX_APP_MODEL_DIR. FIX_SLASH . $Model . FIX_CORE_EXTENSIONS );

            return new $Model();



        }else { die(FIX_Error::fix()->SystemModelExtensionError($Application. " Non Application Or Model")->Run()); }

    }


}
