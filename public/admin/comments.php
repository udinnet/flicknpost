<?php
require_once ('../../includes/initialize.php');

if(!$session->is_logged_in())
{
    redirect_to('login.php');
}
?>
<?php
if(empty($_GET['id']))
{
    $message = "No photograph ID was provided";
    redirect_to('photo_list.php');
}

$photo = Photograph::find_by_id($_GET['id']);

if(!$photo)
{
    $message = "Photograph cannot be located";
    redirect_to('photo_list.php');
}

if($photo->user_id!=$session->user_id && $session->adm_user==0)
{
    $message = "You don't have rights to edit others photos";
    redirect_to('photo_list.php');
}

$comments = $photo->comments();
?>
<?php
echo admin_template("Modarate Comments");
?>
<h4><a href="index.php">&laquo; Back to Control Panel</a></h4>
<div id="comments">
    <?php echo output_msg($message)."<br />";?>
    <h2>Comments posted under the photo <?php echo $photo->topic?></h2>
    <img src="../<?php echo $photo->image_path(); ?>" style="margin-left: 50px;" width="100" alt="<?php echo $photo->topic?>" title="<?php echo $photo->filename?>" />
    <?php foreach($comments as $comment): ?>
    <div class="comment" style="margin-bottom: 2em;">
        <div class="author">
            <?php echo htmlentities($comment->author); ?> wrote:
        </div>
        <div class="comment-body">
            <?php echo strip_tags($comment->body, '<strong><em><p>'); ?>            
        </div>
        <div class="comment-meta">
            <?php echo timestamp_convert($comment->created); ?>
        </div>
        <a href="delete_comment.php?com_id=<?php echo $comment->id;?>&pho_id=<?php echo $photo->id;?>" onclick="return confirm('Are You Sure?');">Delete this comment</a>
    </div>
    <?php    endforeach; ?>
    <?php if(empty($comments))echo "<p>No Comments for this FlickPost yet</p>";?>
</div>

<?php
include_layout_template('admin_footer.php');
?>
