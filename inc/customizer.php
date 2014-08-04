<?php
/**
 * phila Theme Customizer
 *
 * @package phila
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function phila_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->add_section( 'phila_general_options' , array(
       'title'      => __('Sitewide General Options','phila'),
       'priority'   => 30,
    ) );
	
	$wp_customize->add_section( 'phila_home_intro_options' , array(
    'title'      => __('Home Intro Options','phila'),
    'priority'   => 32,
   ) );
	
	// Setting group for social icons
    $wp_customize->add_section( 'phila_social_options' , array(
		'title'      => __('Social Options','phila'),
		'priority'   => 33,
    ) );
	
	// Begin Sitewide General Settings
	//  Logo Image Upload
    $wp_customize->add_setting('phila_logo_image', array(
        'default-image'  => '',
		'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'phila_logo_image', array(
        'label'    => __('Header Logo Image', 'phila'),
        'section'  => 'title_tagline',
		'priority' => 1,
        'settings' => 'phila_logo_image',
    )));
	
	$wp_customize->add_setting(
        'phila_tagline_visibility'
    );

    $wp_customize->add_control(
        'phila_tagline_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Show Tagline below Site Title/Logo?', 'phila'),
        'section'  => 'title_tagline',
		'priority' => 99,
        )
    );
	
	$wp_customize->add_setting(
		'phila_page_title_visibility'
    );

    $wp_customize->add_control(
		'phila_page_title_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide Title On Pages?', 'phila'),
        'section'  => 'phila_general_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
		'phila_feed_title_visibility'
    );

    $wp_customize->add_control(
		'phila_feed_title_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide the "latest Posts" title?', 'phila'),
        'section'  => 'phila_general_options',
		'priority' => 2,
        )
    );
	
	$wp_customize->add_setting(
    'phila_feed_title',
    array(
        'default' => 'Latest Posts',
		'sanitize_callback' => 'sanitize_text_field'
    ));
	
	$wp_customize->add_control(
    'phila_feed_title',
    array(
        'label'     => __('Enter Custom Feed Title', 'phila'),
        'section'   => 'phila_general_options',
		'priority'  => 3,
        'type'      => 'text',
    ));
	
	$wp_customize->add_setting(
		'phila_attachment_commentform_visibility'
    );

    $wp_customize->add_control(
		'phila_attachment_commentform_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide Comment Form on the Attachment page', 'phila'),
        'section'  => 'phila_general_options',
		'priority' => 4,
        )
    );
	
	// Begin Home Intro Settings
	$wp_customize->add_setting(
        'phila_home_intro_visibility'
    );

    $wp_customize->add_control(
        'phila_home_intro_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide the home page intro section?', 'phila'),
        'section'  => 'phila_home_intro_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
    'phila_intro_title_visibility'
    );

    $wp_customize->add_control(
    'phila_intro_title_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide Intro Title?', 'phila'),
        'section'  => 'phila_home_intro_options',
		'priority' => 2,
        )
    );
	
	$wp_customize->add_setting(
    'phila_intro_title',
    array(
        'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
    ));
	
	$wp_customize->add_control(
    'phila_intro_title',
    array(
        'label'     => __('Enter Intro Title here - make it short & catchy!', 'phila'),
        'section'   => 'phila_home_intro_options',
		'priority'  => 3,
        'type'      => 'text',
    ));
	
	/**
       * Adds textarea support to the theme customizer
    */
    class phila_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';
 
            public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
        }
    }
	
	$wp_customize->add_setting( 
	    'phila_intro_text'
    );		

    $wp_customize->add_control(
        new phila_Customize_Textarea_Control(
            $wp_customize,
            'phila_intro_text',
        array(
            'label' => 'Home Intro Text',
            'section' => 'phila_home_intro_options',
			'priority'  => 4,
            'settings' => 'phila_intro_text',
        )
        )
    );
	
	$wp_customize->add_setting(
    'phila_intro_button_visibility'
    );

    $wp_customize->add_control(
    'phila_intro_button_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide CTA Buttons?', 'phila'),
        'section'  => 'phila_home_intro_options',
		'priority' => 5,
        )
    );
		
	$wp_customize->add_setting(
        'phila_intro_learn_button_text',
    array(
        'default' => __('Learn more', 'phila'),
		'sanitize_callback' => 'sanitize_text_field'
    ));
	
	$wp_customize->add_control(
        'phila_intro_learn_button_text',
    array(
        'label'     => __('Home Intro Button Text', 'phila'),
        'section'   => 'phila_home_intro_options',
		'priority'  => 6,
        'type'      => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_intro_learn_button_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_intro_learn_button_url',
    array(
        'label'    => __('Home Intro Learn Button Link', 'phila'),
        'section'  => 'phila_home_intro_options',
		'priority' => 7,
        'type'     => 'text',
    ));
	
	$wp_customize->add_setting( 'phila_learn_button_url_target', array(
		'default' => '_self',
	) );
	
	$wp_customize->add_control( 'phila_learn_button_url_target', array(
    'label'   => __( 'Learn More Url Window Target', 'phila' ),
    'section' => 'phila_home_intro_options',
	'priority' => 8,
    'type'    => 'radio',
        'choices' => array(
            '_self'  => __( 'Open Link In Same Tab', 'phila' ),
			'_blank'   => __( 'Open Link In New Tab', 'phila' ),
        ),
    ));
	
	$wp_customize->add_setting(
    'phila_intro_signup_button_text',
    array(
        'default' => __('Sign Up', 'phila'),
		'sanitize_callback' => 'sanitize_text_field'
    ));
	
	$wp_customize->add_control(
    'phila_intro_signup_button_text',
    array(
        'label'     => __('Home Intro Signup Button Text', 'phila'),
        'section'   => 'phila_home_intro_options',
		'priority'  => 9,
        'type'      => 'text',
    ));
	
	$wp_customize->add_setting(
    'phila_intro_signup_button_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
    'phila_intro_signup_button_url',
    array(
        'label'    => __('Home Intro Signup Button Link', 'phila'),
        'section'  => 'phila_home_intro_options',
		'priority' => 10,
        'type'     => 'text',
    ));
	
	$wp_customize->add_setting( 'phila_signup_button_url_target', array(
		'default' => '_self',
	) );
	
	$wp_customize->add_control( 'phila_signup_button_url_target', array(
    'label'   => __( 'Sign Up Url Window Target', 'phila' ),
    'section' => 'phila_home_intro_options',
	'priority' => 11,
    'type'    => 'radio',
        'choices' => array(
            '_self'  => __( 'Open Link In Same Tab', 'phila' ),
			'_blank'   => __( 'Open Link In New Tab', 'phila' ),
        ),
    ));
		
	// == Social Links Icons Section == //
    // Begin Social Icons	
	$wp_customize->add_setting(
        'phila_header_social_visibility'
    );

    $wp_customize->add_control(
        'phila_header_social_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Show Header Social Icons?','phila'),
        'section' => 'phila_social_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
        'phila_sidebar_social_visibility'
    );

    $wp_customize->add_control(
        'phila_sidebar_social_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Show Sidebar Social Icons?','phila'),
        'section' => 'phila_social_options',
		'priority' => 2,
        )
    );
	$wp_customize->add_setting(
        'phila_sidebar_social_title',
    array(
		'default' => 'Connect With Us',
		'sanitize_callback' => 'sanitize_text_field'
    ));
	
	$wp_customize->add_control(
        'phila_sidebar_social_title',
    array(
        'label' => __('Sidebar Social Title','phila'),
        'section' => 'phila_social_options',
		'priority' => 3,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_facebook_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_facebook_url',
    array(
        'label' => __('Facebook URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 4,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_gplus_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_gplus_url',
    array(
        'label' => __('Google+ URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 5,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_twitter_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_twitter_url',
    array(
        'label' => __('Twitter URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 6,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_pinterest_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_pinterest_url',
    array(
        'label' => __('Pinterest URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 7,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_instagram_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_instagram_url',
    array(
        'label' => __('Instagram URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 8,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_linkedin_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_linkedin_url',
    array(
        'label' => __('LinkedIn URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 9,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_youtube_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_youtube_url',
    array(
        'label' => __('YouTube URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 10,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_flicker_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_flicker_url',
    array(
        'label' => __('Flicker URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 11,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_wordpress_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_wordpress_url',
    array(
        'label' => __('WordPress URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 12,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_github_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'phila_github_url',
    array(
        'label' => __('GitHub URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 13,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'phila_dribbble_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
		'phila_dribbble_url',
    array(
        'label' => __('Dribbble URL','phila'),
        'section' => 'phila_social_options',
		'priority' => 14,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
		'phila_rss_url'
    );

    $wp_customize->add_control(
		'phila_rss_url',
    array(
        'type' => 'checkbox',
        'label' => __('Use Default RSS Feed url?', 'phila'),
        'section' => 'phila_social_options',
		'priority' => 15,
        )
    );
	
	$wp_customize->add_setting(
		'phila_custom_rss_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
		'phila_custom_rss_url',
    array(
        'label' => __('Alternative Custom RSS Feed URL - leave blank if above default url checked!','phila'),
        'section' => 'phila_social_options',
		'priority' => 16,
        'type' => 'text',
    ));
}
add_action( 'customize_register', 'phila_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function phila_customize_preview_js() {
	wp_enqueue_script( 'phila_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'phila_customize_preview_js' );
