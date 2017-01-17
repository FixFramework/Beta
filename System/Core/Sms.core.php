<?php

namespace System\Core;

class Sms
{



    public $username        = "";
    public $password        = "";
    public $title           = "";
    public $text            = "";
    public $numbers         = array();
    public $numbersexp      = array();
    public $date            = "";
    public $xml             = "";
    public $url             = "";
    public $header          = array('Content-Type: text/xml');


    /**
     * @return Iletimerkezi
     */
    public static function fix(){

        return new self();

    }


    /**
     * @param string $url
     * @return $this
     */
    public function url($url = "send"){

        if($url == "send"){

            $this->url =   "http://api.iletimerkezi.com/v1/send-sms";

        }
        else if ($url = "status"){

            $this->url = "http://api.iletimerkezi.com/v1/get-balance";
        }

        return $this;


    }


    /**
     * @param string $username
     * @return $this
     */
    public function username($username = ""){

        $this->username =   $username;
        return $this;

    }


    /**
     * @param string $password
     * @return $this
     */
    public function password($password = ""){

        $this->password =   $password;
        return $this;

    }


    /**
     * @param string $title
     * @return $this
     */
    public function title($title = ""){

        $this->title    =   $title;
        return $this;

    }


    /**
     * @param string $text
     * @return $this
     */
    public function text($text = ""){

        $this->text    =   $text;
        return $this;

    }


    /**
     * @param string $date
     * @return $this
     */
    public function date($date = ""){

        $this->date = $date;
        return $this;

    }


    /**
     * @param array $array
     * @return $this
     */
    public function addnumber(array $array = []){

        $this->numbers[] = $array;
        return $this;

    }


    /**
     * @return string
     */
    public function numberlist(){

        $List = "";
        foreach($this->numbers[0] as $number){

            $List .= "<number>{$number}</number>";

        }

        return $List;

    }


    /**
     * @return $this
     */
    public function sms(){

        $this->xml =  <<<EOS
<request>
     <authentication>
         <username>{$this->username}</username>
         <password>{$this->password}</password>
     </authentication>

     <order>
         <sender>{$this->title}</sender>
         <sendDateTime>{$this->date}</sendDateTime>
         <message>
             <text>{$this->text}</text>
             <receipents>{$this->numberlist() }</receipents>
         </message>
     </order>
</request>
EOS;
        return $this;

    }


    /**
     * @return $this
     */
    public function status(){

        $this->xml =  <<<EOS
<request>
     <authentication>
         <username>{$this->username}</username>
         <password>{$this->password}</password>
     </authentication>
</request>
EOS;
        return $this;

    }


    /**
     * @return \SimpleXMLElement
     */
    public function send(){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$this->header);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);

        return simplexml_load_string(curl_exec($ch));


    }


}
