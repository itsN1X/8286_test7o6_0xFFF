<?php
/* Welcome to travel_notes */

// loading modernizr and jquery, and reply script
function travel_notes_scripts_and_styles() {


  if (!is_admin()) {

		// modernizr (without media query polyfill)
		wp_register_script( 'jquery-modernizr', get_template_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
		
		if ( is_home() ){
			wp_enqueue_style( 'slick', get_template_directory_uri() . '/library/slick/slick.css', array(), '' );
            wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/library/slick/slick-theme.css', array(), '' );
		}
		
		// ie-only style sheet
		wp_enqueue_style( 'travel_notes-ie-only', get_template_directory_uri() . '/library/css/ie.css', array(), '' );

		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '' );

		wp_enqueue_style( 'travel_notes-google-font-raleway', '//fonts.googleapis.com/css?family=Raleway:300,400,400i,600,700,900' );

	    // comment reply script for threaded comments
	    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			  wp_enqueue_script( 'comment-reply' );
	    }

		wp_enqueue_script( 'jquery-modernizr' );
		wp_enqueue_script( 'jquery-effects-core ');
		wp_enqueue_script( 'jquery-effects-slide');

		if( is_page_template( 'template-home-banner.php' ) ) {
			
			wp_enqueue_script( 'travel_notes-js-scripts-banner', get_template_directory_uri() . '/js/scripts-banner.js', array(), '', true );
		}

		if ( is_home() || is_front_page() || is_archive() || is_search() || is_page_template( 'template-home-banner.php' ) ) :
			wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/library//slick/slick.min.js', array(), '', true );
			wp_enqueue_script( 'travel_notes-js-scripts-home', get_template_directory_uri() . '/library/js/scripts-home.js', array(), '', true );

		endif;

		if( !is_page_template( 'template-home-banner.php' ) ) {
			wp_enqueue_script( 'travel_notes-js-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '', true );
		}

		wp_style_add_data( 'travel_notes-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet
		wp_enqueue_script( 'travel_notes-js' , get_template_directory_uri() . '/library/js/scripts.js', array(), '', true );

	}
}
/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function travel_notes_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	add_editor_style();
	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => 'fafafa',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	add_theme_support( 'custom-header', array(
	 'video' => true,
	 'video-active-callback' => true,
	 'width' => '1920px',
	 'height' => '1080px'
	) );

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'video',           // video
			'audio',
			'quote'
		)
	);

	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'travel-notes' ),   // main nav in header
			'social-nav' => __( 'Social Links', 'travel-notes' ), 
			/*'footer-links' => __( 'Footer Links', 'travel-notes' ) // secondary nav in footer*/
		)
	);

	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo' );
} /* end travel_notes theme support */

/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using travel_notes_related_posts(); )
function travel_notes_related_posts() {
	echo '<ul id="travel_notes-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'travel-notes' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</ul>';
} /* end travel_notes related posts function */


function travel_notes_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'travel-notes' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'travel_notes_excerpt_more' );