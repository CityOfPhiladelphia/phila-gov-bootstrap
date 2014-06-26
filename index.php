<?php
/*
Template Name: Home Page Template
*/
?>
<?php get_header(); ?>
			<div id="content" class="clearfix row">
				<div id="main" class="clearfix" role="main">
                    <section class="top-annoucements">
                        <!--Date/time -->
                        <div class="col-lg-8">
                            <?php echo do_shortcode('[PhilaAlertsWidget]'); ?>
                          <!-- slideshow large screens-->
                            <div class="visible-lg visible-md">
                                <?php echo slider_pro(2); //two on prod
                                ?>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="overlay-box mayor">
                        <!-- mayor box and calendar -->
                            <?php $args_mayor = array(
                                'posts_per_page'   => 1,
                                //'category__and' => array(12,22), //PROD
                                'category_name'    =>'frontpage+mayor-news', //DEV
                                'orderby'          => 'post_date',
                                'order'            => 'DESC',
                                'post_type'        => 'post',
                                'post_status'      => 'publish',
                                'meta_key'    => '_thumbnail_id'
                            ); 
                           // $filter = );
                            $query = new WP_Query( $args_mayor ); 
                            // The Loop
                                if ( $query->have_posts() ){
                                    while ( $query->have_posts() ) {
                                        $query->the_post();

                                        echo '<div class="cat-label-top">Mayor\'s Office</div>';
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
                        </div><!--end overlaybox-->
                            <?php if ( is_active_sidebar('home-first-row') ) {
                                 echo '<div class="home-events clearfix"><div class="cat-label-top">Events</div>' ;
                                 dynamic_sidebar('home-first-row');
                                 echo '<a href="#" class="tiny-text">More events &raquo;</a>
                                 </div>' ;
                                } ?>
                         </div>
                                              
                        
                    </section><!--end top row -->
                    <section class="col-lg-12 services">
                        <div class="col-lg-12"><h1 class="break"><span>Online Services</span></h1></div>
                        <div class="col-lg-3">
                            <?php $args_services = array(
                                'posts_per_page'   => 2,
                                'category_name' =>    'frontpage+online-services',//homepage & online services only
                                'orderby'          => 'post_date',
                                'order'            => 'DESC',
                                'post_type'        => 'post',
                                'post_status'      => 'publish',
                                'meta_key'    => '_thumbnail_id'
                            ); 
                            $services_query = new WP_Query( $args_services ); 
                            // The Loop
                                if ( $services_query->have_posts() ) {
                                    while ( $services_query->have_posts() ) {
                                        $services_query->the_post();
                                        
                                        echo '<div class="overlay-box">';
                                        echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                        echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                                        echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                                        echo '</a>';
                                        echo '</div>';
                                    }
                                } else {
                                    // no posts found
                                    ?><p>There are no online services!?</p> <?php
                                } 
                                /* Restore original Post Data */
                                wp_reset_postdata();
             ?>
                        </div>
                        <div class="col-lg-3">
                            <?php echo do_shortcode('[Phila311Widget]'); ?>
                        </div>
                        <div class="col-lg-3">
                            <?php echo do_shortcode('[PhilaPropSearch]'); ?>
                        </div>
                        <div class="col-lg-3">
                            <div class="need-to">
                                <div class="cat-label-top">I need to</div>
                                <?php echo do_shortcode('[PhilaPay]'); ?>
                            </div>
                            <?php echo do_shortcode('[PhilaReportWidget]'); ?>
                        </div>
                        
                    </section>
                    <section class="trending col-sm-12">
                        <h1 class="break"><span>Trending</span></h1>
                        <div class="row">  
                        <?php $args_trending = array(
                                'posts_per_page'   => 4,
                                //'category_name'    => 'revenue,health+',     
                                'orderby'          => 'post_date',
                                'order'            => 'DESC',
                                'post_type'        => 'post',
                                'post_status'      => 'publish',
                                'meta_key'         => '_thumbnail_id'
                            ); 
                           // $omit = array ('cat' => -7);

                            $trending_query = new WP_Query( $args_trending ); 
                            // The Loop
                                if ( $trending_query->have_posts() ) {
                                    while ( $trending_query->have_posts() ) {
                                        $trending_query->the_post();
                                        
                                        $category = get_the_category(); 
                                        echo '<div class="col-md-3"><div class="overlay-box">';
                                        echo '<div class="cat-label">' . $category[0]->cat_name . "</div>";
                                        echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                        echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                                        echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                                        echo '</a>';
                                        echo '</div></div>';
                                    }
                                } else {
                                    // no posts found
                                    ?><p>There are no trending news stories!</p> <?php
                                } 
                                /* Restore original Post Data */
                                wp_reset_postdata();
             ?>
                        </div><!--end first row of trending -->
                        <div class="row">  
                        <?php 
                            $trending_query = new WP_Query( $args_trending ); 
                            // The Loop
                                if ( $trending_query->have_posts() ) {
                                    while ( $trending_query->have_posts() ) {
                                        $trending_query->the_post();
                                        
                                        $category = get_the_category(); 
                                        echo '<div class="col-md-3"><div class="overlay-box">';
                                        echo '<div class="cat-label">' . $category[0]->cat_name . "</div>";
                                        echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                        echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                                        echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                                        echo '</a>';
                                        echo '</div></div>';
                                    }
                                } else {
                                    // no posts found
                                    ?><p>There are no trending news stories!</p> <?php
                                } 
                                /* Restore original Post Data */
                                wp_reset_postdata();
             ?>
                            </div><!--end second row of trending -->
                    
                        <!-- slideshow mobile only-->
                        <div class="visible-sm visible-xs">
                            <?php echo slider_pro(3); ?>
                        </div>
                    </section>
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
