<?php

/**
 * Custom Post Types, on the fly creation
 *
 **/

function lm_custom_post_type_creator($post_type_name, $description, $public, $menu_position, $supports, $has_archive, $irreg_plural) {
  if ($irreg_plural) {$plural = 's';} else {$plural = '';}
  $labels = array(
    'name'               => _x( $post_type_name, 'post type general name' ),
    'singular_name'      => _x( strtolower($post_type_name), 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New '.$post_type_name),
    'edit_item'          => __( 'Edit '.$post_type_name ),
    'new_item'           => __( 'New '.$post_type_name ),
    'all_items'          => __( 'All '.$post_type_name.$plural ),
    'view_item'          => __( 'View '.$post_type_name ),
    'search_items'       => __( 'Search'.$post_type_name.$plural ),
    'not_found'          => __( 'No '.$post_type_name.$plural.' found' ),
    'not_found_in_trash' => __( 'No '.$post_type_name.$plural.' found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => $post_type_name
  );
  $args = array(
    'labels'        => $labels,
    'description'   => $description,
    'public'        => $public,
    'menu_position' => $menu_position,
    'supports'      => $supports,
    'has_archive'   => $has_archive,
  );
  register_post_type( $post_type_name, $args ); 
}
add_action( 'init', lm_custom_post_type_creator('Testimonials', 'Holds our testimonials', true, 4, array( 'title', 'editor', 'thumbnail' ), true, false));
add_action( 'init', lm_custom_post_type_creator('Staff', 'Holds our staff specific data', true, 5, array( 'title', 'editor', 'thumbnail' ), true, false));
add_action( 'init', lm_custom_post_type_creator('Car Care Tips', 'Holds our car care tips.', true, 6, array( 'title', 'editor', 'thumbnail', 'excerpt' ), true, false));
add_action( 'init', lm_custom_post_type_creator('Car Care Videos', 'Holds our car care videos.', true, 7, array( 'title', 'editor', 'thumbnail' ), true, false));

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function lm_add_meta_box() {
    add_meta_box(
        'lm_staff_position',
        __( 'Staff Position', 'lm_textdomain' ),
        'lm_meta_box_callback',
        'staff',//$screen
        'side',
        'high'
    );

    add_meta_box(
        'lm_testimonials_source',
        __( 'Testimonial Source', 'lm_textdomain' ),
        'lm_meta_box_callback',
        'testimonials',//$screen
        'side',
        'high'
    );

    // add_meta_box(
    //     'lm_testimonial_source',
    //     __( 'Testimonial Source', 'myplugin_textdomain' ),
    //     'myplugin_meta_box2_callback',
    //     'testimonials',//$screen
    //     'side',
    //     'high'
    // );  
}
add_action( 'add_meta_boxes', 'lm_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function lm_meta_box_callback( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'lm_meta_box', 'lm_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, '_lm_meta_value_key', true );

    echo '<label for="lm_new_field">';
    _e( '', 'lm_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="lm_new_field" name="lm_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function lm_save_meta_box_data( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['lm_meta_box_nonce'] ) ) { return; }
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['lm_meta_box_nonce'], 'lm_meta_box' ) ) { return; }
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) { if ( ! current_user_can( 'edit_page', $post_id ) ) { return; }
    } else { if ( ! current_user_can( 'edit_post', $post_id ) ) { return; } }

    /* OK, it's safe for us to save the data now. */
    // Make sure that it is set.
    if ( ! isset( $_POST['lm_new_field'] ) ) { return;  }
    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['lm_new_field'] );
    // Update the meta field in the database.
    update_post_meta( $post_id, '_lm_meta_value_key', $my_data );
}
add_action( 'save_post', 'lm_save_meta_box_data' );

/**
 * Add categories and tags to media
 * - apply categories to attachments
 *
 **/

function lm_add_cat_tag_to_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'lm_add_cat_tag_to_attachments' );

/**
 * Randomize menu items function
 * - used for AutoBrands menu
 *
 **/

function randMenu ($menuName, $numItemsReturnedPlusOne) {
    $autoBrandsMenu = wp_nav_menu( array( 'theme_location' => $menuName, 'echo' => false, 'before' => '--' ) );

    //randomize and output 5 menu items
    //ADD MENU TO VAR, DISABLE ECHO AS TO NOT ECHO THE MENU IMMEDIATLY
    // $autoBrandsMenu = wp_nav_menu( array( 'theme_location' => $menuName, 'echo' => false, 'before' => '--' ) );
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
 * Get menu and reset post query
 * - used primarily for archive menus
 *
 **/

function getMainMenu($menulocation, $echo = true, $container = 'div'){
    $locations = get_nav_menu_locations();
    $menuItems = wp_get_nav_menu_items( $locations[ $menulocation ] );

    if(empty($menuItems)) {
        return false;
    } else {
        wp_nav_menu(array('theme_location' => $menulocation,'echo' => $echo, 'container' => $container));
        return true;
    }
}
/**
 * Register Sidebars/Widget Areas.
 *
 **/

function lowermedia_widgets_init() {

    register_sidebar( array(
        'name' => 'Pre Content Widget Area',
        'id' => 'pre-content-widget',
        'before_widget' => '<div id="pre-content-widget" class="pre-content-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );

    register_sidebar( array(
        'name' => 'Post Content Widget Area',
        'id' => 'post-content-widget',
        'before_widget' => '<div id="post-content-widget" class="post-content-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );

    register_sidebar( array(
        'name' => 'Footer Column One',
        'id' => 'footer_column_one',
        'before_widget' => '<div class="footer-column-one-widget footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );
    register_sidebar( array(
        'name' => 'Footer Column Two',
        'id' => 'footer_column_two',
        'before_widget' => '<div class="footer-column-two-widget footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );
    register_sidebar( array(
        'name' => 'Footer Column Three',
        'id' => 'footer_column_three',
        'before_widget' => '<div class="footer-column-three-widget footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );
    register_sidebar( array(
        'name' => 'Footer Column Four',
        'id' => 'footer_column_four',
        'before_widget' => '<div class="footer-column-four-widget footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'lowermedia_widgets_init' );

/**
 * Register Menus
 *
 **/

function lowermedia_menus_init() {
  register_nav_menus(
    array(
      'auto-brands-menu' => __( 'Auto Brands Menu' ),
      'mobile-menu-left' => __( 'Mobile Menu Left' ),
      'mobile-menu-right' => __( 'Mobile Menu Right' ),
      'mini-mobile-menu' => __( 'Mini Mobile Menu' )
    )
  );
}
add_action( 'init', 'lowermedia_menus_init' );

/*
#
#   SPEED OPTIMIZATIONS
#   -Load all fonts from google
#   -remove contact form 7 styles and scripts
#
*/

function load_fonts() {
    wp_dequeue_style( 'twentytwelve-fonts' );
    wp_deregister_style( 'twentytwelve-fonts' );
    wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Signika:400,700|Open+Sans:400italic,700italic,400,700&amp;subset=latin,latin-ext');
    wp_enqueue_style( 'googleFonts');
}
add_action('wp_print_styles', 'load_fonts');

/*
#
#   CONTACT FORM  FUNCTION
#   - changing default WordPress email settings
*/

function new_mail_from($old) { return 'europeanmotorsservicecenter@gmail.com'; }
add_filter('wp_mail_from', 'new_mail_from');

function new_mail_from_name($old) { return 'European Motors Service Center'; }
add_filter('wp_mail_from_name', 'new_mail_from_name');

/*
#
#   WHITE LABEL
#
*/

function lm_custom_admin_styles() {
   echo '<style type="text/css">
       /* Styles here! */
        body {font-family: futura;}

       /*change sidebar icon for testimonials, staff, tips, videos */
        #menu-posts-testimonials .dashicons-admin-post:before,
        #menu-posts-testimonials .dashicons-format-standard:before { content:"\f155"; }

        #menu-posts-staff .dashicons-admin-post:before,
        #menu-posts-staff .dashicons-format-standard:before { content:"\f307"; }

        #menu-posts-carcarevideos .dashicons-admin-post:before,
        #menu-posts-carcarevideos .dashicons-format-standard:before { content:"\f126"; }

        #menu-posts-carcaretips .dashicons-admin-post:before,
        #menu-posts-carcaretips .dashicons-format-standard:before { content:"\f339"; }

       
       /*change admin menu coloring*/ 
        #adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap { background-color: #043789; }

        #adminmenu .wp-submenu a {color: rgba(249,190,25,0.6);}

        #adminmenu .opensub .wp-submenu li.current a,
        #adminmenu .wp-submenu li.current, 
        #adminmenu .wp-submenu li.current a, 
        #adminmenu .wp-submenu li.current a:focus, 
        #adminmenu .wp-submenu li.current a:hover, 
        #adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a { color: rgba(249,190,25,1); }

        #adminmenu li.menu-top:hover,
        #adminmenu li.opensub>a.menu-top, 
        #adminmenu li>a.menu-top:focus { background: linear-gradient(to bottom,#f9f9f9 37%,#c9c9c9 100%); }
     </style>';
}
add_action('admin_head', 'lm_custom_admin_styles');

//* Replace WordPress login logo with your own
function lm_custom_login_logo() {
    echo '<style type="text/css">
    h1 a 
    { 
        background-image:url('.get_stylesheet_directory_uri().'/img/login.png) !important; 
        background-size: 211px auto !important;
        height: 200px !important;
        width: 311px !important; 
        margin-bottom: 0 !important; 
        padding-bottom: 0 !important; 
    }
    .login form { margin-top: 10px !important; border: 1px solid #f9be19; }
    .login {background:#043789;}
    </style>';
}
add_action('login_head', 'lm_custom_login_logo');

//* Change the URL of the WordPress login logo
function lm_url_login_logo(){ return get_bloginfo( 'wpurl' ); }
add_filter('login_headerurl', 'lm_url_login_logo');

//* Login Screen: Change login logo hover text
function lm_login_logo_url_title() { return 'A LowerMedia Site'; }
add_filter( 'login_headertitle', 'lm_login_logo_url_title' );

//* Login Screen: Don't inform user which piece of credential was incorrect
function lm_failed_login () { return 'The login information you have entered is incorrect. Please try again.'; }
add_filter ( 'login_errors', 'lm_failed_login' );

//* Modify the admin footer text
function lm_modify_footer_admin () { echo '<span id="footer-meta"><a href="http://lowermedia.net" target="_blank">A LowerMedia Site</a></span>'; }
add_filter('admin_footer_text', 'lm_modify_footer_admin');

//* Add theme info box into WordPress Dashboard
function lm_add_dashboard_widgets() { wp_add_dashboard_widget('wp_dashboard_widget', 'Theme Details', 'lm_theme_info'); }
add_action('wp_dashboard_setup', 'lm_add_dashboard_widgets' );

/*
#   Create widget info for above function: lm_add_dashboard_widgets
*/
function lm_theme_info() {
  echo "
      <ul>
      <li><strong>Developed By:</strong> LowerMedia.Net</li>
      <li><strong>Website:</strong> <a href='http://lowermedia.net'>www.lowermedia.net</a></li>
      <li><strong>Contact:</strong> <a href='mailto:pete.lower@gmail.com'>pete.lower@gmail.com</a></li>
      </ul>"
  ;
}

/*
#   Add custom admin login logo
*/
function custom_admin_logo() {
    echo '
        <style type="text/css">
            #wp-admin-bar-wp-logo { display:none !important; }
        </style>
    ';
}
add_action('admin_head', 'custom_admin_logo');

/*
#   Move admin bar to the bottom on front end
*/
if(current_user_can( 'edit_posts' )) {
    if(!is_admin()) {
        function lm_admin_bar_bottom() {
            echo '
                <style type="text/css">

                    html {
                        margin-top: 28px !important;
                    }

                    .admin-bar {
                        margin-top: -28px;
                        padding-bottom: 28px;
                    }

                    #wpadminbar {
                        top: auto !important;
                        bottom: 0;
                    }

                    #wpadminbar .quicklinks>ul>li { position: relative; }

                    #wpadminbar .ab-top-menu>.menupop>.ab-sub-wrapper { bottom: 28px; }

                    #wp-admin-bar-wp-logo { display: none; }
                </style>'
            ;
        }
        add_action('wp_head', 'lm_admin_bar_bottom');

        function my_filter_head() {
            remove_action('wp_head', '_admin_bar_bump_cb');
        }
        add_action('get_header', 'my_filter_head');
    }
}

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
    wp_enqueue_script(
        'custom-js',
        get_stylesheet_directory_uri() . '/custom.js',
        array( 'jquery' )
    );

    if (is_front_page()) {
        wp_enqueue_script(
            'jssor',
            get_stylesheet_directory_uri() . '/js/jssor.js',
            array( 'jquery' )
        );

        wp_enqueue_script(
            'jssorslider',
            get_stylesheet_directory_uri() . '/js/jssor.slider.js',
            array( 'jquery' )
        );
    }

    wp_enqueue_script('jquery-ui-accordion');
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
add_filter( 'the_search_query', 'searchAll' );
// The hook needed to search ALL content


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
            <h2>Phone Number</h2>           
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
