<?php
require_once ('../../includes/initialize.php');

if(!$session->is_logged_in())
{
    redirect_to('login.php');
}

if(isset ($_POST['submit']))
{   
    $edit_photoid = $session->get_edit_photo();
    if(!empty($edit_photoid))
    {
        $photo = Photograph::find_by_id($session->get_edit_photo());
        $photo->topic = $_POST['topic'];
        $photo->content = $_POST['content'];
        if($photo->update())
        {
            //success
            $session->unset_edit_photo();
            $session->message("FlickPost edited successfully");
            redirect_to("index.php");
        }
        else
        {
            $session->unset_edit_photo();
            $message = join("<br />", $photo->errors);
            $session->message($message);
            redirect_to("index.php");
        }

        }
}
?>
<?php
if(!empty($_GET['id']))
{
    $photo = Photograph::find_by_id($_GET['id']);
    if(!empty($photo))
    {
        $session->set_edit_photo($photo->id);        
    }
    else
    {
        $session->message("Cannot find the entry from the Database!");
        redirect_to("index.php");
    }
}
else
{
    $session->message("Cannot find the entry. Did you change the URL?");
    redirect_to("index.php");
}

?>
<?php
echo admin_template("Edit FlickPost");
?>
<h1>Edit FlickPost</h1>
<?php echo output_msg($message);?>
<h4><a href="index.php">&laquo; Back to Control Panel</a></h4>
<form  id="edit_post_form" method="post" action="edit_flickpost.php">
    
    <label for="file">Photo: </label><img src="../images/<?php echo $photo->filename;?>" width="350"/>
    <div class="cleaner_h10"></div>
    <label for="topic">Topic:</label> <input type="text" name="topic" id="topic" value="<?php echo htmlentities(stripslashes($photo->topic)); ?>" />
    <div class="cleaner_h10"></div> 
    <label for="content">Post Content:</label> <textarea id="content" name="content" rows="15" cols="20"><?php echo stripslashes($photo->content); ?></textarea>
    <div class="cleaner_h10"></div>
    <input type="submit" name="submit" value="Edit FlickPost" />
</form>



<?php
include_layout_template('admin_footer.php');
?>