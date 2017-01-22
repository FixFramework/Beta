<?php

error_reporting(E_ALL);


function shutdown(){

    if ($error = error_get_last()) { echo json_encode($error); }

}


/**
 * @param $className
 */
function autoload($className){

    $className        =  str_replace("\\","/",$className);

    try{

        if ( file_exists( $className.FIX_SLASH.$className . FIX_CORE_EXTENSIONS ) ){

            require $className.FIX_SLASH.$className . FIX_CORE_EXTENSIONS;

        } elseif ( file_exists( $className . '.core' . FIX_CORE_EXTENSIONS ) ) {

            require $className . '.core' . FIX_CORE_EXTENSIONS;

        } elseif ( file_exists( $className . FIX_CORE_EXTENSIONS ) ){

            require $className . FIX_CORE_EXTENSIONS;

        }


    }catch (\Exception $FIX_Error){ echo json_encode($FIX_Error); }

}

try{


    set_include_path( get_include_path() . PATH_SEPARATOR . PATH_SEPARATOR  );
    spl_autoload_extensions( '.php,.core.php' );
    spl_autoload_register('autoload');

    register_shutdown_function('shutdown');

} catch(\Exception $FIX_Error){  echo json_encode($FIX_Error); }

