<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */

error_reporting(0);

## System Error Report Render
function Fix_Shutdown(){  return error_get_last() ?  die(json_encode(error_get_last())) : null; }

## Auto Vendor Include Query
FIX_VENDOR ? file_exists(FIX_HOME_DIR.FIX_SLASH.FIX_VENDOR_FILE) ? include(FIX_HOME_DIR.FIX_SLASH.FIX_VENDOR_FILE) : die(json_encode(["title" => "System Not Found Vendor (autoload.php) Folder and File."])) : null;

## @param $Fix_ClassName
function Fix_Autoload($Fix_ClassName = null){

    $Fix_ClassName        =  str_replace("\\","/",$Fix_ClassName);

    try{

        if ( file_exists( $Fix_ClassName . FIX_SLASH . $Fix_ClassName . FIX_CORE_EXTENSIONS ) ){

            require $Fix_ClassName . FIX_SLASH . $Fix_ClassName . FIX_CORE_EXTENSIONS;

        } elseif ( file_exists( $Fix_ClassName . '.core' . FIX_CORE_EXTENSIONS ) ) {

            require $Fix_ClassName . '.core' . FIX_CORE_EXTENSIONS;

        } elseif ( file_exists( $Fix_ClassName . FIX_CORE_EXTENSIONS ) ){

            require $Fix_ClassName . FIX_CORE_EXTENSIONS;

        }


    }catch (\Exception $FIX_Error){

        die(json_encode($FIX_Error));

    }

}

try{

    set_include_path( get_include_path() . PATH_SEPARATOR . PATH_SEPARATOR  );
    spl_autoload_extensions( '.php,.core.php' );
    spl_autoload_register( 'Fix_Autoload' );
    register_shutdown_function( 'Fix_Shutdown' );

} catch(\Exception $FIX_Error){

    die(json_encode($FIX_Error));

}

