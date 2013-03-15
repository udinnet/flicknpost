<?php

class Session
{
    public $user_id;
    public $adm_user;
    private $photo_id;
    private $pagination_page;
    private $edit_user;
    private $logged_in = FALSE;
    public $message;


    function __construct() {
        session_start();
        $this->check_login();
        $this->check_message();
        
        if($this->logged_in)
        {
            
        }
        else
        {
            
        }
        
    }
    
    /*edit user*/
    
    public function set_edit_user($userid){
        $_SESSION['edit_user']= $userid;  
    }
    
    public function unset_edit_user(){
        unset($this->edit_user);
        unset($_SESSION['edit_user']);
    }
    
    public function get_edit_user(){
        $this->edit_user = $_SESSION['edit_user'];
        return $this->edit_user;
    }
    
    
    /*edit flickpost entry*/
    
    public function set_edit_photo($photoid){
        $_SESSION['photo_id']= $photoid;  
    }
    
    public function unset_edit_photo(){
        unset($this->photo_id);
        unset($_SESSION['photo_id']);
    }
    
    public function get_edit_photo(){
        $this->photo_id = $_SESSION['photo_id'];
        return $this->photo_id;
    }
    

    public function login($user)
    {
        if($user) //DB should find the user and relavent password
        {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->adm_user = $_SESSION['adm_user'] = $user->adm;
            $this->logged_in = TRUE;
        }
    }
    
    public function logout()
    {
        unset ($_SESSION['user_id']);
        unset ($_SESSION['adm_user']);
        unset ($this->user_id);
        unset ($this->adm_user);
        $this->logged_in = FALSE;
    }
    
    public function is_logged_in()
    {
        return $this->logged_in;
    }
    
    private function check_login()
    {
        if(isset ($_SESSION['user_id']) && isset ($_SESSION['adm_user']))
        {
            $this->user_id = $_SESSION['user_id'];
            $this->adm_user = $_SESSION['adm_user'];
            $this->logged_in = TRUE;
        }
        else
        {
            unset ($this->user_id);
            unset ($this->adm_user);
            $this->logged_in = FALSE;
        }
    }
    
    private function check_message()
    {
       if(isset ($_SESSION['message']))
       {
           $this->message = $_SESSION['message'];
           unset ($_SESSION['message']);
       }
       else
       {
           $this->message = "";
       }
    }
    
    public function set_pagination($page=1)
    {
        $_SESSION['pagination_page']=$page;
    }
    
    public function get_pagination()
    {
        $this->pagination_page = $_SESSION['pagination_page'];
        if(empty($this->pagination_page))
        {
            return 1;
        }
        else
        return $this->pagination_page;
    }

    public function message($msg="")  //have dual functionality
    {
        if(!empty ($msg))
        {
            //Set the value to session
            $_SESSION['message'] = $msg;
        }
        else
        {
            //Get the value
            return $this->message;
        }
    }
    
}

$session = new Session();
$message = $session->message(); //By this user can override $message anywhere

?>
