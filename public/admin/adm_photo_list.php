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

?>
<?php
echo admin_template("All FlickPosts");
?>
<?php

$photos = Photograph::find_all();
?>
<h1>All FlickPosts :: Admin Only</h1>
<?php echo output_msg($message)."<br />";?>
<h4><a href="index.php">&laquo; Back to Control Panel</a></h4>
<h4><a href="create_flickpost.php">Create FlickPost</a></h4>
<div class="cleaner_h30"></div>
    <?php foreach ($photos as $photo): ?>
<div class="display_section">
    <p>
        <h3><?php echo stripslashes($photo->topic)?></h3>
        <h3>Photo ID: <?php echo $photo->id ?></h3>
        <div class="left"><img src="<?php echo "../".$photo->image_path(); ?>" width="200" /></div>
        <div class="right">
        File Name: <span class="wwrap"><?php echo $photo->filename; ?>
        <br />
        Type: <?php echo $photo->type; ?>
        <br />
        Size: <?php echo $photo->size_conv(); ?>
        <br />
        <?php $user = User::find_by_id($photo->user_id);
        ?>
        Author: <?php echo $user->username;?>
        <br />
        <a href="delete_photo.php?id=<?php echo $photo->id; ?>&src=adm" onclick="return confirm('Are You Sure?');">Delete this Entry</a>
        <br />
        <a href="edit_flickpost.php?id=<?php echo $photo->id?>">Edit this Entry</a>
        <br />
        <a href="comments.php?id=<?php echo $photo->id?>"><?php echo count($photo->comments())?> Comment(s)</a>
        </div>
        <div class="cleaner"></div>
        <p><?php echo stripslashes($photo->content); ?></p>
    </p>
    <div class="cleaner"></div>
</div>
    <?php            endforeach; ?>    
<?php if(empty($photos)){echo "No FilckPosts yet. <a href=\"create_flickpost.php\">Create one now</a>";}?>


<?php
include_layout_template('admin_footer.php');
?>
