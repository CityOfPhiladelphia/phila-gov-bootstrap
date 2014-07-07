<?php
/*
Template Name: Home Page Template
*/
?>
<?php get_header(); ?>
			<div id="content" class="clearfix">
				<div id="main" class="clearfix" role="main">
                    <div class="row">
                             <?php echo do_shortcode('[PhilaAlertsWidget]'); ?>
                    </div>
                    
                    <section class="top-annoucements row">
                        <!--Date/time -->
                        <div class="col-md-16">
                            <div class="overlay-box">
                                <h1 class="section-header">Department Headlines</h1>
                                <?php echo slider_pro(2); //two on prod
                                 ?>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <section class="overlay-box mayor">
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

                                        echo '<h1 class="section-header">Mayor\'s Office</h1>';
                                        echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                        echo '<h2>' . get_the_title() .'</h2>';
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
                        </section><!--end overlaybox-->
                            <div class="home-events clearfix">
                                <h1 class="section-header">Citywide Events</h1>
                                <?php echo do_shortcode('[PhilaGoogleCalendarWidget]'); ?>
                                <a href="#" class="tiny-text more-events">More events &raquo;</a>
                               
                            </div>
                         </div>
                                              
                        
                    </section><!--end top row -->
                    <section class="services row">
                        <div class="col-lg-24"><h1 class="break">Online Services</h1></div>
                        <div class="col-md-6 col-sm-8">
                            <?php echo do_shortcode('[Phila311Widget]'); ?>
                        </div>
                        <div class="col-md-6 col-sm-8">
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
                                        $category = get_the_category();
                                        
                                        //dont show first category if it is "frontpage"
                                        if($category[0]->slug == 'frontpage') {                                   
                                            echo '<div class="overlay-box">';
                                            echo '<div class="cat-label">' . $category[1]->slug . "</div>";
                                            echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                            echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                                            echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                                            echo '</a>';
                                            echo '</div>';
                                        }else {
                                            echo '<div class="overlay-box">';
                                            echo '<div class="cat-label">' . $category[0]->slug . "</div>";
                                            echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                            echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                                            echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                                            echo '</a>';
                                            echo '</div>';
                                        
                                        }
                                    }
                                } else {
                                    // no posts found
                                    ?><p>There are no online services!?</p> <?php
                                } 
                                /* Restore original Post Data */
                                wp_reset_postdata();
                            ?>
                        </div>
                        <div class="col-md-6 col-sm-8">
                            <?php echo do_shortcode('[PhilaPropSearch]'); ?>
                           <?php $args_services_single = array(
                                'posts_per_page'   => 1,
                                'category_name' =>    'frontpage+online-services',//homepage & online services only
                                'orderby'          => 'post_date',
                                'order'            => 'DESC',
                                'post_type'        => 'post',
                                'post_status'      => 'publish',
                                'meta_key'    => '_thumbnail_id',
                                'offset'       => '2'
                            ); 
                            $services_query = new WP_Query( $args_services_single ); 
                            $category = get_the_category(); 
                            // The Loop
                                if ( $services_query->have_posts() ) {
                                    while ( $services_query->have_posts() ) {
                                        $services_query->the_post();
                                        $category = get_the_category(); 
                                        if($category[0]->slug == 'frontpage') {  
                                            echo '<div class="overlay-box">';
                                            echo '<div class="cat-label">' . $category[1]->slug . "</div>";
                                            echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                            echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                                            echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                                            echo '</a>';
                                            echo '</div>';
                                        }else {
                                            echo '<div class="overlay-box">';
                                            echo '<div class="cat-label">' . $category[0]->slug . "</div>";
                                            echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                            echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                                            echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                                            echo '</a>';
                                            echo '</div>';
                                        
                                        }
                                    }
                                } else {
                                    // no posts found
                                    ?><p>There are no online services!?</p> <?php
                                } 
                                /* Restore original Post Data */
                                wp_reset_postdata();
                            ?>
                        </div>
                        <div class="col-md-6 col-sm-24">
                            <div class="need-to">
                                <div class="cat-label-top">I want to</div>
                                <?php echo do_shortcode('[PhilaActionWidget]'); ?>
                            </div>
                        </div>
                        
                    </section>
                    <section class="trending row">
                        <div class="col-sm-24">
                            <h1 class="break">Trending City Departments</h1>
                            <div class="row">  
                                <?php $args_trending = array(
                                        'posts_per_page'   => 8,
                                        'category_name'    => 'frontpage',     
                                        'orderby'          => 'post_date',
                                        'order'            => 'DESC',
                                        'post_type'        => 'post',
                                        'post_status'      => 'publish',
                                        'tag'              => 'trending'
                                    ); 
                                    $trending_query = new WP_Query( $args_trending ); 
                                    // The Loop
                                        if ( $trending_query->have_posts() ) {
                                            while ( $trending_query->have_posts() ) {
                                                $trending_query->the_post();
                                                $category = get_the_category(); 
                                                
                                                //thumb is NOT BLANK & slug IS homepage
                                                    if (('' != get_the_post_thumbnail()) && ($category[0]->slug == 'frontpage' )) { //only display images with posts that have a featured imag
                                                        echo '<div class="col-md-6 col-sm-8">
                                                                <div class="overlay-box">';
                                                        echo '<div class="cat-label">' . $category[1]->slug . "</div>";
                                                        echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                                        echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                                                        echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                                                        echo '</a>';
                                                        echo '</div></div>';
                                                        //if the post thumb IS BLANK & category is front page
                                                    } else if (('' == get_the_post_thumbnail()) && ($category[0]->slug == 'frontpage' )) {
                                                        echo '<div class="col-md-6 col-sm-8">
                                                                <div class="overlay-box no-img">';
                                                        echo '<div class="cat-label">' . $category[1]->slug . "</div>";
                                                        echo '<a href="' . get_permalink() .'">';
                                                        echo '<div class="tile-text"> <h1>' . get_the_title() .'</h1>' . get_the_content() . '</div>';
                                                        echo '</a>';
                                                        echo '</div></div>';            
                                                        //if the post thumb is NOT blank and the slug is NOT front page
                                                    } else if ( ('' != get_the_post_thumbnail()) && ($category[0]->slug != 'frontpage')){
                                                         echo '<div class="col-md-6 col-sm-8">
                                                                <div class="overlay-box">';
                                                        echo '<div class="cat-label">' . $category[0]->slug . "</div>";
                                                        echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
                                                        echo '<h1 class="trending-headline">' . get_the_title() .'</h1>';
                                                        echo  get_the_post_thumbnail($post_id, 'full', array('class' =>'img-responsive'));
                                                        echo '</a>';
                                                        echo '</div></div>';
                                                        // IS BLANK thumbnail and the category slug is not frontpage
                                                    }else if (('' == get_the_post_thumbnail()) && ($category[0]->slug != 'frontpage')){
                                                              echo '<div class="col-md-6 col-sm-8">
                                                                <div class="overlay-box no-img">';
                                                        echo '<div class="cat-label">' . $category[0]->slug . "</div>";
                                                        echo '<a href="' . get_permalink() .'">';
                                                        echo '<div class="tile-text"> <h1>' . get_the_title() .'</h1>' . get_the_content() . '</div>';
                                                        echo '</a>';
                                                        echo '</div></div>';  
                                                    }
                                                                                  
                                                }//close while
                                            } else {
                                                // no posts found
                                                ?><p>There are no trending news stories!</p> <?php
                                            } 
                                        /* Restore original Post Data */
                                        wp_reset_postdata();
                                    ?>
                                </div><!--end first row of trending -->
                            </div>
                       
                        <!-- slideshow mobile only
                        <div class="visible-sm visible-xs">
                            <?php echo slider_pro(3); ?>
                        </div>
                    -->
                    </section>
				</div> <!-- end #main -->
			</div> <!-- end #content -->
    </div> <!-- end .container from header.php -->
<?php get_footer(); ?>
