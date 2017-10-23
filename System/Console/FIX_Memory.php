<?php

namespace System\Console;

use System\Core\Json\Json;
use System\Error\FIX_Error;
use System\Fix\Creator;
use System\Router\FIX_Router;
use System\Core\Benchmark\Benchmark;
use System\Fix\ConsoleCreator;
use System\Core\Ip\Ip;

class FIX_Memory {


    /**
     * @param array ...$args
     * @return string
     */
    public static function help(...$args){

        $help =  [
            "<================ Fix Framework Console Application ================>",
            "",
            "",
            "Console uygulamasını çalıştırmak için sisteme tanımlı olan komutları kullanarak işlerinizi yapabilirsiniz.",
            "",
            "--------------------------------------------------------------------",
            "",
            "php fix { Console Arguments }",
            "",
            "--------------------------------------------------------------------",
            "",
            " help                                                      |  komutu ile sisteme tanımlı console komutlarını öğrenebilir ve kullanımları ile alakalı detaylara bakabilirsiniz.",
            "",
            " creator {Uygulama ADI} {ANA CONTROLLER} {FONKSIYON ISMI}  | 1: Uygulama adı, 2: Açılışta çalışacak controller, 3: Ana çalışacak controler'e ait function.",
            "",
            "<================ MODEL ================>",
            "",
            " model --creator {Uygulama ADI} {MODEL ADI}                | 1: Modelin oluşturmak istediğiniz uygulama. 2: Oluşturmak istediğiniz modelin ismi.",
            " model --run                                               | GELİŞTİRİLME AŞAMASINDA",
            " model --delete                                            | GELİŞTİRİLME AŞAMASINDA",
            ""
        ];


        foreach ($help as $item)  echo " * ".$item.FIX_EOL;

    }

    public static function app(...$Params){

        count($Params) === 0 ? exit("Parametreleri boş bırakmayınız.") : null;


        print_r(glob("*",GLOB_BRACE));

    }



    /**
     * @param array ...$Params
     * @return string
     */
    public static function creator(...$Params){

       count($Params) !== 3 ? exit("Parametreleri boş bırakmayınız.") : null;

        $__Creator =
            ConsoleCreator::CreateFolder(
            [
                "app"               => $Params[0],
                "controller"        => $Params[1],
                "function"          => $Params[2],
                "error"             => "/",
                "url"               => "url",
                "method"            => "get",
                "dbserver"           => null,
                "dbusername"        => null,
                "dbpassword"        => null,
                "dbtable"           => null
            ]
        );

        $Text   = FIX_EOL;

        foreach ($__Creator as $key => $item) { $Text .= $item[0].FIX_EOL; }

        return FIX_EOL.$Text;

    }

    /**
     * @return string
     */
    public static function benchmark(){

        return Benchmark::run();

    }

    public static function model(...$Argumans){

        if($Argumans[0] === "--create") :

                (file_exists(
                    ConsoleCreator::newApplicationFolderList(
                        $Argumans[1])["master"][0]
                )
                ) ? null : exit("Uygulama Bulunamadı");

                (file_exists(
                    ConsoleCreator::newApplicationFolderList(
                        $Argumans[1]
                    )["child"][3][0].FIX_SLASH.$Argumans[2].FIX_CORE_EXTENSIONS
                )
                ) ? exit($Argumans[2]." Adında Başka Bir Model Mevcuttur") : null;


                (file_exists(
                    ConsoleCreator::CreateModelFileWrite(
                        [
                            "Class_Name" => $Argumans[2],
                            "File"       => ConsoleCreator::newApplicationFolderList($Argumans[1])["child"][3][0].FIX_SLASH.$Argumans[2].FIX_CORE_EXTENSIONS
                        ]
                    )["child"][3][0]
                )
                ) ? exit( $Argumans[2] . " HATA" ) : exit($Argumans[2]." Oluşturuldu" );

        elseif($Argumans[0] === "--run"):

            exit("Model Çalıştırma Alanı");

        elseif($Argumans[0] === "--delete"):

            exit("Model Silme Alanı");

        else:

            exit("Method Yanlış");

        endif;
    }
}