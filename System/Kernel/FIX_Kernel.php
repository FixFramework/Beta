<?php

namespace System\Kernel;

use System\Core\Header as Header;
use System\Error\FIX_Error as Json;
use System\Router\FIX_Router as Router;
use System\Settings\FIX_Settings as Settings;

class FIX_Kernel
{

    public function __construct(){

        if( Router::detectionurl() ){

            Router::run();

                if( file_exists( FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_URL )){

                    if( file_exists( FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_URL . FIX_SLASH . FIX_APP_CONTROLLER_DIR . Router::kernelcontroller() . FIX_CORE_EXTENSIONS ) ){

                        include( FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_URL . FIX_SLASH . FIX_APP_CONTROLLER_DIR . Router::kernelcontroller() . FIX_CORE_EXTENSIONS );

                        $Start          = Router::kernelcontroller();
                        $Controller     = new $Start();

                        if(method_exists($Start,Router::kernelfunction())){

                            call_user_func_array([$Controller, Router::kernelfunction()],Router::kernelparams(1));

                        }else{  call_user_func_array([$Controller, Settings::$applications[FIX_URL]["function"]],Router::kernelparams(0)); }

                    }else{  if( Router::kernelcontroller() === "home" ) { echo Json::fix()->SystemApplicationDefaultNotFoundController()->Run(); }else{ Header::location(Settings::$applications[FIX_URL]["errorpage"]); } }

                }else{  echo Json::fix()->SystemApplicationNotFoundFolder()->Run();  }

           }else{ echo Json::fix()->SystemKernelReportingErrorMessageToDomain()->Run(); }

    }

}