#!/usr/bin/env php
<?php

    /* System Start Micro Time */
    define("FIX_START_MICRO_TIME",microtime(true));

    /* System Is Linux */
    define('FIX_CLI', PHP_SAPI == 'cli' ? true : false);

    /* System Is Windows */
    define('FIX_WIN', strpos(PHP_OS, 'WIN') !== false);

    /* System Director */
    define("FIX_SP",DIRECTORY_SEPARATOR);

    /* System application Dir */
    define("FIX_HOME_DIR",$_SERVER['DOCUMENT_ROOT']);

    /* System application Dir */
    define("FIX_SLASH","/");

    /* System application Dir */
    define("FIX_APP_DIR","Applications".FIX_SLASH);


    /* System system Dir */
    define("FIX_SYS_DIR","System".FIX_SLASH);

    /* System application Model Dir */
    define("FIX_APP_MODEL_DIR","models".FIX_SLASH);

    /* System application Hooks Dir */
    define("FIX_APP_HOOKS_DIR","hooks".FIX_SLASH);

    /* System application Views Dir */
    define("FIX_APP_VIEWS_DIR","views".FIX_SLASH);

    /* System application Views Dir */
    define("FIX_SYS_VIEWS_DIR","Fix".FIX_SLASH."view/");

    /* System application Controller Dir */
    define("FIX_APP_CONTROLLER_DIR","controllers/");

    /* System application model Dir */
    define("FIX_APP_models_DIR","models/");

    /* System Core Normal Dir */
    define("FIX_NORMAL_CORE_DIR","System/Core/Class/");

    /* System Core Extension */
    define("FIX_CORE_EXTENSIONS",".php");

    /* System Use Memory */
    define("FIX_MEM", memory_get_usage());

    /* System Master Dir */
    define("FIX_DIR", str_replace("\\","/", dirname(__FILE__)), true);

    /* System Running Ip */
    define("FIX_IP", $_SERVER["REMOTE_ADDR"]);

    /* Php Black */
    define("FIX_EOL", " ");

    /* Sytem Url Protocol Status */
    $Protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';

    /* System Url Protocol */
    define("FIX_PROTOCOL", $Protocol );

    /* System Url*/
    define("FIX_URL",  $_SERVER["SERVER_NAME"]);

    /* System application Dir */
    define("FIX_CACHE_URL",FIX_HOME_DIR.FIX_SLASH.FIX_APP_DIR.FIX_URL."/cache/");


    /* include settings */
    require_once "System/Autoloader/FIX_Autoloader.php";


    new System\Kernel\FIX_Kernel();


    /* System Sinish Micro Time */
    define("FIX_FINISH_MICRO_TIME",microtime(true));

