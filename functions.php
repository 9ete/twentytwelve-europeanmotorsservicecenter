<?php

/**
 * Randomize menu function
 *
 */

function randMenu ($menuName, $numItemsReturnedPlusOne) {
    //randomize and output 5 menu items
    //ADD MENU TO VAR, DISABLE ECHO AS TO NOT ECHO THE MENU IMMEDIATLY
    $autoBrandsMenu = wp_nav_menu( 
        array( 
            'theme_location' => $menuName, 
            'echo' => false,
            'before' => '--'
        ) 
    );
    //put each menu li into an array
    $menuArray = explode ("--", $autoBrandsMenu);
    $newMenuArray = array();
    foreach($menuArray as $key => $value) {
        $newMenuArray[$key] = $value;
    }
    echo $menuArray[0];
    //$rand_keys = array_rand($newMenuArray, 7);
    $rand_keys = array_rand($newMenuArray, $numItemsReturnedPlusOne);
    for($i=1; $i<7; $i++){
        echo $newMenuArray[$rand_keys[$i]];
    }
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function lowermedia_widgets_init() {

    register_sidebar( array(
        'name' => 'Footer right sidebar',
        'id' => 'footer_right_1',
        'before_widget' => '<div class="footer-right-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'lowermedia_widgets_init' );

function lowermedia_menus_init() {
  register_nav_menus(
    array(
      'auto-brands-menu' => __( 'Auto Brands Menu' )
    )
  );
}
add_action( 'init', 'lowermedia_menus_init' );

/*
#
#   SPEED OPTIMIZATIONS
#
*/

function load_fonts() {
    wp_dequeue_style( 'twentytwelve-fonts' );
    wp_deregister_style( 'twentytwelve-fonts' );

    wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Signika:400,700|Open+Sans:400italic,700italic,400,700&amp;subset=latin,latin-ext');
    wp_enqueue_style( 'googleFonts');
}

add_action('wp_print_styles', 'load_fonts');

//Remove contact form 7 stylesheet as it is unnecessary
function lowermedia_deregister_cf7style (){
    wp_dequeue_style( 'contact-form-7' );
    wp_deregister_style( 'contact-form-7' );
}
add_action( 'wp_enqueue_scripts', 'lowermedia_deregister_cf7style' );
//http://cci-media.petelower.com/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=3.9.3

add_action( 'wp_print_scripts', 'lowermedia_deregister_javascript', 100 );

function lowermedia_deregister_javascript() {
    wp_deregister_script( 'contact-form-7' );
}


/*
#
#   CONTACT FORM  FUNCTION
#
*/

//$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//$tokens = explode('/', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
// $page_slug = $tokens[sizeof(explode('/', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']))-2];

// if ($page_slug=='') {
    
//     }

/** changing default wordpres email settings */
 
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
 
function new_mail_from($old) {
 return 'pete@europeanmotorsservicecenter.petelower.com';
}
function new_mail_from_name($old) {
 return 'European Motors Service Center';
}

/*
#
#   ADD PRODUCTS CONTENT TYPE (CUSTOM POST TYPE)
#
*/

// function products_custom_init() {
//   $labels = array(
//     'name' => 'products',
//     'singular_name' => 'product',
//     'add_new' => 'Add product',
//     'add_new_item' => 'Add New product',
//     'edit_item' => 'Edit product',
//     'new_item' => 'New product',
//     'all_items' => 'All products',
//     'view_item' => 'View product',
//     'search_items' => 'Search products',
//     'not_found' =>  'No products found',
//     'not_found_in_trash' => 'No products found in Trash', 
//     'parent_item_colon' => '',
//     'menu_name' => 'products'
//   );

//   $args = array(
//     'labels' => $labels,
//     'description'   => 'Canna Delivery product',
//     'menu_position' => 1,
//     'public' => true,
//     'publicly_queryable' => true,
//     'show_ui' => true, 
//     'show_in_menu' => true, 
//     'query_var' => true,
//     'rewrite' => array( 'slug' => 'canna-delivery-products' ),
//     'capability_type' => 'post',
//     'has_archive' => true, 
//     'hierarchical' => false,
//     'menu_position' => null,
//     'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
//     'taxonomies' => array('category', 'post_tag')
//   ); 

//   register_post_type( 'products', $args );
// }
// add_action( 'init', 'products_custom_init' );

/*
#
#   WHITE LABEL
#
*/

//* Replace WordPress login logo with your own
add_action('login_head', 'lm_custom_login_logo');
function lm_custom_login_logo() {
    echo '<style type="text/css">
    h1 a 
    { 
        background-image:url('.get_stylesheet_directory_uri().'/images/login.png) !important; 
        background-size: 311px 100px !important;
        height: 100px !important; 
        width: 311px !important; 
        margin-bottom: 0 !important; 
        padding-bottom: 0 !important; 
    }
    .login form { margin-top: 10px !important; }
    </style>';
}

//* Change the URL of the WordPress login logo
function lm_url_login_logo(){
    return get_bloginfo( 'wpurl' );
}
add_filter('login_headerurl', 'lm_url_login_logo');

//* Login Screen: Change login logo hover text
function lm_login_logo_url_title() {
  return 'A LowerMedia Site';
}
add_filter( 'login_headertitle', 'lm_login_logo_url_title' );

//* Login Screen: Don't inform user which piece of credential was incorrect
function lm_failed_login () {
  return 'The login information you have entered is incorrect. Please try again.';
}
add_filter ( 'login_errors', 'lm_failed_login' );

//* Modify the admin footer text
function lm_modify_footer_admin () {
  echo '<span id="footer-meta"><a href="http://lowermedia.net" target="_blank">A LowerMedia Site</a></span>';
}
add_filter('admin_footer_text', 'lm_modify_footer_admin');

//* Add theme info box into WordPress Dashboard
function lm_add_dashboard_widgets() {
  wp_add_dashboard_widget('wp_dashboard_widget', 'Theme Details', 'lm_theme_info');
}
add_action('wp_dashboard_setup', 'lm_add_dashboard_widgets' );
 
function lm_theme_info() {
  echo "<ul>
  <li><strong>Developed By:</strong> LowerMedia.Net</li>
  <li><strong>Website:</strong> <a href='http://lowermedia.net'>www.lowermedia.net</a></li>
  <li><strong>Contact:</strong> <a href='mailto:pete.lower@gmail.com'>pete.lower@gmail.com</a></li>
  </ul>";
}

function custom_admin_logo() {
    echo '
        <style type="text/css">
            #wp-admin-bar-wp-logo { display:none !important; }
        </style>
    ';
}
add_action('admin_head', 'custom_admin_logo');


/*
#
#   ENABLE SHORTCODE IN WIDGETS
#
*/

add_filter('widget_text', 'do_shortcode');
/*
#
#   REGISTER JS
#
*/

function lowermedia_scripts() {
    // wp_enqueue_script(
    //     'continent-map',
    //     get_stylesheet_directory_uri() . '/continentmap.js',
    //     array( 'jquery' )
    // );
    //     wp_enqueue_script(
    //     'map-data',
    //     get_stylesheet_directory_uri() . '/mapdata.js',
    //     array( 'jquery' )
    // );

    wp_enqueue_script(
        'custom-js',
        get_stylesheet_directory_uri() . '/custom.js',
        array( 'jquery' )
    );
}

add_action( 'wp_enqueue_scripts', 'lowermedia_scripts' );

function lowermedia_enqueue_parent_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'lowermedia_enqueue_parent_style' );

/*
#
#   Make Archives.php Include Custom Post Types
#   http://css-tricks.com/snippets/wordpress/make-archives-php-include-custom-post-types/
#
*/

function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'products'
        ));
      return $query;
    }
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

// Define what post types to search
function searchAll( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array( 'post', 'page', 'feed', 'products', 'people'));
    }
    return $query;
}

// The hook needed to search ALL content
add_filter( 'the_search_query', 'searchAll' );

function format_phonenumber( $arg ) {
    $data = '+'.$arg;
    if(  preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $data,  $matches ) )
    {
        $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
        return $result;
    }

}

// Add [phonenumber] shortcode
function phonenumber_shortcode( $atts ){
    //retrieve phone number from database
    $lm_array = get_option('lowermedia_phone_number');

    //check if user is on mobile if so make the number a link
    if (wp_is_mobile())
    {
        return '<a href="tel:+'.$lm_array["id_number"].'">'.format_phonenumber($lm_array["id_number"]).'</a>';
    } else {
        return format_phonenumber($lm_array["id_number"]);
    }
}
add_shortcode( 'phonenumber', 'phonenumber_shortcode' );


    


// Add [facebookreviews] shortcode
function facebookreviews_shortcode( $atts ){

    $url=$_POST['https://www.facebook.com/europeanmotors.wa?sk=reviews'];
    if($url!=""){
        echo file_get_contents($url);
    }

    // //retrieve phone number from database
    // $lm_array = get_option('lowermedia_phone_number');

    // //check if user is on mobile if so make the number a link
    // if (wp_is_mobile())
    // {
    //     return '<a href="tel:+'.$lm_array["id_number"].'">'.format_phonenumber($lm_array["id_number"]).'</a>';
    // } else {
    //     return format_phonenumber($lm_array["id_number"]);
    // }
}
add_shortcode( 'facebookreviews', 'facebookreviews_shortcode' );


class lowermedia_phonenumber_settings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Phone Number', 
            'manage_options', 
            'lowermedia-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'lowermedia_phone_number' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Canna Delivery Hotline</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'lowermedia_phone_options' );   
                do_settings_sections( 'lowermedia-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'lowermedia_phone_options', // Option group
            'lowermedia_phone_number', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'lowermedia-setting-admin' // Page
        );  

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'lowermedia-setting-admin', // Page
            'setting_section_id' // Section           
        );      
   
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="lowermedia_phone_number[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }

}

if( is_admin() ) {$lowermedia_phonenumber_settings = new lowermedia_phonenumber_settings();}


