<?php //jplayer code ?>
<?php function jplayer_script_discography(){ ?>
	<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    
    
			<script type="text/javascript">
            jQuery(document).ready(function(){
                                    
            var Playlist = function(instance, playlist, options) {
            var self = this;
    
            this.instance = instance; // String: To associate specific HTML with this playlist
            this.playlist = playlist; // Array of Objects: The playlist
            this.options = options; // Object: The jPlayer constructor options for this playlist
    
            this.current = 0;
    
            this.cssId = {
                jPlayer: "jquery_jplayer_",
                interface: "jp_interface_",
                playlist: "jp_playlist_"
            };
            this.cssSelector = {};
    
            jQuery.each(this.cssId, function(entity, id) {
                self.cssSelector[entity] = "#" + id + self.instance;
            });
    
            if(!this.options.cssSelectorAncestor) {
                this.options.cssSelectorAncestor = this.cssSelector.interface;
            }
    
            jQuery(this.cssSelector.jPlayer).jPlayer(this.options);
    
            jQuery(this.cssSelector.interface + " .jp-previous").click(function() {
                self.playlistPrev();
                jQuery(this).blur();
                return false;
            });
    
            jQuery(this.cssSelector.interface + " .jp-next").click(function() {
                self.playlistNext();
                jQuery(this).blur();
                return false;
            });
        };
    
        Playlist.prototype = {
            displayPlaylist: function() {
                var self = this;
                jQuery(this.cssSelector.playlist + " ul").empty();
                for (i=0; i < this.playlist.length; i++) {
                    var listItem = (i === this.playlist.length-1) ? "<li class='jp-playlist-last'>" : "<li>";
                    listItem += "<a href='#' id='" + this.cssId.playlist + this.instance + "_item_" + i +"' tabindex='1'>"+ this.playlist[i].name +"</a>";
    
                    // Create links to free media
                    if(this.playlist[i].free) {
                        var first = true;
                        listItem += "<div class='jp-free-media'>(";
                        jQuery.each(this.playlist[i], function(property,value) {
                            if(jQuery.jPlayer.prototype.format[property]) { // Check property is a media format.
                                if(first) {
                                    first = false;
                                } else {
                                    listItem += " | ";
                                }
                                listItem += "<a id='" + self.cssId.playlist + self.instance + "_item_" + i + "_" + property + "' href='" + value + "' tabindex='1'>" + property + "</a>";
                            }
                        });
                        listItem += ")</span>";
                    }
    
                    listItem += "</li>";
    
                    // Associate playlist items with their media
                    jQuery(this.cssSelector.playlist + " ul").append(listItem);
                    jQuery(this.cssSelector.playlist + "_item_" + i).data("index", i).click(function() {
                        var index = jQuery(this).data("index");
                        if(self.current !== index) {
                            self.playlistChange(index);
                        } else {
                            jQuery(self.cssSelector.jPlayer).jPlayer("play");
                        }
                        jQuery(this).blur();
                        return false;
                    });
    
                    // Disable free media links to force access via right click
                    if(this.playlist[i].free) {
                        jQuery.each(this.playlist[i], function(property,value) {
                            if(jQuery.jPlayer.prototype.format[property]) { // Check property is a media format.
                                jQuery(self.cssSelector.playlist + "_item_" + i + "_" + property).data("index", i).click(function() {
                                    var index = jQuery(this).data("index");
                                    jQuery(self.cssSelector.playlist + "_item_" + index).click();
                                    jQuery(this).blur();
                                    return false;
                                });
                            }
                        });
                    }
                }
            },
            playlistInit: function(autoplay) {
                if(autoplay) {
                    this.playlistChange(this.current);
                } else {
                    this.playlistConfig(this.current);
                }
            },
            playlistConfig: function(index) {
                jQuery(this.cssSelector.playlist + "_item_" + this.current).removeClass("jp-playlist-current").parent().removeClass("jp-playlist-current");
                jQuery(this.cssSelector.playlist + "_item_" + index).addClass("jp-playlist-current").parent().addClass("jp-playlist-current");
                this.current = index;
                jQuery(this.cssSelector.jPlayer).jPlayer("setMedia", this.playlist[this.current]);
            },
            playlistChange: function(index) {
                this.playlistConfig(index);
                jQuery(this.cssSelector.jPlayer).jPlayer("play");
            },
            playlistNext: function() {
                var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
                this.playlistChange(index);
            },
            playlistPrev: function() {
                var index = (this.current - 1 >= 0) ? this.current - 1 : this.playlist.length - 1;
                this.playlistChange(index);
            }
        };
    
        var audioPlaylist<?php the_ID(); ?> = new Playlist("<?php the_ID(); ?>", [
                <?php								
                
                    $track_count = 0;
                    $track_total = 0
                ?>
                    
                    <?php
                    /*
                     * Count tracks. Tracks must have title and file source
                     * Use this dertermine if a comma should be added after the js entry bracket
                     *
                     */
                    $args = array(
                        'post_type' => 'attachment',
                        'numberposts' => -1,
                        'post_status' => null,
                        'post_parent' => get_the_ID(),
						'orderby' => 'menu_order',
						'order' => 'ASC',
                        ); 
                    $attachments = get_posts($args);
                    $currentAttachmentNum = 0;
                    //
                    if ($attachments) {
                        $currentAttachmentNum = 0;
                        foreach ($attachments as $attachment1) {
                            //if ( $attachment1->post_mime_type == "audio/mpeg") { 
                                $track_total++;
                            //}
                    } }?>
                    
                    <?php 
                    /*
                     * Loop through tracks and create entry to be used in JS. Tracks must have title and file source
                     *
                     */
                    $args = array(
                        'post_type' => 'attachment',
                        'numberposts' => -1,
                        'post_status' => null,
                        'post_parent' => get_the_ID(),
						'orderby' => 'menu_order',
						'order' => 'ASC',
                        ); 
                    $attachments = get_posts($args);
                    //print_r($attachments);
                    $currentAttachmentNum = 0;
                    //
                    if ($attachments) {
                        $currentAttachmentNum = 0;
                        foreach ($attachments as $attachment1) {?>
                        <?php $counter = 0; ?>
                            <?php $counter = $counter+1; ?>
                            <?php $track_count++; ?>
                            <?php if ( $attachment1->post_mime_type == "audio/mpeg") { ?>
                                {name:"<?php echo( $attachment1->post_title ); ?>", mp3:"<?php echo($attachment1->guid); ?>", link1:""}
								<?php if ( $track_count < $track_total ) {echo ',';} // Add comma after bracket for all posts except the last one ?>
                            <?php } ?>
                    <?php } }?>
                
                
                            
                            ], {
                                ready: function() {
                                    audioPlaylist<?php the_ID(); ?>.displayPlaylist();
                                    audioPlaylist<?php the_ID(); ?>.playlistInit(false); // Parameter is a boolean for autoplay.
                                },
                                ended: function() {
                                    audioPlaylist<?php the_ID(); ?>.playlistNext();
                                },
                                play: function() {
                                    jQuery(this).jPlayer("pauseOthers");
                                },
                                swfPath: "<?php echo get_template_directory_uri(); ?>/js/jplayer",
                                solution: "flash, html", // Flash with an HTML5 fallback.
                                supplied: "mp3"
                            });
    
                });
            //]]>
    </script>
                <?php endwhile; // end of the loop. ?>
                <?php endif; ?>

<?php } //End of jplayer code 


function mt_soundstage_checkpage(){
	
	//if this is the discography page, load the above script into the head
	//if (is_category(of_get_option('cap_disc_cat'))){
		
		jplayer_script_discography();
	//
}
add_action('wp_head', 'mt_soundstage_checkpage');