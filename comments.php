<?php
/*
The comments page for travel_notes
*/

// don't load it if you can't comment
if ( post_password_required() ) {
  return;
}

?>

<?php // You can start editing here. ?>

  <?php if ( have_comments() ) : ?>

    <section class="commentlist">
      <h3 id="comments-title" class="h2"><?php comments_number( __( '<span>No</span> Comments', 'travel-notes' ), __( '<span>1</span> Comment', 'travel-notes' ), _n( '<span>%</span> Comments', '<span>%</span> Comments', get_comments_number(), 'travel-notes' ) );?></h3>
      <?php
        wp_list_comments( array(
          'style'             => 'div',
          'short_ping'        => true,
          'avatar_size'       => 60,
          'callback'          => 'travel_notes_comments',
          'type'              => 'all',
          'reply_text'        => __('Reply','travel-notes'),
          'page'              => '',
          'per_page'          => '',
          'reverse_top_level' => null,
          'reverse_children'  => '',
          'max_depth'         => 3,
        ) );
      ?>
    </section>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    	<nav class="navigation comment-navigation" role="navigation">
      	<div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Previous Comments', 'travel-notes' ) ); ?></div>
      	<div class="comment-nav-next"><?php next_comments_link( __( 'More Comments &rarr;', 'travel-notes' ) ); ?></div>
    	</nav>
    <?php endif; ?>

    <?php if ( ! comments_open() ) : ?>
    	<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'travel-notes' ); ?></p>
    <?php endif; ?>

  <?php endif; ?>

  <?php comment_form(); ?>