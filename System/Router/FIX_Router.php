<?php

namespace System\Router;

use System\Core\Header as Header;
use System\Error\FIX_Error;
use System\Core\Json\Json;
use System\Fix\Fix;
use System\Fix\View;

class FIX_Router
{



    public static function getConfig($Application = FIX_URL){

        if($Application){

            if(file_exists(FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_URL.FIX_SLASH. FIX_APP_CONFIG )){

               $mixed =  file_get_contents( FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_URL.FIX_SLASH. FIX_APP_CONFIG );
                return (array) Json::validate($mixed);

            }else{

                return false;
            }

        }

    }


    public static function Creator(){

        if( (FIX_CREATOR) && ((isset($_GET["url"])) and ($_GET["url"] === "creator") ) ){

            return \System\Fix\Creator::index();

        }else{

            echo FIX_Error::fix()->SystemKernelReportingErrorMessageToDomain()->Run();

        }

    }


    /**
     * @return bool
     */
    public static function detectionurl(){

        if( file_exists( FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_URL ) ){  return true; } else { return false; }

    }

    /**
     * @return bool
     */
    public static function detectionurlconfig(){

        if( file_exists( FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_URL.FIX_SLASH. FIX_APP_CONFIG ) ){  return true; } else { return false; }

    }




    /**
     * @return array
     */
    public static function receiver(){

      if(self::systemrequestresponsemethod("CONTROL",self::getConfig()["receiver"]) && self::systemrequestresponsemethod("LOAD",self::getConfig()["receiver"])){

          return explode( "/" ,
              filter_var(
                  rtrim(
                      self::systemrequestresponsemethod("LOAD",self::getConfig()["receiver"]) , "/"
                  ),
                  FILTER_SANITIZE_URL
              )
          );

      }


    }

    public static function systemrequestresponsemethod($EXE = "CONTROL", $PARAM = null){

        if($EXE == "LOAD" && self::getConfig()["method"] === "get")           { return $_GET[$PARAM];
        }else if($EXE == "LOAD" && self::getConfig()["method"] === "post")    { return $_POST[$PARAM];
        }else if($EXE == "CONTROL" && self::getConfig()["method"] === "get")  { return $_GET;
        }else if($EXE == "CONTROL" && self::getConfig()["method"] === "post") { return $_POST; }

    }

    /*
     * Forbidden Url Control
     * */
    public static function urlforbiddendcontrol(){

        if(
            self::detectionurl() &&
            array_key_exists( FIX_URL, self::getConfig()["forbidden"])     &&
            $_GET[self::systemrequestresponsemethod("LOAD",self::getConfig()["receiver"])] === self::getConfig()["forbidden"]
        ){

           if(array_key_exists( FIX_URL, self::getConfig()["forbidden_mode_url"])){

                Header::location(self::getConfig()["forbidden_mode_url"]);

           }else{ Header::notfound(); }

        }

    }

    /*
     * Forbidden Url Control
     * */
    public static function maintenancecontrol(){

        if(

            array_key_exists( FIX_URL, self::getConfig())              &&
            in_array( FIX_URL, self::getConfig()["maintenance_mode"])  &&
            !in_array( $_SERVER["REMOTE_ADDR"],self::getConfig()["maintenance_mode_url"])

        ){ echo  FIX_Error::fix()->SystemMaintenanceReportingToDomain()->Run();  }

    }

    /*
     *  Kernel Application Controller Control
     * */
    public static function kernelcontroller(){

        if( ( count(self::receiver() ) > 0 ) && ( self::receiver()[0] !== "" ) ){

            return self::receiver()[0];

        }else{ return self::getConfig()["controller"]; }

    }


    /*
     * Kernel Application Controller Function Control
     * */
    public static function kernelfunction(){

        if( ( count(self::receiver() ) > 1 ) && ( self::receiver()[1] !== "" ) ){

            return self::receiver()[1];

        }else{ return self::getConfig()["function"];  }

    }

    /**
     * @param int $status
     * @return array
     */
    public static function kernelparams($status  = 0){

        $url = self::receiver();

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