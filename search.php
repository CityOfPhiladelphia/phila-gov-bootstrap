<?php get_header(); ?>

	</div> <!-- end header.php container --> 
		<header class="fluid-container page-title">
			<div class="container">
				<h1 class="page-header"><span><?php _e("Search Results for","wpbootstrap"); ?>:</span> <?php echo esc_attr(get_search_query()); ?></h1>
				<div class="breadcrumbs">
				<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
				} ?>
			</div>
			</div>
		</header>

	<div class="container marg-top">
			<div id="content" class="clearfix row">
			
				<div id="main" class="col col-lg-16 clearfix" role="main">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
							
							<h3><?php $category = get_the_category(); echo $category[0]->cat_name;?> : <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							
						</header> <!-- end article header -->
					
						<section class="post_content">							
					<?php
						//total hack!! get stripped contnet, match on [whatever]
						//output plain text
								$page_excerpt = get_the_content();
								$the_excerpt = get_the_excerpt();
								if ($the_excerpt == '') {

									//$menu_content = $page_excerpt;
									$strip_this = "/\[(.*?)\]/";
									$and_this = "/\<(.*?)\>/";
									
									$no_menu_excerpt = preg_replace($strip_this, '', $page_excerpt);
									$no_html_excerpt = preg_replace($and_this, '', $no_menu_excerpt);
									
									echo chop_chars($no_html_excerpt, 200);
									echo '...';
									echo '<a href="' . get_permalink() .'">Read More &raquo;</a>';
								}else {
									the_excerpt();
								}
					?>
						</section> <!-- end article section -->
					<hr>
					</article> <!-- end article -->
					
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>
						
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "wpbootstrap")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "wpbootstrap")) ?></li>
							</ul>
						</nav>
					<?php } ?>			
					
					<?php else : ?>
					
					<!-- this area shows up if there are no results -->
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    			
    			<?php get_sidebar(); // sidebar 1 ?>
    
					</div> <!-- end-->
        </div><!-- end #content -->
  </div><!-- end container -->

<?php get_footer(); ?>