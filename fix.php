<?php

/*
     MIT License

    Copyright (c) 2017 FixFramework

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.

*/

    define("FIX_START_MICRO_TIME",      microtime(true));
    define('FIX_CLI',                   PHP_SAPI == 'cli' ? true : false);
    define('FIX_WIN',                   strpos(PHP_OS, 'WIN') !== false);
    define("FIX_SP",                    DIRECTORY_SEPARATOR);
    define("FIX_DIR",                   str_replace("\\","/", dirname(__FILE__)), true);
    define("FIX_HOME_DIR",              str_replace("\\","/", dirname(__FILE__)), true);
    define("FIX_IP",                    isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "0.0.0.0");
    define("FIX_PROTOCOL",              isset($_SERVER["HTTPS"]) ? 'https://' : 'http://' );
    define("FIX_URL",                   isset($_SERVER["SERVER_NAME"]) ? $_SERVER["SERVER_NAME"] : "console");
    define("FIX_EOL",                   "\r\n");
    define("FIX_UPLOAD_FOLDER",         "storage");
    define("FIX_VERSION",               "Fix Framework - Beta");
    define("FIX_CREATOR",               true);
    define("FIX_CREATOR_IP",            "127.0.0.1");
    define("FIX_MULTIPLE",              true);
    define("FIX_STABILE",               "www");
    define("FIX_VENDOR",                true);
    define("FIX_CACHE_URL",             "cache");
    define("FIX_SLASH",                 "/");
    define("FIX_APP_CONFIG",            "config.json");
    define("FIX_APP_DIR",               "Applications");
    define("FIX_SYS_DIR",               "System");
    define("FIX_CORE_EXTENSIONS",       ".php");
    define("FIX_APP_MODEL_DIR",         "models");
    define("FIX_APP_HOOKS_DIR",         "hooks");
    define("FIX_APP_VIEWS_DIR",         "views");
    define("FIX_SYS_VIEWS_DIR",         "Fix/view");
    define("FIX_APP_CONTROLLER_DIR",    "controllers/");
    define("FIX_NORMAL_CORE_DIR",       "System/Core/Class/");
    define("FIX_VENDOR_FILE",           "System/Vendor/autoload.php");
    define("FIX_MEM",                   memory_get_usage());

    require_once "System/Autoloader/FIX_Autoloader.php";

    new System\Kernel\FIX_Kernel();

    define("FIX_FINISH_MICRO_TIME",     microtime(true));