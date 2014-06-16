<?php
/*
Template Name: Home Page Template
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col col-lg-12 clearfix" role="main">
                    
                    <section class="row top-annoucements">
                        <!--Date/time -->
                        <div class="col-md-7">
                            <div class="heads-up-box">
                                <span id="date">&nbsp;</span><br>
                                <span id="clock">&nbsp;</span>
                                <div class="important-info">Alerts Transit Collection Closures</div>
                            </div>
                        <!-- slideshow -->
                            <?php echo do_shortcode("[huge_it_slider id='1']"); ?>
                        </div>
                        <!-- mayor box and calendar -->
                            <?php if ( is_active_sidebar('home-first-row') ) {
                                 echo '<div class="col-md-5 mayor-events">' ;
                                 dynamic_sidebar('home-first-row');
                                 echo '</div>' ;
                                } ?>
                        
                                              
                        </div>
                    </section><!--end top row -->
                    <section class="row services">
                        <h1>Online Services</h1>
                        <?php echo do_shortcode('[Phila311Widget]'); ?>
                        
                    </section>
                    <section class="row trending">
                        <h1>Trending</h1>
                         <?php if ( is_active_sidebar('home-third-row') ) {
                                 echo '<div class="col-md-12">' ;
                                 dynamic_sidebar('home-third-row');
                                 echo '</div>' ;
                             } ?>
                    </section>

					
				
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
