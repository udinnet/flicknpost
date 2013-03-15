<?php
require_once (LIB_PATH.DS.'config.php');

class MySqlDatabase
{
    private $connection;
    private $magic_quotes_active;
    private $real_escape_string;
    public  $last_query;


    public function __construct() {
        $this->open_connection();
        $magic_quotes_active = get_magic_quotes_gpc();
        $real_escape_string = function_exists('mysql_real_escape_string');
    }
    
    public function open_connection()
    {
        $this->connection = mysql_connect(DB_HOST,DB_USER,DB_PASS);
    
        if(!$this->connection)
        {
            die("Database conncetion failed: ".mysql_error());
        }
        else
        {
            $select_database = mysql_select_db(DB_NAME,  $this->connection);
            if(!$select_database)
                die("Database select failed: ".mysql_error());
                    
        }
    }
    
    public function close_connection()
    {
        if(isset ($this->connection))
        {
            mysql_close($this->connection);
            unset ($this->connection);
        }
    }
    
    public function query($sql)
    {
        $this->last_query = $sql;
        $result = mysql_query($sql,$this->connection);
        $this->confirm_query($result);
        return $result;
    }
    
    public function escape_value($value)
    {   
        if($this->real_escape_string)
        {
            if($this->magic_quotes_active)
             $value = stripslashes($value);

            $value = mysql_real_escape_string($value);
        }
        else
        {
            if(!$this->magic_quotes_active)
                $value = addslashes($value);
        }
        
        return $value;
    }
    
    public function num_rows($result_set)
    {
        $result = mysql_num_rows($result_set);
        return $result;
    }
    
    public function insert_id()
    {
        return mysql_insert_id($this->connection);
    }
    
    public function affected_rows()
    {
        return mysql_affected_rows($this->connection);
    }
    
    public function fetch_array($result_set)
    {
        $array = mysql_fetch_array($result_set);
        return $array;
    }

    private function confirm_query($result)
    {
        if(!$result)
        {
            $err_string = "Cannot process query: ".mysql_error();
            $err_string .= "<br/>$this->last_query<br/>";
            die($err_string);
        }
    }    
}

$database = new MySqlDatabase();
$db =& $database;



?>
