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
function shutdown(){  return error_get_last() ?  die(json_encode(error_get_last())) : null; }

## Auto Vendor Include Query
FIX_VENDOR ? file_exists(FIX_HOME_DIR.FIX_SLASH.FIX_VENDOR_FILE) ? include(FIX_HOME_DIR.FIX_SLASH.FIX_VENDOR_FILE) : die(json_encode(["title" => "System Not Found Vendor (autoload.php) Folder and File."])) : null;

## @param $className
function autoload($className = null){

    $className        =  str_replace("\\","/",$className);

    try{

        if ( file_exists( $className.FIX_SLASH.$className . FIX_CORE_EXTENSIONS ) ){

            require $className.FIX_SLASH.$className . FIX_CORE_EXTENSIONS;

        } elseif ( file_exists( $className . '.core' . FIX_CORE_EXTENSIONS ) ) {

            require $className . '.core' . FIX_CORE_EXTENSIONS;

        } elseif ( file_exists( $className . FIX_CORE_EXTENSIONS ) ){

            require $className . FIX_CORE_EXTENSIONS;

        }


    }catch (\Exception $FIX_Error){

        die(json_encode($FIX_Error));

    }

}

try{

    set_include_path( get_include_path() . PATH_SEPARATOR . PATH_SEPARATOR  );
    spl_autoload_extensions( '.php,.core.php' );
    spl_autoload_register( 'autoload' );
    register_shutdown_function( 'shutdown' );

} catch(\Exception $FIX_Error){ die(json_encode($FIX_Error)); }

