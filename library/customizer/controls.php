<?php

/*******************************************************************
* These are settings for the Theme Customizer in the admin panel.
*******************************************************************/
if ( ! function_exists( 'travel_notes_theme_customizer' ) ) :
  function travel_notes_theme_customizer( $wp_customize ) {


    /**
    * Adds multiple category selection support to the theme customizer via checkboxes
    *
    * The category IDs are saved in the database as a comma separated string.
    */
    class travel_notes_Category_Checkboxes_Control extends WP_Customize_Control {
      public $type = 'category-checkboxes';

      public function render_content() {

          // Displays checkbox heading
          echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';

          // Displays category checkboxes.
          foreach ( get_categories() as $category ) {
              echo '<label><input type="checkbox" name="category-' . $category->term_id . '" id="category-' . $category->term_id . '" class="cstmzr-category-checkbox"> ' . $category->cat_name . '</label><br>';    
          }

          // Loads the hidden input field that stores the saved category list.
          ?><input type="hidden" id="<?php echo $this->id; ?>" class="cstmzr-hidden-categories" <?php $this->link(); ?> value="<?php echo esc_attr( sanitize_text_field( $this->value() ) ); ?>"><?php
      }
    }


    /* color scheme option */
    $wp_customize->add_setting( 'travel_notes_color_settings', array (
      'default' => '#24cb83',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'travel_notes_color_settings', array(
      'label'    => __( 'Theme Accent Color 1', 'travel-notes' ),
      'section'  => 'colors',
      'settings' => 'travel_notes_color_settings',
    ) ) );

    /* author bio in posts option */
    $wp_customize->add_section( 'travel_notes_posts_section' , array(
      'title'       => __( 'Post Settings', 'travel-notes' ),
      'priority'    => 35,
      'description' => '',
    ) );

    $wp_customize->add_setting( 'travel_notes_related_posts', array (
      'sanitize_callback' => 'travel_notes_sanitize_checkbox',
    ) );

    $wp_customize->add_control('related_posts', array(
      'settings' => 'travel_notes_related_posts',
      'label' => __('Disable the Related Posts?', 'travel-notes'),
      'section' => 'travel_notes_posts_section',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'travel_notes_author_area', array (
      'sanitize_callback' => 'travel_notes_sanitize_checkbox',
    ) );

    $wp_customize->add_control('author_info', array(
      'settings' => 'travel_notes_author_area',
      'label' => __('Disable the Author Information?', 'travel-notes'),
      'section' => 'travel_notes_posts_section',
      'type' => 'checkbox',
    ));

    $wp_customize->add_section( 'travel_notes_home_feature' , array(
      'title'       => __( 'Home page features', 'travel-notes' ),
      'priority'    => 28,
    ) );

    $wp_customize->add_setting( 'travel_notes_featured_select', array(
      'default' => __('sticky','travel-notes'),
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'travel_notes_select'

    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'travel_notes_featured_select', array(
      'settings' => 'travel_notes_featured_select',
      'label' => __( 'Choose whether to display "Sticky Posts" or "Categories" or nothing', 'travel-notes' ),
      'section' => 'travel_notes_home_feature',
      'type' => 'select',
      'priority'    => 101,
      'choices' => array(
        'none' => __( 'None', 'travel-notes' ),
        'sticky' => __( 'Sticky Posts', 'travel-notes' ),
        'category' => __( 'Categories', 'travel-notes' ),
      )
    )));

    $wp_customize->add_setting( 'travel_notes_cat', array (
      'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'travel_notes_cat', array(
      'label'    => __( 'Insert Categories Section Title', 'travel-notes' ),
      'section'  => 'travel_notes_home_feature',
      'settings' => 'travel_notes_cat',
      'priority'    => 102,
    ) ) );

    $wp_customize->add_setting( 'travel_notes_sticky', array (
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'travel_notes_sticky', array(
      'label'    => __( 'Insert Sticky Posts Section Title', 'travel-notes' ),
      'section'  => 'travel_notes_home_feature',
      'settings' => 'travel_notes_sticky',
      'priority'    => 103,
    ) ) );

    $wp_customize->add_setting( 'travel_notes_custom_categories', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control(
        new travel_notes_Category_Checkboxes_Control(
            $wp_customize,
            'travel_notes_custom_categories',
            array(
                'label' => __('Select Categories','travel-notes'),
                'section' => 'travel_notes_home_feature',
                'settings' => 'travel_notes_custom_categories',
                'priority'    => 104
            )
        )
    );


  }
endif;
add_action('customize_register', 'travel_notes_theme_customizer');

/**
 * Sanitize checkbox
 */
if ( ! function_exists( 'travel_notes_sanitize_checkbox' ) ) :
  function travel_notes_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
      return 1;
    } else {
      return '';
    }
  }
endif;


function travel_notes_select( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}