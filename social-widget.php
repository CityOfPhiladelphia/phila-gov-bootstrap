<div id="social-icons">
	
	<?php if (get_theme_mod( 'phila_facebook_url' )) : ?>
	<a href="<?php echo esc_url(get_theme_mod( 'phila_facebook_url' )) ;?>" target="_blank"><p class="facebook-icon social-icons"></p></a>
	<?php endif ; ?>
			
	<?php if (get_theme_mod( 'phila_gplus_url' )) : ?>
	<a href="<?php echo esc_url(get_theme_mod( 'phila_gplus_url' )) ;?>" target="_blank"><p class="gplus-icon social-icons"></p></a>
	<?php endif ; ?>
 			
 	<?php if (get_theme_mod( 'phila_twitter_url' )) : ?>
	<a href="<?php echo esc_url(get_theme_mod( 'phila_twitter_url' )) ;?>" target="_blank"><p class="twitter-icon social-icons"></p></a>
	<?php endif ; ?>
 	
    <?php if (get_theme_mod( 'phila_pinterest_url' )) : ?>	
 	<a href="<?php echo esc_url(get_theme_mod( 'phila_pinterest_url' )) ;?>" target="_blank"><p class="pinterest-icon social-icons"></p></a>
	<?php endif ; ?>
	
	<?php if (get_theme_mod( 'phila_instagram_url' )) : ?>	
 	<a href="<?php echo esc_url(get_theme_mod( 'phila_instagram_url' )) ;?>" target="_blank"><p class="instagram-icon social-icons"></p></a>
	<?php endif ; ?>
	
	<?php if (get_theme_mod( 'phila_linkedin_url' )) : ?>
	<a href="<?php echo esc_url(get_theme_mod( 'phila_linkedin_url' )) ;?>" target="_blank"><p class="linkedin-icon social-icons"></p></a>
	<?php endif ; ?>
	
	<?php if (get_theme_mod( 'phila_youtube_url' )) : ?>
	<a href="<?php echo esc_url(get_theme_mod( 'phila_youtube_url' )) ;?>" target="_blank"><p class="youtube-icon social-icons"></p></a>
	<?php endif ; ?>
	
	<?php if (get_theme_mod( 'phila_flicker_url' )) : ?>
	<a href="<?php echo esc_url(get_theme_mod( 'phila_flicker_url' )) ;?>" target="_blank"><p class="flickr-icon social-icons"></p></a>
	<?php endif ; ?>
	
	<?php if (get_theme_mod( 'phila_wordpress_url' )) : ?>
	<a href="<?php echo esc_url(get_theme_mod( 'phila_wordpress_url' )) ;?>" target="_blank"><p class="wordpress-icon social-icons"></p></a>
	<?php endif ; ?>
	
	<?php if (get_theme_mod( 'phila_github_url' )) : ?>
	<a href="<?php echo esc_url(get_theme_mod( 'phila_github_url' )) ;?>" target="_blank"><p class="github-icon social-icons"></p></a>
	<?php endif ; ?>
	
	<?php if (get_theme_mod( 'phila_dribbble_url' )) : ?>
	<a href="<?php echo esc_url(get_theme_mod( 'phila_dribbble_url' )) ;?>" target="_blank"><p class="dribbble-icon social-icons"></p></a>
	<?php endif ; ?>
	
	<?php if ( get_theme_mod( 'phila_rss_url' ) != 0 ) { ?>
	<a href="<?php echo esc_url(bloginfo('rss2_url')); ?>" target="_blank"><p class="rss-icon social-icons"></p></a>
	<?php } else { ?>
	<?php if (get_theme_mod( 'phila_custom_rss_url' )) : ?>
	<a href="<?php echo esc_url(get_theme_mod( 'phila_custom_rss_url' )) ;?>" target="_blank"><p class="rss-icon social-icons"></p></a>
	<?php endif ; ?>
	<?php } ?>
</div>