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

class ConsoleCreator
{

    public static $_Log = [];


    /**
     * @return array
     */
    public static function newApplicationFolderList($AppName = null){

        return [
            "master" => [self::AppConsoleNewName($AppName),0755],
            "child" =>
                [
                    [self::AppConsoleNewName($AppName).FIX_SLASH."cache",0755],
                    [self::AppConsoleNewName($AppName).FIX_SLASH."controllers",0755],
                    [self::AppConsoleNewName($AppName).FIX_SLASH."hooks",0755],
                    [self::AppConsoleNewName($AppName).FIX_SLASH."models",0755],
                    [self::AppConsoleNewName($AppName).FIX_SLASH."storage",0755],
                    [self::AppConsoleNewName($AppName).FIX_SLASH."views",0755]
                ]

        ];

    }


    /**
     * @param null $appName
     * @return string
     */
    public static function AppConsoleNewName($appName = null){

        if(FIX_MULTIPLE){

            return FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_SLASH . $appName;

        }else{

            return FIX_HOME_DIR . FIX_SLASH .FIX_APP_DIR . FIX_SLASH . FIX_STABILE;

        }

    }


    /**
     * @param array $Request
     * @return array
     */
    public static function CreateFolder(array $Request = []){

        file_exists(self::newApplicationFolderList($Request["app"])["master"][0]) ? exit("Uygulama önceden oluşturulmuştur.") : null;

        if(mkdir(self::newApplicationFolderList($Request["app"])["master"][0],self::newApplicationFolderList($Request["app"])["master"][1])){

            self::$_Log[] = ["Uygulama klasörü oluşturuldu"];
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
                "file"              => self::newApplicationFolderList($Request["app"])["master"][0].FIX_SLASH."config.json",
            ]);
            foreach(self::newApplicationFolderList($Request["app"])["child"] as $Key => $Val){

               if(file_exists($Val[0])){

                   self::$_Log[] = ["".$Val[0]." Mevcut"];

               }else{

                   if(mkdir($Val[0],$Val[1])){

                       self::$_Log[] = [$Val[0]." Oluşturuldu"];

                   }else{

                       self::$_Log[] = [$Val[0]." Oluşturma Hatası"];

                   }

               }

            }

            if(self::CreateControllerFileWrite([
                "File"              => self::newApplicationFolderList($Request["app"])["child"][1][0].FIX_SLASH.$Request["controller"].FIX_CORE_EXTENSIONS,
                "Class_Name"        =>  $Request["controller"],
                "Function_Name"     =>  $Request["function"]
            ])){
                self::$_Log[] = [$Request["controller"].".php Controller dosyası oluşturuldu."];
            }else{

                self::$_Log[] = [$Request["controller"].".php Constoller dosyası oluşturma hatası."];
            }

        }else{

            self::$_Log[] = [" Uygulama dosyası oluşturma hatası"];

        }

        return self::$_Log;
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