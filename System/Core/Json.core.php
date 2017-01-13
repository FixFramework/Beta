<?php

namespace System\Core;


class Json
{

    /**
     * @return Json
     */
    public static function fix(){

        return new self();

    }

    /**
     * @param array $array
     * @param bool|false $status
     * @return $this
     */
    public function encode(array $array = [], $status = false){

        return json_encode($array,$status);

    }


    /**
     * @param array $array
     * @param bool|false $status
     * @return $this
     */
    public function decode($array, $status = false){

        return json_decode($array,$status);

    }


}