<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */

namespace System\Router;

use System\Core\Header\Header;
use System\Error\FIX_Error;
use System\Core\Json\Json;

class FIX_Router
{

    public static function getConfig($Application = null){

        $Application = self::appDedection(true);

        if($Application){

            if(file_exists(FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_SLASH . $Application .FIX_SLASH. FIX_APP_CONFIG )){

               return (array) Json::validate(file_get_contents( FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_SLASH . FIX_SLASH . $Application .FIX_SLASH. FIX_APP_CONFIG ));


            }else{

                return false;
            }

        }

    }


    public static function Creator(){

        if( (FIX_CREATOR) && ((isset($_GET["url"])) and ($_GET["url"] === "creator") ) ){

            return \System\Fix\Creator::index();

        }else{

            die(FIX_Error::fix()->SystemKernelReportingErrorMessageToDomain()->Run());

        }

    }


    /**
     * @return bool
     */
    public static function detectionurl(){

        if( file_exists( self::appDedection() ) ){  return true; } else { return false; }

    }

    /**
     * @return bool
     */
    public static function detectionurlconfig(){

        if( file_exists( self::appDedection() .FIX_SLASH. FIX_APP_CONFIG ) ){  return true; } else { return false; }
    }

    /**
     * @param bool $App
     * @return mixed|string
     */
    public static function appDedection($App = false){

        if(FIX_MULTIPLE){

            return $App ? FIX_URL : FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_SLASH . FIX_URL;

        }else{

            return $App ? FIX_STABILE : FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_SLASH . FIX_STABILE;

        }

    }

    /**
     * @return array
     */
    public static function receiver(){

      if( isset($_GET[self::getConfig()["receiver"]]) || isset($_POST[self::getConfig()["receiver"]]) ){

          if( (isset($_GET[self::getConfig()["receiver"]]) || isset($_POST[self::getConfig()["receiver"]])) && self::systemrequestresponsemethod("CONTROL",self::getConfig()["receiver"]) && self::systemrequestresponsemethod("LOAD",self::getConfig()["receiver"])){

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

    }


    /**
     * @param string $EXE
     * @param null $PARAM
     * @return mixed
     */
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

      if(is_array(is_array(self::getConfig()["forbidden"]))){

            if(count(self::receiver()) > 0 && in_array(self::systemrequestresponsemethod("LOAD",self::getConfig()["receiver"]),self::getConfig()["forbidden"])){

                $URL = (array)self::getConfig()["forbidden_mode_url"];

                if(array_key_exists( self::systemrequestresponsemethod("LOAD",self::getConfig()["receiver"]), $URL)){

                   Header::location($URL[self::systemrequestresponsemethod("LOAD",self::getConfig()["receiver"])]);

               }else{ Header::notfound(); }

            }

      }

    }

    /*
     * Forbidden Url Control
     * */
    public static function maintenancecontrol(){

        if(is_array(is_array(self::getConfig()["forbidden"]))) {

            if (
                count(self::receiver()) > 0 &&
                in_array(self::systemrequestresponsemethod("LOAD", self::getConfig()["receiver"]), self::getConfig()["maintenance_mode"]) &&
                !in_array($_SERVER["REMOTE_ADDR"], self::getConfig()["maintenance_mode_ip"])

            ) {
                die(FIX_Error::fix()->SystemMaintenanceReportingToDomain()->Run());
            }

        }

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

            die(FIX_Error::fix()->SystemErrorMessage($FIX_Error->getMessage())->Run());

        }

    }

}