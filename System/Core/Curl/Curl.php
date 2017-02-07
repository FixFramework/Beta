<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
namespace System\Core\Curl;

class Curl
{


    /**
     * @param null $Target
     * @return mixed
     */
    public static function get($Target = null){

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$Target);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        return curl_exec($ch);
        curl_close($ch);

    }


    /**
     * @param null $Target
     * @param array $Params
     * @return mixed
     */
    public static function post($Target = null,$Params = []){

        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$Target);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$Params);
        return curl_exec($ch);
        curl_close($ch);

    }


    /**
     * @param null $Target
     * @param null $Name
     * @return resource
     */
    public function download($Target = null,$Name = null){

        $ch = curl_init($Target);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        $use = fopen($Name, "a+");
        fwrite($use, $data);
        fclose($use);
        return $use;

    }


    /**
     * @param array $Arguments
     * @return mixed
     */
    public static function upload($Arguments = []){

        $ch = curl_init();
        $filePath = $_FILES[$Arguments['file']]['tmp_name'];
        $data = array(
            'name'      => $Arguments['name'],
            'onepar'    => $Arguments['file'],
            'data'      => "@$filePath",
            'fileName'  => $Arguments['name']);
        curl_setopt($ch, CURLOPT_URL, $Arguments['target']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        return curl_exec($ch);
        curl_close($ch);

    }



}