<?php

namespace System\Core\Permatext;

class Permatext
{

    /**
     * @param null $string
     * @return mixed|null|string
     */
    public static function convert($string = null){

        $find       = array('-','  ','Ç', 'Þ', 'Ð', 'Ü', 'Ý', 'Ö', 'ç', 'þ', 'ð', 'ü', 'ö', 'ý', '+', '#');
        $replace    = array('','','c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
        $string     = strtolower(str_replace($find, $replace, $string));
        $string     = preg_replace("@[^A-Za-z0-9\\-_\\.\\+]@i", ' ', $string);
        $string     = trim(preg_replace('/\s+/', ' ', $string));
        $string     = str_replace(' ', '-', $string);
        return $string;

    }


}