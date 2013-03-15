<?php
require_once ('../../includes/initialize.php');

if(!$session->is_logged_in())
{
    redirect_to('login.php');
}

if($session->adm_user==0)
{
    redirect_to('index.php');
}

if(isset($_POST['submit'])){
    if(isset($_POST['usertype']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['password2']))
    {
        if($_POST['password']==$_POST['password2'])
        {

 	    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $_POST['email'])) {
   	        $message = "Email is invalid";
                $session->message($message);
                redirect_to('create_user.php');
            }    
        
        
            if(User::check_availability("username", $_POST['username']))
            {
                $message = "An user already exsist with this username";
                $session->message($message);
                redirect_to('create_user.php');
            }
            if(User::check_availability("email", $_POST['email']))
            {
                $message = "An user already exsist with this email address";
                $session->message($message);
                redirect_to('create_user.php'); 
            }
            
            $user = new User();
            $user->adm = (int)$_POST['usertype'];
            $user->email = $_POST['email'];
            $user->username = $_POST['username'];
            $user->first_name = $_POST['firstname'];
            $user->last_name = $_POST['lastname'];
            $user->password = sha1($_POST['password']);
            
            if($user->save()){
                $message = "User successfully created";
                $session->message($message);
                redirect_to('index.php');                
            }
            else
            {
                $message = "SQL Error! User not created";
                $session->message($message);                
            }
            
        }
        else
        {
            $message = "Two passwords doesn't match";
        }
        
    }
    else
    {
        $message = "Please fill all the fields";
    }
    $session->message($message);
    
}
else {
    
}

?>
<?php
echo admin_template("Create User");
?>
<h1>Create User :: Admin Only Page</h1>
<?php echo output_msg($message);?>
<h4><a href="index.php">&laquo; Back to Control Panel</a></h4>
        <div id="usr_form">
        
            <form method="post" name="create_user" action="create_user.php">
              <label for="usertype">User Type:</label> 
              <span style="font-size: 0.8em;">Site User </span> <input type="radio" name="usertype" value="0" checked/>   
              <span style="font-size: 0.8em;">| Administrator </span> <input type="radio" name="usertype" value="1"/>  
              <label for="username">Username:</label> <input type="text" id="username" name="username" class="input_field"/>
              <div class="cleaner_h10"></div>
                
              <label for="email">Email Address:</label> <input type="text" id="email" name="email" class="input_field"/>
              <div class="cleaner_h10"></div>
                
              <label for="firstname">First Name:</label> <input type="text" name="firstname" id="firstname" class="input_field"/>
              <div class="cleaner_h10"></div>
              <label for="lastname">Last Name:</label> <input type="text" name="lastname" id="lastname" class="input_field"/>
              <div class="cleaner_h10"></div>
              
              <label for="password">Password:</label> <input type="password" name="password" id="password" class="input_field"/>
              <div class="cleaner_h10"></div>
              <label for="password2">Password(Again):</label> <input type="password" name="password2" id="password2" class="input_field"/>
              <div class="cleaner_h10"></div>
                
                <input style="font-weight: bold;" type="submit" class="submit_btn" name="submit" id="submit" value=" Create User " />
                <input style="font-weight: bold;" type="reset" class="submit_btn" name="reset" id="reset" value=" Reset Fields " />
            
          </form>
            
        </div>


<?php
include_layout_template('admin_footer.php');
?>
