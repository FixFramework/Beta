<?php

namespace System\Core;


class Xml {



    private $xml;

    private $_query  =  "";

    private $_rows   =  "rows";


    public function header(){

        return header("Content-type: text/xml");

    }


    /**
     * @return Xml
     */
    public static function fix(){

        return new self();

    }



    /**
     * @param string $element
     * @return $this
     */
    public function start($element = "<fix/>"){

        $this->_query    =  $element;
        return $this;

    }


    /**
     * @return $this
     */
    public function create(){

        $this->xml    =   new \SimpleXMLElement($this->_query);
        return $this;

    }

    /**
     * @param $xmlstring
     * @return \SimpleXMLElement
     */
    public function xmltoarray($xmlstring){

       return simplexml_load_string($xmlstring);

    }

    /**
     * @param array $data
     * @param string $itemname
     * @return mixed
     */
    public function arraytoxml(array $data = [],$itemname = "item"){

        $this->_rows = $itemname;

        $this->array_to_xml($data,$this->xml);

        return $this->xml->asXML();

    }


    /**
     * @param $array
     * @param $xml_user_info
     */
    private function array_to_xml($array, &$xml_user_info) {

        foreach($array as $key => $value) {

            if(is_array($value)) {

                if(!is_numeric($key)){

                    $subnode = $xml_user_info->addChild($key);

                    $this->array_to_xml($value, $subnode);

                }else{

                    $subnode = $xml_user_info->addChild($this->_rows);

                    $this->array_to_xml($value, $subnode);

                }

            }else {

                $xml_user_info->addChild("$key",htmlspecialchars("$value"));

            }

        }

    }
}