<?php

/**
* Apply Color Scheme
*/

  function travel_notes_apply_color() {

    if( get_theme_mod('travel_notes_color_settings') ){
      $primary  =   esc_html( get_theme_mod('travel_notes_color_settings') );
    }else{
      $primary  =  '#24cb83';
    }

    $custom_css = "
        a,
        .blog-list .item .meta-cat a,
        article.post .meta-cat a,
        .blog-list .item a.excerpt-read-more,
        .scrollToTop span,
        .slide-copy-wrap a:hover, .slide-copy-wrap a:focus,
        .blog-list .item a, .blog-list .widget-item a, article.post h2.post-title a, h2.post-title,
        nav[role='navigation'] .nav li.current_page_item > a,
        #responsive-nav .nav-icon,
        #logo a,
        h1.archive-title{
          color: {$primary};
        }
        button,
        html input[type='button'],
        input[type='reset'],
        input[type='submit'],
        .ias-trigger a,
        .nav li ul.children,
        .nav li ul.sub-menu,
        nav[role='navigation'] .nav li ul li a,
        #submit, .blue-btn, .comment-reply-link,
        .widget #wp-calendar caption,
        .slide-copy-wrap .more-link,
        .gallery .gallery-caption,
        .short-sep,
        #submit:active, #submit:focus, #submit:hover, .blue-btn:active, .blue-btn:focus, .blue-btn:hover, .comment-reply-link:active, .comment-reply-link:focus, .comment-reply-link:hover{
          background: {$primary};
        }
        .ias-trigger a,
        #submit, .blue-btn, .comment-reply-link,
        .scrollToTop{
          border: 1px solid {$primary};
        }
        #top-area .opacity-overlay{
          border-bottom: 1px solid {$primary};
        }
        @media screen and (max-width: 1039px) {
          nav.gh-main-navigation[role='navigation']{
            background: {$primary};
          }
        }
        ";

        wp_enqueue_style( 'travel_notes-stylesheet', get_template_directory_uri() . '/library/css/style.min.css', array(), '', 'all' );
        wp_enqueue_style( 'travel_notes-main-stylesheet', get_stylesheet_uri() , array(), '', 'all' );
        wp_add_inline_style( 'travel_notes-main-stylesheet', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'travel_notes_apply_color', 999 );