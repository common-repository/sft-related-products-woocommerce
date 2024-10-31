<?php
/**
 * Plugin Name: Related Products for WooCommerce
 * Description: Present related products on the product page based on your preferences.
 * Author URI:  https://www.saffiretech.com
 * Author:      SaffireTech
 * Text Domain: sft-related-products-woocommerce
 * Domain Path: /languages
 * Stable Tag : 2.0.1
 * Requires at least: 5.0
 * Tested up to: 6.6.2
 * Requires PHP: 7.2
 * WC requires at least: 4.0.0
 * WC tested up to: 9.3.3
 * License:     GPLv3
 * License URI: URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Version:     2.0.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check the installation of pro version.
 *
 * @return bool
 */
function rpwfr_check_pro_version() {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';

	if ( is_plugin_active( 'woocommerce-related-products-pro/woocommerce-related-products-pro.php' ) ) {
		return true;
	} else {
		return false;
	}
}


add_action( 'init', 'rpwfr_color_picker' );

/** The color picker utilized on the general settings page has been incorporated. */
function rpwfr_color_picker() {

	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$id_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $id_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	// Load colorpicker on the free menu setting.
	if ( 'rpwfr_menu' === ( isset( $_GET['page'] ) ? sanitize_key( $_GET['page'] ) : '' ) ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp_color_picker', plugins_url( '/assets/js/rpwfr-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), '1.0.0', true );
	}
}


add_action( 'plugins_loaded', 'rpwfr_plugin_install' );

/**
 * Display notice if pro plugin found and decativate the free version.
 */
function rpwfr_plugin_install() {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';

	// nonce verification.
	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$id_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $id_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	// if pro plugin found deactivate free plugin.
	if ( rpwfr_check_pro_version() ) {

		deactivate_plugins( plugin_basename( __FILE__ ), true ); // deactivate free plugin if pro found.

		// If pro plugin is defined deactivate it after activate is triggred.
		if ( defined( 'rpwfr_PRO_PLUGIN' ) ) {

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			// Trigger admin notice.
			add_action( 'admin_notices', 'rpwfr_install_admin_notice' );
		}
	}
}


/**
 * Add message if pro version is installed.
 */
function rpwfr_install_admin_notice() {
	?>
	<div class="notice notice-error is-dismissible">
		<p><?php esc_html_e( 'Free version deactivated Related Products Pro version Installed', 'sft-related-products-woocommerce' ); ?></p>
	</div>
	<?php
}


add_action( 'init', 'rpwfr_bulk_upsells_assets' );

/**
 * Bulk edit upsells & Cross-Sells files.
 */
function rpwfr_bulk_upsells_assets() {

	// nonce verification.
	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$id_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $id_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	// schedule event for price drop email.
	require_once plugin_dir_path( __FILE__ ) . '/library/action-scheduler/action-scheduler.php';

	// if ( 'rpwfr_bulk_setting_menu' === ( isset( $_GET['page'] ) ? sanitize_key( $_GET['page'] ) : '' ) ) {
		wp_register_script( 'rpwfr_bulk_js', plugins_url( 'assets/js/rpwfr-bulk-upsells-crosssells.js', __FILE__ ), array( 'jquery', 'jquery-ui-autocomplete' ), '2.0.2', true );
		wp_enqueue_script( 'rpwfr_bulk_js' );
		wp_localize_script(
			'rpwfr_bulk_js',
			'rpwfr_bulk_ajax_obj',
			array(
				'url'                 => admin_url( 'admin-ajax.php' ),
				'nonce'               => wp_create_nonce( 'sft-related-products-woocommerce' ),
				'rpwfr_search_msg'    => __( 'Please select a filter ( product category, tags, product name or SKU) to search your products.', 'sft-related-products-woocommerce' ),
				'rpwfr_msg_one'       => __( 'No products found on current on selected search criteria. Please change filter or search for other products.', 'sft-related-products-woocommerce' ),
				'rpwfr_msg_two'       => __( 'Please input keywords/ terms for the chosen filter for the products you wish to update', 'sft-related-products-woocommerce' ),
				'rpwfr_msg_save'      => __( 'Saving Changes...', 'sft-related-products-woocommerce' ),
				'rpwfr_msg_save_html' => __( 'This will take a few seconds.', 'sft-related-products-woocommerce' ),
				'rpwfr_msg_update'    => __( 'Products Updated Successfully!', 'sft-related-products-woocommerce' ),
				'rpwfr_msg_error'     => __( 'Some Error Occurred', 'sft-related-products-woocommerce' ),
				'rpwfr_dismiss_noti'  => __( 'Dismiss this notice.', 'sft-related-products-woocommerce' ),
				'rpwfr_pro_notice'    => __( 'Inactive. You\'ve got pro version !', 'sft-related-products-woocommerce' ),
			)
		);
	// }

	// Schedule Related AI actions.
	if ( false === as_has_scheduled_action( 'rpwfr_api_request_prompt' ) && get_option( 'rpwfr_api_request_created_status' ) === 'created' ) {

		// Schedule the action to run immediately send api prompt.
		as_schedule_single_action( time() + 1 * 60, 'rpwfr_api_request_prompt', array() );
		update_option( 'rpwfr_api_request_created_status', 'pending' );
	}

	// Select2 library.
	wp_enqueue_style( 'rpwfr_select2_css', plugins_url( '/assets/css/select2.min.css', __FILE__ ), array(), '10.0.0', false );

	// Load select2 on backend.
	if ( 'rpwfr_menu' === ( isset( $_GET['page'] ) ? sanitize_key( $_GET['page'] ) : '' ) || 'rpwfr_bulk_setting_menu' === ( isset( $_GET['page'] ) ? sanitize_key( $_GET['page'] ) : '' ) ) {
		wp_enqueue_script( 'rpwfr-select2-js', plugins_url( 'assets/js/select2.min.js', __FILE__ ), array( 'jquery' ), '1.1.0', false );
		wp_enqueue_script( 'rpwfr-backend-js', plugins_url( 'assets/js/rpwfr-backend.js', __FILE__ ), array( 'jquery' ), '1.1.0', false );
	}

	wp_set_script_translations( 'rpwfr_bulk_js', 'sft-related-products-woocommerce', plugin_dir_path( __FILE__ ) . 'languages/' );
}


add_action( 'init', 'rpwfr_load_asset_files' );

/**
 * Loads css & js & includes files.
 */
function rpwfr_load_asset_files() {

	// nonce verification.
	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$is_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $is_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	require_once dirname( __FILE__ ) . '/includes/rpwfr-buc-settings.php';
	require_once dirname( __FILE__ ) . '/includes/rpwfr-buc-functions.php';

	// Only loads file if proversion is not installed already.
	if ( ! rpwfr_check_pro_version() ) {

		$woocommerce_active_check = class_exists( 'WC_Auth' ) ? true : false;

		if ( $woocommerce_active_check ) {

			// Load all the settings files and its functions.
			require_once dirname( __FILE__ ) . '/includes/rpwfr-settings-tabs.php';
			require_once dirname( __FILE__ ) . '/includes/rpwfr-general-settings.php';
			require_once dirname( __FILE__ ) . '/includes/rpwfr-related-setting.php';
			require_once dirname( __FILE__ ) . '/includes/rpwfr-upsells-settings.php';
			require_once dirname( __FILE__ ) . '/includes/rpwfr-custom-functions.php';
			require_once dirname( __FILE__ ) . '/includes/rpwfr-ajax-action-functions.php';
			require_once dirname( __FILE__ ) . '/includes/rpwfr-publish-product-ajax.php';

			// Library for Search Option for Font Awesome Icon.
			wp_enqueue_style( 'rpwfr_font_icons', plugins_url( '/assets/css/font-awesome.min.css', __FILE__ ), array(), '1.0.0' );

			// SweetAlert library.
			wp_enqueue_style( 'rpwfr_sweet_alert_css', plugins_url( '/assets/css/sweetalert2.min.css', __FILE__ ), array(), '1.0.0', false );
			wp_enqueue_script( 'rpwfr_sweet_alert_js', plugins_url( '/assets/js/sweetalert2.all.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', false );

			// -----------------------------------------------------------------------------------------------------------------

			wp_enqueue_style( 'rpwfr-icon-css', esc_url( 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' ), true, '4.7.0' );
			wp_enqueue_script( 'rpwfr_multi_ajax_js', plugins_url( 'assets/js/jQuery-multi-select-js/src/jquery.multi-select.js', __FILE__ ), array(), '10.10.1', false );

			// ------------------------------------------------------------------------------------------------------------------
			wp_enqueue_style( 'rpwfr_front_select2_css', plugins_url( '/assets/css/select2.min.css', __FILE__ ), array(), '10.0.0', false );

			// Plugin css Files.
			wp_enqueue_style( 'rpwfr_main_style', plugins_url( '/assets/css/rpwfr-related-products.css', __FILE__ ), array(), '1.0.0' );

			// Load Related Bulk edit css file.
			if ( 'rpwfr_bulk_setting_menu' === ( isset( $_GET['page'] ) ? sanitize_key( $_GET['page'] ) : '' ) ) {
				wp_enqueue_style( 'rpwfr_bulk_style', plugins_url( '/assets/css/rpwrf-bulk-upsells-crosssells.css', __FILE__ ), array(), '1.0.0' );
			}

			$default_check = (string) get_option( 'rpwfr_default_options' );

			if ( '' === $default_check ) {
				update_option( 'rpwfr_display_related_products', '1' );
				update_option( 'rpwfr_default_options', '1' );
				update_option( 'rpwfr_display_mode_related_products', 'theme' );
			}

			// ----------------------------------------------------------------------------------------------------------------------------------------------

			$ai_default_check = (string) get_option( 'rpwfr_ai_default_check' );

			if ( '' === $ai_default_check ) {
				$selected_product_detail = array( 'products_name', 'products_desc' );
				$selected_products       = rpwfr_get_all_products_with_variations();
				$selected_categories     = array();
				update_option( 'rpwfr_default_ai_prompt', 'Here is selected products data: {selected_products} and here is all products data {all_products} and suggest related products from this set.' );
				update_option( 'rpwfr_all_products', 'products' );
				update_option( 'rpwfr_products_name', 'on' );
				update_option( 'rpwfr_products_desc', 'on' );
				update_option( 'rpwfr_ai_default_check', '1' );
				update_option( 'rpwfr_ai_prompt_type', 'default' );
				update_option( 'rpwfr_display_ai_request_notice', 'no' );
				rpwfr_update_tokens( 'Here is selected products data: {selected_products} and here is all products data {all_products} and suggest related products from this set.', '', $selected_product_detail, 'all_products', $selected_products );
			}

			// ----------------------------------------------------------------------------------------------------------------------------------------------

			// get the option to show related product.
			$display_related_section = (string) get_option( 'rpwfr_display_related_products' );

			// Get the display mode option.
			$display_mode = (string) get_option( 'rpwfr_display_mode_related_products' );

			// Check if the display mode is set to 'ajaxslider'.
			if ( 'ajaxslider' === $display_mode ) {

				// If so, remove the default WooCommerce action to output related products.
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

				// Check if the shortcode mode for related products is set to 'default'.
				if ( (string) get_option( 'rpwfr_shortcode_mode_related_products' ) === 'default' ) {

					// If so, add a custom action to display related products using a custom function.
					add_action( 'woocommerce_after_single_product', 'rpwfr_custom_related_products_section' );
				}
				$display_related_section = 0;
			} elseif ( 'theme' === $display_mode ) { // If the display mode is set to 'theme'.

				// Add a filter to modify the related products section using a custom function.
				add_filter( 'woocommerce_related_products', 'rpwfr_related_products_section', 9999, 3 );
			}

			wp_enqueue_script( 'rpwfr_main_js', plugins_url( '/assets/js/rpwfr-related-products.js', __FILE__ ), array( 'jquery' ), '1.0.0', false );

			wp_localize_script(
				'rpwfr_main_js',
				'rpwfr_ajax_obj',
				array(
					'url'                                  => admin_url( 'admin-ajax.php' ),
					'nonce'                                => wp_create_nonce( 'sft-related-products-woocommerce' ),
					'display_related_section'              => intval( $display_related_section ),
					'rpwfr_free_to_pro_upgrade'            => __( 'Upgrade Now!', 'sft-related-products-woocommerce' ),
					'rpwfr_free_to_pro_popup_line_one'     => __( 'Looking for this cool feature? Go Pro!', 'sft-related-products-woocommerce' ),
					'rpwfr_free_to_pro_popup_line_two'     => __( 'Go with our premium version to unlock the following features:', 'sft-related-products-woocommerce' ),
					'rpwfr_free_to_pro_popup_listing_one'  => __( 'Bulk Update  Related Products, Upsells, and Cross-Sells from a single screen.', 'sft-related-products-woocommerce' ),
					'rpwfr_free_to_pro_popup_listing_two'  => __( 'Custom Related Products  Shortcode with AJAX Slider.', 'sft-related-products-woocommerce' ),
					'rpwfr_free_to_pro_popup_listing_three' => __( 'More Control for Related Products : Show Ratings, Sale Price, Widget Location & more.', 'sft-related-products-woocommerce' ),
					'rpwfr_free_to_pro_popup_listing_four' => __( 'Sales Boost: Increase average order value and revenue.', 'sft-related-products-woocommerce' ),
					'rpwfr_free_to_pro_alert'              => __( 'Pro Field Alert!', 'sft-related-products-woocommerce' ),
					'rpwfr_free_sh_copied'                 => __( 'Shortcode Copied !', 'sft-related-products-woocommerce' ),
					'rpwfr_free_sh_error'                  => __( 'Error', 'sft-related-products-woocommerce' ),
					'rpwfr_free_sh_ok'                     => __( 'Ok', 'sft-related-products-woocommerce' ),
				)
			);
		}
	}
}


add_action( 'admin_notices', 'rpwfr_admin_notice__success' );

/**
 * Function to display admin notice if woocommerce is not active.
 */
function rpwfr_admin_notice__success() {
	$woocommerce_active_check = class_exists( 'WC_Auth' ) ? true : false;

	if ( ! $woocommerce_active_check ) {
		$class   = 'notice notice-warning is-dismissible';
		$message = __( 'Sorry, but \'Related Products for woocommerce\' plugin requires the Woocommerce Plugin to be installed and active.', 'sft-related-products-woocommerce' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}
}


add_action( 'admin_enqueue_scripts', 'rpwfr_admin_publish_product' );

/**
 * Add js to frontend.
 */
function rpwfr_admin_publish_product() {

	// nonce verification.
	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$id_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $id_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	require_once dirname( __FILE__ ) . '/includes/rpwfr-ajax-action-functions.php';

	if ( 'product' === get_post_type() || 'rpwfr_menu' === ( isset( $_GET['page'] ) ? sanitize_key( $_GET['page'] ) : '' ) || 'rpwfr_bulk_setting_menu' === ( isset( $_GET['page'] ) ? sanitize_key( $_GET['page'] ) : '' ) ) {
		wp_enqueue_script( 'rpwfr-select2-js', plugins_url( 'assets/js/select2.min.js', __FILE__ ), array( 'jquery' ), '1.1.0', false );
		wp_enqueue_script( 'rpwfr-backend-js', plugins_url( 'assets/js/rpwfr-backend.js', __FILE__ ), array( 'jquery' ), '1.1.0', false );
	}

	$is_product = 0;

	$post_type = get_post_type( get_the_ID() );

	if ( 'product' === $post_type ) {
		$is_product = 1;
	}

	wp_enqueue_script( 'rpwfr_related_product_publish', plugins_url( '/assets/js/rpwfr-related-product-publish.js', __FILE__ ), array( 'jquery' ), '1.0.0', false );

	wp_localize_script(
		'rpwfr_related_product_publish',
		'rpwfr_related_ajax_obj',
		array(
			'url'              => admin_url( 'admin-ajax.php' ),
			'nonce'            => wp_create_nonce( 'sft-related-products-woocommerce' ),
			'is_product'       => $is_product,
			'cat_tag_save_msg' => __( 'To save your changes, you must choose tags or categories within the \'include/exclude\' field or disable the \'Filter by Categories and tags\' switch.', 'sft-related-products-woocommerce' ),
		)
	);

	wp_enqueue_script( 'rpwfr_ajax_js', plugins_url( 'assets/js/rpwfr-ajax.js', __FILE__ ), array(), '10.10.1', false );

	wp_localize_script(
		'rpwfr_ajax_js',
		'rpwfr_ajax_object',
		array(
			'ajax_url'            => admin_url( 'admin-ajax.php' ),
			'api_valid_key'       => get_option( 'rpwfr_api_valid_key_status' ),
			'api_request_status'  => get_option( 'rpwfr_api_request_created_status' ),
			'api_response_status' => get_option( 'rpwfr_api_request_created_status' ),
		)
	);
}

add_filter( 'woocommerce_output_related_products_args', 'rpwfr_row_column_related_products', 9999 );
add_action( 'woocommerce_product_options_related', 'rpwfr_related_product_add_fields' );
add_action( 'woocommerce_process_product_meta', 'rpwfr_product_custom_fields_save' );

// Related product shortcode.
add_shortcode( 'rpwfr_custom_related_products_display', 'rpwfr_custom_shortcode' );

// -------------------------------------- Plugin links on plugin page -------------------------------------.

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'rpwfr_action_links_callback', 10, 1 );

/**
 * Settings link in plugin page.
 *
 * @param array $links links Plugin links on plugins.php.
 * @return array
 */
function rpwfr_action_links_callback( $links ) {

	if ( ! rpwfr_check_pro_version() ) {
		$setting_links = array(
			'<a href="' . admin_url( 'admin.php?page=rpwfr_menu' ) . '">' . __( 'Settings', 'sft-related-products-woocommerce' ) . '</a>',
			'<a class="rpwfr-setting-upgrade" href="https://www.saffiretech.com/woocommerce-related-products-pro/?utm_source=wp_plugin&utm_medium=plugins_archive&utm_campaign=free2pro&utm_id=c1&utm_term=upgrade_now&utm_content=rpwfr" target="_blank">' . __( 'UpGrade to Pro !', 'sft-related-products-woocommerce' ) . '</a>',
		);
		return array_merge( $setting_links, $links );
	} else {
		return $links;
	}
}


// Define the action hook to handle the scheduled event.
add_action( 'rpwfr_api_request_prompt', 'rpwfr_openai_setup_api_call' );

/**
 * Server API Call with product data.
 *
 * This function handles the communication with the OpenAI API to request product recommendations
 * based on product data. It checks for button click, handles errors, processes the response, and
 * updates options accordingly.
 */
function rpwfr_openai_setup_api_call() {
	global $wpdb;

	// Get the current date and time in GMT format.
	$date = gmdate( 'Y-m-d' );
	$time = gmdate( 'H:i:s' );

	$products             = array();  // Array to store selected products.
	$prompt_product_data  = array();  // Array to store product details for the prompt.
	$prompt_text          = '';       // Variable to store the prompt text.
	$final_response       = array();  // Array to store the final API response.
	$all_products         = rpwfr_get_all_products_with_variations(); // Get all products with variations.
	$all_products_prompt  = array();  // Array to store all products for the prompt.
	$ai_build_prompt_data = '';       // Variable to store the final AI prompt data.

	// Check if the "AI prompt request" button has been hit (triggered).
	if ( get_option( 'rpwfr_prompt_request_button_hit' ) ) {

		// Check if the API request has already been fulfilled to avoid duplicate requests.
		if ( get_option( 'rpwfr_api_request_created_status' ) === 'fulfilled' ) {
			return;
		}

		// If the request is not fulfilled, proceed with resetting and processing.
		if ( 'fulfilled' !== get_option( 'rpwfr_api_request_created_status' ) ) {

			// Reset error status and hit button.
			update_option( 'rpwfr_api_error_data', '' );
			update_option( 'rpwfr_prompt_request_button_hit', 0 );

			// Get the default AI prompt from options.
			$prompt_text = get_option( 'rpwfr_default_ai_prompt' );

			// Get the selected product details and store description.
			$selected_product_detail = get_option( 'rpwfr_product_selected_options' );
			$about_store_text        = get_option( 'rpwfr_about_store' );

			// Build the AI prompt with selected products and store details.
			$build_prompt = rpwfr_update_tokens( $prompt_text, $about_store_text, $selected_product_detail, get_option( 'rpwfr_all_products' ), get_option( 'rpwfr_product_list' ) );

			// For testing/debugging purposes, save the built prompt.
			update_option( 'test', $build_prompt );

			// Get the API key entered by the user from options.
			$api_key = ( get_option( 'rpwfr_openai_api_key' ) ) ? get_option( 'rpwfr_openai_api_key' ) : 0;

			// Get the model name from options.
			$model_name = ( get_option( 'rpwfr_api_model_name' ) ) ? get_option( 'rpwfr_api_model_name' ) : 0;

			// The API endpoint URL for the OpenAI API.
			$request_url = 'https://api.openai.com/v1/chat/completions';

			// Prepare the request body with model, messages, and other parameters.
			$request_body = array(
				'model'             => $model_name,
				'messages'          => array(
					array(
						'role'    => 'user',
						'content' => $build_prompt['prompt_to_send'],
					),
				),
				'max_tokens'        => 4096,
				'temperature'       => 0.7,
				'top_p'             => 1,
				'frequency_penalty' => 0,
				'presence_penalty'  => 0,
			);

			// Set up the arguments for the API request, including headers and body.
			$args = array(
				'method'  => 'POST',
				'headers' => array(
					'Content-Type'  => 'application/json',
					'Authorization' => 'Bearer ' . $api_key,
				),
				'body'    => wp_json_encode( $request_body ),
				'timeout' => 100,  // Set a long timeout to handle large requests.
			);

			// Clear current AI request log.
			update_option( 'rpwfr_current_ai_request', '' );

			// Make the POST request to the OpenAI API.
			$response = wp_remote_post( $request_url, $args );

			// Handle server error (500) response.
			if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 500 ) {
				$final_response = array(
					'status'          => 1,
					'openai_response' => 'Request to OpenAI API failed.',
				);

				// Update the status as failed and save the error log.
				update_option( 'rpwfr_api_request_created_status', 'failed' );
				rpwfr_save_data_with_date_and_time( $date, $time, 0, 'Your Request has failed due to server error. Try again!' );
			}

			// Handle quota exceeded (429) response.
			if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 429 ) {
				$final_response = array(
					'status'          => 0,
					'openai_response' => 'insufficient_quota',
				);

				// Update the status as insufficient quota and save the log.
				update_option( 'rpwfr_api_request_created_status', 'insufficient_quota' );
				rpwfr_save_data_with_date_and_time( $date, $time, 0, 'You have insufficient quota left for making requests.' );
			}

			// Handle incorrect API Key (401) response.
			if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 401 ) {
				$final_response = array(
					'status'          => 0,
					'openai_response' => 'incorrect_api',
				);

				// Update the status as incorrect API key.
				update_option( 'rpwfr_api_request_created_status', 'incorrect_api' );
			}

			// Handle system overload (503) response.
			if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 503 ) {
				$final_response = array(
					'status'          => 0,
					'openai_response' => 'system_overloaded',
				);

				// Update the status as system overload and save the log.
				update_option( 'rpwfr_api_request_created_status', 'system_overloaded' );
				rpwfr_save_data_with_date_and_time( $date, $time, 0, 'API system is overloaded. Try again.' );
			}

			// Handle successful (200) response.
			if ( wp_remote_retrieve_response_code( $response ) === 200 ) {

				// Decode the response body into an array.
				$response_data = json_decode( wp_remote_retrieve_body( $response ), true );

				$final_response = array(
					'status'          => 1,
					'openai_response' => $response_data,
				);

				// Update the status to indicate a response was received and save the log.
				update_option( 'rpwfr_api_request_created_status', 'response_received' );
				rpwfr_save_data_with_date_and_time( $date, $time, $response_data, 'Your request has been successfully received!' );
			}

			// Retrieve the response headers and body for further processing.
			$headers = wp_remote_retrieve_headers( $response );
			$body    = wp_remote_retrieve_body( $response );
			$content = json_decode( $body, true );

			// Calculate tokens used based on the API response (if available).
			$tokens_used = isset( $content['usage']['total_tokens'] ) ? $content['usage']['total_tokens'] : 0;

			// Update the options with the AI request logs and the final response.
			update_option( 'rpwfr_ai_request_logs', $final_response );
			update_option( 'response_ai', $final_response );

			// Save the product data based on the AI recommendations.
			rpwfr_save_product_data( get_option( 'rpwfr_ai_request_logs' ) );
		}
	}
}

add_action( 'admin_enqueue_scripts', 'rpwfr_product_publish' );

/**
 * To check if it is page or product .
 */
function rpwfr_product_publish() {

	$is_product = 0;

	$temp = get_post_type( get_the_ID() );

	if ( 'product' === $temp ) {
		$is_product = 1;
	}

	wp_enqueue_script( 'rpwfr_related_product_publish', plugins_url( '/assets/js/rpwfr-related-product-publish.js', __FILE__ ), array( 'jquery' ), '1.0.0', false );

	wp_localize_script(
		'rpwfr_related_product_publish',
		'rpwfr_related_ajax_obj',
		array(
			'url'                   => admin_url( 'admin-ajax.php' ),
			'is_product'            => $is_product,
			'buy_again_page_select' => __( 'Please choose a custom page to apply the modifications for "Buy It Again" products.', 'sft-related-products-woocommerce' ),
			'cat_tag_save_msg'      => __( 'To save your changes, you must choose tags or categories within the \'include/exclude\' field or disable the \'Filter by Categories and tags\' switch.', 'sft-related-products-woocommerce' ),
		)
	);
}


add_filter( 'woocommerce_output_related_products_args', 'rpwfr_row_column_related_products', 9999 );
add_action( 'woocommerce_product_options_related', 'rpwfr_related_product_add_fields' );
add_action( 'woocommerce_process_product_meta', 'rpwfr_product_custom_fields_save' );


// Shortcode to show related products.
add_shortcode( 'rpwfr_custom_related_products_display', 'rpwfr_custom_shortcode' );

// Re-order button is added as action on orders page.
add_filter( 'woocommerce_my_account_my_orders_actions', 'rpwfr_reorder', 10, 2 );

/**
 * Get all product in required format ( simple + variation ).
 */
function rpwfr_get_all_products_with_variations() {
	$all_products = array();

	$products_id = wc_get_products(
		array(
			'limit'  => -1,  // All products.
			'status' => 'publish', // Only published products.
			'return' => 'ids',
		)
	);

	foreach ( $products_id as $product_id ) {
		$product = wc_get_product( $product_id );

		// All simple products.
		$all_products[] = array(
			'product_id' => intval( $product_id ),
			'label'      => 'ID:' . esc_attr( $product_id ) . ' ' . esc_html( wp_strip_all_tags( $product->get_formatted_name() ) ),
		);

		// All variation product.
		if ( $product->is_type( 'variable' ) ) {

			foreach ( $product->get_children() as $variation_id ) {
				$variation      = wc_get_product( $variation_id );
				$all_products[] = array(
					'product_id' => intval( $variation_id ),
					'label'      => 'ID:' . esc_attr( $variation_id ) . ' ' . esc_html( wp_strip_all_tags( $variation->get_formatted_name() ) ),
				);

			}
		}
	}

	return $all_products;
}

/**
 * Update API request tokens used in the latest prompt.
 *
 * This function generates a prompt for related product recommendations based on product descriptions, calculates the token usage, and stores it.
 *
 * @param string $prompt_text The text for the AI prompt.
 * @param string $about_store_text The text about the store.
 * @param array  $selected_product_detail The details of the selected products (e.g., name, description).
 * @param array  $selected_product_type The selected product type (e.g., products, categories).
 * @param array  $selected_products The list of selected product IDs.
 */
function rpwfr_update_tokens( $prompt_text, $about_store_text, $selected_product_detail, $selected_product_type, $selected_products ) {

	// Initialize arrays and variables.
	$products             = array(); // Array to store selected products.
	$prompt_product_data  = array(); // Array to store product details for the prompt.
	$final_response       = array(); // Array to store final API response.
	$all_products         = rpwfr_get_all_products_with_variations(); // Get all products including variations.
	$all_products_prompt  = array(); // Array to store all products for prompt.
	$ai_build_prompt_data = '';      // Variable to store the final AI prompt data.

	// If selected product type is 'products', use the provided selected products.
	if ( $selected_product_type === 'products' ) {
		$products = $selected_products;
	}

	// Gather product details for the selected products.
	foreach ( $products as $product_id ) {

		$product            = wc_get_product( $product_id ); // Get WooCommerce product by ID.
		$temp               = array(); // Temporary array to store product details.
		$temp['product_id'] = $product_id; // Store product ID.

		// Handle the case where the product is not found.
		if ( ! $product ) {
			continue;
		}

		// Add product name if it is part of the selected product details.
		if ( in_array( 'products_name', $selected_product_detail ) ) {
			$temp['products_name'] = get_the_title( $product_id );
		}

		// Add product description if it is part of the selected product details.
		if ( in_array( 'products_desc', $selected_product_detail ) ) {
			$temp['rpwfr_products_desc'] = strip_tags( $product->get_short_description() );
		}

		// Add the product details to the prompt data array.
		$prompt_product_data[] = $temp;
	}

	// Gather product details for all products in the store.
	foreach ( $all_products as $product_id => $value ) {

		$product            = wc_get_product( $value['product_id'] ); // Get WooCommerce product by ID.
		$temp               = array(); // Temporary array to store product details.
		$temp['product_id'] = $value['product_id']; // Store product ID.

		// Handle the case where the product is not found.
		if ( ! $product ) {
			continue;
		}

		// Add product name if it is part of the selected product details.
		if ( in_array( 'products_name', $selected_product_detail ) ) {
			$temp['products_name'] = get_the_title( $value['product_id'] );
		}

		// Add product description if it is part of the selected product details.
		if ( in_array( 'products_desc', $selected_product_detail ) ) {
			$temp['rpwfr_products_desc'] = strip_tags( $product->get_short_description() );
		}

		// Add the product details to the all products prompt data array.
		$all_products_prompt_data[] = $temp;
	}

	// Encode the gathered product data into JSON format.
	$replacement_words   = wp_json_encode( $prompt_product_data );
	$all_products_prompt = wp_json_encode( $all_products_prompt_data );

	// Replace the placeholder {all_products} in the prompt text with the JSON data.
	$modified_string_all = str_replace( '{all_products}', $all_products_prompt, $prompt_text );

	// Customize the prompt based on the selected product type option.
	if ( get_option( 'rpwfr_all_products' ) == 'products' ) {
		$ai_build_prompt_data = str_replace( '{selected_products}', $replacement_words, $modified_string_all );
	}

	// Build the final prompt string to send to the AI.
	$prompt_to_send = $about_store_text . '. Generate a JSON object listing related product recommendations for a WooCommerce store based on product descriptions. Exclude any products where the type is "child". Focus on finding similarities in product descriptions to determine related items. Suggest at least 5 recommendations for each product.' . $ai_build_prompt_data . ' The JSON output should only include product IDs and should be formatted compactly without unnecessary spaces. For example, for a product with ID 123, the output should be: {"123":{"related":["344,333,444"]}}. Ensure the product IDs are listed without spaces and that the relationships are based on significant description similarities. Do not include any additional content or commentary, just provide the JSON data.';

	// Build the prompt string to save (for logging or future use).
	$prompt_to_save = $about_store_text . '. Generate a JSON object listing related product recommendations for a WooCommerce store based on product descriptions. Exclude any products where the type is "child". Focus on finding similarities in product descriptions to determine related items. Suggest at least 5 recommendations for each product.' . $prompt_text . '. The JSON output should only include product IDs and should be formatted compactly without unnecessary spaces. For example, for a product with ID 123, the output should be: {"123":{"related":["344,333,444"]}}. Ensure the product IDs are listed without spaces and that the relationships are based on significant description similarities. Do not include any additional content or commentary, just provide the JSON data.';

	// Calculate the token length for the prompt (assuming 1 token = 4 characters).
	$token_length = ceil( strlen( $prompt_to_send ) / 4 );

	// Update the token usage option (store the number of tokens used).
	update_option( 'rpwfr_tokens_used', $token_length );

	// Prepare the response array to return.
	$built_prompt['prompt_to_send'] = $prompt_to_send;
	$built_prompt['prompt_to_save'] = $prompt_to_save;
	$built_prompt['prompt_token']   = $token_length;

	// Return the built prompt data and token count.
	return $built_prompt;
}


add_action( 'admin_notices', 'rpwfr_ai_admin_notice__success' );

/**
 * Related AI Request Status Notice Rendering.
 *
 * This function renders admin notices based on the current AI request status for related products.
 * It handles different cases like pending requests, fulfilled requests, and errors (e.g., insufficient quota, incorrect API key).
 */
function rpwfr_ai_admin_notice__success() {

	// Get the current URL for reloading the page.
	$reload_page = esc_url( $_SERVER['REQUEST_URI'] );

	// Check if the notice should be displayed by checking the 'rpwfr_display_ai_request_notice' option.
	if ( get_option( 'rpwfr_display_ai_request_notice' ) == 'yes' ) {

		// Check if the request is not yet fulfilled.
		if ( 'fulfilled' !== get_option( 'rpwfr_api_request_created_status' ) ) {

			// Show a notice for pending requests (either 'created' or 'pending' status).
			if ( 'created' === get_option( 'rpwfr_api_request_created_status' ) || 'pending' === get_option( 'rpwfr_api_request_created_status' ) ) {

				?>
				<div class="notice notice-warning is-dismissible">
					<p><b><?php _e( 'Related Product', 'sft-related-products-woocommerce' ); ?></b></p>
					<p>
						<b><?php _e( 'Your request is currently being processed. We appreciate your patience and will notify you as soon as it\'s ready!', 'sft-related-products-woocommerce' ); ?></b>
					</p>
					<p>
						<b><?php _e( 'Actions you can perform: ', 'sft-related-products-woocommerce' ); ?><a href="<?php echo $reload_page; ?>"><?php _e( 'Reload Page', 'sft-related-products-woocommerce' ); ?></a></b>
					</p>
				</div>
				<?php
			}
		} else {
			// Get the API response data from the option 'rpwfr_ai_request_logs'.
			$api_response_data = get_option( 'rpwfr_ai_request_logs' );

			// Handle different API response cases.
			switch ( $api_response_data['openai_response'] ) {

				// Case 1: Insufficient quota.
				case 'insufficient_quota':
					?>
					<div class="notice notice-error is-dismissible">
						<p><b><?php _e( 'Related Product', 'sft-related-products-woocommerce' ); ?></b></p>
						<p>
							<b>
								<?php _e( 'We\'re sorry, but your current request could not be processed due to insufficient quota remaining on your API key. It appears that you have used up most of your allocated quota. Please check your API usage or consider upgrading your plan.', 'sft-related-products-woocommerce' ); ?>
							</b>
						</p>
					</div>
					<?php
					break;

				// Case 2: Incorrect API key.
				case 'incorrect_api':
					?>
					<div class="notice notice-error is-dismissible">
						<p><b><?php _e( 'Related Product', 'sft-related-products-woocommerce' ); ?></b></p>
						<p>
							<b>
								<?php _e( 'Your API Key is incorrect! Please double-check your entry and try again.', 'sft-related-products-woocommerce' ); ?>
							</b>
						</p>
					</div>
					<?php
					break;

				// Case 3: API system overloaded.
				case 'system_overloaded':
					?>
					<div class="notice notice-error is-dismissible">
						<p><b><?php _e( 'Related Product', 'sft-related-products-woocommerce' ); ?></b></p>
						<p>
							<b>
								<?php _e( 'Unfortunately, we were unable to fulfill your request at this time because the API system is currently experiencing heavy load. Our servers are working at full capacity. Please try again in a few moments when the system has stabilized.', 'sft-related-products-woocommerce' ); ?>
							</b>
						</p>
					</div>
					<?php
					break;

				// Default case: Successful response with recommendations.
				default:
					if ( isset( $api_response_data['openai_response']['choices'] ) ) {

						?>
						<div class="notice notice-success is-dismissible">
							<p><b><?php _e( 'Related Product', 'sft-related-products-woocommerce' ); ?></b></p>
							<p>
								<b>
									<?php _e( 'Your request has been successfully fulfilled!', 'sft-related-products-woocommerce' ); ?>
								</b>
							</p>
						</div>
						<?php
						// Reset the hit button option to ensure the notice is not displayed again after rendering.
						update_option( 'rpwfr_prompt_request_button_hit', 0 );
						update_option( 'rpwfr_display_ai_request_notice', 'no' );
					}
					break;
			}
		}
	}
}


/**
 * Save Related products recommendations from AI.
 *
 * This function processes AI recommendations from the OpenAI response, extracts the related products,
 * and saves them as related products for the specified product. The function also updates various options
 * and metadata based on the AI response.
 *
 * @param array $product_data The product data from the AI request logs.
 */
function rpwfr_save_product_data( $product_data ) {

	// Retrieve the AI request logs stored in the 'rpwfr_ai_request_logs' option.
	$product_data = get_option( 'rpwfr_ai_request_logs' );

	// Check if 'choices' exist in the OpenAI response.
	if ( isset( $product_data['openai_response']['choices'] ) ) {

		// Extract the final response data (content) from the first choice.
		$final_data = $product_data['openai_response']['choices'][0]['message']['content'];

		// Clean up the final data by removing unwanted 'json' and '```' characters.
		$ai_recommendations = str_replace( 'json', '', $final_data );
		$ai_recommendations = str_replace( '```', '', $ai_recommendations );

		// Decode the cleaned AI recommendations as a JSON object.
		$recommendations_data = json_decode( $ai_recommendations, true );

		// If the decoded recommendations data is not empty, process the data.
		if ( ! empty( $recommendations_data ) ) {

			// Loop through each key-value pair in the recommendations data.
			foreach ( $recommendations_data as $key => $item ) {

				// Initialize an empty array to store the related product IDs.
				$related_data = array();

				// Get the WooCommerce product object for the current key (product ID).
				$product = wc_get_product( $key );

				// Iterate through all related products in the 'related' field.
				foreach ( $item['related'] as $related ) {

					// Convert the related product string to an array of integers and add to related_data.
					array_push( $related_data, array_map( 'intval', explode( ',', $related ) ) );
				}

				// Check if the current product ID exists in the related data, and remove it if found.
				$related_key = array_search( $key, $related_data, true );

				if ( false !== $related_key ) {
					unset( $related_data[ $related_key ] );
				}

				// Initialize an empty array to hold the flattened list of related product IDs.
				$related_product_ids = array();

				// Flatten the multidimensional array into a single array of product IDs.
				foreach ( $related_data as $item ) {
					$related_product_ids[] = $item[0];
				}

				// Update the product's meta field with the related product IDs.
				update_post_meta( $key, 'related_products_individual_select', $related_product_ids );

				// Save the product object to ensure changes are stored.
				$product->save();
			}
		}
	}

	// Update the status options to indicate that the API request and response have been fulfilled.
	update_option( 'rpwfr_api_request_created_status', 'fulfilled' );
}

// Added HPOS Compatibility.
add_action(
	'before_woocommerce_init',
	function() {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
		}
	}
);

// ---------------------------------------------- New Feature Notice ----------------------------------------.

add_action( 'admin_notices', 'rpwfr_updated_features_admin_notice' );

/**
 * Related pro new updates notice.
 */
function rpwfr_updated_features_admin_notice() {

	// Check if the notice has been dismissed.
	$current_version = '2.0.1';

	// Check the current version with stored version of plugin.
	if ( metadata_exists( 'user', get_current_user_id(), 'rpwfr_latest_version_read_message' ) ) {

		// Get version data from notice.
		$rprow_notice_user_meta = get_user_meta( get_current_user_id(), 'rpwfr_latest_version_read_message', true );
		$notice_read_version    = $rprow_notice_user_meta['version'];

		// If version not matches show the notice.
		if ( $notice_read_version != $current_version ) {
			$rprow_show_notice = true;
		} else {
			$rprow_show_notice = false;
		}
	} else {
		$rprow_show_notice = true;
	}

	// Return false.
	if ( ! $rprow_show_notice ) {
		return;
	}
	?>

	<!-- New features Notice div -->
	<div class="notice notice-warning is-dismissible rpwfr-custom-notice" data-notice="rpwfr_new_features_notice">
		<h3>
			<?php echo esc_html__( '🎉 Exciting New AI Features in Related Products for WooCommerce (v2.0.1) !', 'sft-related-products-woocommerce' ); ?>
		</h3>

		<?php echo esc_html__( 'We’ve just rolled out some amazing AI-driven enhancements using Chat GPT in version 2.0.1! These updates will help you offer more relevant product recommendations to your customers, driving more conversions and enhancing the shopping experience.', 'sft-related-products-woocommerce' ); ?>

		<h4>What’s New:</h4>
		<ul>
			<li>&#x2022; AI-powered related product suggestions tailored to your store.</li>
			<li>&#x2022; Get best Related suggestions by leveraging ChatGPT.</li>
			<li>&#x2022; Improved recommendation accuracy, driving more relevant product discovery.</li>
		</ul>

		<a style="text-decoration:none">
			<button class="rpwfr-notice-button" style="cursor:pointer;" onclick="window.open('https://www.saffiretech.com/blog/how-to-get-ai-product-suggestions-for-related-products-in-woocommerce?utm_source=wp_plugin&utm_medium=notice&utm_campaign=blog&utm_id=c1&utm_term=ai_update&utm_content=rpwfr', '_blank')">
				<svg fill="#FFD700" height="24px" width="24px" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M12,17c0.8-4.2,1.9-5.3,6.1-6.1c0.5-0.1,0.8-0.5,0.8-1s-0.3-0.9-0.8-1C13.9,8.1,12.8,7,12,2.8C11.9,2.3,11.5,2,11,2 c-0.5,0-0.9,0.3-1,0.8C9.2,7,8.1,8.1,3.9,8.9C3.5,9,3.1,9.4,3.1,9.9s0.3,0.9,0.8,1c4.2,0.8,5.3,1.9,6.1,6.1c0.1,0.5,0.5,0.8,1,0.8 S11.9,17.4,12,17z"></path> <path d="M22,24c-2.8-0.6-3.4-1.2-4-4c-0.1-0.5-0.5-0.8-1-0.8s-0.9,0.3-1,0.8c-0.6,2.8-1.2,3.4-4,4c-0.5,0.1-0.8,0.5-0.8,1 s0.3,0.9,0.8,1c2.8,0.6,3.4,1.2,4,4c0.1,0.5,0.5,0.8,1,0.8s0.9-0.3,1-0.8c0.6-2.8,1.2-3.4,4-4c0.5-0.1,0.8-0.5,0.8-1 S22.4,24.1,22,24z"></path> <path d="M29.2,14c-2.2-0.4-2.7-0.9-3.1-3.1c-0.1-0.5-0.5-0.8-1-0.8c-0.5,0-0.9,0.3-1,0.8c-0.4,2.2-0.9,2.7-3.1,3.1 c-0.5,0.1-0.8,0.5-0.8,1s0.3,0.9,0.8,1c2.2,0.4,2.7,0.9,3.1,3.1c0.1,0.5,0.5,0.8,1,0.8c0.5,0,0.9-0.3,1-0.8 c0.4-2.2,0.9-2.7,3.1-3.1c0.5-0.1,0.8-0.5,0.8-1S29.7,14.1,29.2,14z"></path> <path d="M5.7,22.3C5.4,22,5,21.9,4.6,22.1c-0.1,0-0.2,0.1-0.3,0.2c-0.1,0.1-0.2,0.2-0.2,0.3C4,22.7,4,22.9,4,23s0,0.3,0.1,0.4 c0.1,0.1,0.1,0.2,0.2,0.3c0.1,0.1,0.2,0.2,0.3,0.2C4.7,24,4.9,24,5,24c0.1,0,0.3,0,0.4-0.1s0.2-0.1,0.3-0.2 c0.1-0.1,0.2-0.2,0.2-0.3C6,23.3,6,23.1,6,23s0-0.3-0.1-0.4C5.9,22.5,5.8,22.4,5.7,22.3z"></path> <path d="M28,7c0.3,0,0.5-0.1,0.7-0.3C28.9,6.5,29,6.3,29,6s-0.1-0.5-0.3-0.7c-0.1-0.1-0.2-0.2-0.3-0.2c-0.2-0.1-0.5-0.1-0.8,0 c-0.1,0-0.2,0.1-0.3,0.2C27.1,5.5,27,5.7,27,6c0,0.3,0.1,0.5,0.3,0.7C27.5,6.9,27.7,7,28,7z"></path> </g> </g></svg>
				<?php echo esc_html__( ' Learn More About AI Suggestions', 'sft-related-products-woocommerce' ); ?>
			</button>
		</a>
	</div>
	<?php
}


add_action( 'wp_ajax_rpwfr_update_new_feature_notice_read', 'rpwfr_update_new_feature_notice_read_callback' );
add_action( 'wp_ajax_nopriv_rpwfr_update_new_feature_notice_read', 'rpwfr_update_new_feature_notice_read_callback' );

/**
 * Update meta on dismiss of notice.
 */
function rpwfr_update_new_feature_notice_read_callback() {

	// Current version.
	$current_version = '2.0.1';

	// Current user id.
	$current_user_id = get_current_user_id();

	// Notice array.
	$rprow_notice_status = array(
		'rpwfr_update_notice_read' => 'read',
		'version'                  => $current_version,
	);

	update_user_meta( $current_user_id, 'rpwfr_latest_version_read_message', $rprow_notice_status );

	echo 'updated';

	wp_die();
}
