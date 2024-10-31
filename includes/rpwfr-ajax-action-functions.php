<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Register AJAX actions to display AJAX slider.
add_action( 'wp_ajax_action_shortcode_slider', 'rpwfr_action_shortcode_slider' );
add_action( 'wp_ajax_nopriv_action_shortcode_slider', 'rpwfr_action_shortcode_slider' );

/**
 * Function for slider shortcode in front.
 */
function rpwfr_action_shortcode_slider() {

	// Check if the nonce is set in the POST request.
	if ( isset( $_POST['rpwfr_nonce'] ) ) {

		// Verify the nonce for security.
		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['rpwfr_nonce'] ) ), 'sft-related-products-woocommerce' ) ) {
			wp_die( esc_html__( 'Permission Denied.', 'sft-related-products-woocommerce' ) );
		}

		// Handle the 'back' button action.
		if ( isset( $_POST['back_btn'] ) ) {

			$iterator          = 0;
			$product_index     = isset( $_POST['start_index_back'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['start_index_back'] ) ) ) : '';
			$feature_name      = isset( $_POST['feature_name'] ) ? sanitize_text_field( wp_unslash( $_POST['feature_name'] ) ) : '';
			$product_ids_array = isset( $_POST['product_ids_array'] ) ? sanitize_text_field( wp_unslash( $_POST['product_ids_array'] ) ) : '';
			$all_products      = explode( ',', $product_ids_array );
			$slider_limit      = isset( $_POST['products_limit_back'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['products_limit_back'] ) ) ) : '';
			$page_count        = isset( $_POST['page_count'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['page_count'] ) ) ) : '';
			$page_count_back   = isset( $_POST['page_count_back'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['page_count_back'] ) ) ) : '';
			$diff              = $slider_limit * $page_count_back;

			// Calculate the range of products to display based on the current page and slider limit.
			if ( $page_count >= 1 ) {

				if ( $product_index + 1 >= $slider_limit ) {
					$all_products = array_slice( $all_products, $product_index - $diff, $slider_limit, true );

					$product_index = $product_index - $diff;
				} else {
					$all_products  = array_slice( $all_products, 0, $slider_limit, true );
					$product_index = 0;
				}
			} else {
				$range = fmod( count( $all_products ), $slider_limit );
				if ( ! $range ) {
					$range = $slider_limit;
				}

				$product_index = count( $all_products ) - $range;
				$all_products  = array_slice( $all_products, -( $range ) );

			}

			// Display the products for the current page.
			foreach ( $all_products as $id ) {

				if ( intval( $id ) !== 0 && $iterator < $slider_limit ) {

					$product = wc_get_product( $id );
					?>
	
					<div class="rpwfr-product-container rpwfr-<?php echo esc_attr( $feature_name ); ?>-product-container" data-product_id="<?php echo esc_attr( $id ); ?>" data-index="<?php echo esc_attr( $product_index ); ?>" style="position: relative;">
	
						<div class="rpwfr-product-thumbnail" style="height: auto; position: relative;">
	
							<div class="rpwfr-loader rpwfr-<?php echo esc_attr( $feature_name ); ?>-loader" style="position: absolute;top: 15%;display:none;">
	
								<a href="<?php echo esc_url( plugins_url( '../assets/images/shimmer-loader5.gif', __FILE__ ) ); ?>">
									<img src="<?php echo esc_url( plugins_url( '../assets/images/shimmer-loader5.gif', __FILE__ ) ); ?>" style="max-width: 50%;">
								</a>
	
							</div>
	
							<a href="<?php echo esc_url( get_permalink( $id ) ); ?>">
							<?php
								$image      = $product->get_image_id();
								$image_size = get_option( 'rpwfr_general_product_image_size' ) ? get_option( 'rpwfr_general_product_image_size' ) : 'thumbnail';
								echo wp_kses_post( '<div class="rpwfr-image-container">' . wp_get_attachment_image( $image, $image_size ) . '</div>' );
							?>
							</a>
						</div>
	
						<div class="rpwfr-product-info">
	
							<div class="rpwfr-product-title">
								<a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_attr( get_the_title( $id ) ); ?></a>
							</div>
	
							<div class="rpwfr-<?php echo esc_attr( $feature_name ); ?>-title-loader">
								<a href="<?php echo esc_url( plugins_url( '../assets/images/shimmer-title-loader.gif', __FILE__ ) ); ?>" >
									<img src="<?php echo esc_url( plugins_url( '../assets/images/shimmer-title-loader.gif', __FILE__ ) ); ?>" style="width: 100%;">
								</a>
							</div>
	
						</div>
					</div>
					<?php
					// $iterator += 1;
					++$iterator;
				}
				// $product_index += 1;
				++$product_index;
			}
		}

		// Handle the 'next' button action.
		if ( isset( $_POST['next_btn'] ) ) {

			$iterator          = 0;
			$products_id_array = array();
			$product_index     = isset( $_POST['start_index_next'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['start_index_next'] ) ) ) : '';
			$feature_name      = isset( $_POST['feature_name'] ) ? sanitize_text_field( wp_unslash( $_POST['feature_name'] ) ) : '';
			$product_ids_array = isset( $_POST['product_ids_array'] ) ? sanitize_text_field( wp_unslash( $_POST['product_ids_array'] ) ) : '';
			$all_products      = explode( ',', $product_ids_array );
			$slider_limit      = isset( $_POST['products_limit_next'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['products_limit_next'] ) ) ) : '';
			$pages             = isset( $_POST['pages'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['pages'] ) ) ) : '';
			$page_count        = isset( $_POST['page_count'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['page_count'] ) ) ) : '';

			// Calculate the range of products to display based on the current page and slider limit.
			if ( $pages < $page_count ) {
				$product_index = 0;
			} else {
				if ( $product_index < ( count( $all_products ) - 1 ) ) {
					$all_products = array_slice( $all_products, $product_index + 1 );

					// $product_index += 1;
					++$product_index;
				} else {
					$mod = fmod( count( $all_products ), $slider_limit );
					if ( ! intval( $mod ) ) {
						$products_id_array = array_slice( $all_products, ( count( $all_products ) - $slider_limit ) );
						$product_index     = count( $all_products ) - $slider_limit;

					} else {
						$products_id_array = array_slice( $all_products, ( count( $all_products ) - $mod ) );
						$product_index     = count( $all_products ) - $mod;
					}

					$all_products = $products_id_array;
				}
			}

			// Display the products for the current page.
			foreach ( $all_products as $id ) {
				if ( intval( $id ) !== 0 && $iterator < $slider_limit ) {
					$product = wc_get_product( $id );
					?>
					<div class="rpwfr-product-container rpwfr-<?php echo esc_attr( $feature_name ); ?>-product-container" data-product_id="<?php echo esc_attr( $id ); ?>" data-index="<?php echo esc_attr( $product_index ); ?>" style="position: relative;">
	
						<div class="rpwfr-product-thumbnail" style="height: auto; position: relative;">
							<div class="rpwfr-loader rpwfr-<?php echo esc_attr( $feature_name ); ?>-loader" style="position: absolute;top: 15%;display:none;">
								<a href="<?php echo esc_url( plugins_url( '../assets/images/shimmer-loader5.gif', __FILE__ ) ); ?>">
									<img src="<?php echo esc_url( plugins_url( '../assets/images/shimmer-loader5.gif', __FILE__ ) ); ?>" style="max-width: 50%;">
								</a>
							</div>
	
							<a href="<?php echo esc_url( get_permalink( $id ) ); ?>">
								<?php
								$image      = $product->get_image_id();
								$image_size = get_option( 'rpwfr_general_product_image_size' ) ? get_option( 'rpwfr_general_product_image_size' ) : 'thumbnail';
								echo wp_kses_post( '<div class="rpwfr-image-container">' . wp_get_attachment_image( $image, $image_size ) . '</div>' );
								?>
							</a>
	
						</div>
	
						<div class="rpwfr-product-info">
	
							<div class="rpwfr-product-title">
								<a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_attr( get_the_title( $id ) ); ?></a>
							</div>
	
							<div class="rpwfr-<?php echo esc_attr( $feature_name ); ?>-title-loader">
								<a href="<?php echo esc_url( plugins_url( '../assets/images/shimmer-title-loader.gif', __FILE__ ) ); ?>" >
									<img src="<?php echo esc_url( plugins_url( '../assets/images/shimmer-title-loader.gif', __FILE__ ) ); ?>" style="width: 100%;">
								</a>
							</div>
	
						</div>
	
					</div>
					<?php

					++$iterator;
				}

				++$product_index;
			}
		}

		// Handle the 'startover' button action.
		if ( isset( $_POST['start_over_btn'] ) ) {

			$feature_name      = isset( $_POST['feature_name'] ) ? sanitize_text_field( wp_unslash( $_POST['feature_name'] ) ) : '';
			$product_ids_array = isset( $_POST['product_ids_array'] ) ? sanitize_text_field( wp_unslash( $_POST['product_ids_array'] ) ) : array();
			$all_products      = explode( ',', $product_ids_array );
			$slider_limit      = isset( $_POST['products_limit_startover'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['products_limit_startover'] ) ) ) : '';

			$product_index = 0;

			// Display the products for the current page.
			foreach ( $all_products as $id ) {

				if ( intval( $id ) !== 0 && $iterator < $slider_limit ) {

					$product = wc_get_product( $id );
					?>
					<div class="rpwfr-product-container rpwfr-<?php echo esc_attr( $feature_name ); ?>-product-container" data-product_id="<?php echo esc_attr( $id ); ?>" data-index="<?php echo esc_attr( $product_index ); ?>" style="position: relative;">
	
						<div class="rpwfr-product-thumbnail" style="height: auto; position: relative;">
	
							<div class="rpwfr-loader rpwfr-<?php echo esc_attr( $feature_name ); ?>-loader" style="position: absolute;top: 15%;display:none;">
								<a href="<?php echo esc_url( plugins_url( '../assets/images/shimmer-loader5.gif', __FILE__ ) ); ?>">
									<img src="<?php echo esc_url( plugins_url( '../assets/images/shimmer-loader5.gif', __FILE__ ) ); ?>" style="max-width: 50%;">
								</a>
							</div>
	
							<a href="<?php echo esc_url( get_permalink( $id ) ); ?>">
								<?php
								$image      = $product->get_image_id();
								$image_size = get_option( 'rpwfr_general_product_image_size' ) ? get_option( 'rpwfr_general_product_image_size' ) : 'thumbnail';
								echo wp_kses_post( '<div class="rpwfr-image-container">' . wp_get_attachment_image( $image, $image_size ) . '</div>' );
								?>
							</a>
	
						</div>
	
						<div class="rpwfr-product-info">
	
							<div class="rpwfr-product-title">
								<a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_attr( get_the_title( $id ) ); ?></a>
							</div>
	
							<div class="rpwfr-<?php echo esc_attr( $feature_name ); ?>-title-loader">
								<a href="<?php echo esc_url( plugins_url( '../assets/images/shimmer-title-loader.gif', __FILE__ ) ); ?>" >
									<img src="<?php echo esc_url( plugins_url( '../assets/images/shimmer-title-loader.gif', __FILE__ ) ); ?>" style="width: 100%;">
								</a>
							</div>
	
						</div>
	
					</div>
					<?php
					// $iterator += 1;
					++$iterator;
				}

				// $product_index += 1;
				++$product_index;
			}
		}

		// Product displayed in shortcode on page reload.
		if ( isset( $_POST['slider_pagination_one'] ) ) {

			$feature_name      = isset( $_POST['feature_name'] ) ? sanitize_text_field( wp_unslash( $_POST['feature_name'] ) ) : '';
			$product_ids_array = isset( $_POST['product_ids_array'] ) ? sanitize_text_field( wp_unslash( $_POST['product_ids_array'] ) ) : '';
			$slider_limit      = isset( $_POST['products_limit_front'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['products_limit_front'] ) ) ) : '';
			$all_products      = explode( ',', $product_ids_array );
			$product_index     = 0;

			// Display the products for the current page.
			foreach ( $all_products as $id ) {
				if ( intval( $id ) !== 0 && $iterator < $slider_limit ) {
					$product = wc_get_product( $id );
					?>
					<div class="rpwfr-product-container rpwfr-<?php echo esc_attr( $feature_name ); ?>-product-container" data-product_id="<?php echo esc_attr( $id ); ?>" data-index="<?php echo esc_attr( $product_index ); ?>" >
	
						<div class="rpwfr-product-thumbnail">					
						<a href="<?php echo esc_url( get_permalink( $id ) ); ?>">
							<?php
							$image      = $product->get_image_id();
							$image_size = get_option( 'rpwfr_general_product_image_size' ) ? get_option( 'rpwfr_general_product_image_size' ) : 'thumbnail';
							echo wp_kses_post( '<div class="rpwfr-image-container">' . wp_get_attachment_image( $image, $image_size ) . '</div>' );
							?>
						</a>
						</div>
						<div class="rpwfr-product-title">
							<a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_attr( get_the_title( $id ) ); ?></a>
						</div>
	
					</div>
					<?php
					// $iterator += 1;
					++$iterator;
				}

				// $product_index += 1;
				++$product_index;
			}
		}
	}

	wp_die();
}

// -------------------------------------------- AI AJAX part ------------------------------------------------.

add_action( 'wp_ajax_rpwfr_ai_send_prompt', 'rpwfr_ai_send_prompt' );
add_action( 'wp_ajax_nopriv_rpwfr_ai_send_prompt', 'rpwfr_ai_send_prompt' );

/**
 * Check token function.
 *
 * This function handles the form submission for sending prompts and calculating token usage for OpenAI API requests.
 * It processes the selected product details, builds the prompt, and updates various options for storing the data.
 */
function rpwfr_ai_send_prompt() {

	// Check if the form is submitted with a 'prompt'.
	if ( isset( $_POST['prompt'] ) ) {

		// Save the current AI request timestamp.
		update_option( 'rpwfr_current_ai_request', date( 'Y-m-d H:i:s' ) );

		// Save the selected product details (e.g., name, description).
		$selected_product_detail = $_POST['selected_options'];
		update_option( 'rpwfr_product_selected_options', $selected_product_detail );

		$prompt_product_data = array();  // Array to store product data for the prompt.
		$products            = $_POST['selected_products'];  // Get the selected product IDs.

		// Save the product type (e.g., all products, selected products).
		update_option( 'rpwfr_all_products', $_POST['selected_product_type'] );

		// Save the list of selected products.
		update_option( 'rpwfr_product_list', $_POST['selected_products'] );

		// Save the about store information.
		update_option( 'rpwfr_about_store', $_POST['about_store'] );

		// Check if the product name should be included in the prompt and save the option accordingly.
		if ( in_array( 'products_name', $selected_product_detail ) ) {
			update_option( 'rpwfr_products_name', 'on' );
		} else {
			update_option( 'rpwfr_products_name', '' );
		}

		// Check if the product description should be included in the prompt and save the option accordingly.
		if ( in_array( 'products_desc', $selected_product_detail ) ) {
			update_option( 'rpwfr_products_desc', 'on' );
		} else {
			update_option( 'rpwfr_products_desc', '' );
		}

		// Loop through the selected products and gather product details (name and description if selected).
		foreach ( $products as $product_id ) {
			$product            = wc_get_product( $product_id );  // Get WooCommerce product by ID.
			$temp               = array();
			$temp['product_id'] = $product_id;  // Store the product ID.

			// Include product name if selected.
			if ( in_array( 'products_name', $selected_product_detail ) ) {
				$temp['products_name'] = get_the_title( $product_id );
			}

			// Include product description if selected.
			if ( in_array( 'products_desc', $selected_product_detail ) ) {
				$temp['rpwfr_products_desc'] = strip_tags( $product->get_short_description() );
			}

			// Add product data to the prompt product data array.
			$prompt_product_data[] = $temp;
		}

		// Save the prompt type (e.g., default or custom).
		update_option( 'rpwfr_ai_prompt_type', $_POST['prompt_type'] );

		// Get the default AI prompt from options.
		$prompt_text = get_option( 'rpwfr_default_ai_prompt' );

		// Set the API request status to 'created' and indicate that the button has been clicked.
		update_option( 'rpwfr_api_request_created_status', 'created' );
		update_option( 'rpwfr_prompt_request_button_hit', 1 );

		// Enable the AI request notice to display in the admin area.
		update_option( 'rpwfr_display_ai_request_notice', 'yes' );
	}

	// Check if the form is submitted with 'prompt_token' for calculating the token count.
	if ( isset( $_POST['prompt_token'] ) ) {

		// Get the prompt text and other form fields.
		$prompt_text           = $_POST['prompt_token'];
		$selected_options      = $_POST['selected_options'];
		$selected_product_type = $_POST['selected_product_type'];
		$selected_products     = $_POST['selected_products'];
		$about_store_text      = $_POST['about_store'];

		// Build the AI prompt with the provided data.
		$build_prompt = rpwfr_update_tokens( $prompt_text, $about_store_text, $selected_options, $selected_product_type, $selected_products );

		// Return the token count in JSON format.
		echo json_encode( $build_prompt['prompt_token'] );
	}

	// Check if the form is submitted with 'about_store' field to update the store details.
	if ( isset( $_POST['about_store'] ) ) {
		update_option( 'rpwfr_about_store', $_POST['about_store'] );
	}

	// Terminate the script (required in AJAX requests).
	wp_die();
}


add_action( 'wp_ajax_rpwfr_api_key_validation', 'rpwfr_api_key_validation' );
add_action( 'wp_ajax_nopriv_rpwfr_api_key_validation', 'rpwfr_api_key_validation' );

/**
 * Send the api response to check usage.
 */
function rpwfr_api_key_validation() {

	// Nonce verification.
	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$is_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $is_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	// Delete transient on validation is done.
	delete_transient( 'rpwfr_set_model_names' );

	// Get entered key data.
	$api_key_data = isset( $_POST['key_data'] ) ? sanitize_text_field( $_POST['key_data'] ) : 0;

	// Call the request and save data.
	$response_data = rpwfr_api_server_callback_validation( $api_key_data );

	// Get the api status value.
	$api_status = $response_data['status'];

	// If Status is on.
	if ( $api_status ) {

		// Send status data.
		echo wp_json_encode(
			array(
				'usage'  => get_option( 'rpwfr_api_usage_status' ),
				'status' => $api_status,
			)
		);
	} else {

		// Send status data.
		echo wp_json_encode(
			array(
				'usage'  => get_option( 'rpwfr_api_usage_status' ),
				'status' => 0,
			)
		);
	}

	wp_die();
}

/**
 * Account key info Validation.
 *
 * @param mixed $request .
 * @return mixed
 */
function rpwfr_api_server_callback_validation( $request ) {

	// Get Api key data.
	$api_key_data = isset( $request ) ? $request : 0;

	// Api request url.
	$model_api_url = 'https://api.openai.com/v1/models';

	// Set up the arguments for the request, including the headers.
	$request_args = array(
		'method'  => 'GET',
		'headers' => array(
			'Authorization' => 'Bearer ' . $api_key_data,
		),
		'timeout' => 50,
	);

	// Make the GET request to the OpenAI.
	$response = wp_remote_get( $model_api_url, $request_args );

	// Status code 200.
	if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 200 ) {

		// Decode the response from JSON.
		$response_data = json_decode( wp_remote_retrieve_body( $response ), true );

		// Access the token usage information.
		$total_tokens_used = $response_data['data']['total_tokens'] ? $response_data['data']['total_tokens'] : '';

		// Prepare the final response with the OpenAI API response.
		$status_response = array(
			'status'           => 1,
			'used_token'       => $total_tokens_used,
			'data'             => $response_data,
			'openai_sresponse' => $response,
		);

		// Update the model name and usage data.
		update_option( 'rpwfr_api_model_name', 'gpt-4o' );
		update_option( 'rpwfr_api_valid_key_status', 1 );
		update_option( 'rpwfr_api_usage_status', 'Your API Key is Valid !' );

		return $status_response;
	}

	// Check for errors in the response.
	if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 500 ) {
		update_option( 'rpwfr_api_usage_status', 'Request to OpenAI API failed.' );
		return new WP_Error( 'request_failed', 'Request to OpenAI API failed.' );
	}

	// Check for errors in the response bad request.
	if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 400 ) {

		// Prepare the final response with the OpenAI API response.
		$final_response = array(
			'status'          => 0,
			'openai_response' => 'Your Key Bad Request!',
		);

		update_option( 'rpwfr_api_valid_key_status', 0 );
		update_option( 'rpwfr_api_usage_status', 'Your Key Bad Request !' );

		return $final_response;
	}

	// Check for errors in the response on quota exceed.
	if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 429 ) {

		// Prepare the final response with the OpenAI API response.
		$final_response = array(
			'status'          => 0,
			'openai_response' => 'Insufficient Quota',
		);

		update_option( 'rpwfr_api_valid_key_status', 0 );
		update_option( 'rpwfr_api_usage_status', 'Insufficient Quota' );

		return $final_response;
	}

	// Check for errors in the response on incorrect API Key.
	if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 401 ) {

		// Prepare the final response with the OpenAI API response.
		$final_response = array(
			'status'           => 0,
			'openai_response'  => 'The requesting API key is not correct.',
			'openai_sresponse' => $response,
		);

		update_option( 'rpwfr_api_valid_key_status', 0 );
		update_option( 'rpwfr_api_usage_status', 'The requesting API key is not correct.' );

		return $final_response;
	}

	// Check for errors in the response un-supported country.
	if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 403 ) {

		// Prepare the final response with the OpenAI API response.
		$final_response = array(
			'status'          => 0,
			'openai_response' => 'You are accessing the API from an unsupported country, region, or territory.',
		);

		update_option( 'rpwfr_api_valid_key_status', 0 );
		update_option( 'rpwfr_api_usage_status', 'You are accessing the API from an unsupported country, region, or territory.' );

		return $final_response;
	}

	// Check for errors if the system is overloaded.
	if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 503 ) {

		// Prepare the final response with the OpenAI API response.
		$final_response = array(
			'status'          => 0,
			'openai_response' => 'System Overloaded',
		);

		update_option( 'rpwfr_api_valid_key_status', 0 );
		update_option( 'rpwfr_api_usage_status', 'System Overloaded' );

		return $final_response;
	}
}

/**
 * Fetch valid model names.
 *
 * @param mixed $model_names .
 * @param mixed $api_key_data .
 * @return mixed
 */
function rpwfr_get_valid_model_names( $model_names, $api_key_data ) {

	$valid_model = array();

	// Iterate all the model names.
	foreach ( $model_names as $model ) {

		// Get the model name.
		$model_name = $model['id'];

		// The API endpoint for the OpenAI completions API.
		$request_model_url = 'https://api.openai.com/v1/chat/completions';

		// Request body array.
		$request_body = array(
			'model'             => $model_name,
			'messages'          => array(
				array(
					'role'    => 'user',
					'content' => 'how are you ?',
				),
			),
			'max_tokens'        => 4096,
			'temperature'       => 0.7,
			'top_p'             => 1,
			'frequency_penalty' => 0,
			'presence_penalty'  => 0,
		);

		// Set up the arguments for the request, including the headers and body.
		$args = array(
			'method'  => 'POST',
			'headers' => array(
				'Content-Type'  => 'application/json',
				'Authorization' => 'Bearer ' . $api_key_data,
			),
			'body'    => wp_json_encode( $request_body ),
			'timeout' => 100,
		);

		// Make the POST request to the OpenAI.
		$response_data = wp_remote_post( $request_model_url, $args );

		// Check the response code.
		if ( ! in_array( $response_data['response']['code'], array( '404', '403', '400', '429', '401', '403', '503' ) ) ) {
			array_push( $valid_model, $model['id'] );
		}
	}

	return $valid_model;
}

/**
 * Save date and time and value on option update.
 *
 * @param mixed $date .
 * @param mixed $time .
 * @param mixed $count .
 * @param mixed $value .
 */
function rpwfr_save_data_with_date_and_time( $date, $time, $count = 0, $value ) {

	$option_name = 'rpwfr_ai_request_logs';

	$existing_data = get_option( $option_name );

	// Check if the date key exists.
	if ( ! isset( $existing_data[ $date ] ) ) {
		$existing_data[ $date ] = array();
	}

	// Update the data for the specified date and time.
	$existing_data[ $date ][ $time ] = $value;

	// Save the updated data back to the option.
	update_option( $option_name, $existing_data );
}
