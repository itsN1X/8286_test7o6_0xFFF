<?php

function travel_notes_theme_setup() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'travel-notes', get_template_directory() . '/library/translation' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'travel_notes_scripts_and_styles', 999 );

  // launching this stuff after theme setup
  travel_notes_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'travel_notes_register_sidebars' );

  // cleaning up excerpt
  add_filter( 'excerpt_more', 'travel_notes_excerpt_more' );

} 

// let's get this party started
add_action( 'after_setup_theme', 'travel_notes_theme_setup' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
  $content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes

add_image_size( 'travel_notes_300x300', 300, 300, true );
add_image_size( 'travel_notes_600x600', 600, 600, true );


add_filter( 'image_size_names_choose', 'travel_notes_custom_image_sizes' );
function travel_notes_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        '300x300' => __('300px by 300px','travel-notes')
    ) );
}

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function travel_notes_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar1',
    'name' => __( 'Posts Sidebar', 'travel-notes' ),
    'description' => __( 'The Posts sidebar.', 'travel-notes' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Page Sidebar', 'travel-notes' ),
    'description' => __( 'The Page sidebar.', 'travel-notes' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function travel_notes_comments( $comment, $args, $depth ) { ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php echo get_avatar( $comment,60 ); ?>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php esc_html_e( 'Your comment is awaiting moderation.', 'travel-notes' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'travel-notes' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'travel-notes' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><?php comment_time(__( 'F jS, Y', 'travel-notes' )); ?></time>
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

add_filter( 'comment_form_defaults', 'travel_notes_remove_comment_form_allowed_tags' );
function travel_notes_remove_comment_form_allowed_tags( $defaults ) {

  $defaults['comment_notes_after'] = '';
  return $defaults;

}