<?php
function minttheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   
   
    <li>
        <div class="visual">
            <?php echo get_avatar($comment,$size='57',$default='<path_to_url>' ); ?>
        </div>
        <div class="text">
            <span class="title"><strong><?php comment_author_link(); ?></strong> <?php _e('said on', 'mt_soundstage_translation'); ?> <?php comment_date('M j, Y g:i a'); ?></span>
            <p><?php comment_text() ?></p>
        </div>
    </li>
                    
  
                                
                                        
<?php 
}

