<?php require_once("../includes/initialize.php"); ?>
<?php

//Form Processing
if(isset($_POST['submit']))
{
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    if(!empty($username)&&!empty($email)&&!empty($fname)&&!empty($lname)&&!empty($password)&&!empty($password2))
    {
        if($password==$password2)
        {
            if(User::check_availability("username", $username))
            {
                $message = "An user already exsist with this User name";
                $session->message($message);
                redirect_to('register.php');
            }
            elseif(User::check_availability("email", $email))
            {
                $message = "An user already exsist with this Email Address";
                $session->message($message);
                redirect_to('register.php');
            }
            else
            {
                $user = new User();
                $user->username = $username;
                $user->first_name = $fname;
                $user->last_name = $lname;
                $user->password = sha1($password);
                $user->email = $email;
                $user->adm = 0;

                $user->save();
                $session->message("You have registred successfully. <a href=\"admin/login.php\">Please Login Now</a>");
                
                $subject = "Registration on Flick & Post";
                $message_body = "username: {$username}\r\n";
                $message_body .= "Password: {$password}\r\n";
                $message_body .= "\r\nPlease visit http://www.fnp.com to findout more\r\n";
                $message_body .= "\r\nRegards!\r\nFlick & Post Team.";
                $mailto = $user->email;
                $toname = $user->full_name();
                send_mail($message_body, $subject, $mailto, $toname);
                
                redirect_to('register.php');
            }
            
        }
        else
        {
            $session->message("Passwords doesn't match!");
        }
    }
    else
    {
        $session->message("Please complete all the fields!");
    }
}

?>
<?php 

//Send Form Validator Javascript
$script = "<script src=\"js/form_validator_rg.js\"></script>";

echo public_template("Register",$script);


?>
<!-- main menu -->
       <div id="fnp_menu">
    
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="flickblog.php">FlickBlog</a></li>
                <?php if($session->is_logged_in())
                { ?>
                    <li><a href="admin/index.php">Control Panel</a></li>
                    <li><a href="admin/logout.php">Logout</a></li>
                <?php }
                else { ?>
                    <li><a href="register.php" class="current">Register</a></li>
                    <li><a href="admin/login.php">Login</a></li>
                <?php } ?>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>    	
    
    	</div> <!-- end of fnp_menu -->
        
        <div class="cleaner"></div>
	</div> <!-- end of header -->
    
    <div id="fnp_content">
        <h1>Register on Flick & Post</h1>
        <h3 style="color: #ffb305;"><?php echo $session->message();?></h3>
        <div id="errorT">
        <img src="assert_img/error.gif" alt="error" /><span id="errorMsg"></span>
        </div>


<div id="register_form">
        
            <form id="register_frm" method="post" name="register" action="register.php">
            
              <label for="username">User Name:</label> <input type="text" id="username" name="username" class="input_field" value="<?php echo htmlentities($username);?>" /><span class="req_star">*</span>
                <div class="cleaner_h10"></div>
                
                <label for="email">Email:</label> <input type="text" id="email" name="email" class="input_field" value="<?php echo htmlentities($email);?>" /><span class="req_star">*</span>
                <div class="cleaner_h10"></div>
                
                <label for="fname">First Name:</label> <input type="text" id="fname" name="fname" class="input_field" value="<?php echo htmlentities($fname);?>" /><span class="req_star">*</span>
                <div class="cleaner_h10"></div>
                
                <label for="lname">Last Name:</label> <input type="text" id="lname" name="lname" class="input_field" value="<?php echo htmlentities($lname);?>"/><span class="req_star">*</span>
                <div class="cleaner_h10"></div>
                
                <label for="lname">Password:</label> <input type="password" id="password" name="password" class="input_field" /><span class="req_star">*</span>
                <div class="cleaner_h10"></div>
                
                <label for="lname">Password Again:</label> <input type="password" id="password2" name="password2" class="input_field" /><span class="req_star">*</span>
                <div class="cleaner_h10"></div>
                <p>When registering on Flick & Post, you are also accepting our <a href="tos.php">Terms of Service</a></p>
                <div class="cleaner_h10"></div>
                <input style="font-weight: bold;" type="submit" class="submit_btn" name="submit" id="submit" value=" Register " />
                <input style="font-weight: bold;" type="reset" class="submit_btn" name="reset" id="reset" value=" Reset " />
            
          </form>
            
        </div>
        <div class="cleaner_h10"></div>
        <div style="margin-left: 60px;"><span class="req_star">* Fields marked as required</span></div>
        
        
<?php
include_footer_layout('footer.php');
?>
