<?php

  require_once dirname( __FILE__ ) . '/vendor/tgm/class-tgm-plugin-activation.php';
  foreach( glob( dirname( __FILE__ ) . '/inc/*.php') as $file) require_once($file);

  add_action( 'tgmpa_register', 'wpf5c_register_required_plugins' );

  function wpf5c_register_required_plugins() {

	$plugins = array(
		array(
			'name'      => 'WP-SCSS',
			'slug'      => 'wp-scss',
			'required'  => false
		)
	);

	$config = array(
		'default_path' => dirname( __FILE__ ) . '/vendor/plugins',
		'menu'         => 'wpf5c-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'is_automatic' => false
	);

	tgmpa( $plugins, $config );
  }


  function wpf5c_enqueue_scripts() {
	wp_enqueue_script( 'modernizr', get_template_directory_uri(). '/js/vendor/modernizr.js', array(), false, false);
	wp_enqueue_script( 'foundation', get_template_directory_uri(). '/js/foundation.js', array( 'jquery' ), false, true);
	wp_enqueue_script( 'app', get_template_directory_uri(). '/js/app.js', array( 'jquery' ), false, true);
  }

  add_action( 'wp_enqueue_scripts', 'wpf5c_enqueue_scripts' );



add_action( 'widgets_init', 'wpf5c_widgets_init' );
function wpf5c_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'wpf5c' ),
		'id' => 'sidebar-1',
		'description' => __( 'Widgets in this area will be shown on some posts and pages.', 'wpf5c' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name' => __( 'Footer', 'wpf5c' ),
		'id' => 'sidebar-footer',
		'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'wpf5c' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	));
}

function wpf5c_count_widgets($sidebar=null){
	$widgets = wp_get_sidebars_widgets();

	if( !empty($widgets[$sidebar] )){
		return count($widgets[$sidebar]);
	}

	return 0;
}