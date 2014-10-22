<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-18 clearfix archive" role="main">
					
					<div class="breadcrumbs">
					<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs">','</p>');
					} ?>
					</div>
					<div class="page-header">

								<h1>Browsing 
									<?php $term = get_term_by( 'slug', 
															  //search for this
															  get_query_var('term'), 'topics'
															 ); echo $term->name; ?></h1>
					
					</div>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<?php 
						//look for URL and output this instead of the full news story
						$url = get_post_meta($post->ID, 'phila_url', true );
						if (strpos($url, 'http://') !==false) : ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix row'); ?> role="article">
						<h3><a href="<?php echo get_post_meta($post->ID, 'phila_url', true ) ?>"><?php echo the_title() ?> (link)							</a></h3>						
							<p class="meta">
								<time datetime="<?php echo get_the_date(); ?>" pubdate><?php echo get_the_date(); ?></time> | 
								<?php the_category(', '); ?> | <?php echo $term->name;?>
							</p>
						
						<?php if ($post->post_excerpt) {
							?><section class="post_excerpt"><?php the_excerpt(); ?></section>
						<?php } ?>
						
						</article>
					
					<?php else : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix row'); ?> role="article">
						<?php if ('' != get_the_post_thumbnail()){ ?>
							<div class="col-md-10">
								<?php the_post_thumbnail( 'wpbs-featured' ); ?>
							</div>
							<div class="col-md-12">
						<?php } else {?>
							<div class="col-md-24">
						<?php } ?>
										
						<header>
							<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<p class="meta"><time datetime="<?php echo get_the_date(); ?>" pubdate><?php echo get_the_date(); ?></time> | <?php the_category(', '); ?> | <?php echo $term->name;?></p>
						<?php /*
							<p><?php echo 'start:' . date("m.d.y", get_post_meta($post->ID, 'news-start-date', true )); ?></p>
							<p><?php echo 'end:' . date("m.d.y", get_post_meta($post->ID, 'news-end-date', true )); ?></p>
							<p><?php echo 'no expire:' .  get_post_meta($post->ID, 'news-no-expire', true ); ?></p>
						
							*/?>
								
						</header> <!-- end article header -->
					
						<section class="post_excerpt">

							<?php the_excerpt(); ?>
					
						</section> <!-- end article section -->
						</div><!-- end col  -->
						<footer>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					<?php endif; //end the display bits?>
					
					<?php endwhile; //ends the loop?>
					
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
    		
				<?php get_sidebar(); ?>
				
				
    
			</div> <!-- end something? -->
        </div><!-- end #content -->

<?php get_footer(); ?>