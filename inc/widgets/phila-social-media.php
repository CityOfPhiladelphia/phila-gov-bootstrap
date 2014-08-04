<?php

/* Function for CSS */

function Phila_Social_Media(){
	// Respects SSL, css is relative to the current file
	wp_register_style( 'phila-social-widget', plugins_url('phila-social_widget.css', __FILE__) );
	wp_enqueue_style( 'phila-social-widget' );
}

/* Register the widget */
function socialwidget_load_widgets() {
	register_widget( 'Phila_Social_Widget' );
}

/* Begin Widget Class */
class Phila_Social_Widget extends WP_Widget {

	/* Widget setup  */
	function Phila_Social_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Social_Widget', 
							'description' => __('A widget that allows the user to display social media icons in their sidebar', 'phila_smw') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'social-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'social-widget', __('Social Media Widget', 'phila_smw'), $widget_ops, $control_ops );

		$this->networks = array(
			'facebook' => array(
				'title' => 'Facebook',
				'image' => 'facebook.png'
			),
			'googleplus' => array(
				'title' => 'Google+',
				'image' => 'googleplus.png'
			),
			'twitter' => array(
				'title' => 'Twitter',
				'image' => 'twitter.png'
			),
			'linkedin' => array(
				'title' => 'LinkedIn',
				'image' => 'linkedin.png'
			),
			'flickr' => array(
				'title' => 'Flickr',
				'image' => 'flickr.png'
			),
			'youtube' => array(
				'title' => 'YouTube',
				'image' => 'youtube.png'
			),
			'wordpress' => array(
				'title' => 'Wordpress',
				'image' => 'wordpress.png'
			),
		);

		$this->networks_end = array(
			'rss_url' => array(
				'title' => 'RSS',
				'image' => 'rss.png'
			),
			'subscribe' => array(
				'title' => 'E-mail',
				'image' => 'email.png'
			),
		);

		$this->custom_count = 2;
	}

function initData( $instance ) {
		$this->imgcaption     = $instance['imgcaption'];
		$this->animation      = $instance['animation'];
		$this->icon_opacity   = $instance['icon_opacity'];
		$this->newtab         = $instance['newtab'];
		$this->nofollow       = $instance['nofollow'];
		$this->icon_size      = $instance['icon_size'];
		// $this->display_titles = $instance['display_titles'];
		$this->icons_per_row  = isset($instance['icons_per_row']) ? $instance['icons_per_row'] : 'auto';
		$this->alignment      = $instance['alignment'];
		$this->icon_pack      = $instance['icon_pack'];
		$this->slugs 		  = array();

		for ($i = 1; $i <= $this->custom_count; $i++) {
			${"custom".$i."icon"} = isset($instance['custom'.$i.'icon']) ? $instance['custom'.$i.'icon'] : '';
			${"custom".$i."name"} = isset($instance['custom'.$i.'name']) ? $instance['custom'.$i.'name'] : '';
			${"custom".$i."url"}  = isset($instance['custom'.$i.'url']) ?  $instance['custom'.$i.'url']  : '';
		}

		/* Choose Icon Size if Value is 'default' */
		if($this->icon_size == 'default') {
			$this->icon_size = '32';
		}
		
		/* Choose icon opacity if Value is 'default' */
		if($this->icon_opacity == 'default') {
			$this->icon_opacity = '0.8';
		}
		
		/* Check to see if nofollow is set or not */
		if ($this->nofollow == 'on') {
			$this->nofollow = "rel=\"nofollow\"";
			} else {
			$this->nofollow = '';
			}
	
		/* Get Plugin Path */
		if($instance['icon_pack'] == 'custom') {
			$this->phila_smw_path = $customiconsurl;
			$this->phila_smw_dir  = $customiconspath;
		} else {
			$this->phila_smw_path = get_template_directory() . 'inc/widgets/images/social';
			$this->phila_smw_dir  = get_template_directory() . 'inc/widgets/images/social';
		}
		
	}

	/* Display the widget  */
	function widget( $args, $instance ) {
		extract( $args );
	
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$text = apply_filters( 'widget_text', $instance['text'], $instance );

		$this->slugorder 	= (array)$instance['slugorder'];

		$this->slugtargets  = (array)$instance['slugtargets'];
		$this->slugtitles 	= (array)$instance['slugtitles'];
		$this->slugalts  	= (array)$instance['slugalts'];

		$this->imgcaption     = $instance['imgcaption'];
		$this->animation      = $instance['animation'];
		$this->icon_opacity   = $instance['icon_opacity'];
		$this->newtab         = $instance['newtab'];
		$this->nofollow       = $instance['nofollow'];
		$this->icon_size      = $instance['icon_size'];
		// $this->display_titles = $instance['display_titles'];
		$this->icons_per_row  = isset($instance['icons_per_row']) ? $instance['icons_per_row'] : 'auto';
		$alignment            = $instance['alignment'];
		$icon_pack            = $instance['icon_pack'];

		foreach ($this->networks as $slug => $ndata) {
			$$slug = $instance[$slug];
			// ${$slug."_title"} = $instance[$slug."_title"];
		}
		foreach ($this->networks_end as $slug => $ndata) {
			$$slug = $instance[$slug];
			// ${$slug."_title"} = $instance[$slug."_title"];
		}

		$customiconsurl = $instance['customiconsurl'];
		$customiconspath = $instance['customiconspath'];
		for ($i = 1; $i <= $this->custom_count; $i++) {
			${"custom".$i."icon"} = isset($instance['custom'.$i.'icon']) ? $instance['custom'.$i.'icon'] : '';
			${"custom".$i."name"} = isset($instance['custom'.$i.'name']) ? $instance['custom'.$i.'name'] : '';
			${"custom".$i."url"}  = isset($instance['custom'.$i.'url']) ?  $instance['custom'.$i.'url']  : '';
		}

	
		/* Choose Icon Size if Value is 'default' */
		if($this->icon_size == 'default') {
			$this->icon_size = '32';
		}
		
		/* Choose icon opacity if Value is 'default' */
		if($this->icon_opacity == 'default') {
			$this->icon_opacity = '0.8';
		}
		
		/* Need to make opacity a whole number for IE styling filter() */
		$icon_ie = $this->icon_opacity * 100;
		
		/* Check to see if nofollow is set or not */
		if ($this->nofollow == 'on') {
			$this->nofollow = "rel=\"nofollow\"";
			} else {
			$this->nofollow = '';
			}
	
			
		/* Check to see if New Tab is set to yes */
		if ($this->newtab == 'yes') {
			$this->newtab = "target=\"_blank\"";
			} else {
			$this->newtab = '';
			}
		
		/* Set alignment */
		if ($alignment == 'centered') {
			$alignment = 'phila_smw_center';
		} elseif ($alignment == 'right') {
			$alignment = 'phila_smw_right';
			} else {
				$alignment = 'phila_smw_left';
			}
				
		/* Get Plugin Path */
		if($icon_pack == 'custom') {
			$this->phila_smw_path = $customiconsurl;
			$this->phila_smw_dir  = $customiconspath;
		} else {
			$this->phila_smw_path = get_template_directory() . 'inc/widgets/images/social';
			$this->phila_smw_dir  = get_template_directory() . 'inc/widgets/images/social';
		}
		
		
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		
		
		
		echo "<div class=\"socialmedia-buttons ".$alignment.($this->icons_per_row == 'one' ? ' icons_per_row_1' : '')."\">";
		/* Display short description */
		
		if ( $text )
			echo "<div class=\"socialmedia-text\>" . $instance['filter'] ? wpautop($text) : $text . '</div>';
			
		/* Display linked images to profiles from widget settings if one was input. */
		

		$html_chunks = array();

		foreach ($this->networks as $slug => $ndata) {
			$html_chunks[$slug] = $this->html_chunk( $slug, $$slug, $ndata['image'], $ndata['title'] );
		}

		for ($i = 1; $i <= $this->custom_count; $i++) {
			$slug = "custom".$i;
			$html_chunks[$slug] = $this->html_chunk( $slug, ${"custom".$i."url"}, ${"custom".$i."icon"}, ${"custom".$i."name"}, true );
		}
		
		foreach ($this->networks_end as $slug => $ndata) {
			$html_chunks[$slug] = $this->html_chunk( $slug, $$slug, $ndata['image'], $ndata['title'] );
		}
		
		foreach( (array) $this->slugorder as $slug )
			if ( key_exists($slug, $html_chunks) ) echo $html_chunks[$slug];
		
		foreach( $html_chunks as $slug => $html )
			if ( ! in_array($slug, (array) $this->slugorder) ) echo $html; 

		//echo implode('', $html_chunks);

	/* After widget (defined by themes). */
		
		echo "</div>";
		
		echo $after_widget;
	}

	function html_chunk( $name, $slug, $image, $title, $custom = false ) {
		if ( strlen($slug) > 7 && (($custom === false && file_exists($this->phila_smw_dir . '/' . $image)) || ($custom === true && $image != ''))) {
			$img = $custom === false ? $this->phila_smw_path . '/' . $image : $image;
			$html = '';
			// $html = '<span class="phila_smw_icon">';
			/*
			if ($this->display_titles == 'left') {
				$html .= '<span> ' . $title . ' </span>';
			}
			elseif ($this->display_titles == 'above') {
				$html .= '<span> ' . $title . ' </span><br/>';
			}
			*/
			$target= empty( $this->slugtargets[$name] ) ? $this->newtab : 'target="'.$this->slugtargets[$name].'"';
			$html .= '<a href="' . $slug . '" ' . ($name == 'googleplus' ? 'rel="publisher"' : $this->nofollow) . ' ' . $target.'>';
			$html .= '<img width="' . $this->icon_size .'" height="' . $this->icon_size . '" src="' . $img . '" 
				alt="' . esc_attr(empty($this->slugalts[$name]) ? "$this->imgcaption $title": $this->slugalts[$name]).'" 
				title="' . esc_attr(empty($this->slugtitles[$name]) ? "$this->imgcaption $title" : $this->slugtitles[$name]) . '" ' . 
				($this->animation == 'fade' || $this->animation == 'combo' ? 'style="opacity: ' . $this->icon_opacity . '; -moz-opacity: ' . $this->icon_opacity . ';"' : '') . ' class="' . $this->animation . '" />';
			$html .= '</a>';
			/*
			if ($this->display_titles == 'right') {
				$html .= '<span> ' . $title . ' </span>';
			}
			elseif ($this->display_titles == 'below') {
				$html .= '<br/><span> ' . $title . ' </span>';
			}
			*/
			// $html .= '</span>';
			if ($this->icons_per_row == 'one') {
				$html .= '<br/>';
			}
			return $html;
		}
	}

	/* Update the widget settings  */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip Tags For Text Boxes */
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['imgcaption']     = $new_instance['imgcaption'];
		$instance['icon_size']      = $new_instance['icon_size'];
		$instance['icon_pack']      = $new_instance['icon_pack'];
		$instance['animation']      = $new_instance['animation'];
		$instance['icon_opacity']   = $new_instance['icon_opacity'];
		$instance['newtab']         = $new_instance['newtab'];
		$instance['nofollow']       = $new_instance['nofollow'];
		$instance['alignment']      = $new_instance['alignment'];
		$instance['display_titles'] = $new_instance['display_titles'];
		$instance['icons_per_row']  = $new_instance['icons_per_row'];

		$instance['slugtargets']    = (array)$new_instance['slugtargets'] + (array)$instance['slugtargets'];
		$instance['slugtitles'] 	= (array)$new_instance['slugtitles'] + (array)$instance['slugtitles'];
		$instance['slugalts']  		= (array)$new_instance['slugalts'] + (array)$instance['slugalts'];
		$instance['slugorder']  	= (array)$new_instance['slugorder'];

		foreach ($this->networks as $slug => $ndata) {
			$instance[$slug] = !empty($new_instance[$slug]) ? strip_tags( $new_instance[$slug] ) : 'http://';
			// $instance[$slug.'_title'] = strip_tags( $new_instance[$slug.'_title'] );
		}

		foreach ($this->networks_end as $slug => $ndata) {
			$instance[$slug] = strip_tags( $new_instance[$slug] );
			// $instance[$slug.'_title'] = strip_tags( $new_instance[$slug.'_title'] );
		}

		for ($i = 1; $i <= $this->custom_count; $i++) {
			$instance['custom'.$i.'name'] = strip_tags( $new_instance['custom'.$i.'name'] );
			$instance['custom'.$i.'icon'] = strip_tags( $new_instance['custom'.$i.'icon'] );
			$instance['custom'.$i.'url']  = strip_tags( $new_instance['custom'.$i.'url'] );
		}
		$instance['customiconsurl'] = strip_tags( $new_instance['customiconsurl'] );
		$instance['customiconspath'] = strip_tags( $new_instance['customiconspath'] );
		
		return $instance;
	}

		/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
	    error_reporting(0);
		$this->initData( $instance );
		/* Set up some default widget settings. */
		$defaults = array( 
			'title'           => __('Follow Us!', 'phila_smw'),
			'text'            => '',
			'imgcaption'      => __('Follow Us on', 'phila_smw'), 
			'icon_size'       => 'default',
			'icon_pack'       => 'default',
			'icon_opacity'    => 'default',
			'newtab'          => 'yes',
			'nofollow'        => 'on',
			'alignment'       => 'left',
			// 'display_titles'  => 'no',
			'icons_per_row'   => 'auto',
			'customiconsurl'  => __('http://www.yoursite.com/wordpress/wp-content/your-icons', 'phila_smw'), 
			'customiconspath' => __('/path/to/your-icons', 'phila_smw'), 
		);
		foreach ($this->networks as $slug => $ndata) {
			$defaults[$slug] = __('http://', 'phila_smw');
			// $defaults[$slug.'_title'] = __($ndata['title'], 'phila_smw');
		}
		foreach ($this->networks_end as $slug => $ndata) {
			$defaults[$slug] = __($slug == 'subscribe' ? 'mailto:' : 'http://', 'phila_smw');
			// $defaults[$slug.'_title'] = __($ndata['title'], 'phila_smw');
		}
		for ($i = 1; $i <= $this->custom_count; $i++) {
			$defaults['custom'.$i.'name'] = __('', 'phila_smw');
			$defaults['custom'.$i.'icon'] = __('', 'phila_smw');
			$defaults['custom'.$i.'url']  = __('', 'phila_smw');
		}
			
		$instance = wp_parse_args( (array) $instance, $defaults );
		if ($instance['icon_size'] == 'default') {
			$instance['icon_size'] = 32;
		}
		?>
		<p>
		<em>Note: Make sure you include FULL URL (i.e. http://www.example.com) </em>
		</p>
		
	<div>
		<p><a href="javascript:;" onclick="jQuery(this).parent().next('div').slideToggle();" style="background: url('images/arrows.png') no-repeat; padding-left: 15px;"><strong>General Settings</strong></a></p>

		<div style="display: block;">
		<!-- Widget Title: Text Input -->
                    
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<!-- Widget Text: Textarea -->
		<p>
			<label for"<?php echo $this->get_field_id( 'text' ); ?>"><?php _e('Widget Text:', 'phila_smw'); ?></label>
			<textarea id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="8" cols="20" class="widefat"><?php echo $instance['text']; ?></textarea>
		</p>

		<!-- Image Caption: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'imgcaption' ); ?>"><?php _e('Icon Alt and Title Tag:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'imgcaption' ); ?>" name="<?php echo $this->get_field_name( 'imgcaption' ); ?>" value="<?php echo $instance['imgcaption']; ?>" class="widefat" type="text" />
		</p>
		
		<!-- Choose Icon Size: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_size' ); ?>"><?php _e('Icon Size', 'phila_smw'); ?></label>
			<span style="float: right;<?php if(in_array($instance['icon_size'], array('16', '24', '32', '64', 'default'))) : ?> display: none;<?php endif; ?>">
				<input type="text" class="small-text" style="width: 30px;" name="" value="<?php echo $instance['icon_size']; ?>" onkeyup="jQuery(this).parent().siblings('input:hidden').val(jQuery(this).val());">px
			</span>
			<select style="float:right;" onchange="if (jQuery(this).find('option:selected').val() == '') { jQuery(this).prev('span').show(); } else { jQuery(this).prev('span').hide(); jQuery(this).next('input:hidden').val(jQuery(this).find('option:selected').val()); }">
			<option value="16" <?php if($instance['icon_size'] == '16') { echo 'selected'; } ?>>16px</option>
			<option value="24" <?php if($instance['icon_size'] == '24') { echo 'selected'; } ?>>24px</option>
			<option value="32" <?php if($instance['icon_size'] == '32' || $instance['icon_size'] == 'default') { echo 'selected'; } ?>>Default (32px)</option>
			<option value="64" <?php if($instance['icon_size'] == '64') { echo 'selected'; } ?>>64px</option>
			<option value="" <?php if(!in_array($instance['icon_size'], array('16', '24', '32', '64', 'default'))) { echo 'selected'; } ?>>Custom</option>
			</select>
			<input type="hidden" name="<?php echo $this->get_field_name( 'icon_size' ); ?>" value="<?php echo $instance['icon_size']; ?>">
		</p>
		<div class="clear"></div>
		
		<!-- Choose Icon Pack: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_pack' ); ?>"><?php _e('Icon Pack', 'phila_smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'icon_pack' ); ?>" name="<?php echo $this->get_field_name( 'icon_pack' ); ?>" style="float:right;">
			<option value="cutout" <?php if($instance['icon_pack'] == 'cutout') { echo 'selected'; } ?>>Cutout Icons</option>
			<option value="heart" <?php if($instance['icon_pack'] == 'heart') { echo 'selected'; } ?>>Heart Icons</option>
			<option value="default" <?php if($instance['icon_pack'] == 'default') { echo 'selected'; } ?>>Default Icons (Web2.0)</option>
			<option value="sketch" <?php if($instance['icon_pack'] == 'sketch') { echo 'selected'; } ?>>Sketch Icons</option>
			<option value="custom" <?php if($instance['icon_pack'] == 'custom') { echo 'selected'; } ?>>Custom Icons</option>
			</select>
		</p>
		<div class="clear"></div>
		
		<!-- Type of Animation: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'animation' ); ?>"><?php _e('Type of Animation', 'phila_smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'animation' ); ?>" name="<?php echo $this->get_field_name( 'animation' ); ?>" style="float:right;">
			<option value="fade" <?php if($instance['animation'] == 'fade') { echo 'selected'; } ?>>Fade In</option>
			<option value="scale" <?php if($instance['animation'] == 'scale') { echo 'selected'; } ?>>Scale</option>
			<option value="bounce" <?php if($instance['animation'] == 'bounce') { echo 'selected'; } ?>>Bounce</option>
			<option value="combo" <?php if($instance['animation'] == 'combo') { echo 'selected'; } ?>>Combo</option>
			</select>
		</p>
		<div class="clear"></div>
		
		<!--Starting Icon Opacity: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_opacity' ); ?>"><?php _e('Default Icon Opacity', 'phila_smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'icon_opacity' ); ?>" name="<?php echo $this->get_field_name( 'icon_opacity' ); ?>" style="float:right;">
			<option value="0.5" <?php if($instance['icon_opacity'] == '0.5') { echo 'selected'; } ?>>50%</option>
			<option value="0.6" <?php if($instance['icon_opacity'] == '0.6') { echo 'selected'; } ?>>60%</option>
			<option value="0.7" <?php if($instance['icon_opacity'] == '0.7') { echo 'selected'; } ?>>70%</option>
			<option value="default" <?php if($instance['icon_opacity'] == 'default') { echo 'selected'; } ?>>Default (80%)</option>
			<option value="0.9" <?php if($instance['icon_opacity'] == '0.9') { echo 'selected'; } ?>>90%</option>
			<option value="1" <?php if($instance['icon_opacity'] == '1') { echo 'selected'; } ?>>100%</option>
			</select>
			<span style="color: #999;"><em>Only applies to Fade and Combo animations</em></span>
		</p>
		<div class="clear"></div>
	
		<!-- No Follow On or Off: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e('Use rel="nofollow" for links', 'phila_smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" style="float:right;">
			<option value="on" <?php if($instance['nofollow'] == 'on') { echo 'selected'; } ?>>On</option>
			<option value="off" <?php if($instance['nofollow'] == 'off') { echo 'selected'; } ?>>Off</option>
			</select>
		</p>
		<div class="clear"></div>
		
		<!-- Open in new tab: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'newtab' ); ?>"><?php _e('Open in new tab?', 'phila_smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'newtab' ); ?>" name="<?php echo $this->get_field_name( 'newtab' ); ?>" style="float:right;">
			<option value="yes" <?php if($instance['newtab'] == 'yes') { echo 'selected'; } ?>>Yes</option>
			<option value="no" <?php if($instance['newtab'] == 'no') { echo 'selected'; } ?>>No</option>
			</select>
		</p>
		<div class="clear"></div>
		
		<!-- Alignment: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'alignment' ); ?>"><?php _e('Icon Alignment', 'phila_smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'alignment' ); ?>" name="<?php echo $this->get_field_name( 'alignment' ); ?>" style="float:right;">
			<option value="left" <?php if($instance['alignment'] == 'left') { echo 'selected'; } ?>>Left</option>
			<option value="centered" <?php if($instance['alignment'] == 'centered') { echo 'selected'; } ?>>Centered</option>
			<option value="right" <?php if($instance['alignment'] == 'right') { echo 'selected'; } ?>>Right</option>
			</select>
		</p>
		<div class="clear"></div>
		
		<?php /*
		<!-- Display titles: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'display_titles' ); ?>"><?php _e('Display Titles', 'phila_smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'display_titles' ); ?>" name="<?php echo $this->get_field_name( 'display_titles' ); ?>" style="float:right;">
			<option value="no" <?php if($instance['display_titles'] == 'no') { echo 'selected'; } ?>>No</option>
			<option value="left" <?php if($instance['display_titles'] == 'left') { echo 'selected'; } ?>>Left to the icon</option>
			<option value="right" <?php if($instance['display_titles'] == 'right') { echo 'selected'; } ?>>Right to the icon</option>
			<option value="above" <?php if($instance['display_titles'] == 'above') { echo 'selected'; } ?>>Above the icon</option>
			<option value="below" <?php if($instance['display_titles'] == 'below') { echo 'selected'; } ?>>Below the icon</option>
			</select>
		</p>
		<div class="clear"></div>
		*/ ?>
		
		<!-- Icons per row: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icons_per_row' ); ?>"><?php _e('Icons per row', 'phila_smw'); ?></label>
			<select id="<?php echo $this->get_field_id( 'icons_per_row' ); ?>" name="<?php echo $this->get_field_name( 'icons_per_row' ); ?>" style="float:right;">
			<option value="auto" <?php if($instance['icons_per_row'] == 'auto') { echo 'selected'; } ?>>Auto</option>
			<option value="one" <?php if($instance['icons_per_row'] == 'one') { echo 'selected'; } ?>>1</option>
			</select>
		</p>
		<div class="clear"></div>
		<div>
                  <small>Icons will appear in the same order they are arranged here. You can reorder icons with mouse.</small>
                  <ol class="media-icons-sortable" style="margin: 0 0 0 10px;">
                    <?php 
                        $fname = $this->get_field_name( 'slugtargets' );
                        $tname = $this->get_field_name( 'slugtitles' );
                        $aname = $this->get_field_name( 'slugalts' );
                        $oname = $this->get_field_name( 'slugorder' );
                        $blocks = array();
                        $cnt=0;
                        foreach (array_merge($this->networks, $this->networks_end) as $slug => $ndata) :
                            $href = $instance[$slug];
                            $img = $this->smw_dir . '/' . $ndata['image'];
                            if (strlen($href) > 7 && file_exists($img)) :
                                ob_start(); 
                                ?>
                                <li class="sort-item" style="clear: both; border-top: 1px solid #dfdfdf; height: 82px; background: #f1f1f1; margin:0; padding:0;"> 
                                    <img width="24" height="24" style="float: left; padding: 25px 0px; cursor: move;" src="<?php echo $this->smw_path . '/' . $ndata['image']; ?>" />
                                    <input name="<?php echo "{$oname}[]"; ?>" value="<?php echo esc_attr($slug); ?>" type="hidden" />
                                    <table style="float: right">
                                        <tr>
                                            <td>Title</td>
                                            <td><input name="<?php echo "{$tname}[$slug]"; ?>" value="<?php echo esc_attr($instance['slugtitles'][$slug]); ?>" type="text" /></td>
                                        </tr>
                                        <tr>
                                            <td>Alt</td>
                                            <td><input name="<?php echo "{$aname}[$slug]"; ?>" value="<?php echo esc_attr($instance['slugalts'][$slug]); ?>" type="text" /></td>
                                        </tr>
                                        <tr>
                                            <td>Target</td>
                                            <?php $targ = @$instance['slugtargets'][$slug]; ?>
                                            <td><select name="<?php echo "{$fname}[$slug]"; ?>">
                                                <option value="" <?php selected("", $targ); ?>>Default</option>
                                                <option value="_blank" <?php selected("_blank", $targ); ?>>New Tab/Window</option>
                                                <option value="_self" <?php selected("_self", $targ); ?>>Same Tab/Window</option>
                                            </select></td>
                                        </tr>
                                    </table>
                                </li>
                                <?php
                                $blocks[$slug] = ob_get_clean();
                            endif;
                        endforeach; 
                        foreach( (array) @$instance['slugorder'] as $slug ) echo $blocks[$slug];
                        foreach( $blocks as $slug => $html ) if ( ! in_array($slug, (array) @$instance['slugorder']) ) echo $html;
                    ?>
                </ol>
            </div>	
		</div>

		
		<p><a href="javascript:;" onclick="jQuery(this).parent().next('div').slideToggle();" style="background: url('images/arrows.png') no-repeat; padding-left: 15px;"><strong>Social Networking</strong></a></p>

		<div style="display: none;">
		<?php foreach (array('facebook', 'googleplus', 'twitter','linkedin') as $slug) : ?>
		<p>
			<label><strong><?php _e((isset($this->networks[$slug]) ? $this->networks[$slug]['title'] : $this->networks_end[$slug]['title']).' URL:', 'phila_smw'); ?></strong></label>
			<?php /*
			<div class="clear"></div>
			<label for="<?php echo $this->get_field_id( $slug); ?>"><?php _e('URL:', 'phila_smw'); ?></label>
			*/ ?>
			<input id="<?php echo $this->get_field_id( $slug ); ?>" name="<?php echo $this->get_field_name( $slug ); ?>" value="<?php echo !empty($instance[$slug]) ? $instance[$slug] : 'http://'; ?>" class="widefat" type="text" />
			<?php /*
			<div class="clear"></div>
			<label for="<?php echo $this->get_field_id( $slug.'_title' ); ?>"><?php _e('Title:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( $slug.'_title' ); ?>" name="<?php echo $this->get_field_name( $slug.'_title' ); ?>" value="<?php echo $instance[$slug.'_title']; ?>" class="alignright" type="text" size="30" />
			<div class="clear"></div>
			*/?>
		</p>
		<?php endforeach; ?>
		</div>

		
		<p><a href="javascript:;" onclick="jQuery(this).parent().next('div').slideToggle();" style="background: url('images/arrows.png') no-repeat; padding-left: 15px;"><strong>Images and Video</strong></a></p>

		<div style="display: none;">
		<?php foreach (array('flickr', 'youtube') as $slug) : ?>
		<p>
			<label><strong><?php _e((isset($this->networks[$slug]) ? $this->networks[$slug]['title'] : $this->networks_end[$slug]['title']).' URL:', 'phila_smw'); ?></strong></label>
			<?php /*
			<div class="clear"></div>
			<label for="<?php echo $this->get_field_id( $slug); ?>"><?php _e('URL:', 'phila_smw'); ?></label>
			*/ ?>
			<input id="<?php echo $this->get_field_id( $slug ); ?>" name="<?php echo $this->get_field_name( $slug ); ?>" value="<?php echo !empty($instance[$slug]) ? $instance[$slug] : 'http://'; ?>" class="widefat" type="text" />
			<?php /*
			<div class="clear"></div>
			<label for="<?php echo $this->get_field_id( $slug.'_title' ); ?>"><?php _e('Title:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( $slug.'_title' ); ?>" name="<?php echo $this->get_field_name( $slug.'_title' ); ?>" value="<?php echo $instance[$slug.'_title']; ?>" class="alignright" type="text" size="30" />
			<div class="clear"></div>
			*/?>
		</p>
		<?php endforeach; ?>
		</div>


		<p><a href="javascript:;" onclick="jQuery(this).parent().next('div').slideToggle();" style="background: url('images/arrows.png') no-repeat; padding-left: 15px;"><strong>Social News & Feeds</strong></a></p>

		<div style="display: none;">
		<?php foreach (array('rss_url', 'subscribe') as $slug) : ?>
		<p>
			<label><strong><?php _e((isset($this->networks[$slug]) ? $this->networks[$slug]['title'] : $this->networks_end[$slug]['title']).' URL:', 'phila_smw'); ?></strong></label>
			<?php /*
			<div class="clear"></div>
			<label for="<?php echo $this->get_field_id( $slug); ?>"><?php _e('URL:', 'phila_smw'); ?></label>
			*/ ?>
			<input id="<?php echo $this->get_field_id( $slug ); ?>" name="<?php echo $this->get_field_name( $slug ); ?>" value="<?php echo !empty($instance[$slug]) ? $instance[$slug] : 'http://'; ?>" class="widefat" type="text" />
			<?php /*
			<div class="clear"></div>
			<label for="<?php echo $this->get_field_id( $slug.'_title' ); ?>"><?php _e('Title:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( $slug.'_title' ); ?>" name="<?php echo $this->get_field_name( $slug.'_title' ); ?>" value="<?php echo $instance[$slug.'_title']; ?>" class="alignright" type="text" size="30" />
			<div class="clear"></div>
			*/?>
		</p>
		<?php endforeach; ?>
		</div>

		
		<p><a href="javascript:;" onclick="jQuery(this).parent().next('div').slideToggle();" style="background: url('images/arrows.png') no-repeat; padding-left: 15px;"><strong>Blogging</strong></a></p>

		<div style="display: none;">
		<?php foreach (array('wordpress') as $slug) : ?>
		<p>
			<label><strong><?php _e((isset($this->networks[$slug]) ? $this->networks[$slug]['title'] : $this->networks_end[$slug]['title']).' URL:', 'phila_smw'); ?></strong></label>
			<?php /*
			<div class="clear"></div>
			<label for="<?php echo $this->get_field_id( $slug); ?>"><?php _e('URL:', 'phila_smw'); ?></label>
			*/ ?>
			<input id="<?php echo $this->get_field_id( $slug ); ?>" name="<?php echo $this->get_field_name( $slug ); ?>" value="<?php echo !empty($instance[$slug]) ? $instance[$slug] : 'http://'; ?>" class="widefat" type="text" />
			<?php /*
			<div class="clear"></div>
			<label for="<?php echo $this->get_field_id( $slug.'_title' ); ?>"><?php _e('Title:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( $slug.'_title' ); ?>" name="<?php echo $this->get_field_name( $slug.'_title' ); ?>" value="<?php echo $instance[$slug.'_title']; ?>" class="alignright" type="text" size="30" />
			<div class="clear"></div>
			*/?>
		</p>
		<?php endforeach; ?>
		</div>

		<p><a href="javascript:;" onclick="jQuery(this).parent().next('div').slideToggle();" style="background: url('images/arrows.png') no-repeat; padding-left: 15px;"><strong>Custom Services</strong></a></p>

		<div style="display: none;">
		<p><em>Here you can input <?php echo $this->custom_count; ?> custom icons. Make sure you input FULL urls to the icon (including http://). The images will resize both width and height to the icon size chosen.</em><br />	
		</p>
		<!-- Custom Service 1: Text Input -->
		
		<?php for ($i = 1; $i <= $this->custom_count; $i++) : ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom'.$i.'name' ); ?>"><?php _e('Custom Service '.$i.' Name:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom'.$i.'name' ); ?>" name="<?php echo $this->get_field_name( 'custom'.$i.'name' ); ?>" value="<?php echo $instance['custom'.$i.'name']; ?>" class="widefat" type="text" />
			<br>
			<label for="<?php echo $this->get_field_id( 'custom'.$i.'icon' ); ?>"><?php _e('Custom Service '.$i.' Icon URL:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom'.$i.'icon' ); ?>" name="<?php echo $this->get_field_name( 'custom'.$i.'icon' ); ?>" value="<?php echo $instance['custom'.$i.'icon']; ?>" class="widefat" type="text" />
			<br>
			<label for="<?php echo $this->get_field_id( 'custom'.$i.'url' ); ?>"><?php _e('Custom Service '.$i.' Profile URL:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom'.$i.'url' ); ?>" name="<?php echo $this->get_field_name( 'custom'.$i.'url' ); ?>" value="<?php echo $instance['custom'.$i.'url']; ?>" class="widefat" type="text" />
		</p>
		<?php endfor; ?>
		
		</div>

		<p><em>If you selected "Custom Icon Pack" in 'General Settings', input the URL and path to those icons in the following boxes. See the README.txt for more information on how to use this.</em><br />
		</p>
	
	<!-- Custom Icon Pack URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'customiconsurl' ); ?>"><?php _e('Custom Icons URL:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'customiconsurl' ); ?>" name="<?php echo $this->get_field_name( 'customiconsurl' ); ?>" value="<?php echo $instance['customiconsurl']; ?>" class="widefat" type="text" />
		</p>
		
	<!-- Custom Icon Pack Path: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'customiconspath' ); ?>"><?php _e('Custom Icons Path:', 'phila_smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'customiconspath' ); ?>" name="<?php echo $this->get_field_name( 'customiconspath' ); ?>" value="<?php echo $instance['customiconspath']; ?>" class="widefat" type="text" />
		</p>
		</div>
		<script type="text/javascript">
			jQuery(function($){
				$('ol.media-icons-sortable').sortable({
					forcePlaceholderSize: true,
				    start: function(e, ui){
    				    ui.placeholder.height(ui.item.height());
    				}
				});
			});
		</script>
		<div style="clear: both;"></div>		
		
	<?php
	}
}


?>
