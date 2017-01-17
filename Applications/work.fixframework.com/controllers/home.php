<?php

use System\Fix\Fix as Fix;
use System\Core\Parsedown as Parsedown;

class home
{

    public static function index(){

       echo Fix::show();



    }


    public function test(){


        echo Parsedown::fix()->text('escaped \*emphasis\*.

`escaped \*emphasis\* in a code span`

    escaped \*emphasis\* in a code block

\\ \` \* \_ \{ \} \[ \] \( \) \> \# \+ \- \. \!

_one\_two_ __one\_two__

*one\*two* **one\*two**');


    }
}

