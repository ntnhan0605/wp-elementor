<?php
// function menu_customizer_preview_nav_menu( $setting ) {
// 	$menu_id = str_replace( 'nav_menu_', '', $setting->id );
// 	add_filter( 'wp_get_nav_menu_items', function( $items, $menu, $args ) use ( $menu_id, $setting ) {
// 		$preview_menu_id = $menu->term_id;
// 		if ( $menu_id == $preview_menu_id ) {
// 			$new_ids = $setting->post_value();
// 			foreach ( $new_ids as $item_id ) {
// 				$item = wp_setup_nav_menu_item( $item );
// 				$item->menu_order = $i;
// 				$new_items[] = $item;
// 				$i++;
// 			}
// 			return $new_items;
// 		} else {
// 			return $items;
// 		}
// 	}, 10, 3 );
// }
// add_action( 'customize_preview_nav_menu', 'menu_customizer_preview_nav_menu', 10, 2 );

function themeslug_customize_register( $wp_customize ) {
  $wp_customize->add_section('general', array(
    'priority' => 1,
    // 'panel' => '',
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('General', 'ntn'),
    'description' => 'General setting head, footer, something',
    'type' => 'theme_mod',
    'description_hidden' => 'Hello general'
  ));

  $wp_customize->add_setting(
      'brookside_lightbox_enable',
      array(
          'default'    =>  true,
          'transport'  =>  'refresh',
      )
  );
  $wp_customize->add_control(
      'brookside_lightbox_enable',
      array(
          'section'   => 'general',
          'label'     => esc_html__('Enable in-built lightbox feature.','brookside'),
          'type'      => 'textarea'
      )
  );

}
add_action( 'customize_register', 'themeslug_customize_register', 110 );
