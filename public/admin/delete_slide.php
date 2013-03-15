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

if(empty($_GET['id']))
{
    $session->message("No Slide ID was supplied");
    redirect_to('manage_slides.php');
}

$slide = Slide::find_by_id($_GET['id']);

if($slide && $slide->distroy())
{
    $session->message("The Slide ".$slide->filename." deleted successfully");
    redirect_to('manage_slides.php');
}
else
{
    $msg = "Slide could not be deleted ";
    $session->message($msg);
    redirect_to('manage_slides.php');
}






if(isset($database)){$database->close_connection();}
?>