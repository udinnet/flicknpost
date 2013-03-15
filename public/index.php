<?php require_once("../includes/initialize.php"); ?>
<?php 
$scripts = "<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js\"></script> ";
$scripts .= "<script>window.jQuery || document.write('<script src=\"js/jquery.min.js\"><\/script>')</script> ";
$scripts .= "<script src=\"js/jquery.anythingslider.js\"></script>";
$scripts .= " <link rel=\"stylesheet\" href=\"css/anythingslider.css\">";
$scripts .=  " <style>
	#slider { width:610px; height: 300px; }
	</style>

	<!-- Slider initialization -->
	<script>
		// DOM Ready
		$(function(){
			$('#slider').anythingSlider();
		});
	</script> ";

echo public_template("",$scripts);
$fp_photos = Photograph::home_page_photos();
?>
       <div id="fnp_menu">
    
            <ul>
                <li><a href="index.php" class="current">Home</a></li>
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
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>    	
    
    	</div> <!-- end of fnp_menu -->
        
        <div class="cleaner"></div>
	</div> <!-- end of header -->
    
    <div id="fnp_content">
        <?php echo output_msg($message)."<br />";?>
           <?php 
           
           $slides = Slide::find_all();
           if(!empty($slides)) {?>
        <ul id="slider">
               
                
              
             <?php 
                    foreach($slides as $slide): ?>
                    <li><a href="<?php echo $slide->url;?>"><img src="slider_img/<?php echo $slide->filename;?>" alt="<?php echo $slide->caption;?>" title="<?php echo $slide->caption;?>"></a></li>
                    
                <?php 
                endforeach; ?>
                
	</ul>
              <?php  }
                ?>

        <div class="cleaner_h40"></div>
        <center><h1 id="flickblog_title">Welcome to Flick & Post!</h1></center>
        <div class="cleaner_h40"></div>
        <div class="hand_write">
            
            <p><span class="bigger">P</span>hotography and painting are the same. Each renders imagination in tangible form. The difference is that painters can work completely from imagination, although most of us work from life as a starting point. Both can take lifetimes to master the tools to render imaginations exactly as we intend. With inkjet printing (giclée is the term stolen from painting), they are identical in that each of us is using tools to apply our imagination as physical colors to flat media, often canvas. (We still prefer darkroom, chemically processed media.)</p>
            </div>
        <div class="cleaner_h40"></div>
        <?php
    $fp_photo = array_shift($fp_photos);
    $content = $fp_photo->content;
    
    $post = homepage_box($content);
    
?>
        <?php if($fp_photo) { ?>
        <div class="frontpage_set_box float_l">

            <div class="frontpage_set_image">
                <img src="images/<?php echo $fp_photo->filename;?>"/>
                </div>
    
            <div class="frontpage_set_text">
                <h6><?php echo stripslashes($fp_photo->topic);?></h6>
                <p><?php echo stripslashes($post);?></p>    
                <div class="button"><a href="flickpost.php?id=<?php echo $fp_photo->id;?>">More</a></div>
            </div>

        </div>
        <?php }
        unset($fp_photo);
        $fp_photo = array_shift($fp_photos);
        $content = $fp_photo->content;
    
        $post = homepage_box($content);
        if($fp_photo) {
        ?>
        
                <div class="frontpage_set_box float_r">
            <div class="frontpage_set_image">
                <img src="images/<?php echo $fp_photo->filename;?>"/>
                </div>
    
            <div class="frontpage_set_text">
                <h6><?php echo stripslashes($fp_photo->topic);?></h6>
                <p><?php echo stripslashes($post);?></p>    
                <div class="button"><a href="flickpost.php?id=<?php echo $fp_photo->id;?>">More</a></div>
            </div>

        </div>
        
        <?php } ?>
        
        
        
        
            <div class="cleaner_h40"></div>
        

        <div class="hand_write">
<p><span class="bigger">I</span>t's never been about the gear. It's always been about seeing something, knowing how you want it to look, and making it so. Making it so is the easy part; seeing it in the first place is what makes a photographer. Powers of observation are everything. Snapping a camera is trivial.</p>




</div>
            
            
                    <div class="cleaner_h40"></div>
        <?php
        unset($fp_photo);
        $fp_photo = array_shift($fp_photos);
        $content = $fp_photo->content;
    
        $post = homepage_box($content);
        if($fp_photo) {
        ?>
        <div class="frontpage_set_box float_l">
            <div class="frontpage_set_image">
                <img src="images/<?php echo $fp_photo->filename;?>"/>
                </div>
    
            <div class="frontpage_set_text">
                <h6><?php echo stripslashes($fp_photo->topic);?></h6>
                <p><?php echo stripslashes($post);?></p>    
                <div class="button"><a href="flickpost.php?id=<?php echo $fp_photo->id;?>">More</a></div>
            </div>

        </div>
        <?php }
        unset($fp_photo);
        $fp_photo = array_shift($fp_photos);
        $content = $fp_photo->content;
    
        $post = homepage_box($content);
        if($fp_photo) {
        ?>
                <div class="frontpage_set_box float_r">
            <div class="frontpage_set_image">
                <img src="images/<?php echo $fp_photo->filename;?>"/>
                </div>
    
            <div class="frontpage_set_text">
                <h6><?php echo stripslashes($fp_photo->topic);?></h6>
                <p><?php echo stripslashes($post);?></p>    
                <div class="button"><a href="flickpost.php?id=<?php echo $fp_photo->id;?>">More</a></div>
            </div>

        </div>
                    
       <?php } ?>
<div class="cleaner_h40"></div>

<h3><a href="flickblog.php">Find out More ..</a></h3>

<?php
include_footer_layout('footer.php');
?>
