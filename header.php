<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '|', ' ', 'right' ); ?></title>	
        <!--no scaling for you! -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
				
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
        <? echo 'body { font-size:',$_COOKIE['site_font_size'],'; }'; } ?>
		<!-- end of wordpress head -->
        <meta name="google-translate-customization" content="d90261400faa65ae-ddf7613446a7abb6-g2c489841db617277-9"></meta>
        
        
	</head>
	
	<body <?php body_class(); ?>>
				
		<header role="banner" class="header animated" id="header">
          		<div class="container"> 
                    <div class="row">
                            <div class="accessibility visible-lg visible-md col-lg-24">
                            <a href="#" class="text-size-bubble-link">Text size</a>
                                <div class="text-size-bubble" id="text-size">
                                    <p>Text size:</p>
                                    <button type="button" href="#" id="incfont" class="btn btn-default">A+</button>
                                    <button type="button" href="#" id="decfont" class="btn btn-default">a-</button>
                               </div>
                        <a href="#" class="translate-bubble-link"><span class="glyphicon glyphicon-globe"></span> Translate</a>
                        <div class="translate-bubble" id="translate">
                             <p>Language:</p>
                                <div id="google_translate_element"></div>
                                <script type="text/javascript">
                                    function googleTranslateElementInit() {
                                          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                        }
                                    </script>
                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                        </div><!--end translate stuff -->
                        </div>
                    </div>
                </div>

			<div class="navbar navbar-default">
				<div class="container"> 
                    <section class="row">

                            <!-- hamburger button -->
                            <button type="button" class="navbar-toggle expose" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                          <div class="col-sm-4 col-xs-12 col-md-4 col-lg-3">
                                <a title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
                                <div class="hidden-xs logo"></div>
                                <div class="visible-xs logo"></div>
                                <h1 class="hide"><?php bloginfo('name'); ?></h1>
                            </a>
                         </div>
                            <div class="collapse navbar-collapse navbar-responsive-collapse col-lg-9 col-md-8 col-sm-3 col-xs-24">
                                    <?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
                            </div>

                        <!-- home search area -->
                        <div class="col-lg-13 col-sm-12 col-xs-24 col-search-box">
                                <?php get_search_form(); ?>
                                <div id="trending-searches" class="hidden-xs">
                                <h1>Trending Searches:</h1>
                                    <ul class="list-inline">
                                        <li><a href="#">Health Clinics</a></li>
                                        <li><a href="#">Inmate Location</a></li>
                                        <li><a href="#">Taxes</a></li>
                                        <li><a href="#">Property</a></li>
                                    </ul>
                            </div>
                        </div>
                    </section><!-- end .row -->
   
				</div> <!-- end .container -->
			</div> <!-- end .navbar -->
		
		</header> <!-- end header -->
        <!--bg fade -->
        <div id="full-page-overlay"></div>
		
		<div class="container">
