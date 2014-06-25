<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
				
		<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
        
        <link rel='stylesheet' type='text/css' href='<?php echo get_stylesheet_directory_uri() ?>/phila-styles.css'>

		<!-- end of wordpress head -->
				
	</head>
	
	<body <?php body_class(); ?>>
				
		<header role="banner">
				
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="container">
                    <div class="row">

                            <!-- hanburger button -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                          <div class="col-lg-2">
                                <a title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/phila-logo-final.gif" alt="The City of Philadelphia" title="The City of Philadelphia - Life, Libery, and You.">
                                <h1 class="hide"><?php bloginfo('name'); ?></h1>
                            </a>
                         </div>
                            <div class="collapse navbar-collapse navbar-responsive-collapse col-md-5">
                                    <?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>

                            </div>

                        <!-- home search area -->
                        <div class="col-lg-5 search-box">
                            <div class="clearfix">
                                <div class="accessibility">
                                    Text size ++ / Language
                                </div>
                            </div>
                                <?php get_search_form(); ?>
                                <div id="trending-searches">
                                <h1>Trending Searches:</h1>
                                    <ul class="list-inline">
                                        <li><a href="#">Health Clinics</a></li>
                                        <li><a href="#">Inmate Location</a></li>
                                        <li><a href="#">Taxes</a></li>
                                        <li><a href="#">Property</a></li>
                                    </ul>
                            </div>
                        </div>
                    </div><!-- end .row -->
				</div> <!-- end .container -->
			</div> <!-- end .navbar -->
		
		</header> <!-- end header -->
		
		<div class="container">
