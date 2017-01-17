<?php

namespace System\Settings;

class FIX_Settings
{

    /*
    * System Applications
    * */
    public static  $applications  =
    [
        "work.fixframework.com" =>
            [
                "controller"    =>  "home",
                "function"      =>  "index",
                "arguments"     =>  [],
                "errorpage"     =>  "/",
                "geturl"        =>  "url",
                "getmethod"     =>  "get",
                "dbdrive"       =>
                    [
                        "pdo"    =>
                            [
                                'host'     =>  'localhost',
                                'username' =>  '',
                                'password' =>  '',
                                'db'       =>  '',
                                'charset'  =>  'utf8'
                            ]
                    ]
            ]
    ];


    /*
     * System Maintenance Mode
     * #Examples "XXX", "ZZZ", ....
     * */
    public static  $maintenance_mode                    =    [];

    /*
     * System Maintenance Mode Url
     * #Examples "XXX" => [ IP,IP,... ]
     * */
    public static  $maintenance_mode_url                =    [];

    /*
     * System Forbidden
     * #Examples "XXX" => "XX/XX/..."
     * */
    public static  $forbidden                           =    [];

    /*
     * System Maintenance Mode Url
     * #Examples "XXX" => "XX/XX/..."
     * */
    public static  $forbidden_mode_url                  =    [];


}