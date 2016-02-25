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


		add_meta_box(
			'metabox_id',
			__( 'Add here your h1 header if it contains html  and h2 subheader', $this->plugin_name ),
			array( $this, 'metabox_callback' ),
			'page',
			'normal',
			'high'
		);


	}

	public function metabox_callback($post) {

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


		//retrieve the metadata values if they exist
		$heading1 = get_post_meta( $post->ID, $this->plugin_name.'_heading1', true );
		$heading2 = get_post_meta( $post->ID, $this->plugin_name.'_heading2', true );


		_e('Please fill out the information below', $this->plugin_name);
		?>
		<div><p><?php _e( 'h1 header with html', $this->plugin_name );?>:</p> <textarea name="<?php echo $this->plugin_name; ?>_heading1"><?php echo esc_textarea( $heading1 ); ?> </textarea></div>
		<div><p><?php _e( 'h2 subheader', $this->plugin_name );?>:</p> <textarea name="<?php echo $this->plugin_name; ?>_heading2"  ><?php echo esc_textarea( $heading2 ); ?></textarea> </div>
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

}
