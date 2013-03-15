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


if($_GET['clear']=='true')
{   
    $log_message ="Log Cleared";
    $action = "Clear";
    log_action($action, $log_message);
    redirect_to('logfile.php'); // unless it'll show the url ?clear=true
}
?>
<?php
echo admin_template("Log Manager");
?>
        <h1>
            Logfile Viewer :: Admin Area
        </h1>
<h4><a href="index.php">&laquo; Back to Control Panel</a></h4>
<p>
    <?php
    $log_message ="Log Read";
    $action = "Read";
    $raw_content = log_action($action,$log_message);
    $html_content = nl2br($raw_content);
    echo $html_content;
    ?>
</p>

        <h4>
            <a href="logfile.php?clear=true">Clear Log</a>
        </h4>
<?php
include_layout_template('admin_footer.php');
?>