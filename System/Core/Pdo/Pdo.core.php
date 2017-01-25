<?php

namespace System\Core\Pdo;


use System\Error\FIX_Error;
use System\Router\FIX_Router as Router;

class Pdo
{


    public static $_query;
    public static $_tablename;
    public static $_grupby;
    public static $_orderyb;
    public static $_limit;
    public static $_multiple;
    public static $_setdata;
    public static $_wheredata;
    public static $_indata;




    /**
     * @return Pdo
     */
    public static function fix()
    {
        return new self();
    }


    /**
     * @return \PDO
     */
    public function connect(){

        try {

            $Data       = (array) Router::getConfig()["database"];
            $DataBase   = (array) $Data["pdo"];
            $PDO        = new \PDO('mysql:host=' . $DataBase["host"] . ';dbname=' . $DataBase["table"], $DataBase["username"], $DataBase["password"]);
            $PDO->query('SET CHARACTER SET ' . $DataBase["charset"]);
            $PDO->query('SET NAMES ' . $DataBase["charset"]);

            return $PDO;

        } catch ( \PDOException $e ){ die(FIX_Error::fix()->SystemErrorMessage($e->getMessage())->Run()); }

    }


    /**
     * @param null $table
     * @param string $selector
     * @return $this
     */
    public function select($table = null, $selector = "*") {

        self::$_query = "SELECT" . FIX_EOL . $selector . FIX_EOL . "FROM" . FIX_EOL . $table;
        self::$_tablename = $table;
        return $this;

    }


    /**
     * @param null $columname
     * @return $this
     */
    public function insert($columname = null){

        self::$_query = "INSERT INTO".FIX_EOL.$columname;
        return $this;

    }


    /**
     * @param null $columname
     * @return $this
     */
    public function delete($columname = null){

        self::$_query = "DELETE FROM".FIX_EOL.$columname;
        return $this;

    }


    /**
     * @param null $columname
     * @return $this
     */
    public function update($columname = null){

        self::$_query = "UPDATE".FIX_EOL.$columname;
        return $this;

    }


    /**
     * @param string $query
     * @param array $data
     * @return $this
     */
    public function manuel($query = "", array $data = []){

        return $this->connect();

    }


    /**
     * @param array|null $colm
     * @param array|null $data
     * @param string $bracket
     * @return $this
     */
    public function  set(array $colm = null, array $data = null,$bracket = ","){

        if(is_array($colm) && is_array($data) && count($colm) >= count($data)){


            if(count($colm) === count($data)){


            self::$_query .= FIX_EOL."SET".FIX_EOL;

            $count = 0;

            foreach($colm as $col){

                $count = $count+1;
                if(count($colm) === $count){

                    self::$_query .= FIX_EOL.$col."=?".FIX_EOL;

                }else{

                    self::$_query .= FIX_EOL.$col."=?".FIX_EOL.$bracket.FIX_EOL;

                }

            }

            self::$_setdata = $data;

            return $this;

            }else{ die(FIX_Error::fix()->SystemErrorMessage(["Pdo Library ( Set ) Data and colm are not equal"])->run()); }

        }{ die(FIX_Error::fix()->SystemErrorMessage(["Pdo Library ( Set ) Data and colm are not array"])->run()); }


    }

    /**
     * @param array|null $colm
     * @param array|null $data
     * @param string $bracket
     * @return $this
     */
    public function  where(array $colm = null, array $data = null,$bracket = "AND"){


        if(is_array($colm) && is_array($data) && count($colm) >= count($data)){


            if(count($colm) === count($data)){

                self::$_query .= FIX_EOL."where".FIX_EOL;

                $count = 0;

                foreach($colm as $col){

                    $count = $count+1;
                    if(count($colm) === $count){

                        self::$_query .= FIX_EOL.$col."=?".FIX_EOL;

                    }else{

                        self::$_query .= FIX_EOL.$col."=?".FIX_EOL.$bracket.FIX_EOL;

                    }

                }

                self::$_wheredata = $data;

                return $this;
            }else{ die(FIX_Error::fix()->SystemErrorMessage(["Pdo Library ( where ) Data and colm are not equal"])->run()); }

        }{ die(FIX_Error::fix()->SystemErrorMessage(["Pdo Library ( where ) Data and colm are not array"])->run()); }

    }


    /**
     * @param array|null $colm
     * @param array|null $data
     * @param string $bracket
     * @return $this
     */
    public function  in($colm = null, array $data = null,$bracket = ","){


        if( is_array($data)){


                $in  = str_repeat('?,', count($data) - 1) . '?';
                self::$_query .= FIX_EOL.$colm.FIX_EOL."IN (".$in.")".FIX_EOL;
                self::$_indata = $data;

                return $this;


        }{ die(FIX_Error::fix()->SystemErrorMessage(["Pdo Library ( where ) Data and colm are not array"])->run()); }

    }

    /**
     * @param null $columname
     * @param string $sort
     * @return $this
     */
    public function orderby($columname = null, $sort = "ASC"){

        self::$_query .= "ORDER BY".FIX_EOL.$columname.FIX_EOL.$sort;
        return $this;


    }

    /**
     * @param null $columname
     * @return $this
     */
    public function groupby($columname = null){

        self::$_query .= FIX_EOL."GROUP BY".FIX_EOL.$columname;
        return $this;

    }

    /**
     * @param null $start
     * @param null $finish
     * @return $this
     */
    public function limit($start = null,$finish = null){

        self::$_query .= FIX_EOL."LIMIT".FIX_EOL.$start.",".$finish.FIX_EOL;
        return $this;

    }


    public function ands($start = ","){

        self::$_query .= FIX_EOL.$start.FIX_EOL;
        return $this;

    }

    /**
     * @return array
     */
    public function exportsql(){

        return [
            "query"    => self::$_query,
            "where"    => self::$_wheredata,
            "set"      => self::$_setdata,
            "in"       => self::$_indata
        ];

    }


    /**
     * @param bool|false $single
     * @return array|mixed
     */
    public function run($single  = false){

        $array1 = [];
        $array2 = [];
        $array3 = [];

        if(is_array(self::$_setdata)){

            $array1 = self::$_setdata;
        }

        if(is_array(self::$_wheredata)){

            $array2 = self::$_wheredata;
        }

        if(is_array(self::$_indata)){

            $array3 = self::$_indata;
        }

        if(self::$_query !== ""){


            if(is_array(self::$_wheredata) or is_array(self::$_setdata)){

                $sql = $this->connect()->prepare(self::$_query);

            }else{

                $sql = $this->connect()->query(self::$_query);
            }


            if( count(array_merge($array1,$array2,$array3)) > 0 ){

                $sql->execute(array_merge($array1,array_merge($array2,$array3)));

            }

            if($single){

                $Export = $sql->fetch(\PDO::FETCH_ASSOC);

            }else{

                $Export = $sql->fetchAll(\PDO::FETCH_ASSOC);

            }

            return $Export;

        }

    }


}