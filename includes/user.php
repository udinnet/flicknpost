<?php
require_once (LIB_PATH.DS.'database.php');

class User extends databaseObject
{
    protected static $table_name = "users";
    protected static $db_fields = array('id','username','password','email','first_name','last_name','adm');

    public $id;
    public $username;
    public $password;
    public $email;
    public $first_name;
    public $last_name;
    public $adm;


    public function photos_for_user()
    {
        return Photograph::find_photos_by_user($this->id);
    }
    

    public function full_name()
    {
        if(isset ($this->first_name) && isset ($this->last_name))
                return $this->first_name." ".$this->last_name;
        else
            return "";
    }
    
    public function has_attribute($attribute)
    {
        $object_vars = $this->attributes();
        return array_key_exists($attribute, $object_vars); //returns true or false
    }
    
    public static function authenticate($username="",$password="")
    {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);
        
        $sql = "SELECT * FROM users";
        $sql .= " WHERE username='{$username}'";
        $sql .= " AND password='{$password}'";
        $sql .= " LIMIT 1";
        
        $result_array = self::find_by_sql($sql);
        return !empty ($result_array)? array_shift($result_array):FALSE;  
    }
    
    public static function check_availability($field="",$value="")
    {
        global $database;
        $field = $database->escape_value($field);
        $value = $database->escape_value($value);

        $sql = "SELECT * FROM users";
        $sql .= " WHERE {$field}='{$value}'";
        $sql .= " LIMIT 1";
        
        $result_array = self::find_by_sql($sql);
        return !empty ($result_array)? array_shift($result_array):FALSE;  
    }
    
    
    
    //common DB functions
    public static function find_all()
    {
        return self::find_by_sql("SELECT * FROM users");
    }
    
    public static function find_by_id($id=0)
    {
        $result_array = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
        return !empty ($result_array)? array_shift($result_array):FALSE;    
    }
    
    public static function find_by_sql($sql='')
    {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set))
        {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }

    private static function instantiate($record)
    {
        $object = new self;
        
        foreach($record as $attribute=>$value)
        {
            if($object->has_attribute($attribute))
            {
                $object->$attribute = $value;
            }
        }
        return $object;
    }
    
    protected function attributes()
    {
        $attributes = array();
        
        foreach(self::$db_fields as $field)
        {
            $attributes[$field]=$this->$field; // here we using dynamic var as $this->$field (id,username,...)
        }
        return $attributes;
    }
    
    protected function senetized_attributes()
    {
        global $database;
        $clean_attributes= array();
        foreach($this->attributes() as $key=>$value)
        {
            $clean_attributes[$key]=$database->escape_value($value);
        }
        return $clean_attributes;
    }


    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create() ;
    }


    public function create()
    {
        global $database;
        $attributes = $this->senetized_attributes();
        $sql = "INSERT INTO ".self::$table_name." (";
        $sql .= join(", ", array_keys($attributes));
        //$sql .= "username, password, first_name, last_name";
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        /*$sql .= $database->escape_value($this->username)."', '";      //Removing this to add a new short code
        $sql .= $database->escape_value($this->password)."', '";
        $sql .= $database->escape_value($this->first_name)."', '";
        $sql .= $database->escape_value($this->last_name)."')";*/
        $sql .= "')";
        if($database->query($sql))
        {
            $this->id = $database->insert_id();
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
    public function update()
    {
        global $database;
        
        $attributes = $this->senetized_attributes();
        foreach($attributes as $key=>$value)
        {
            $attribute_pairs[]= "{$key}='{$value}'";
        }
        
        $sql = "UPDATE ".self::$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        /*$sql .= "username = '".$database->escape_value($this->username)."', ";
        $sql .= "password = '".$database->escape_value($this->password)."', ";
        $sql .= "first_name = '".$database->escape_value($this->first_name)."', ";
        $sql .= "last_name = '".$database->escape_value($this->last_name)."' ";*/
        $sql .= " WHERE id=".$database->escape_value($this->id);
        $database->query($sql);
        return($database->affected_rows()== 1) ? true:false;
    }
    
    public function delete()
    {
        global $database;
        
        $sql = "DELETE FROM ".self::$table_name;
        $sql .= " WHERE id=".$database->escape_value($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return($database->affected_rows() == 1) ? true:false;
    }  
}



?>
