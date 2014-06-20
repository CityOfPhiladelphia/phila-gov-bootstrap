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
                            <?php echo do_shortcode('[PhilaAlertsWidget]'); ?>
                          <!-- slideshow -->
                            Slideshow here
                        </div>
                        
                        <div class="col-md-5">
                            <div class="mayor-events">
                        <!-- mayor box and calendar -->
                            <?php $args = array(
                                'posts_per_page'   => 1,
                                'category__and' => array(12,22),
                                'orderby'          => 'post_date',
                                'order'            => 'DESC',
                                'post_type'        => 'post',
                                'post_status'      => 'publish',
                                'meta_key'    => '_thumbnail_id'
                            ); 
                            $query = new WP_Query( $args ); 
                            // The Loop
                                if ( $query->have_posts() ) {
                                    while ( $query->have_posts() ) {
                                        $query->the_post();
                                        echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                        echo '<h1>' . get_the_title() .'</h1>';
                                        echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                                        echo '</a>';
                                    }
                                } else {
                                    // no posts found
                                    ?><p>There are no Mayor's Office news stories!</p> <?php
                                } 
                                /* Restore original Post Data */
                                wp_reset_postdata();
             ?>
                      </div><!-- end mayor's events -->
                            <?php if ( is_active_sidebar('home-first-row') ) {
                                 echo '' ;
                                 dynamic_sidebar('home-first-row');
                                 echo '' ;
                                } ?>
                         </div>
                                              
                        
                    </section><!--end top row -->
                    <section class="row services">
                        <h1>Online Services</h1>
                        <div class="col-md-4">
                            <?php echo do_shortcode('[Phila311Widget]'); ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo do_shortcode('[PhilaPropSearch]'); ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo do_shortcode('[PhilaPay]'); ?>
                            <?php echo do_shortcode('[PhilaReportWidget]'); ?>
                        </div>
                        
                    </section>
                    <section class="row trending">
                        <h1>Trending</h1>
                        <div class="col-md-12">Trending boxes here</div>
                    </section>

					
				
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
