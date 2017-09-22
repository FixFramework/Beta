<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Core\Json;

use System\Error\FIX_Error;

class Json
{


    /**
     * @param array $array
     * @param bool|false $status
     * @return $this
     */
    public static function encode(array $array = [], $status = true){

        return json_encode($array,$status);

    }


    /**
     * @param null $string
     * @param bool|false $Type
     * @return mixed
     */
    public static function validate($string = null,$Type = false){

        $result = json_decode($string);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = '';
                break;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
                // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
                // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
                // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }

        if ($error !== '') {

            if($Type){ exit(FIX_Error::fix()->SystemApplicaionsConfigFileError($error)->Run()); }else{ exit(FIX_Error::fix()->SystemApplicaionsConfigFileError($error)->Run());  }

        }

        return $result;

    }

    /**
     * @param array $array
     * @param bool|false $status
     * @return $this
     */
    public static function decode($array, $status = false){

        return json_decode($array,$status);

    }


}