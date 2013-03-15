<?php require_once("../../includes/initialize.php"); ?>
<?php

    $user = User::find_by_id($session->user_id);
    $log_message = $user->username." logged out";
    $action = "Logout";
    log_action($action, $log_message);
    $session->logout();
    redirect_to("login.php");
?>