<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/dinab881
 * @since      1.0.0
 *
 * @package    Houstonapps
 * @subpackage Houstonapps/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Houstonapps
 * @subpackage Houstonapps/admin
 * @author     Dina <dina881@gmail.com>
 */
require_once('partials/custom-widgets.php');
class Houstonapps_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Houstonapps_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Houstonapps_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/houstonapps-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Houstonapps_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Houstonapps_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/houstonapps-admin.js', array( 'jquery' ), $this->version, false );

	}


	public function page_metabox() {

		add_meta_box(
			'metabox_id',
			__( 'Add here your h1 header if it contains html  and h2 subheader', $this->plugin_name ),
			array( $this, 'page_metabox_callback' ),
			'page',
			'normal',
			'high'
		);


	}

	public function process_metabox() {

		add_meta_box(
			'process_metabox_id',
			__( 'Add here class for icon', $this->plugin_name ),
			array( $this, 'process_metabox_callback' ),
			'process',
			'normal',
			'high'
		);


	}

	public function page_metabox_callback($post) {

		//retrieve the metadata values if they exist
		$heading1 = get_post_meta( $post->ID, $this->plugin_name.'_heading1', true );
		$heading2 = get_post_meta( $post->ID, $this->plugin_name.'_heading2', true );


		_e('Please fill out the information below', $this->plugin_name);
		?>
		<div>
			<p><?php _e( 'h1 header with html', $this->plugin_name );?>:</p>
			<textarea class="widefat" name="<?php echo $this->plugin_name; ?>_heading1"><?php echo esc_textarea( $heading1 ); ?> </textarea>
		</div>

		<div>
			<p><?php _e( 'h2 subheader', $this->plugin_name );?>:</p>
			<textarea class="widefat" name="<?php echo $this->plugin_name; ?>_heading2"  ><?php echo esc_textarea( $heading2 ); ?></textarea>
		</div>
		<?php

	}

	public function process_metabox_callback($post) {

		//retrieve the metadata values if they exist
		$process_icon_class = get_post_meta( $post->ID, $this->plugin_name.'_process_icon', true );

		?>
		<div>
			<p><?php _e( 'Process icon class', $this->plugin_name );?>:</p>
			<input name="<?php echo $this->plugin_name; ?>_process_icon" value="<?php echo esc_attr( $process_icon_class ); ?>"/>
		</div>

		<?php

	}






	public function page_metabox_save($post_id) {

		$slug = 'page';
		$valid_data = array();



		// If this isn't a 'page' post, don't update it.
		/*if ( $slug != $post->post_type ) {
			return;
		}*/

		// - Update the post's metadata.
		if ( isset( $_POST[$this->plugin_name.'_heading1'] ) && !empty($_POST[$this->plugin_name.'_heading1']) ) {

			$valid_data['heading1'] = wp_kses($_POST[$this->plugin_name.'_heading1'], array(
				'strong' => array(),
				'a' => array('href')
			) );
			update_post_meta( $post_id, $this->plugin_name.'_heading1',$valid_data['heading1']);
		}

		if ( isset( $_POST[$this->plugin_name.'_heading2'] ) && !empty($_POST[$this->plugin_name.'_heading2']) ) {

			$valid_data['heading2'] = wp_kses($_POST[$this->plugin_name.'_heading2'], array(
				'strong' => array(),
				'a' => array('href')
			) );
			update_post_meta( $post_id, $this->plugin_name.'_heading2',  $valid_data['heading2'] );
		}

	}

	public function process_metabox_save($post_id) {

		$slug = 'page';
		$valid_data = array();



		// If this isn't a 'page' post, don't update it.
		/*if ( $slug != $post->post_type ) {
			return;
		}*/

		// - Update the post's metadata.
		if ( isset( $_POST[$this->plugin_name.'_process_icon'] ) && !empty($_POST[$this->plugin_name.'_process_icon']) ) {

			$valid_data['class_icon'] = sanitize_text_field($_POST[$this->plugin_name.'_process_icon']);
			update_post_meta( $post_id, $this->plugin_name.'_process_icon',$valid_data['class_icon']);
		}

	}


	public function add_custom_post_types() {

		/* Team post type*/
		$labels = array(
			'name' => __( 'Team', $this->plugin_name ),
			'singular_name' => __( 'Team member', $this->plugin_name ),
			'add_new' => __( 'Add new', $this->plugin_name ),
			'add_new_item' => __( 'Add new team member', $this->plugin_name ),
			'edit_item' => __( 'Edit team member', $this->plugin_name ),
			'new_item' => __( 'New member', $this->plugin_name ),
			'view_item' => __( 'View team member', $this->plugin_name ),
			'search_items' => __( 'Find team member', $this->plugin_name ),
			'not_found' =>  __( 'No team members found', $this->plugin_name ),
			'not_found_in_trash' =>  __( 'No team members found in Trash', $this->plugin_name ),
			'parent_item_colon' => '',
			'menu_name' => __( 'Team', $this->plugin_name )

		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail','post-formats')
		);
		register_post_type('team',$args);




		/* Working process */
		$labels = array(
			'name' => __( 'Process items', $this->plugin_name ),
			'singular_name' => __( 'Process item', $this->plugin_name ),
			'add_new' => __( 'Add new', $this->plugin_name ),
			'add_new_item' => __( 'Add new process item', $this->plugin_name ),
			'edit_item' => __( 'Edit process item', $this->plugin_name ),
			'new_item' => __( 'New process item', $this->plugin_name ),
			'view_item' => __( 'View process item', $this->plugin_name ),
			'search_items' => __( 'Find process item', $this->plugin_name ),
			'not_found' =>  __( 'No process items found', $this->plugin_name ),
			'not_found_in_trash' =>  __( 'No process items found in Trash', $this->plugin_name ),
			'parent_item_colon' => '',
			'menu_name' => __( 'Process items', $this->plugin_name )

		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor')
		);
		register_post_type('process',$args);




		/* Technologies */
		$labels = array(
			'name' => __( 'Technologies', $this->plugin_name ),
			'singular_name' => __( 'Technology', $this->plugin_name ),
			'add_new' => __( 'Add new', $this->plugin_name ),
			'add_new_item' => __( 'Add new technology', $this->plugin_name ),
			'edit_item' => __( 'Edit technology', $this->plugin_name ),
			'new_item' => __( 'New technology', $this->plugin_name ),
			'view_item' => __( 'View technology', $this->plugin_name ),
			'search_items' => __( 'Find technology', $this->plugin_name ),
			'not_found' =>  __( 'No technologies found', $this->plugin_name ),
			'not_found_in_trash' =>  __( 'No technologies found in Trash', $this->plugin_name ),
			'parent_item_colon' => '',
			'menu_name' => __( 'Technologies', $this->plugin_name )

		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor')
		);
		register_post_type('technologies',$args);


		/* Contacts */
		$labels = array(
			'name' => __( 'Contacts', $this->plugin_name ),
			'singular_name' => __( 'Contacts item', $this->plugin_name ),
			'add_new' => __( 'Add new', $this->plugin_name ),
			'add_new_item' => __( 'Add new contacts item', $this->plugin_name ),
			'edit_item' => __( 'Edit contacts item', $this->plugin_name ),
			'new_item' => __( 'New contacts item', $this->plugin_name ),
			'view_item' => __( 'View contacts item', $this->plugin_name ),
			'search_items' => __( 'Find contacts item', $this->plugin_name ),
			'not_found' =>  __( 'No contacts items found', $this->plugin_name ),
			'not_found_in_trash' =>  __( 'No contacts items found in Trash', $this->plugin_name ),
			'parent_item_colon' => '',
			'menu_name' => __( 'Contacts', $this->plugin_name )

		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor')
		);
		register_post_type('contacts',$args);



	}

	public function add_custom_widgets(){



		register_widget('Team_Widget');
	}


}
