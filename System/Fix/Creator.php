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

use System\Core\Json\Json;
use System\Error\FIX_Error;
use System\Router\FIX_Router;

class Creator
{

    public static $_Log = [];

    public static function index(){


       if( isset( $_GET["process"] ) &&  $_POST ){

           self::CreateFolder($_POST);


       }else{

           if(FIX_CREATOR_IP === $_SERVER["REMOTE_ADDR"]){

               View::render("Creator/Index");

           }else{

               echo FIX_Error::fix()->SystemKernelReportingErrorMessageToDomain()->Run();

           }

       }


    }


    /**
     * @return array
     */
    public static function newApplicationFolderList(){

        return [
            "master" => [FIX_Router::appDedection(),0755],
            "child" =>
                [
                    [FIX_Router::appDedection().FIX_SLASH."cache",0755],
                    [FIX_Router::appDedection().FIX_SLASH."controllers",0755],
                    [FIX_Router::appDedection().FIX_SLASH."hooks",0755],
                    [FIX_Router::appDedection().FIX_SLASH."models",0755],
                    [FIX_Router::appDedection().FIX_SLASH."storage",0755],
                    [FIX_Router::appDedection().FIX_SLASH."views",0755]
                ]

        ];

    }

    /**
     * @param array $Request
     */
    public static function CreateFolder(array $Request = []){

        if(mkdir(self::newApplicationFolderList()["master"][0],self::newApplicationFolderList()["master"][1])){

            self::$_Log[] = [" Application Master Folder Created"];
            self::CreateConfigJsonFileWrite([
                "controller"        => $Request["controller"],
                "function"          => $Request["function"],
                "error"             => $Request["error"],
                "receiver"          => "url",
                "method"            => $Request["method"],
                "host"              => $Request["dbserver"],
                "username"          => $Request["dbusername"],
                "password"          => $Request["dbpassword"],
                "table"             => $Request["dbtable"],
                "file"              => self::newApplicationFolderList()["master"][0].FIX_SLASH."config.json",
            ]);
            foreach(self::newApplicationFolderList()["child"] as $Key => $Val){

               if(file_exists($Val[0])){

                   self::$_Log[] = ["".$Val[0]." Available"];

               }else{

                   if(mkdir($Val[0],$Val[1])){

                       self::$_Log[] = [$Val[0]." Created"];

                   }else{

                       self::$_Log[] = [$Val[0]." Created Error"];

                   }

               }

            }

            if(self::CreateControllerFileWrite([
                "File"              => self::newApplicationFolderList()["child"][1][0].FIX_SLASH.$Request["controller"].FIX_CORE_EXTENSIONS,
                "Class_Name"        =>  $Request["controller"],
                "Function_Name"     =>  $Request["function"]
            ])){
                self::$_Log[] = [$Request["controller"]." Controller File Created"];
            }else{

                self::$_Log[] = [$Request["controller"]." Controller File Created Error - Manuel Create"];
            }

        }else{

            self::$_Log[] = [" Application Master Folder Created Error"];

        }

        echo Json::encode(self::$_Log);
    }

    /**
     * @param array $Config
     * @return string
     */
    public static function CreateConfigJsonFile(array $Config = []){

        if(is_array($Config)){

            $Custom = [
                    "controller"    =>  $Config["controller"],
                    "function"      =>  $Config["function"],
                    "arguments"     =>  [],
                    "error"         =>  $Config["error"],
                    "receiver"      =>  "url",
                    "method"        =>  $Config["method"],
                    "database"=> [
                                "pdo" =>  [
                                    "host"      => $Config["host"],
                                    "username"  => $Config["username"],
                                    "password"  => $Config["password"],
                                    "table"     => $Config["table"],
                                    "charset"   => "utf8"
                        ]
                    ],
                    "router_url_mode"           => null,
                    "maintenance_mode"          => null,
                    "maintenance_mode_ip"       => null,
                    "forbidden"                 => null,
                    "forbidden_mode_url"        => null

            ];

            return json_encode($Custom,JSON_PRETTY_PRINT);

        }


    }


    /**
     * @param array $Config
     * @return int
     */
    public static function CreateControllerFileWrite(array $Config = []){

        if(is_array($Config)){

         $Custom = file_get_contents(FIX_HOME_DIR.FIX_SLASH.FIX_SYS_DIR."/Fix/view/Creator/controller.fix");

            $Pattern = ["Class_Name","Function_Name"];
            $Replace = [$Config["Class_Name"],$Config["Function_Name"]];
            $Controller_Replace = str_replace($Pattern,$Replace,$Custom);
            $ConfigFile = fopen($Config["File"], "w") or die("Error Controller File!");
            $Status = fwrite($ConfigFile, $Controller_Replace);
            fclose($ConfigFile);

            return $Status;


        }


    }


    /**
     * @param array $Config
     * @return int
     */
    public static function CreateConfigJsonFileWrite(array $Config = []){

        if(is_array($Config)){

            $JsonFile   = self::CreateConfigJsonFile($Config);
            $ConfigFile = fopen($Config["file"], "w") or die("Error Config File!");
            $Status =  fwrite($ConfigFile, $JsonFile);
            fclose($ConfigFile);

            return $Status;
        }

    }

}