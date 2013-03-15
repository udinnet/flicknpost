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

$max_sildes = 7;

if($max_sildes<=Slide::count_all())
{
    redirect_to('manage_slides.php');
}

$max_filesize = 1048576;
if(isset ($_POST['submit']))
{
    $slide = new Slide();
    $slide->caption = $_POST['caption'];
    $slide->url = $_POST['url'];
    $slide->attach_file($_FILES['up-file']);
    if($slide->save())
    {
        //success
        $session->message("Slide uploaded successfully");
        redirect_to('manage_slides.php');
    }
    else
    {
        $message = join("<br />", $slide->errors);
    }
}

?>
<?php
echo admin_template("Create Slide");
?>
<h1>Create Front-Page Slide(Admin Only)</h1>
<?php echo output_msg($message);?>
<h4><a href="manage_slides.php">&laquo; Back to Slide Manager</a></h4>
<h3 style="color: red;">Note:- Please user 610x300px slides for the maximum visibility</h3>
<form  id="upload_form" method="post" action="create_slide.php" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_filesize?>" />
    <label for="file">Slide Photo:</label> <input type="file" name="up-file" id="file" />
    <span style="font-size: 0.5em; font-style: italic;">Max file size 1MB</span>
    <div class="cleaner_h10"></div>
    <label for="caption">Caption:</label> <input type="text" name="caption" id="caption" />
    <div class="cleaner_h10"></div> 
    <label for="url">URL for the Slide Link:</label> <input type="text" name="url" id="url" />
    <div class="cleaner_h10"></div>
    <input type="submit" name="submit" value="Add Slide" />
</form>



<?php
include_layout_template('admin_footer.php');
?>
