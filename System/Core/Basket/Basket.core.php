<?php

namespace System\Core\Basket;


class Basket
{


    public static $basket_name = "fix";

    public static $basket_all = array();


    /**
     * @return Basket
     */
    public static function fix(){

        return new self();

    }


    /**
     * @param array $par
     * @return $this
     */
    public function basket_add( $par = [] ){

        if(is_array($par)){ self::$basket_all[self::$basket_name][] = array_merge( $par, [ "item_number" => rand(0,999999) ] ); }

        return $this;
    }


    /**
     * @param string $par
     * @return $this
     */
    public function basket_name($par = ""){

        self::$basket_name = $par;
        return $this;

    }


    /**
     * @param string $par
     * @return mixed
     */
    public function basket_list($par = ""){

        return self::$basket_all[$par];

    }


    /**
     * @param string $par1
     * @param string $par2
     * @return int
     */
    public function basket_plus_many($par1 = "", $par2 = ""){

        if($par1 !== "" and $par2 !== ""){

            $zero = 0;

            foreach(self::$basket_all[$par1] as $pro){ $zero += $pro[$par2]; }

            return $zero;

        }

    }


    /**
     * @param string $par1
     * @param array $par2
     * @return $this
     */
    public function basket_remove_item($par1 = "",$par2 = []){

       if(is_array($par2) and $par1 !== ""){

           foreach($par2 as $un){ unset(self::$basket_all[$par1][$un]); }

       }

        return $this;

    }


    /**
     * @param string $par
     * @return int
     */
    public function basket_plus_items($par = ""){

        if($par == ""){ return count(self::$basket_all); }else{ return count(self::$basket_all[$par]); }

    }


}