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

        } catch ( \PDOException $e ){

            exit(FIX_Error::fix()->SystemPdoModelError($e->getMessage())->Run());

        }

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

        self::$_query = $query;
        self::$_setdata = $data;
        return $this;

    }


    /**
     * @param array|null $colm
     * @param array|null $data
     * @param string $bracket
     * @return $this
     */
    public function  set(array $colm = null, array $data = null,$bracket = ","){

        if(is_array($colm) && is_array($data) && count($colm) >= count($data)){

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

        }

    }

    /**
     * @param array|null $colm
     * @param array|null $data
     * @param string $bracket
     * @return $this
     */
    public function  where(array $colm = null, array $data = null,$bracket = "AND"){

        if(is_array($colm) && is_array($data) && count($colm) >= count($data)){

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

        }

    }

    /**
     * @param null $columname
     * @param string $sort
     * @return $this
     */
    public function orderby($columname = null, $sort = "ASC"){

        self::$_query .= "ORDER BY ".FIX_EOL.$columname.FIX_EOL.$sort;
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

        self::$_query .= FIX_EOL."LIMIT".FIX_EOL.$start.",".$finish;
        return $this;

    }

    /**
     * @return array
     */
    public function exportsql(){

        return [
            "query"    => self::$_query,
            "where"    => self::$_wheredata,
            "set"      => self::$_setdata
        ];

    }

    /**
     * @param bool|false $single
     * @return array|mixed
     */
    public function run($single  = false){

        $array1 = [];
        $array2 = [];

        if(is_array(self::$_setdata)){

            $array1 = self::$_setdata;
        }

        if(is_array(self::$_wheredata)){

            $array2 = self::$_wheredata;
        }

        if(self::$_query !== ""){

            $sql = $this->connect()->prepare(self::$_query);

            if( count(self::$_setdata) > 0 ){

                $sql->execute(self::$_setdata);

            }

            if($single){

                $sql->fetch(\PDO::FETCH_ASSOC);

            }else{

                $sql->fetchAll(\PDO::FETCH_ASSOC);

            }

            return $sql;

        }

    }


}