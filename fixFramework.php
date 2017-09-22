<?php


    /*
     * Author  : Fix Framework | Cengiz Akcan
     * Web     : fixframework.com
     * Mail    : info@fixframework.com
     * Docs    : docs.fixframework.com
     * Version : Beta
     * Github  : github.com/FixFramework
     * */

    define("FIX_START_MICRO_TIME",      microtime(true));
    define('FIX_CLI',                   PHP_SAPI == 'cli' ? true : false);
    define('FIX_WIN',                   strpos(PHP_OS, 'WIN') !== false);
    define("FIX_SP",                    DIRECTORY_SEPARATOR);
    define("FIX_DIR",                   str_replace("\\","/", dirname(__FILE__)), true);
    define("FIX_HOME_DIR",              dirname( __FILE__ ));
    define("FIX_IP",                    $_SERVER["REMOTE_ADDR"]);
    define("FIX_PROTOCOL",              isset($_SERVER["HTTPS"]) ? 'https://' : 'http://' );
    define("FIX_URL",                   $_SERVER["SERVER_NAME"]);
    define("FIX_EOL",                   " ");
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

    require_once FIX_HOME_DIR . "/System/Autoloader/FIX_Autoloader.php";

    new System\Kernel\FIX_Kernel();

    define("FIX_FINISH_MICRO_TIME",     microtime(true));