<?php

namespace System\Router;

use System\Core\Header as Header;
use System\Error\FIX_Error;
use System\Settings\FIX_Settings as Setting;

class FIX_Router
{



    /**
     * @return bool
     */
    public static function detectionurl(){

        if(array_key_exists( FIX_URL, Setting::$applications )){  return true; }else{ return false; }

    }

    /**
     * @return array
     */
    public static function geturl(){

      if(self::systemrequestresponsemethod("CONTROL",Setting::$applications[FIX_URL]["geturl"]) && self::systemrequestresponsemethod("LOAD",Setting::$applications[FIX_URL]["geturl"])){

          return explode( "/" ,
              filter_var(
                  rtrim(
                      self::systemrequestresponsemethod("LOAD",Setting::$applications[FIX_URL]["geturl"]) , "/"
                  ),
                  FILTER_SANITIZE_URL
              )
          );

      }

    }

    public static function systemrequestresponsemethod($EXE = "CONTROL", $PARAM = null){

        if($EXE == "LOAD" && Setting::$applications[FIX_URL]["getmethod"] === "get")           { return $_GET[$PARAM];
        }else if($EXE == "LOAD" && Setting::$applications[FIX_URL]["getmethod"] === "post")    { return $_POST[$PARAM];
        }else if($EXE == "CONTROL" && Setting::$applications[FIX_URL]["getmethod"] === "get")  { return $_GET;
        }else if($EXE == "CONTROL" && Setting::$applications[FIX_URL]["getmethod"] === "post") { return $_POST; }

    }

    /*
     * Forbidden Url Control
     * */
    public static function urlforbiddendcontrol(){

        if(
            array_key_exists( FIX_URL, Setting::$applications ) &&
            array_key_exists( FIX_URL, Setting::$forbidden)     &&
            $_GET[self::systemrequestresponsemethod("LOAD",Setting::$applications[FIX_URL]["geturl"])] === Setting::$forbidden[FIX_URL]
        ){

           if(array_key_exists( FIX_URL, Setting::$forbidden_mode_url)){

                Header::location(Setting::$forbidden_mode_url[FIX_URL]);

           }else{ Header::notfound(); }

        }

    }

    /*
     * Forbidden Url Control
     * */
    public static function maintenancecontrol(){

        if(

            array_key_exists( FIX_URL, Setting::$applications)      &&
            in_array( FIX_URL, Setting::$maintenance_mode)          &&
            !in_array( $_SERVER["REMOTE_ADDR"], Setting::$maintenance_mode_url[FIX_URL])

        ){ echo  FIX_Error::fix()->SystemMaintenanceReportingToDomain()->Run();  }

    }

    /*
     *  Kernel Application Controller Control
     * */
    public static function kernelcontroller(){

        if( ( count(self::geturl() ) > 0 ) && ( self::geturl()[0] !== "" ) ){

            return self::geturl()[0];

        }else{ return Setting::$applications[FIX_URL]["controller"]; }

    }


    /*
     * Kernel Application Controller Function Control
     * */
    public static function kernelfunction(){

        if( ( count(self::geturl() ) > 1 ) && ( self::geturl()[1] !== "" ) ){

            return self::geturl()[1];

        }else{ return Setting::$applications[FIX_URL]["function"];  }

    }

    /**
     * @param int $status
     * @return array
     */
    public static function kernelparams($status  = 0){

        $url = self::geturl();

         if($url){
             if($status === 0){

                 if( count($url) > 0 ){

                     unset($url[0]);

                 }

             }else if($status === 1){

                 if( count($url) === 1 ){

                     unset($url[0]);
                     unset($url[1]);

                 }else if( count($url) > 1 ){

                     unset($url[0]);
                     unset($url[1]);

                 }
             }

             return array_values($url);

         }else{ return []; }

    }

    public static function getclass($class = null,$Write = null){

            if(is_file(FIX_HOME_DIR."/".FIX_NORMAL_CORE_DIR.$class.".php")){

                include(FIX_HOME_DIR."/".FIX_NORMAL_CORE_DIR.$class.".php");

                if(class_exists($class)){

                    return new $class($Write);

                }else{  echo FIX_Error::fix()->SystemGetModelError()->Run(); }

            }else{ echo FIX_Error::fix()->SystemGetModelIncludeError()->Run(); }
    }

    /*
     * System Run
     * */
    public static function run(){

        try{

            self::maintenancecontrol();
            self::urlforbiddendcontrol();

        }catch (\Exception $FIX_Error){

            echo json_encode($FIX_Error);

        }

    }

}