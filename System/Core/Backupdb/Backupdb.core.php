<?php
/*
*   Proje : Fix Cms
*   Autor : Cengiz Akcan
*   Time  : 13.08.2015 13:44:10
*/
namespace System\Core\Backupdb;

class Backupdb
{

    /*
     *
     * @ Params
     * Mysql Db Username
     * */
    public $Username;

    /*
     *
     * @ Params
     * Mysql Db Password
     * */
    public $Password;

    /*
     *
     * @ Params
     * Mysql Db Veritabanı
     * */
    public $Dbname;

    /*
     *
     * @ Params
     * Mysql Db Host
     * */
    public $Host;

    /*
     *
     * @ Params
     * Mysql Db Table
     * */
    public $Tables = false;

    /*
     *
     * @ Params
     * Mysql Db Save File Folder
     * */
    public $File = "/app/storage/";

    /*
     *
     * @ Params
     * Mysql Db Frefix Name
     * */
    public $Title = "FIX-FRAMEWORK-DBBACKUP";


    /**
     * @return Backupdb
     */
    public static function fix(){

        return new self();

    }

    /*
     *
     * @Param Username
     *
     * */
    public function username($par  =""){

        $this->Username = $par;
        return $this;

    }

    /*
     *
     * @Param Password
     *
     * */
    public function password($par  =""){

        $this->Password = $par;
        return $this;

    }

    /*
     *
     * @Param Db Name
     *
     * */
    public function dbname($par  =""){

        $this->Dbname = $par;
        return $this;

    }

    /*
     *
     * @Param Host
     *
     * */
    public function host($par  =""){

        $this->Host = $par;
        return $this;

    }

    /*
     *
     * @Param Table
     *
     * */
    public function table($par  = "*"){

        $this->Tables = $par;
        return $this;

    }

    /*
     *
     * @Param Save Sql Data File
     *
     * */
    public function file($par  = "/app/storage/"){

        $this->File = $par;
        return $this;

    }

    /*
     *
     * @Param Save Sql Data File
     *
     * */
    public function title($par  = "FIX-FRAMEWORK-DBBACKUP"){

        $this->Title = $par;
        return $this;

    }


    /*
     *
     * @Param Username
     *
     * */
    public function run()
    {
        $mysqli = new mysqli($this->Host,$this->Username,$this->Password,$this->Dbname);
        $mysqli->select_db($this->Dbname);
        $mysqli->query("SET NAMES 'utf8'");

        $queryTables    = $mysqli->query('SHOW TABLES');
        while($row = $queryTables->fetch_row())
        {
            $target_tables[] = $row[0];
        }
        if($this->Tables !== false)
        {
            $target_tables = array_intersect( $target_tables, $this->Tables);
        }
        foreach($target_tables as $table)
        {
            $result         =   $mysqli->query('SELECT * FROM '.$table);
            $fields_amount  =   $result->field_count;
            $rows_num=$mysqli->affected_rows;
            $res            =   $mysqli->query('SHOW CREATE TABLE '.$table);
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0)
            {
                while($row = $result->fetch_row())
                { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 )
                    {
                        $content .= "\nINSERT INTO ".$table." VALUES";
                    }
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)
                    {
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) );
                        if (isset($row[$j]))
                        {
                            $content .= '"'.$row[$j].'"' ;
                        }
                        else
                        {
                            $content .= '""';
                        }
                        if ($j<($fields_amount-1))
                        {
                            $content.= ',';
                        }
                    }
                    $content .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num)
                    {
                        $content .= ";";
                    }
                    else
                    {
                        $content .= ",";
                    }
                    $st_counter=$st_counter+1;
                }
            } $content .="\n\n\n";
        }

        $handle = fopen($this->File.$this->Title.'.sql','w+');
        fwrite($handle,$content);
        fclose($handle);

        if($mysqli){ return true; }else{ return false; }
    }

}
