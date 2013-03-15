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

if(isset($_POST['submit'])){
    if(!empty($_POST['userid'])){
        if(User::find_by_id($_POST['userid']))
        {
            $session->set_edit_user($_POST['userid']);
            redirect_to("update_usr_dtl.php");
        }
        else{
            $message = "Somethig is wrong. Cannot find the user to edit";
        }
    }
    else{
        $message = "You didn't select any username";
    }
}
?>

<?php
$users = User::find_all();
?>
<?php
echo admin_template("Edit User");
?>
<h1>Edit Users :: Admin Only Page</h1>
<?php echo output_msg($message);?>
<h4><a href="index.php">&laquo; Back to Control Panel</a></h4>
        <div id="usr_form">
        
            <form method="post" name="edit_user" action="edit_user.php">
              <label for="usertype" style="width: 200px;">Please select an User to edit</label>
              <select name="userid">
                  <option value="0" selected="selected">Usernames</option>
                  <?php foreach($users as $user): ?>
                  <option value="<?php echo $user->id;?>"><?php echo $user->username; ?></option>
                  <?php endforeach; ?>
              </select>
              <div class="cleaner_h10"></div>
            <input style="font-weight: bold; margin-left: 0px;" type="submit" class="submit_btn" name="submit" id="submit" value=" Edit this User " />
            
          </form>
            
        </div>


<?php
include_layout_template('admin_footer.php');
?>