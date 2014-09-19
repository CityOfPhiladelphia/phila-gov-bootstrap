<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)

// Shortcodes
require_once('library/shortcodes.php');

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

// Custom Backend Footer
add_filter('admin_footer_text', 'wp_bootstrap_custom_admin_footer');
function wp_bootstrap_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://320press.com" target="_blank">320press</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.';
}

// adding it to the admin area
add_filter('admin_footer_text', 'wp_bootstrap_custom_admin_footer');

function phila_add_cats_to_pages(){
	register_taxonomy_for_object_type('category', 'page');  
}

add_action( 'init', 'phila_add_cats_to_pages' );

// Set content width
if ( ! isset( $content_width ) ) $content_width = 580;

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'wpbs-featured', 770, 400, true );
add_image_size( 'wpbs-featured-carousel', 970, 400, true);
add_image_size( 'phila-standard-thumb', 283, 210, true);

/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function wp_bootstrap_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'A Sidebar',
    	'description' => 'Used on pages with a sidebar template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'id' => 'department-sidebar',
    	'name' => 'Department Sidebar and Nav',
    	'description' => 'For use on department pages',
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    /*
    register_sidebar(array(
    	'id' => 'home-second-row',
    	'name' => 'Homepage Row Two',
    	'description' => 'Homepage Second Row',
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'id' => 'home-third-row',
    	'name' => 'Homepage Row Three',
    	'description' => 'Homepage Third Row',
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    */        
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

//karissa includes
/*
include(get_template_directory() . '/inc/widgets/phila-social-media.php');

function load_phila_widgets() {
	register_widget("Phila_Social_Widget");
}
add_action("widgets_init", "load_phila_widgets");
*/

register_nav_menu( 'sidebar-menu', 'Secondary Navigation' );

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function wp_bootstrap_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="comment-author vcard clearfix">
				<div class="avatar col-sm-3">
					<?php echo get_avatar( $comment, $size='75' ); ?>
				</div>
				<div class="col-sm-9 comment-text">
					<?php printf('<h4>%s</h4>', get_comment_author_link()) ?>
					<?php edit_comment_link(__('Edit','wpbootstrap'),'<span class="edit-comment btn btn-sm btn-info"><i class="glyphicon-white glyphicon-pencil"></i>','</span>') ?>
                    
                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert-message success">
          				<p><?php _e('Your comment is awaiting moderation.','wpbootstrap') ?></p>
          				</div>
					<?php endif; ?>
                    
                    <?php comment_text() ?>
                    
                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                    
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

// Display trackbacks/pings callback function
function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php 

}

/************* SEARCH FORM LAYOUT *****************/

/****************** password protected post form *****/

add_filter( 'the_password_form', 'custom_password_form' );

function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<div class="clearfix"><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . '<p>' . __( "This post is password protected. To view it please enter your password below:" ,'wpbootstrap') . '</p>' . '
	<label for="' . $label . '">' . __( "Password:" ,'wpbootstrap') . ' </label><div class="input-append"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'wpbootstrap' ) . '" /></div>
	</form></div>
	';
	return $o;
}

/*********** update standard wp tag cloud widget so it looks better ************/

add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}

// filter tag clould output so that it can be styled by CSS
function add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#";
	$replaceme = "('$1$2 label tag-'.get_tag($2)->slug.'$3')";
//KD updates - removed use of deprecated preg_replace
    foreach( $tags as $tag ) {
    	$tagn[] = $replacement = preg_replace_callback(
		$regex,
			function($m) use ($replaceme) {return $m[0];},
		$tag
		);
    }

    $taglinks = implode('</a>', $tagn);

    return $taglinks;
}

add_action( 'wp_tag_cloud', 'add_tag_class' );

add_filter( 'wp_tag_cloud','wp_tag_cloud_filter', 10, 2) ;

function wp_tag_cloud_filter( $return, $args )
{
  return '<div id="tag-cloud">' . $return . '</div>';
}

// Enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

// Disable jump in 'read more' link
function remove_more_jump_link( $link ) {
	$offset = strpos($link, '#more-');
	if ( $offset ) {
		$end = strpos( $link, '"',$offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_jump_link' );

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
/*
// Add the Meta Box to the homepage template
function add_homepage_meta_box() {  
	global $post;

	// Only add homepage meta box if template being used is the homepage template
	// $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : "");
	$post_id = $post->ID;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

	if ( $template_file == 'page-homepage.php' ){
	    add_meta_box(  
	        'homepage_meta_box', // $id  
	        'Optional Homepage Tagline', // $title  
	        'show_homepage_meta_box', // $callback  
	        'page', // $page  
	        'normal', // $context  
	        'high'); // $priority  
    }
}

add_action( 'add_meta_boxes', 'add_homepage_meta_box' );
*/


// Field Array  
$prefix = 'custom_';  
$custom_meta_fields = array(  
    array(  
        'label'=> 'Homepage tagline area',  
        'desc'  => 'Displayed underneath page title. Only used on homepage template. HTML can be used.',  
        'id'    => $prefix.'tagline',  
        'type'  => 'textarea' 
    )  
);  

// The Homepage Meta Box Callback  
function show_homepage_meta_box() {  
  global $custom_meta_fields, $post;

  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );
    
  // Begin the field table and loop
  echo '<table class="form-table">';

  foreach ( $custom_meta_fields as $field ) {
      // get value of this field if it exists for this post  
      $meta = get_post_meta($post->ID, $field['id'], true);  
      // begin a table row with  
      echo '<tr> 
              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
              <td>';  
              switch($field['type']) {  
                  // text  
                  case 'text':  
                      echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" /> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
                  break;
                  
                  // textarea  
                  case 'textarea':  
                      echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="80" rows="4">'.$meta.'</textarea> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
                  break;  
              } //end switch  
      echo '</td></tr>';  
  } // end foreach  
  echo '</table>'; // end table  
}  

// Save the Data  
function save_homepage_meta( $post_id ) {  

    global $custom_meta_fields;  
  
    // verify nonce  
    if ( !isset( $_POST['wpbs_nonce'] ) || !wp_verify_nonce($_POST['wpbs_nonce'], basename(__FILE__)) )  
        return $post_id;

    // check autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    // check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
    }
  
    // loop through fields and save the data  
    foreach ( $custom_meta_fields as $field ) {
        $old = get_post_meta( $post_id, $field['id'], true );
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta( $post_id, $field['id'], $new );
        } elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id, $field['id'], $old );
        }
    } // end foreach
}
add_action( 'save_post', 'save_homepage_meta' );

// Add thumbnail class to thumbnail links
function add_class_attachment_link( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a','<a class="thumbnail"',$html );
    return $html;
}
add_filter( 'wp_get_attachment_link', 'add_class_attachment_link', 10, 1 );

// Add lead class to first paragraph
/*function first_paragraph( $content ){
    global $post;

    // if we're on the homepage, don't add the lead class to the first paragraph of text
    if( is_page_template( 'page-homepage.php' ) )
        return $content;
    else
        return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
}
add_filter( 'the_content', 'first_paragraph' );
*/

//Get post cat slug and looks for single-[cat slug].php and applies it
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
		return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);

// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

	 global $wp_query;
	 $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	 $class_names = $value = '';
	
		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			$class_names = "dropdown ";
		}
	
		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		
		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
       
   	$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

   	$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
   	$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
   	$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
   	$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

   	// if the item has children add these two attributes to the anchor tag
   	// if ( $args->has_children ) {
		  // $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    // }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
    $item_output .= $args->link_after;

    // if the item has children add the caret just before closing the anchor tag
    if ( $args->has_children ) {
    	$item_output .= '<b class="caret"></b></a>';
    }
    else {
    	$item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
  } // end start_el function
        
  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
      
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
        $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }        
}

//add_editor_style('editor-style.css');



//modify login page
function login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/city-of-phila@2.png);
            padding-bottom: 20px;
            background-size: 200px 200px;
            height:200px;
            width:200px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'login_logo' );



// enqueue styles
    function theme_styles() { 
        // This is the compiled css file from LESS - this means you compile the LESS file locally and put it in the appropriate directory if you want to make any changes to the master bootstrap.css.
		wp_register_style( 'jasny-bootstrap', get_template_directory_uri() . '/library/css/jasny-bootstrap.min.css' );
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/bootstrap.css' );
        wp_register_style('phila-style',  get_template_directory_uri() . '/phila-style.css'); 
    
       	wp_enqueue_style( 'jasny-bootstrap' ); 
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style('phila-style');
    }
add_action( 'wp_enqueue_scripts', 'theme_styles' );

// enqueue javascript
if( !function_exists( "theme_js" ) ) {  
  function theme_js(){
          
    wp_register_script( 'bootstrap', 
      get_template_directory_uri() . '/library/js/bootstrap.min.js', 
      array('jquery'),
		'3.2.0',
		true);
	  
    wp_register_script(  'modernizr', 
      get_template_directory_uri() . '/library/js/modernizr.full.min.js', 
      array('jquery'),
		'2.0.6',
		false);
 
	//for mobile swiping of things
    wp_register_script(  'swiper', 
      get_template_directory_uri() . '/library/js/idangerous.swiper-2.1.min.js', 
      array('jquery'),
		'2.1',
		true);
     
	  //for sweet select boxes
    wp_register_script(  'fancySelect', 
      get_template_directory_uri() . '/library/js/fancySelect.js', 
      array('jquery'), 
		'1.4.0',
		true);
        
    wp_register_script( 'phila-scripts', 
      get_template_directory_uri() . '/library/js/scripts.js', 
      array('jquery'),
		'1.0',
		true);
	  
	  wp_register_script( 'jansy-bootstrap', 
      get_template_directory_uri() . '/library/js/jasny-bootstrap.min.js', 
      array('jquery'),
		'3.1.3',
		false);

      
	add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
  
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap');
	wp_enqueue_script('jansy-bootstrap');
    wp_enqueue_script('modernizr');
    wp_enqueue_script('headroom');
    wp_enqueue_script('swiper'); 
    wp_enqueue_script('fancySelect');
    wp_enqueue_script('phila-scripts');

    
  }
}
add_action( 'wp_enqueue_scripts', 'theme_js' );
add_filter('stylesheet_uri','wpi_stylesheet_uri',10,2);



add_filter( 'the_content_more_link', 'modify_read_more_link' );
    function modify_read_more_link() {
        return '<a class="more-link" href="' . get_permalink() . '"></a>';
}

function theme_name_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= ' | ' . "$site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'theme_name_wp_title', 10, 2 );

function get_department_name(){
	$post = null;
	$post = get_post( $post['ID'] );//need array notation here
	$terms = get_the_terms($post, 'category');

	if ($terms && ! is_wp_error($terms)){
		
		$department_name_links = array();
		
		foreach($terms as $term){
			$department_name_links[] = $term->name;
		}
		$department_name = join(", ", $department_name_links );
	}
	return $department_name;
}


/*
	All this stuff is custom for phila.gov. Consider moving/making better.
*/

function mayor_box_homepage() {
	global $post_id; //kind of a hack
        $args_mayor = array(
        	'posts_per_page'   => 1,
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_type'        => 'post',
            'post_status'      => 'publish',
            'meta_key'    => '_thumbnail_id',
			'tax_query'	=> array(
				'relation'		=> 'AND',
				array(
					'taxonomy'		=> 'display_options', 
					'field'			=> 'slug',
					'terms' 		=> 'frontpage'
				),
				array(
					'taxonomy'		=> 'display_options', 
					'field'			=> 'slug',
					'terms' 		=> 'mayor-news'
				),
			)
        ); 
          $query = new WP_Query( $args_mayor ); 
          if ( $query->have_posts() ){
              while ( $query->have_posts() ) {
                  $query->the_post();
                  echo '<a href="#"><h1 class="section-header">Mayor\'s Office</h1></a>';
                  echo '<a href="' . get_permalink() . '">';
                  echo '<h2>' . get_the_title() .'</h2>';
                  echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                  echo '</a>';
            }
        } else {
         ?><p>There are no Mayor's Office news stories!</p> <?php
        } 
       wp_reset_postdata();
}

function add_services_homepage($numb_posts, $post_offset){
		global $post_id; //kind of a hack
        $args_services = array(
             'posts_per_page'   => $numb_posts,
             'orderby'          => 'post_date',
             'order'            => 'DESC',
             'post_type'        => 'post',
             'post_status'      => 'publish',
             'offset'       => $post_offset,
			 'tax_query'	=> array(
				array(
					'taxonomy'		=> 'display_options', 
					'field'			=> 'slug',
					'terms' 		=> 'frontpage'
				),
				array(
					'taxonomy'		=> 'display_options', 
					'field'			=> 'slug',
					'terms' 		=> 'online-services'
				),
			),
         ); 
        $services_query = new WP_Query( $args_services ); 
         if ( $services_query->have_posts() ) {
              while ( $services_query->have_posts() ) {
               $services_query->the_post();
				   
                 if (('' != get_the_post_thumbnail())) {
                   echo '<div class="overlay-box">';
                   echo '<div class="cat-label">Online Services</div>';
                   echo '<a href="' . get_permalink() . '">';
                   echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                   echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                   echo '</a>';
                   echo '</div>';
                } else if (('' == get_the_post_thumbnail())) {
				     echo '<div class="overlay-box no-img">';
                     echo '<div class="cat-label">Online Services</div>';
                     echo '<a href="' . get_permalink() .'">';
                     echo '<div class="tile-text"> <h1>' . get_the_title() .'</h1>' . get_the_excerpt() . '</div>';
                     echo '</a>';
                     echo '</div>';            
				 }                        
			  }//close while
          	} else {
			?><p>There are no online services!?</p> <?php
         } 
        wp_reset_postdata();
    }

function trending_posts_homepage(){
	global $post_id; //kind of a hack
	global $thumbnail;
     $args_trending = array(
          'posts_per_page'   => 8,
           'orderby'          => 'post_date',
           'order'            => 'DESC',
            'post_type'        =>  array('post', 'page'),
            'post_status'      => 'publish',
		 	'tax_query'	=> array(
				'relation'		=> 'AND',
				array(
					'taxonomy'		=> 'display_options', 
					'field'			=> 'slug',
					'terms' 		=> 'frontpage'
					),
				array(
					'taxonomy'		=> 'display_options', 
					'field'			=> 'slug',
					'terms' 		=> 'trending'
				),
			),
        ); 
       $trending_query = new WP_Query( $args_trending ); 
       if ( $trending_query->have_posts() ) {
           while ( $trending_query->have_posts() ) {
                 $trending_query->the_post();
                 $category = get_the_category();
                  if (('' != get_the_post_thumbnail())) { 
                      echo '<div class="col-md-6 col-sm-8 col-ms-12"><div class="overlay-box">';
                      echo '<div class="cat-label">' . get_department_name(). "</div>";
                      echo '<a href="' . get_permalink() . '" title="' . esc_attr( $thumbnail['post_title'] ) . '">';
                      echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                      echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                      echo '</a>';
                      echo '</div></div>';
				  	} else if ('' == get_the_post_thumbnail())  {
					  
					  echo '<div class="col-md-6 col-sm-8 col-ms-12">
                             <div class="overlay-box no-img">';
                      echo '<div class="cat-label">' . get_department_name() . "</div>";
                      echo '<a href="' . get_permalink() .'">';
                      echo '<div class="tile-text"> <h1>' . get_the_title() .'</h1>' .get_the_excerpt() . ' </div>';
                      echo '</a>';
                      echo '</div></div>';            
                    }                                                             
              }//close while
             } else {
           ?><p>There are no trending news stories!</p> <?php
          } 
          wp_reset_postdata();
        ?></div> <?php 
}
function trending_posts_homepage_mobile(){
     $args_trending = array(
         'posts_per_page'   => 8,  
          'orderby'          => 'post_date',
          'order'            => 'DESC',
          'post_type'        => 'post',
          'post_status'      => 'publish',
			'tax_query'	=> array(
				'relation'		=> 'AND',
				array(
					'taxonomy'		=> 'display_options', 
					'field'			=> 'slug',
					'terms' 		=> 'frontpage'
					),
				array(
					'taxonomy'		=> 'display_options', 
					'field'			=> 'slug',
					'terms' 		=> 'trending'
				),
			),
       ); 
         $trending_query = new WP_Query( $args_trending ); 
         // The Loop
           if ( $trending_query->have_posts() ) {
            while ( $trending_query->have_posts() ) {
            	$trending_query->the_post();
                echo  '<div class="swiper-slide">';
                echo '<a href="' . get_permalink() .'"></a>';
                echo '<p class="title">' . get_the_title() . '</p>' . '<p>' . get_the_excerpt() . '</p>';
                echo  '</div>';                              
                }//close while
                } else {
                // no posts found
                ?><p>There are no trending news stories!</p> <?php } 
                 /* Restore original Post Data */
                     wp_reset_postdata();
                  ?></div> <?php 
             }

//require WPMU_PLUGIN_DIR.'/phila_general/inc/VC_shortcodes.php';\

