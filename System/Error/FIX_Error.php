<?php

namespace System\Error;

use System\Core\Json;

class FIX_Error
{

    public static $Template = [];


    public function __construct(){

        header('Content-Type: application/json');

    }

    public static function fix(){

        return new self();

    }

    public function SystemReportigTemplate(array $template = []){

        self::$Template =
            [
                "title"         => $template[0],
                "message"       => $template[1],
                "code"          => $template[2],
                "domaim"        => $template[3],
                "type"          => $template[4],
                "time"          => time()
            ];
        return $this;

    }

    public function SystemKernelReportingErrorMessageToDomain(){

        $this->SystemReportigTemplate(
            [
                "This is application error for domain",
                "Contact to Developer",
                "505",
                FIX_URL,
                "error"
            ]
        );
        return $this;


    }

    public function SystemGetModelError(){

        $this->SystemReportigTemplate(
            [
                "This is include model name undefined",
                "Contact to Developer",
                "505",
                FIX_URL,
                "error"
            ]
        );
        return $this;


    }

    public function SystemGetModelIncludeError(){

        $this->SystemReportigTemplate(
            [
                "This is include model file undefined",
                "Contact to Developer",
                "505",
                FIX_URL,
                "error"
            ]
        );
        return $this;


    }

    public function SystemMaintenanceReportingToDomain(){

        $this->SystemReportigTemplate(
            [
                "The system is currently under maintenance",
                "Try again leter",
                "404",
                FIX_URL,
                "warning"
            ]
        );
        return $this;


    }

    public function SystemApplicationNotFoundFolder(){

        $this->SystemReportigTemplate(
            [
                "The system is not found application folder",
                "Contact to Developer",
                "505",
                FIX_URL,
                "error"
            ]
        );
        return $this;


    }

    public function SystemApplicationDefaultNotFoundController(){

        $this->SystemReportigTemplate(
            [
                "The system is not found application default controller",
                "Contact to Developer",
                "505",
                FIX_URL,
                "error"
            ]
        );
        return $this;


    }

    public function SystemCoreErrorMode(){

        $this->SystemReportigTemplate(
            [
                "System Core Error",
                "Contact to Developer",
                "505",
                FIX_URL,
                "error"
            ]
        );
        return $this;


    }

    public function SystemApplicationControllerFilesNotFound(){

        $this->SystemReportigTemplate(
            [
                "System Application Controller Files Not Found",
                "Contact to Developer",
                "505",
                FIX_URL,
                "error"
            ]
        );
        return $this;


    }

    public function System(){

        $this->SystemReportigTemplate(
            [
                "Fix Framework Kernel Error",
                "Contact to Developer",
                "505",
                FIX_URL,
                "error"
            ]
        );
        return $this;


    }

    public function Run(){


       return Json::fix()->encode(self::$Template);

    }



}