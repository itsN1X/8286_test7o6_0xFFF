<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js" style="height:100%;"><!--<![endif]-->

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

	</head>

	<body <?php body_class(); ?>>

		<div id="container">

			<div id="banner-wrap" <?php if( get_header_image() ) { ?> class="has-bg" style="background-image:url('<?php header_image(); ?>')" <?php } ?> >
				<div id="banner">
				        <div class="wrap">

								<?php while ( have_posts() ) : the_post();
				                    the_content();
								endwhile; ?>
				        </div>
				</div>
				<?php  if ( get_theme_mod('travel_notes_featured_select') != 'none' ) { ?>
					<a href="#featured-posts" class="arrow fa fa-angle-down"></a>
				<?php }else{ ?>
					<a href="#blog" class="arrow fa fa-angle-down"></a>
				<?php } 

				if ( has_header_video() ){ the_custom_header_markup(); } ?>
				
				<span class="opacity-overlay"></span>
	    	</div>
			<header class="head-absolute header" role="banner">

				<?php travel_notes_header(); ?>

			</header>