<?php require_once("../includes/initialize.php"); ?>
<?php 
$script = "<script src=\"js/form_validator_cnt.js\"></script>";
$script .= "<script src=\"js/jquery.min.js\"></script>";
echo public_template("Contact Us",$script);

if(isset($_POST['submit']))
{
    $author = trim($_POST['author']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['text']);
    
    if(!empty($author)&&!empty ($email)&&!empty ($message))
    {
        $subject = "Hey Webmaster, You got a mail from the Contact Form";
        $admin = "udithabnd@dr.com";
        $message_body = "Sender Name: {$author}\r\n";
        $message_body .= "Email: {$email}\r\n";
        $message_body .= "Telephone Number: {$phone}\r\n";
        $message_body .= "Message: {$message}";
        $mailto = $admin;
        $toname = "Admin";
        $result = send_mail($message_body, $subject, $mailto, $toname);
        
        if($result)
        {
            $session->message("Mail Successfully sent! team will contact you soon");
            redirect_to('contactus.php');
        }
        else
        {
            $session->message("Mail sending problem. Try again later");
            redirect_to('contactus.php');
        }
    }
    else
    {   $session->message("Please fill required fields");
        redirect_to('contactus.php');
    }
}


        


?>
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
                    <li><a href="register.php">Register</a></li>
                    <li><a href="admin/login.php">Login</a></li>
                <?php } ?>
                <li><a href="contactus.php" class="current">Contact Us</a></li>
            </ul>    	
    
    	</div> <!-- end of fnp_menu -->
        
        <div class="cleaner"></div>
	</div> <!-- end of header -->
    
    <div id="fnp_content">
        <h1>Contact Flick & Post Team</h1>
        <h3 style="color: #ffb305;"><?php echo $session->message();?></h3>  
         <div id="errorT">
        <img src="assert_img/error.gif" alt="error" /><span id="errorMsg"></span>
        </div>


        <div class="cleaner_h30"></div>
        <div class="hand_write"><p>Hey! Wanna contact our Great team? This is the place for it. Write whatever you want. We're happy to read those. And by the way, Enjoy the WebSite!<p></div>
        <div class="cleaner_h30"></div>
<div id="contact_form">
        
            <form id="contact_form_id" method="post" name="contact" action="contactus.php">
            
              <label for="author">Name:</label> <input type="text" id="author" name="author" class="input_field" /><span class="req_star">*</span>
                <div class="cleaner_h10"></div>
                
                <label for="email">Email:</label> <input type="text" id="email" name="email" class="input_field" /><span class="req_star">*</span>
                <div class="cleaner_h10"></div>
                
                <label for="phone">Phone:</label> <input type="text" name="phone" id="phone" class="input_field" />
              <div class="cleaner_h10"></div>
                
                <label for="text">Message:</label> <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea><span class="req_star">*</span>
                <div class="cleaner_h10"></div>
                
                <input style="font-weight: bold;" type="submit" class="submit_btn" name="submit" id="submit" value=" Send " />
                <input style="font-weight: bold;" type="reset" class="submit_btn" name="reset" id="reset" value=" Reset " />
            
          </form>
            
        </div>
        <div class="cleaner_h10"></div>
        <div style="margin-left: 60px;"><span class="req_star">* Fields marked as required</span></div>
        
        
<?php
include_footer_layout('footer.php');
?>
