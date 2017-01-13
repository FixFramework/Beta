<?php
namespace System\Core;

class Hooks
{

  /**
   * Plugin instance.
   *
   * @see get_instance()
   * @type object
   */
  protected static $instance = NULL;


  /*
   * Plugin All Hooks
   * */
  public static $_hooks;

  /*
   * Plugin All Hooks
   * */
  public static $_list;

  /*
   * Plugin All Function
   * */
  public static $_function;


  /**
   * @return object|Hooks
   */
  public static function fix(){

    NULL === self::$instance and self::$instance = new self;

    return self::$instance;

  }


  /**
   * @param null $Action
   * @param null $Function
   * @param null $list
   * @return $this
   */
  public function add_action($Action = null,$Function = null,$list = null){

    if($Action && $Function){

      self::$_function[$Action][]  = [$Function];

      return $this;

    }

  }


  /**
   * @param null $Action
   * @return $this
   */
  public function die_action($Action = null){

    if($Action){

      if(isset(self::$_function[$Action])){

        unset(self::$_function[$Action]);

      }

      return $this;

    }

  }


  /**
   * @param string $Folder
   */
  public function get_plugins( $Folder  = FIX_APP_DIR.FIX_URL.FIX_SLASH.FIX_APP_HOOKS_DIR ){

    if ( is_dir( $Folder ) ) {

      if ( $List = opendir( $Folder ) ) {

        while ( ( $File = readdir( $List ) ) !== false ) {

          $Files = str_replace("..","",str_replace(".php","",$File));

          if( is_file( $Folder.$Files.FIX_SLASH.$Files.FIX_CORE_EXTENSIONS ) ){


            self::$_list[$Files][]  = [ $File, $Folder, $Folder.$File.FIX_SLASH.$File.FIX_CORE_EXTENSIONS,$Files.FIX_CORE_EXTENSIONS];

          }


        }

        closedir( $List );

      }

    }

  }


  /**
   * @param array|null $List
   */
  public function run_plugins(array $List = null){

    $this->get_plugins();


    foreach($List as $Start){

      if(array_key_exists($Start,self::$_list)){

        if(file_exists(self::$_list[$Start][0][2])){

          include(self::$_list[$Start][0][2]);

        }

      }

    }


  }


  /**
   * @param string $par
   * @param array $Params
   */
  public function do_action($par  = "",$Params = []){

    if(isset(self::$_function[$par])){

      foreach( self::$_function[$par] as $Key => $Val ){

        if (function_exists($Val[0])) {

          call_user_func_array($Val[0],$Params);

        }

      }

    }

  }

  /**
   * @param null $Plugins
   * @return array
   */
  public function get_detalis( $Plugins =  null ){

    if(is_file($Plugins)){

      $file = file_get_contents( $Plugins );
      preg_match('#Plugin Name:(.*)#i' , $file , $name );
      preg_match('#Author Name:(.*)#i' , $file , $author );
      preg_match('#Author Mail:(.*)#i' , $file , $mail );
      preg_match('#Description:(.*)#i' , $file , $desc );
      preg_match('#URL:(.*)#i' , $file , $url );

      return [
          'path'	  => $Plugins,
          'name' 	  => trim( isset($name[1])      ? $name[1]    : null ),
          'author'    => trim( isset($author[1])    ? $author[1]  : null ),
          'mail'	  => trim( isset($mail[1])      ? $mail[1]    : null ),
          'desc'	  => trim( isset($desc[1])      ? $desc[1]    : null ),
          'url'	      => trim( isset($url[1])       ? $url[1]     : null ),
      ];

    }

  }



}