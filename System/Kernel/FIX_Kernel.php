<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */

namespace System\Kernel;

use System\Error\FIX_Error;
use System\Fix\Fix;
use System\Router\FIX_Router;

class FIX_Kernel
{

    public function __construct(){

        date_default_timezone_set('Europe/Istanbul');

        if( FIX_Router::detectionurl() ){

            if( FIX_Router::detectionurlconfig() ){

                FIX_Router::run();

                    if( file_exists( FIX_Router::appDedection() . FIX_SLASH . FIX_APP_CONTROLLER_DIR . FIX_Router::kernelcontroller() . FIX_CORE_EXTENSIONS ) ){

                        include( FIX_Router::appDedection() . FIX_SLASH . FIX_APP_CONTROLLER_DIR . FIX_Router::kernelcontroller() . FIX_CORE_EXTENSIONS );

                        $Start          = FIX_Router::kernelcontroller();
                        $Controller     = new $Start();

                        if(method_exists($Controller,FIX_Router::kernelfunction())){

                            call_user_func_array([$Controller, FIX_Router::kernelfunction()],FIX_Router::kernelparams(1));

                        }else{

                            if(method_exists($Controller,FIX_Router::getConfig()["function"])){

                                call_user_func_array([$Controller, FIX_Router::getConfig()["function"]],FIX_Router::kernelparams(0));

                            } else{ die(FIX_Error::fix()->SystemApplicationControllerInFunctionNotFound()->Run()); }
                        }

                    }else{

                        if( !file_exists(FIX_Router::appDedection() . FIX_SLASH . FIX_APP_CONTROLLER_DIR . FIX_Router::getConfig()["controller"] . FIX_CORE_EXTENSIONS) )  {

                            die(FIX_Error::fix()->SystemApplicationDefaultNotFoundController()->Run());

                        }  else { Fix::htmlheader(FIX_Router::getConfig()["error"],0); }

                    }

            }else{ die(FIX_Error::fix()->SystemKernelReportingErrorMessageToDomainConfig()->Run()); }

        }else{ FIX_Router::Creator(); }

    }

}