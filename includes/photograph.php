<?php
require_once (LIB_PATH.DS.'database.php');

class Photograph extends databaseObject
{
    protected static $table_name = "photographs";
    protected static $db_fields = array('id','user_id','filename','type','size','topic','content');

    public $id;
    public $user_id;
    public $filename;
    public $type;
    public $size;
    public $topic;
    public $content;

    private $temp_path;
    protected $upload_dir= "images";
    protected $upload_errors = array (
    UPLOAD_ERR_OK => "Upload Successfull",
    UPLOAD_ERR_FORM_SIZE => "Error File is lager than MAX_FILE_SIZE",
    UPLOAD_ERR_PARTIAL => "Error Upload not complete",
    UPLOAD_ERR_NO_FILE => "Error No File",
    UPLOAD_ERR_NO_TMP_DIR => "Error No TMP_DIR to upload",
    UPLOAD_ERR_CANT_WRITE => "Error Can't write to disk",
    UPLOAD_ERR_EXTENSION => "Error Upload stopped by the extension"
    );
    public $errors= array();
    
    
    public static function find_photos_by_user($user_id=0)
    {
        global $database;
        
        $sql = "SELECT * FROM ".self::$table_name;
        $sql .= " WHERE user_id=".$database->escape_value($user_id);
        $sql .= " ORDER BY id DESC";
        return self::find_by_sql($sql);
    }
    
    public static function home_page_photos()
    {
        global $database;
        
        $sql = "SELECT * FROM ".self::$table_name;
        $sql .= " ORDER BY id DESC";
        $sql .= " LIMIT 0 , 4";
        return self::find_by_sql($sql);
    }
    
    
    public function attach_file($file)
    {   
        if(!$file || empty ($file) || !is_array($file))
        {
            $this->errors[] = "No file was uploaded";
            return false;
        }
        elseif($file['error']!=0)
        {
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        }
        else
        {
            $this->temp_path = $file['tmp_name'];
            $this->filename = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];
            return true;
        }
        
        
    }
    
    public function distroy()
    {
        if($this->delete()) //first delete DB recode
        {
            //Then delete file
            $target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
            return unlink($target_path)? true : false;
        }
        else
        {
            return false;
        }
    }


    public function save()
    {
        //a new record won't have and id yet
        if(isset ($this->id))
        {
            //just updating the record means only update the topic or description
            $this->update();
        }
        else
        {
            //if there is a error?
            if(!empty ($this->errors)){return false;}
            
            //if the topic is too long to hold in DB table
            if(strlen($this->topic)> 255)
            {
                $this->errors[]="Topic can't be too long than 255 characters. File Upload Failed";
                return false;
            }
            
            //can't save without file name and temp path
            if(empty ($this->filename) || empty ($this->temp_path))
            {
                $this->errors[] = "File location was not available";
                return false;
            }
            
            //determine the target path
            $target_path = SITE_ROOT.DS.'public'.DS.$this->upload_dir.DS.$this->filename;
            
            //Check if the file is alredy exist
            if(file_exists($target_path))
            {
                $this->errors[] = "File already exists in the directory";
                return false;
            }
            
            //Attempt to move the
            if(move_uploaded_file($this->temp_path, $target_path))
            {
                $this->create();
                unset ($this->temp_path); //The file is moved now.
                return true;
            }
            else
            {
                $this->errors[] = "File upload failed. Possibly upload directory permission problem";
                return false;
            }
            
        }
    }
    
    public function comments()
    {
        return Comment::find_comments($this->id);
    }
    
    public function image_path()
    {
        return $this->upload_dir.DS.$this->filename;
    }
    
    public function size_conv()
    {
        if($this->size < 1024)
        {
            return "{$this->size} bytes";
        }
        elseif($this->size < 1048576)
        {
            $size_kb = round($this->size/1024);
            return "{$size_kb} KB";
        }
        else
        {
            $size_mb = round($this->size/1048576);
            return "{$size_mb} MB";
        }
    }
    
    public static function count_all()
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM ".self::$table_name;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_all()
    {
        return self::find_by_sql("SELECT * FROM ".self::$table_name);
    }
    
    public static function find_by_id($id=0)
    {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id=".$database->escape_value($id)." LIMIT 1");
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
    
    public function has_attribute($attribute)
    {
        $object_vars = $this->attributes();
        return array_key_exists($attribute, $object_vars); //returns true or false
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

//    This method is ripped off because I wrote a modified save() method up
//    public function save()
//    {
//        return isset($this->id) ? $this->update() : $this->create() ;
//    }


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
            return true;
            $this->id = $database->insert_id();
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
        return($database->affected_rows() == 1) ? true:false;
    }
    
    public function delete()
    {
        global $database;
        
        $sql = "DELETE FROM ".self::$table_name;
        $sql .= " WHERE id=".$database->escape_value($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true:false;
    }  
}



?>
