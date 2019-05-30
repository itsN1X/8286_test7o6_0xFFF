<?php

/**
  *
  * Template Name: Homepage with banner
  *
*/

get_header('banner'); travel_notes_carousel(); ?>

<div class="front-wrapper">
	<div id="content">
		<div id="blog" class="wrap cf">
			<div id="main" role="main">
				<div class="blog-list container">
						<?php $paged = (get_query_var('page')) ? get_query_var('page') : 1;
	                    $wp_query = new WP_Query();
	                    $wp_query->query('post_type=post&ignore_sticky_posts=1&paged=' . $paged);
	                    $separator = 0;
	                    $separator_2 = 1;
	                            while ( $wp_query -> have_posts() ) : $wp_query -> the_post();
		  						get_template_part( 'home-content/home', get_post_format() ); ?>
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
						<?php previous_posts_link('<span class="fa fa-long-arrow-left"></span> ' . __('Newer Posts','travel-notes')); ?>
					</div>
					<div class="right-arrow">
						<?php next_posts_link( __('Older Posts','travel-notes') . ' <span class="fa fa-long-arrow-right"></span>'); ?>
					</div>
					<span class="clear"></span>
				</div>
				<?php wp_reset_postdata(); ?>
			</div>
		</div> <!-- inner-content -->
	</div> <!-- content -->
</div><!-- front-wrapper -->
<?php get_footer(); ?>