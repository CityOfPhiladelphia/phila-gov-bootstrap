			<footer role="contentinfo">
			
				<div id="inner-footer" class="clearfix">
		          <div id="widget-footer" class="clearfix row">
                    <div class="col-lg-24">					
					   <nav>
						<?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
					   </nav>
                        <p class="attribution">&copy; <?php bloginfo('name'); ?></p>
                         </div>
				    </div> <!-- end #inner-footer -->
                </div>
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
				
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>
	</body>

</html>