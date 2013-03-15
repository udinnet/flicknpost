<?php
require_once ('../../includes/initialize.php');

if(!$session->is_logged_in())
{
    redirect_to('login.php');
}

if(empty($_GET['id']))
{
    $session->message("No image ID was supplied");
    redirect_to('index.php');
}

$photo = Photograph::find_by_id($_GET['id']);

if($photo && $photo->distroy())
{
    $comments = Comment::find_comments($photo->id);
    foreach ($comments as $comment)
    {
        $comment->delete();
    }
    
    $session->message("The image ".$photo->filename." deleted successfully");
    if(!empty($_GET['src']))
    {
        if($_GET['src']=="adm")
        redirect_to ("adm_photo_list.php");
        elseif($_GET['src']=="norm")
        redirect_to ("photo_list.php");
        else
        redirect_to ("index.php");
    }
    else
    redirect_to('photo_list.php');
}
else
{
    $msg = "Image could not be deleted ".$photo->tmp;
    $session->message($msg);
    //redirect_to('photo_list.php');
}






if(isset($database)){$database->close_connection();}
?>