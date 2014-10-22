<?php get_header(); ?>

	</div> <!-- end header.php container --> 
			<header class="fluid-container page-title">
				<div class="container">
								<h1 class="page-header">Technology</h1>
								<div class="breadcrumbs">
									<?php if ( function_exists('yoast_breadcrumb') ) {
										yoast_breadcrumb('<p id="breadcrumbs">','</p>');
									} ?>
					</div>
				</header> <!-- end article header -->

		<div class="container marg-top">
			<div id="content" class="clearfix row">
				<div id="main" class="col-sm-18 clearfix">
					<div class="masonry">
					<?php 
						$alpha_query = new WP_Query( array ( 'orderby' => 'title', 'order' => 'ASC', 'post_type'=> 'technology' ) ); 
						if ($alpha_query->have_posts()) : while ($alpha_query->have_posts()) : $alpha_query->the_post();	?>
					
						<div class="col-sm-8">
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
							
								<div class="thumb"><?php the_post_thumbnail( 'wpbs-featured' ); ?></div>
							<header>

								<h3 class="h2"><a href="<?php 
									$url = get_post_meta($post->ID, 'phila_url', true );
									echo $url;
									?>" rel="bookmark" title="<?php $address ?> Website"><?php the_title(); ?></a></h3>

							</header> <!-- end article header -->

							<section class="post_content">
						
								<?php the_excerpt();

								$address = get_post_meta($post->ID, 'phila_address', true );
								$url = get_post_meta($post->ID, 'phila_url', true );
								$phone = get_post_meta($post->ID, 'phila_phone', true );
									echo '<div class="address">'. $address . '</div>';
									echo '<div class="url"><a href="'. $url . '">Visit Website</a></div>';
									echo '<div class="phone">'. $phone . '</div>';
								?>
								<div class="social">
									<?php 
										$facebook = get_post_meta($post->ID, 'phila_facebook', true );
										$twitter = get_post_meta($post->ID, 'phila_twitter', true );
										if ($facebook != ''){
											echo '<a href="' . $facebook . '" title="Facebook profile" target="_self">
												<span class="fa-stack fa-lg">
													<i class="fa fa-circle fa-stack-2x"></i>
													<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
												</span></a>';
										}
										if ($twitter != ''){
											echo '<a href="' . $twitter . '" title="Twitter profile" target="_self">
												<span class="fa-stack fa-lg">
													<i class="fa fa-circle fa-stack-2x"></i>
													<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
												</span></a>';
										}
									?>
								</div>
							</section> <!-- end article section -->

							<footer>

							</footer> <!-- end article footer -->

						</article> <!-- end article -->
					</div>
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>

					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="pager">
								<li class="previous"><?php next_posts_link(_e('&laquo; Older Entries', "wpbootstrap")) ?></li>
								<li class="next"><?php previous_posts_link(_e('Newer Entries &raquo;', "wpbootstrap")) ?></li>
							</ul>
						</nav>
					<?php } ?>
								
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("No Posts Yet", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, What you were looking for is not here.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
		
				</div> <!-- end #main -->
    </div>
			
					<?php get_sidebar(); // sidebar 1 ?>
   
			</div> <!-- end something? -->
        </div><!-- end #content -->
	</div>
<?php get_footer(); ?>