<?php
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */

namespace System\Core\Crop;

class Crop
{

    /*
     *
     * @ param
     * X coordinate is number
     *
     * */
    public $x;

    /*
     *
     * @ param
     * Y coordinate is number
     *
     * */
    public $y;

    /*
     *
     * @ param
     * Width for image
     *
     * */
    public $width = 100;

    /*
     *
     * @ param
     * Height for  image
     *
     * */
    public $height = 100;

    /*
     *
     * @ param
     * Windth for image
     *
     * */
    public $targetw;


    /*
     *
     * @ param
     * Height for image
     *
     * */
    public $targeth;

    /*
     *
     * @ param
     * Only image
     *
     * */
    public $image;

    /*
     *
     * @ param
     * İmage quality
     *
     * */
    public $quality = 90;


    /**
     * @return Crop
     */
    public static function fix(){

        return new self();

    }

    /*
     *
     * Only İmage
     *
     * */
    public  function image($par = ""){

        $this->image = $par;
        return $this;

    }

    /*
     *
     * İmages Target Width
     *
     * */
    public  function width($par = ""){

        $this->width = $par;
        return $this;

    }

    /*
     *
     * İmages Target Height
     *
     * */
    public  function height($par = ""){

        $this->height = $par;
        return $this;

    }

    /*
     *
     * İmages Target Width
     *
     * */
    public  function targetw($par = ""){

        $this->targetw = $par;
        return $this;

    }

    /*
     *
     * İmages Target Height
     *
     * */
    public  function targeth($par = ""){

        $this->targeth = $par;
        return $this;

    }

    /*
     *
     * İmages Width
     *
     * */
    public  function xcor($par = ""){

        $this->x = $par;
        return $this;

    }

    /*
     *
     * İmages Width
     *
     * */
    public  function ycor($par = ""){

        $this->y = $par;
        return $this;

    }
    /*
     *
     * İmages quality
     *
     * */
    public  function quality($par = ""){

        $this->quality = $par;
        return $this;

    }

    /*
     *
     * Crop function running
     *
     * */
    public function run(){

        $img_r = imagecreatefromjpeg($this->image);
        $dst_r = ImageCreateTrueColor( $this->width, $this->height );
        imagecopyresampled($dst_r,$img_r,0,0,$this->x,$this->y,$this->width,$this->height,$this->targetw,$this->targeth);
        header('Content-type: image/jpeg');
        imagejpeg($dst_r,null,$this->quality);

    }

}