<?php
require_once ('../../includes/initialize.php');

if(!$session->is_logged_in())
{
    redirect_to('login.php');
}
?>
<?php
echo admin_template("Control Panel");
?>
        <h1>
            User Control Panel
        </h1>
        <?php echo output_msg($message);?>
        <?php $user = User::find_by_id($session->user_id); ?>
        <h3>Hello <?php echo $user->full_name(); ?></h3>
<ul>
<?php if($session->adm_user==1) {
    echo "<li><p><a href=\"create_user.php\">Create User(Admin Only)</a></p></li>";
    echo "<li><p><a href=\"edit_user.php\">Edit User Details(Admin Only)</a></p></li>";
    echo "<li><p><a href=\"logfile.php\">View Log(Admin Only)</a></p></li>";
    echo "<li><p><a href=\"adm_photo_list.php\">All FlickPosts(Admin Only)</a></p></li>";
    echo "<li><p><a href=\"manage_slides.php\">Manage Home Page Slides(Admin Only)</a></p></li>";
    echo "<li><p><a href=\"create_slide.php\">Create a Home Page Slides(Admin Only)</a></p></li>";
}
?>
<li><p><a href="update_my_prof.php">Update my Profile</a></p></li>
<li><p><a href="photo_list.php">My FlickPost List</a></p></li>
<li><p><a href="create_flickpost.php">Create a FlickPost</a></p></li>
<li><p><a href="logout.php">Logout</a></p></li>
</ul>
<?php
include_layout_template('admin_footer.php');
?>
