<?php require_once("../includes/initialize.php"); ?>
<?php 

if(empty($_GET['id']))
{
    $message = "No photograph ID was provided";
    redirect_to('flickblog.php');
}

$photo = Photograph::find_by_id($_GET['id']);
$user = User::find_by_id($photo->user_id);

if(!$photo)
{
    $message = "Photograph cannot be located";
    redirect_to('flickblog.php');
}

if(isset($_POST['submit']))
{
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);
    
    $new_comment = Comment::make_comment($photo->id, $author, $body);
    if($new_comment && $new_comment->save())
    {
        $subject = "New Comment posted in one of your FlickPost(s)";
        $message_body = "FlickPost: {$photo->topic}\r\n";
        $message_body .= "Comment Author: {$author}\r\n";
        $message_body .= "Comment: {$body}\r\n";
        $message_body .= "\r\nPlease visit http://www.fnp.com to findout more\r\n";
        $message_body .= "\r\nRegards!\r\nFlick & Post Team.";
        $mailto = $user->email;
        $toname = $user->full_name;
        send_mail($message_body, $subject, $mailto, $toname);
        $session->message("Comment Submitted Successfully!");
        redirect_to("flickpost.php?id={$photo->id}");
    }
    else
    {
        $message = "There was an error when saving the comment";
    }
}
else
{
    
}

$comments = $photo->comments();
echo public_template(stripslashes($photo->topic));
?>
       <div id="fnp_menu">
    
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="flickblog.php" class="current">FlickBlog</a></li>
                <?php if($session->is_logged_in())
                { ?>
                    <li><a href="admin/index.php">Control Panel</a></li>
                    <li><a href="admin/logout.php">Logout</a></li>
                <?php }
                else { ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="admin/login.php">Login</a></li>
                <?php } ?>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>    	
    
    	</div> <!-- end of fnp_menu -->
        
        <div class="cleaner"></div>
	</div> <!-- end of header -->
    
    <div id="fnp_content">
        

<h4><a href="flickblog.php?page=<?php echo $session->get_pagination();?>">&laquo; Back</a></h4>
<?php echo output_msg($message)."<br />";?>
<div id="flickpost">
    <center><h1><?php echo stripslashes($photo->topic); ?></h1></center>
    <center><h4>by <?php echo $user->full_name()?></h4></center>
    <div class="flickpost_image"><center><img src="<?php echo $photo->image_path();?>"/></center></div>
    <div class="flickpost"><?php echo stripslashes($photo->content);?></p>
</div>
</div>

<div id="fnp_comments">
    <?php if($comments){echo "<h3 style=\"margin-top:10px;\">Comments</h3>";}?>
    <?php foreach($comments as $comment): ?>
    <div class="fnp_comment" style="margin-bottom: 2em;">
        <div class="comment-meta">
            <?php echo htmlentities($comment->author); ?> wrote:
        </div>
        <div class="comment-body">
            <?php echo strip_tags($comment->body, '<strong><em><p>'); ?>            
        </div>
        <div class="comment-meta">
            <?php echo timestamp_convert($comment->created); ?>
        </div>
    </div>
    <?php    endforeach; ?>
</div>

<div id="comment-form">
    <?php echo output_msg($message)."<br />";?>
    <h3>Add new Comment</h3>
<form action="flickpost.php?id=<?php echo $photo->id;?>" method="post">
    <table>
        <tr>
            <td>
                Name :
            </td>
            <td>
                <input type="text" name="author" value="<?php echo htmlentities($author);?>" />
            </td>
        </tr>
        <tr>
            <td>
                Comment :
            </td>
            <td>
                <textarea name="body" rows="8" cols="40"><?php echo htmlentities($body);?></textarea>
            </td>
        </tr>
    </table>
 <input type="submit" value="Submit Comment" name="submit" />
 <p style="font-size: 0.6em;">&lt;em&gt; &lt;p&gt; &lt;strong&gt; Tags are allowed</p>

</form>
</div>

<?php
include_footer_layout('footer.php');
?>