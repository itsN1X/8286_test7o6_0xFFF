<?php get_header(); ?>
	<div id="content">
		<?php if ( shortcode_exists( 'wpgeo_mashup' ) ) { ?>
			<div clsas="wp-geo">
				<?php echo do_shortcode('[wpgeo_mashup height="300px" width="100%"]'); ?>
			</div>
		<?php } ?>
		<div id="blog" class="wrap cf">
			<div id="main" role="main">
				<header class="article-header">
						<h1 class="archive-title h2">
							<?php the_archive_title(); ?>
						</h1>
				</header>
				<div class="blog-list container">
						<?php 
						$separator = 0;
						$separator_2 = 1;
						while ( have_posts() ) : the_post(); ?>
		  						<?php get_template_part( 'home-content/home', get_post_format() ); ?>
		  				<?php 
		  				if($separator++ == 2){
							echo '<span class="clear clear-three"></span>';
							$separator = 0;
						}
						if($separator_2%2 == 0){
							echo '<span class="clearfix clear-two"></span>';
							
						}
						$separator_2++;
		  				endwhile;  ?>
						<div class="clear"></div>
				</div>
				<div class="nav-arrows text-center">
  					<div class="left-arrow">
  						<?php next_posts_link( __('Older Posts','travel-notes') . " <span class='fa fa-long-arrow-right'></span>"); ?>
					</div>
					<div class="right-arrow">
						<?php previous_posts_link("<span class='fa fa-long-arrow-left'></span> ". __('Newer Posts','travel-notes') .""); ?>
					</div>
					<span class="clear"></span>
				</div>
			</div>
		</div> <!-- inner-content -->
	</div> <!-- content -->

<?php get_footer(); ?>