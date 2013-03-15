<?php require_once("../includes/initialize.php"); ?>
<?php 
echo public_template("Flick Blog");

//1. Page Number
$page = !empty($_GET['page']) ? (int)$_GET['page']:1;
$session->set_pagination($page);

//2. Items per page
$per_page= 3;

//3.Total items
$total_count = Photograph::count_all();

//4.Find all photos
//$photos = Photograph::find_all();
$pagination = new Pagination($per_page, $page, $total_count); 
$photos = $pagination->get_pagination();
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
        <center><h1 id="flickblog_title">The FlickBlog</h1></center>
<?php

echo output_msg($message)."<br />";
?>
<?php foreach($photos as $photo): ?>
<div class="flickblog_section">
    <p>
        <?php $user = User::find_by_id($photo->user_id); ?>
        <h3 class="linktopic"><a href="flickpost.php?id=<?php echo $photo->id;?>"><?php echo stripslashes($photo->topic);?></a></h3>
        <p>
        <div class="left"><a href="flickpost.php?id=<?php echo $photo->id;?>"><img src="<?php echo $photo->image_path();?>" width="200" /></a></div>
        <div class="flickblog_content"><?php echo stripslashes($photo->content); ?></div>
        </p>
        <span class="flickblog_author">A FlickPost by: <?php echo $user->full_name();?></span>
        <div style="float: right;"><h4><a href="flickpost.php?id=<?php echo $photo->id;?>">View More..</a></h4></div>
        <div class="cleaner"></div>
    </p>
    <div class="cleaner"></div>
</div>
<?php endforeach; ?>

<div id="pagination" >
<?php
if($pagination->total_count>1)    
    if($pagination->has_next_page())
    {
        echo "<a href=\"flickblog.php?page=";
        echo $pagination->next_page();
        echo "\">Older Posts &raquo;</a>";
    }
    
    for($i=1;$i<=$pagination->total_pages();$i++)
    {
        if($i==$page)
            echo "<span class=\"selected\">{$i}</span>";
        else
            echo "<a href=\"flickblog.php?page={$i}\">{$i}</a>";
    }
    
    if($pagination->has_previous_page())
    {
        echo " <a href=\"flickblog.php?page=";
        echo $pagination->previous_page();
        echo "\">&laquo; Previous</a>";
    }
?>
</div>




<?php
include_footer_layout('footer.php');
?>