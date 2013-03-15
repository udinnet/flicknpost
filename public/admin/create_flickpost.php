<?php
require_once ('../../includes/initialize.php');

if(!$session->is_logged_in())
{
    redirect_to('login.php');
}

$max_filesize = 1048576;
if(isset ($_POST['upload']))
{
    $photo = new Photograph();
    $photo->topic = $_POST['topic'];
    $photo->content = $_POST['content'];
    $photo->user_id = $_SESSION['user_id']; //This cannot be empty. because we're in a logged in state
    $photo->attach_file($_FILES['up-file']);
    if($photo->save())
    {
        //success
        $session->message("File uploaded successfully");
        redirect_to('photo_list.php');
    }
    else
    {
        $message = join("<br />", $photo->errors);
    }
}

?>
<?php
echo admin_template("Create FlickPost");
?>
<h1>Create FlickPost</h1>
<?php echo output_msg($message);?>
<h4><a href="index.php">&laquo; Back to Control Panel</a></h4>
<form  id="upload_form" method="post" action="create_flickpost.php" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_filesize?>" />
    <label for="file">Photo:</label> <input type="file" name="up-file" id="file" />
    <span style="font-size: 0.5em; font-style: italic;">Max file size 1MB</span>
    <div class="cleaner_h10"></div>
    <label for="topic">Topic:</label> <input type="text" name="topic" id="topic" />
    <div class="cleaner_h10"></div> 
    <label for="content">Post Content:</label><textarea id="content" name="content" rows="0" cols="0" class="required"></textarea>
    <div class="cleaner_h10"></div>
    <input type="submit" name="upload" value="Create FlickPost" />
</form>



<?php
include_layout_template('admin_footer.php');
?>