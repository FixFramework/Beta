<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 1.03.2017
 * Time: 12:09
 */

namespace System\Core\Upload;


use System\Router\FIX_Router;

class Upload
{

    public static $_File;

    public static $_UploadPath;

    public static $_FileTmp;

    public static $_FileName;

    public static $_FileType;

    public static $_FileSize;

    public static $_FileError;



    /**
     * @return Upload
     */
    public static function fix(){

        return new self();

    }

    /**
     * @param null $File
     * @return $this
     */
    public function file($File = null){

        self::$_File        = $File;
        self::$_FileName    = $_FILES[self::$_File]["name"];
        self::$_FileType    = $_FILES[self::$_File]["type"];
        self::$_FileTmp     = $_FILES[self::$_File]["tmp_name"];
        self::$_FileError   = $_FILES[self::$_File]["error"];
        self::$_FileSize    = $_FILES[self::$_File]["size"];
        return $this;

    }


    /**
     * @param array $_Upload
     * @return bool
     */
    public function upload(array $_Upload = ["name" => "Fix-Upload.jpg","path" => false ]){

        $_Upload["path"] ? self::$_UploadPath = $_Upload["path"] : self::$_UploadPath = FIX_APP_DIR.FIX_SLASH.FIX_Router::appMultipleStatus().FIX_SLASH.FIX_UPLOAD_FOLDER.FIX_SLASH;

        return move_uploaded_file(self::$_FileTmp,self::$_UploadPath.$_Upload["name"]);

    }


    /**
     * @param array|null $_Mark
     * @param bool $_Path
     */
    public function watermark(array $_Mark = null, $_Path = false){

        !is_array($_Mark) ? exit("Watermark Config Error (array)") : null ;
        !isset(self::$_FileTmp) ? exit("Watermark Master File Error file('xxxx') file input name") : null;

        $_Path ? self::$_UploadPath = $_Path : self::$_UploadPath = FIX_APP_DIR.FIX_SLASH.FIX_Router::appMultipleStatus().FIX_SLASH.FIX_UPLOAD_FOLDER.FIX_SLASH;

        $_Marks  = imagecreatefrompng($_Mark["mark"]);
        $_Image = imagecreatefromjpeg(self::$_FileTmp);

        $right_blank = $_Mark["right"];
        $bottom_blank = $_Mark["bottom"];
        $sx = imagesx($_Marks);
        $sy = imagesy($_Marks);

        imagecopy($_Image, $_Marks, imagesx($_Image) - $sx - $right_blank,  imagesy($_Image) - $sy - $bottom_blank,  0, 0, imagesx($_Marks), imagesy($_Marks));

        header('Content-type: image/png');
        $_Mark["save"] ? imagepng($_Image,self::$_UploadPath.$_Mark["savename"]) : imagepng($_Image);
        imagedestroy($_Image);

    }

}