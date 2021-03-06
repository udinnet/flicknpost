<?php
require_once ('../../includes/initialize.php');

if(!$session->is_logged_in())
{
    redirect_to('login.php');
}

if(isset($_POST['submit'])){
   if($session->adm_user==1)
    {
        $set_username = $_POST['username'];
    }
    else
    {
        $set_username = 1;
    }
    
    if($set_username&& !empty($_POST['email']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['password2']))
    {
        
        $user = User::find_by_id($session->user_id);
        
        if($_POST['password']==$_POST['password2'])
        {
            
            if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $_POST['email'])) {
   	        $message = "Email is invalid";
                $session->message($message);
                redirect_to('update_my_prof.php');
             }    
            
            if($_POST['username']!=$user->username)
            {
                if(User::check_availability("username", $_POST['username']))
                {
                    $message = "An user already exsist with this username";
                    $session->message($message);
                    redirect_to('update_my_prof.php');
                }
            }
            
            if($_POST['email']!=$user->email)
            {
                if(User::check_availability("email", $_POST['email']))
                {
                    $message = "An user already exsist with this email address";
                    $session->message($message);
                    redirect_to('update_my_prof.php');
                }
            }
            
            $user->email = $_POST['email'];
            if($session->adm_user==1)
            {
                $user->username = $_POST['username'];
            }
            $user->first_name = $_POST['firstname'];
            $user->last_name = $_POST['lastname'];
            $user->password = sha1($_POST['password']);
            
            if($user->save()){
                $message = "User successfully Updated";
                $session->message($message);
                $session->unset_edit_user();
                redirect_to('index.php');
            }
            else
            {
                $message = "SQL Error! User not updated";
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
$edit_userid = $session->user_id;
if(!empty($edit_userid)){
    $user = User::find_by_id($edit_userid);
    if($user)
    {

    }
    else {
    $session->message("Cannot find user from the Database!");
    redirect_to("index.php");
    }
}
else
{
    $session->message("No user found in the session! Please try again");
    redirect_to("index.php");
}   
?>

<?php
echo admin_template("Update My Profile");
?>
<h1>Edit User Detail </h1>
<?php echo output_msg($message);?>
<h4><a href="index.php">&laquo; Back to Control Panel</a></h4>
        <div id="usr_form">
        
            <form method="post" name="update_user_detail" action="update_my_prof.php">
               <?php if($session->adm_user==1)
               {
                   echo "<label for=\"username\">Username:</label> <input type=\"text\" id=\"username\" name=\"username\" class=\"input_field\" value=\"{$user->username}\"/>";
               }
               else
                   echo "<label for=\"username\">Username: </label>{$user->username}";  
                   
               ?>
              <div class="cleaner_h10"></div>
                
              <label for="email">Email Address:</label> <input type="text" id="email" name="email" class="input_field" value="<?php echo $user->email; ?>"/>
              <div class="cleaner_h10"></div>
                
              <label for="firstname">First Name:</label> <input type="text" name="firstname" id="firstname" class="input_field" value="<?php echo $user->first_name; ?>"/>
              <div class="cleaner_h10"></div>
              <label for="lastname">Last Name:</label> <input type="text" name="lastname" id="lastname" class="input_field" value="<?php echo $user->last_name; ?>"/>
              <div class="cleaner_h10"></div>
              
              <label for="password">Password:</label> <input type="password" name="password" id="password" class="input_field"/>
              <div class="cleaner_h10"></div>
              <label for="password2">Password(Again):</label> <input type="password" name="password2" id="password2" class="input_field"/>
              <div class="cleaner_h10"></div>
                
                <input style="font-weight: bold;" type="submit" class="submit_btn" name="submit" id="submit" value=" Update My Profile " />
            
          </form>
            
        </div>


<?php
include_layout_template('admin_footer.php');
?>
