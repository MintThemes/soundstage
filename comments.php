<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) { ?>
<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'mt_soundstage_translation'); ?></p>
<?php
return;
}
?>
 
<!-- You can start editing here. -->
 

<!--<div class="comments">-->
<?php if ( have_comments() ) : ?>

<div class="title-box">
	<h2><?php comments_number( '0 ' . __('Comments', 'mt_soundstage_translation'), '1 ' . __('Comment', 'mt_soundstage_translation'), '% ' . __('Comments', 'mt_soundstage_translation') ); ?></h2>
</div>


<ul class="comments-list">
<?php wp_list_comments('type=comment&callback=minttheme_comment'); ?>
</ul>


<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->



 
<?php else : // comments are closed ?>
<!-- If comments are closed. -->

 
<?php endif; ?>
<?php endif; ?>
 
<?php if ('open' == $post->comment_status) : ?>

 


 
<div class="cancel-comment-reply">
<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('You must be', 'mt_soundstage_translation'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'mt_soundstage_translation'); ?></a> <?php _e('to post a comment.', 'mt_soundstage_translation'); ?></p>
<?php else : ?>
 

<div class="title-box">
	<h2><?php _e('Got something to say?', 'mt_soundstage_translation'); ?></h2>
</div>




<?php comment_form(); ?>
<?php paginate_comments_links(); ?> 

<?php endif; // If registration required and not logged in ?>
<!--</div><!-- comments-form -->

<?php endif; // if you delete this the sky will fall on your head ?>


