<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */

    /* System Start Micro Time */
    define("FIX_START_MICRO_TIME",microtime(true));

    /* System Is Linux */
    define('FIX_CLI', PHP_SAPI == 'cli' ? true : false);

    /* System Is Windows */
    define('FIX_WIN', strpos(PHP_OS, 'WIN') !== false);

    /* System Director */
    define("FIX_SP",DIRECTORY_SEPARATOR);

    /* System Master Dir */
    define("FIX_DIR", str_replace("\\","/", dirname(__FILE__)), true);

    /* System Application Dir */
    define("FIX_HOME_DIR",$_SERVER['DOCUMENT_ROOT']);

    /* System Running Ip */
    define("FIX_IP", $_SERVER["REMOTE_ADDR"]);

    /* System Url Protocol Status */
    $Protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';

    /* System Url Protocol */
    define("FIX_PROTOCOL", $Protocol );

    /* System Url*/
    define("FIX_URL",  $_SERVER["SERVER_NAME"]);

    /* Php Black */
    define("FIX_EOL", " ");

    /* App Upload Folder */
    define("FIX_UPLOAD_FOLDER", "storage");

    /* System Version */
    define("FIX_VERSION","Fix Framework - Beta");

    /* System Application Creator true | false */
    define("FIX_CREATOR",true);

    /* System Application Creator Access IP */
    define("FIX_CREATOR_IP","127.0.0.1");

    /* System Application Multi true | false */
    define("FIX_MULTIPLE",true);

    /* System Application Stabile Folder */
    define("FIX_STABILE","www");

    /* System Application AutoLoad Vendor */
    define("FIX_VENDOR",false);

    /* System Application AutoLoad Vendor */
    define("FIX_VENDOR_FILE","vendor/autoload.php");

    /* Fix Slash Char */
    define("FIX_SLASH","/");

    /* System Application Config Json */
    define("FIX_APP_CONFIG","config.json");

    /* System Application Dir */
    define("FIX_APP_DIR","Applications");

    /* System System Dir */
    define("FIX_SYS_DIR","System");

    /* System Application Model Dir */
    define("FIX_APP_MODEL_DIR","models");

    /* System Application Hooks Dir */
    define("FIX_APP_HOOKS_DIR","hooks");

    /* System Application Views Dir */
    define("FIX_APP_VIEWS_DIR","views");

    /* System Application Views Dir */
    define("FIX_SYS_VIEWS_DIR","Fix/view");

    /* System Application Controller Dir */
    define("FIX_APP_CONTROLLER_DIR","controllers/");

    /* System Application model Dir */
    define("FIX_APP_models_DIR","models/");

    /* System Core Normal Dir */
    define("FIX_NORMAL_CORE_DIR","System/Core/Class/");

    /* System Core Extension */
    define("FIX_CORE_EXTENSIONS",".php");

    /* System Use Memory */
    define("FIX_MEM", memory_get_usage());

    /* System Application Dir */
    define("FIX_CACHE_URL","cache");

    /* include Settings */
    require_once FIX_HOME_DIR."/System/Autoloader/FIX_Autoloader.php";

    /* Running System KERNEL */
    new System\Kernel\FIX_Kernel();

    /* System Finish Micro Time */
    define("FIX_FINISH_MICRO_TIME",microtime(true));



