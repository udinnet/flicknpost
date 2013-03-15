<?php
require_once ('../../includes/initialize.php');

if(!$session->is_logged_in())
{
    redirect_to('login.php');
}

if(empty($_GET['pho_id'])||empty($_GET['com_id']))
{
    $session->message("No comment ID and Photo ID was supplied");
    redirect_to("photo_list.php");
}

$photo = Photograph::find_by_id($_GET['pho_id']);
$comment = Comment::find_by_id($_GET['com_id']);

if($comment && $comment->delete())
{
    $session->message("Comment deleted successfully");
    redirect_to("comments.php?id={$photo->id}");
}
else
{
    $msg = "Coment could not be deleted ".$photo->tmp;
    $session->message($msg);
    redirect_to("comments.php?id={$photo->id}");
}






if(isset($database)){$database->close_connection();}
?>