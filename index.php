<?php
/*
Template Name: Home Page Template
*/
?>
<?php get_header(); ?>
			<div id="content" class="clearfix">
                    <div class="row">
                             <?php echo do_shortcode('[PhilaAlertsWidget]'); ?>
                    </div>
                    
                    <!--MOBILE VIEW ONLY -->
                    <section class="mobile-visitors visible-xs-block">
                        <div class="row">
                            <div class="col-xs-24">
                                <a href="https://iframe.publicstuff.com/#?client_id=242" class="philly-311-link mobile-button">
                                    <section class="philly-311">
                                        <h1>Philly 311</h1>
                                        <h2>Submit a service request</h2>
                                    </section>
                                </a>
                            </div>
                        </div>
                        <section class="actions row">
                            <div class="col-xs-24">
                                <?php echo do_shortcode('[PhilaActionWidget]'); ?>
                            </div>
                        </section>
                        <section class="most-visited row">
                            <div class="col-xs-8">
                                    <a href="http://property.phila.gov/" class="mobile-button">
                                        <span class="button-text">Property Search</span>  
                                    </a>
                            </div>
                            <div class="col-xs-8">
                                <a href="#" class="mobile-button">
                                    <span class="button-text">Real Estate Taxes</span>  
                                </a>
                            </div>
                            <div class="col-xs-8">
                                <a href="http://www.phila.gov/topics/employment/Pages/default.aspx" class="mobile-button">
                                    <span class="button-text">Employment</span>  
                                </a>
                            </div>
                            <div class="col-xs-8">
                                <a href="http://www.opendataphilly.org/" class="mobile-button">
                                    <span class="button-text">Open Data</span>  
                                </a>
                            </div>
                            <div class="col-xs-8">
                                <a href="http://www.phila.gov/map" class="mobile-button">
                                    <span class="button-text">Maps</span>  
                                </a>
                            </div>
                            <div class="col-xs-8">
                                <a href="#" class="mobile-button">
                                    <span class="button-text">Property History</span>  
                                </a>
                            </div>
                        </section>
                        <section class="actions row">
                            <div class="col-xs-24">
                                <?php echo do_shortcode('[PhilaApplyWidget]'); ?>
                            </div>
                        </section>
                        <section class="trending row">
                            <div class="col-sm-24">
                                <h1 class="break">Trending City Departments</h1>
                                <div class="row">  
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                           <?php trending_posts_homepage_mobile(); ?>
                                        </div><!--end wrapper -->
                                      </div><!--end container -->
                                </div>
                        </section>
                    </section><!--END MOBILE VIEW ONLY -->
                    
                    
                    <section class="top-annoucements row">
                        <!--Date/time -->
                        <div class="col-md-16">
                            <div class="overlay-box">
                                <h1 class="section-header">Headlines</h1>
                                <?php echo slider_pro(2); //two on prod ?>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <section class="overlay-box mayor">
                        <!-- mayor box and calendar -->
                        <?php mayor_box_homepage(); ?>
                        </section><!--end overlaybox-->
                            <div class="home-events-container">
                                <h1 class="section-header">Citywide Events</h1>
                                <div class="home-events clearfix">
                                    <?php echo do_shortcode('[PhilaGoogleCalendarWidget]'); ?>
                                </div>
                                <p class="more-events-bg"><a href="#" class="tiny-text more-events">More events &raquo;</a></p>
                            </div>
                         </div>
                                              
                        
                    </section><!--end top row -->
                    <section class="services row hidden-xs">
                        <div class="col-lg-24"><h1 class="break">Online Services</h1></div>
                        <!--begin col 1 -->
                        <div class="col-md-6 col-sm-12 col-ms-12">
                            <?php echo do_shortcode('[Phila311Widget]'); ?>
                        </div>
                        <!--begin col 2 -->
                          <div class="col-md-6 col-sm-12 col-ms-12">
                            <div class="need-to">
                                <div class="cat-label-top">I want to</div>
                                <?php echo do_shortcode('[PhilaActionWidget]'); ?>
                            </div>
                        </div>
                        <!--begin col 3 -->
                        <div class="col-md-6 col-sm-12  col-ms-12">
                            <?php echo do_shortcode('[PhilaPropSearch]'); ?>
                            <?php echo do_shortcode('[PhilaApplyWidget]'); ?>
                        </div>
                        <!--begin col 4 -->
                        <div class="col-md-6 col-sm-12  col-ms-12">
                            <?php add_services_homepage(2,0); ?>
                        </div>
                        
                    </section>
                    <section class="trending row hidden-xs">
                        <div class="col-sm-24">
                            <h1 class="break">Trending City Departments</h1>
                            <div class="row">  
                               <?php trending_posts_homepage(); ?>
                            </div>
                    </section>
				</div> <!-- end #main -->
			</div> <!-- end #content -->
    </div> <!-- end .container from header.php -->
<?php get_footer(); ?>
