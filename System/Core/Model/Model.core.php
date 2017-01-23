<?php

namespace System\Core\Model;

use System\Error\FIX_Error;

class Model
{


    /**
     * @param null $Model
     * @param null $Application
     * @return bool
     */
    public static function get($Model = null, $Application = null){

        $Application ? $Application = $Application: $Application = FIX_URL;

        if(file_exists( FIX_APP_DIR . $Application . FIX_SLASH . FIX_APP_MODEL_DIR . $Model . FIX_CORE_EXTENSIONS )){

            include( FIX_APP_DIR . $Application . FIX_SLASH . FIX_APP_MODEL_DIR . $Model . FIX_CORE_EXTENSIONS );

            return new $Model();

        }else { die(FIX_Error::fix()->SystemModelExtensionError($Application. " Non Application Or Model")->Run()); }

    }


}