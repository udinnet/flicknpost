<?php
require_once ('../../includes/initialize.php');

if(!$session->is_logged_in())
{
    redirect_to('login.php');
}


?>
<?php
echo admin_template("Manage Slider");
?>
<?php
$max_sildes = 7;
$total_slides = Slide::count_all();
if(!empty($total_slides))
{
    $slides = Slide::find_all(); 
}
?>
<h1>Home Page Slides</h1>
<?php echo output_msg($message)."<br />";?>
<h4><a href="index.php">&laquo; Back to Control Panel</a></h4>
<?php if($total_slides<$max_sildes) {
echo "<h4><a href=\"create_slide.php\">Upload a slide</a></h4>";
 }
else
{ 
 echo "<h4>You created maximum number({$max_sildes}) of slides</h4>";   
 } ?>
 
<div class="cleaner_h30"></div>
    <?php if(!empty($slides)){
    foreach ($slides as $slide): ?>
<div class="display_section">
    <p>
        <h3><?php echo stripslashes($slide->caption)?></h3>
        <h3>Slide ID: <?php echo $slide->id ?></h3>
        <div class="left"><img src="<?php echo "../".$slide->image_path(); ?>" width="200" /></div>
        <div class="right">
        File Name: <?php echo $slide->filename; ?>
        <br />
        Type: <?php echo $slide->type; ?>
        <br />
        Size: <?php echo $slide->size_conv(); ?>
        <br />
        <a href="<?php echo stripslashes($slide->url); ?>" target="_blank">Visit Slide URL</a>
        <br />
        <a href="delete_slide.php?id=<?php echo $slide->id; ?>" onclick="return confirm('Are You Sure?');">Delete this Slide</a>
        <br />
        </div>
        <div class="cleaner"></div>
    </p>
    <div class="cleaner"></div>
</div>
    <?php            endforeach;} ?>    
<?php if(empty($slides)){echo "You have No Slides yet. <a href=\"create_slide.php\">Create one now</a>";}?>


<?php
include_layout_template('admin_footer.php');
?>
