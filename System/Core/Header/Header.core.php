<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Core\Header;


class Header
{


    /**
     * @param null $url
     * @param $code = 301 Moved Permanently
     * @param $code = 302 Found
     * @param $code = 303 See Other
     * @param $code = 307 Temporary Redirect
     */
    public static function location( $url = null ){

        if($url){

            header('location: ' . $url );

        }

    }

    /**
     * @param int $second
     * @param null $url
     */
    public static function refresh($url = null,$second = 0){

        if($url){

            header( "refresh:" . $second . ";url=" . $url );

        }

    }

    /*
     * Page 404 Not Found
     * */
    public static function notfound(){

        header('HTTP/1.0 404 Not Found');

    }


    /**
     * Document Content Type Pdf
     */
    public static function pdf(){

        header('Content-type: application/pdf');

    }

    /**
     * Document Attachment File Download
     */
    public static function download($file = null){

        if($file){

            header('Content-Disposition: attachment; filename=' . $file);

        }

    }


    /**
     * @param null $mimetype
     * Examples Mime Types
     * #Url :  https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
     */
    public static function contenttype($mimetype = null){

        if($mimetype){

            header('Content-Type: ' . $mimetype);

        }

    }

    /*
     * Header File Transfer
     * */
    public static function filetransfer(){

        header("Content-Description: File Transfer");

    }

    /**
     * @param null $file
     */
    public static function filesize($file = null){

        if($file){

            header("Content-Length: " . filesize($file));

        }

    }

}