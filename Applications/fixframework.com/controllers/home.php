<?php

use System\Fix\Fix as Fix;

class home
{

    public static function index(){

       echo Fix::show();


        try{

            $new = new aa();

        }catch (FIX_Exception $error){

            throw new FIX_Exception("Hata");

        }
    }
}

