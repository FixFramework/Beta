<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Core\Hooks;

use System\Router\FIX_Router;

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
     * @param null $View
     * @param array $data
     * @param null $Application
     * @return bool
     */
    public static function render($View = null, array $data = [], $Application = null){

        $Application ? $Application = $Application: $Application = FIX_Router::appMultipleStatus();

        if(file_exists( FIX_APP_DIR . FIX_SLASH . $Application . FIX_SLASH . FIX_APP_HOOKS_DIR.FIX_SLASH.FIX_APP_VIEWS_DIR. FIX_SLASH . $View . FIX_CORE_EXTENSIONS )){

            extract($data);

            include( FIX_APP_DIR . FIX_SLASH . $Application . FIX_SLASH . FIX_APP_HOOKS_DIR.FIX_SLASH.FIX_APP_VIEWS_DIR. FIX_SLASH . $View . FIX_CORE_EXTENSIONS );

        } else { return false;  }

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
     * @param null $Folder
     */
    public function get_plugins($Folder =  null ){

      $Folder = FIX_Router::appDedection().FIX_SLASH.FIX_APP_HOOKS_DIR.FIX_SLASH;

        if ( is_dir( $Folder ) ) {

          if ( $List = opendir( $Folder ) ) {

            while ( ( $File = readdir( $List ) ) !== false ) {

              $Files = str_replace("..","",str_replace(".php","",$File));

              if( is_file( $Folder.$Files.FIX_SLASH.$Files.FIX_CORE_EXTENSIONS ) ){

                self::$_list[$Files][]  = [ $File, str_replace("\\","/",$Folder), str_replace("\\","/",$Folder.$File.FIX_SLASH.$File.FIX_CORE_EXTENSIONS),$Files.FIX_CORE_EXTENSIONS];

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
     * @return bool
     */
    public function do_action($par  = "", $Params = []){

    if(isset(self::$_function[$par])){

      foreach( self::$_function[$par] as $Key => $Val ){

        if (function_exists($Val[0])) {

          call_user_func_array($Val[0],$Params);

        }

      }

    }

    return false;

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