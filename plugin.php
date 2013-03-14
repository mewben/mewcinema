<?php
/*
Plugin Name: Mew Cinema
Plugin URI: http://melvinsoldia.info
Description: A plugin for movie theatre scheduling
Version: 1.0
Author: Melvin Soldia
Author URI: http://melvinsoldia.info
Author Email: melvinsoldia@outlook.com
License:

  Copyright 2013 GPL (melvinsoldia@outlook.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

// TODO: rename this class to a proper name for your plugin
class MewCinema {
	 
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
		
		// Load plugin text domain
		add_action( 'init', array( $this, 'plugin_textdomain' ) );

		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
	
		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );
	
		// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		//register_uninstall_hook( __FILE__, array( $this, 'uninstall' ) );
		register_uninstall_hook( __FILE__, 'uninstall' );
		
	    /*
	     * TODO:
	     * Define the custom functionality for your plugin. The first parameter of the
	     * add_action/add_filter calls are the hooks into which your code should fire.
	     *
	     * The second parameter is the function name located within this class. See the stubs
	     * later in the file.
	     *
	     * For more information: 
	     * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
	     */
	    //add_action( 'TODO', array( $this, 'action_method_name' ) );
	    //add_filter( 'TODO', array( $this, 'filter_method_name' ) );
	    add_action('init', array( $this, 'plugin_init' ) );

	} // end constructor
	
	/**
	 * Fired when the plugin is activated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	public function activate( $network_wide ) {
		// TODO:	Define activation functionality here
	} // end activate
	
	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	public function deactivate( $network_wide ) {
		// TODO:	Define deactivation functionality here		
	} // end deactivate
	
	/**
	 * Fired when the plugin is uninstalled.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	public function uninstall( $network_wide ) {
		// TODO:	Define uninstall functionality here		
	} // end uninstall

	/**
	 * Loads the plugin text domain for translation
	 */
	public function plugin_textdomain() {
	
		// TODO: replace "plugin-name-locale" with a unique value for your plugin
		$domain = 'mewcinema-locale';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
        load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
        load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

	} // end plugin_textdomain

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {
	
		// TODO:	Change 'plugin-name' to the name of your plugin
		wp_enqueue_style( 'mewcinema-admin-styles', plugins_url( 'mewcinema/css/admin.css' ) );
	
	} // end register_admin_styles

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */	
	public function register_admin_scripts() {
	
		// TODO:	Change 'plugin-name' to the name of your plugin
		wp_enqueue_script( 'mewcinema-admin-script', plugins_url( 'mewcinema/js/admin.js' ) );
	
	} // end register_admin_scripts
	
	/**
	 * Registers and enqueues plugin-specific styles.
	 */
	public function register_plugin_styles() {
	
		// TODO:	Change 'plugin-name' to the name of your plugin
		wp_enqueue_style( 'mewcinema-flexslider-styles', plugins_url( 'mewcinema/vendor/flexslider/flexslider.css' ) );
		wp_enqueue_style( 'mewcinema-plugin-styles', plugins_url( 'mewcinema/css/display.css' ) );
	
	} // end register_plugin_styles
	
	/**
	 * Registers and enqueues plugin-specific scripts.
	 */
	public function register_plugin_scripts() {
	
		// TODO:	Change 'plugin-name' to the name of your plugin
		wp_enqueue_script( 'mewcinema-flexslider-script', plugins_url( 'mewcinema/vendor/flexslider/jquery.flexslider-min.js' ), array( 'jquery' ), '20120206', true );
		wp_enqueue_script( 'mewcinema-plugin-script', plugins_url( 'mewcinema/js/display.js' ) );

	
	} // end register_plugin_scripts
	
	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/
	
	/**
 	 * NOTE:  Actions are points in the execution of a page or process
	 *        lifecycle that WordPress fires.
	 *
	 *		  WordPress Actions: http://codex.wordpress.org/Plugin_API#Actions
	 *		  Action Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 */
	function action_method_name() {
    	// TODO:	Define your action method here
	} // end action_method_name
	
	/**
	 * NOTE:  Filters are points of execution in which WordPress modifies data
	 *        before saving it or sending it to the browser.
	 *
	 *		  WordPress Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *		  Filter Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 */
	function filter_method_name() {
	    // TODO:	Define your filter method here
	} // end filter_method_name

	function plugin_init() {
		// register post type
		self::register_post_types();

		// remove cinema metabox
		//add_action('admin_menu', array($this, 'remove_metaboxes'));

		// create and register taxonomies
		self::create_taxonomies();

		// metabox
		add_action( 'add_meta_boxes', array($this, 'add_metaboxes') );

		

		// save metabox on post save
		add_action('save_post', array($this, 'save_metaboxes'));
		// thumbnail support and size
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'movie-thumbnail', 220 , 330 , true );
		
	}


	/**
	 * User Defined Functions
	 */
	function register_post_types() {
		// movies
		$labels = array(
			'name' => 'Movies',
			'singular_name' => 'Movie',
			'add_new' => 'Add New Movie',
			'add_new_item' => 'Add New Movie',
			'edit_item' => 'Edit Movie',
			'new_item' => 'New Movie',
			'view_item' => 'View Movie',
			'search_items' => 'Search Movies',
			'not_found' =>  'No Movies found',
			'not_found_in_trash' => 'No Movies found in Trash',
			'parent_item_colon' => ''
		);

	 	$args = array(
	     	'labels' => $labels,
	     	'singular_label' => __('Movie', 'mewcinema'),
	     	'public' => true,
		  	'capability_type' => 'post',
	     	'rewrite' => true,
	     	'supports' => array('title', 'editor', 'thumbnail'),
	     );
	 	register_post_type('mewcinema', $args);

	 	flush_rewrite_rules();
	}

	function create_taxonomies()
	{
		$taxonomies = array();

		$taxonomies['cinema'] = array(
			'query_var' => 'movie_cinema',
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'movies/cinema'
			),
			'labels' => array(
				'name' => 'Cinemas',
				'singular_name' => 'Cinema',
				'edit_item' => 'Edit Cinema',
				'update_item' => 'Update Cinema',
				'add_new_item' => 'Add Cinema',
				'new_item_name' => 'Add New Cinema',
				'all_items' => 'All Cinemas',
				'search_items' => 'Search Cinemas',
				'popular_items' => 'Popular Cinemas',
				'separate_items_with_commas' => 'Separate cinemas with commas',
				'add_or_remove_items' => 'Add or remove cinemas',
				'choose_from_most_used' => 'Choose from most used cinemas',
			)
		);
		$taxonomies['genre'] = array(
			'query_var' => 'movie_genre',
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'movies/genre'
			),
			'labels' => array(
				'name' => 'Genre',
				'singular_name' => 'Genre',
				'edit_item' => 'Edit Genre',
				'update_item' => 'Update Genre',
				'add_new_item' => 'Add Genre',
				'new_item_name' => 'Add New Genre',
				'all_items' => 'All Genre',
				'search_items' => 'Search Genre',
				'popular_items' => 'Popular Genre',
				'separate_items_with_commas' => 'Separate genre with commas',
				'add_or_remove_items' => 'Add or remove genre',
				'choose_from_most_used' => 'Choose from most used genre',
			)
		);
		$taxonomies['rating'] = array(
			'query_var' => 'movie_rating',
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'movies/rating'
			),
			'labels' => array(
				'name' => 'Rating',
				'singular_name' => 'Rating',
				'edit_item' => 'Edit Rating',
				'update_item' => 'Update Rating',
				'add_new_item' => 'Add Rating',
				'new_item_name' => 'Add New Rating',
				'all_items' => 'All Rating',
				'search_items' => 'Search Rating',
				'popular_items' => 'Popular Rating',
				'separate_items_with_commas' => 'Separate rating with commas',
				'add_or_remove_items' => 'Add or remove rating',
				'choose_from_most_used' => 'Choose from most used rating',
			)
		);

		self::register_all_taxonomies($taxonomies);
	}

	function register_all_taxonomies($taxonomies)
	{
		foreach ($taxonomies as $name => $arr) {
			register_taxonomy($name, array('mewcinema'), $arr);
		}
	}

	function add_metaboxes()
	{
		// Duplicate Cinema ID
		// date sched : start-end
		// time sched
		// rating
		

		add_meta_box('movie_details', 'Movie Details', 'movie_details_mb', 'mewcinema', 'normal');


		function movie_details_mb($post)
		{
			$meta = get_post_meta($post->ID);
			extract($meta);
			wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
			?>

			<table>
				<tr>
					<td width="30%" valign="top"><label for="movie_duplicate_id">Is this a duplicate movie? Enter the ID of the original movie post: </label>
					</td>
					<td><input type="text" name="movie_duplicate_id" id="movie_duplicate_id" value="<?php echo isset($movie_duplicate_id[0]) ? esc_attr($movie_duplicate_id[0]) : '';?>" />
						<p><em>Note: The content you placed above will be overriden by the content of the original movie post.</em></p>
					</td>
				</tr>
				<tr>
					<td><label>Start Date: <em>yyyy-mm-dd</em></label>
					</td>
					<td><input type="text" name="start_date" value="<?php echo isset($start_date[0]) ? esc_attr($start_date[0]) : ''?>" />
					</td>
				</tr>		
				<tr>
					<td><label>End Date: <em>yyyy-mm-dd</em></label>
					</td>
					<td><input type="text" name="end_date" value="<?php echo isset($end_date[0]) ? esc_attr($end_date[0]) : ''?>" />
					</td>
				</tr>	
				<tr>
					<td><label>Screening Time</label>
					</td>
					<td><input type="text" name="time" value="<?php echo isset($time[0]) ? esc_attr($time[0]) : ''?>"  />
					</td>
				</tr>
			</table>
			<?php
		}
	}

	function save_metaboxes($id)
	{
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return; 

    	if (isset($_POST['movie_duplicate_id'])) {
    		update_post_meta(
    			$id,
    			'movie_duplicate_id',
    			strip_tags($_POST['movie_duplicate_id'])
    		);
    	}

    	if (isset($_POST['start_date'])) {
    		update_post_meta(
    			$id,
    			'start_date',
    			strip_tags($_POST['start_date'])
    		);
    	}

    	if (isset($_POST['end_date'])) {
    		update_post_meta(
    			$id,
    			'end_date',
    			strip_tags($_POST['end_date'])
    		);
    	}

    	if (isset($_POST['time'])) {
    		update_post_meta(
    			$id,
    			'time',
    			strip_tags($_POST['time'])
    		);
    	}
	}

	function remove_metaboxes()
	{
		// taxonomy_slug.div for custom taxonomy
		remove_meta_box('cinemadiv', 'mewcinema', 'side');
	}
} // end class

// TODO:	Update the instantiation call of your plugin to the name given at the class definition

include_once(dirname(__FILE__) . '/widgets/widget-nowshowing.php');
$mewcinema = new MewCinema();
