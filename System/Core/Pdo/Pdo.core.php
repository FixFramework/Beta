<?php

namespace System\Core\Pdo;


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

        $PDO = new \PDO('mysql:host=' . Router::getConfig()["database"]["pdo"]["host"] . ';dbname=' . Router::getConfig()["database"]["pdo"]["table"], Router::getConfig()["database"]["pdo"]["username"], Router::getConfig()["database"]["pdo"]["password"]);
        $PDO->query('SET CHARACTER SET ' . Router::getConfig()["database"]["pdo"]["charset"]);
        $PDO->query('SET NAMES ' . Router::getConfig()["database"]["pdo"]["charset"]);

        return $PDO;

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
     * @param array|null $colm
     * @param array|null $data
     * @param string $bracket
     * @return $this
     */
    public function set(array $colm = null, array $data = null,$bracket = ","){


        $count = 0;
        self::$_query .= FIX_EOL."SET".FIX_EOL;
        foreach($colm as $col){

            $count = $count+1;
            if(count($colm) === $count){

                self::$_query .= FIX_EOL.$col."=?".FIX_EOL;

            }else{

                self::$_query .= FIX_EOL.$col."=?".$bracket.FIX_EOL;

            }

        }

        self::$_setdata = $data;

        return $this;

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

                    self::$_query .= FIX_EOL.$col."=".FIX_EOL.$bracket.FIX_EOL;

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

                $sql = $this->connect()->prepare(self::$_query);

                $sql->execute(array_merge($array1,$array2));

            if($single){

                return $sql->fetch(\PDO::FETCH_ASSOC);

            }else{

                return $sql->fetchAll(\PDO::FETCH_ASSOC);

            }


    }


}