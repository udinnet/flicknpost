<?php
require_once ('../../includes/initialize.php');

if($session->is_logged_in())
{
    redirect_to('index.php');
}

if(isset ($_POST['submit']))
{
    $username = trim($_POST['username']);
    $password = sha1(trim($_POST['password']));
    
    $user_found = User::authenticate($username,$password);
    
    if($user_found)
    {
        $log_message = $user_found->username." logged in";
        $action = "Login";
        log_action($action, $log_message);
        $session->login($user_found);
        redirect_to('index.php');
    }
    else
    {
        $message = "The username/passowrd combination incorrect!";
    }
}
else
{
    //$message = "Please fill both username and password fields";
    $username = "";
    $password = "";
}
if($session)
?>

<?php
echo admin_template("Login", 1);
?>
        <h3 style="color: #ffb305;"><?php echo $message;?></h3>
        <h1>User Login</h1>
        <br />
        <form action="login.php" method="post">
            <table>
                <tr>
                    <td>
                        Username :  
                    </td>
                    <td>
                        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username);?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Password : 
                    </td>
                    <td>
                        <input type="password" name="password" maxlength="30" value=""/>
                    </td>
                </tr>
            </table>
            <div class="cleaner_h10"></div>
            <input type="submit" name="submit" value="Login" />
        </form>
        <div class="cleaner_h10"></div>
        <h5>Don't have an Account? <a href="../register.php">Create one now</a></h5>
<?php
include_footer_layout('admin_footer.php');
?>