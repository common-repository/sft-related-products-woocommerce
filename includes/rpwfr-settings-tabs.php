<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'admin_menu', 'rpwfr_setting_api_options_page' );

/**
 * Function to add menu to setting and submenu to that menu.
 */
function rpwfr_setting_api_options_page() {

	require_once ABSPATH . 'wp-admin/includes/plugin.php';

	add_menu_page( '', __( 'Related Products', 'sft-related-products-woocommerce' ), 'manage_options', 'rpwfr_menu', 'rpwfr_setting_page' );

	// Rally Bulk edit sub-menu.
	add_submenu_page( 'rpwfr_menu', 'related-upsells-cross-sells', __( 'Related, UpSells & Cross-Sells', 'sft-related-products-woocommerce' ), 'manage_options', 'rpwfr_bulk_setting_menu', 'rpwfr_bulk_edit_upsells_submenu_page_callback' );
	// --------------------------------------------------------------------------------
	// add_menu_page(
	// __( 'SaffireTech Plugins', 'woocommerce-related-products-pro' ), // Page title.
	// __( 'SaffireTech Plugins', 'woocommerce-related-products-pro' ), // Menu title.
	// 'manage_options',
	// 'sft-plugins-menu-page',
	// 'sft_promo_plugins_page',
	// 'rpwfr_api_integration_settings_section',
	// 'dashicons-admin-tools',                                    // Icon URL.
	// 101                                                         // Position.
	// );

	add_submenu_page(
		'rpwfr_menu',
		'Chat GPT (API) Key Settings',
		__( 'Chat GPT (API) Key Settings', 'woocommerce-related-products-pro' ),
		'manage_options',
		'rpwfr_api_setting_page',
		'rpwfr_api_integration_settings_section'
	);

	// add_submenu_page(
	// 'sft-plugins-menu-page',
	// 'Logs',
	// __( 'API Request Logs', 'woocommerce-related-products-pro' ),
	// 'manage_options',
	// 'sft_ai_logs_page',
	// 'sft_api_integration_logs'
	// );
	// -------------------------------------------------------------------------------------
}

/**
 * Displaying page HTML and print settings .
 */
function rpwfr_setting_page() {

	// nonce verification.
	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$id_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $id_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<?php
		$tabs = array(
			'general' => __( 'General', 'sft-related-products-woocommerce' ),
			'related' => __( 'Related Products', 'sft-related-products-woocommerce' ),
			'upsells' => __( 'Upsells Products  ', 'sft-related-products-woocommerce' ) . '<img class="rpwfr-pro-feature-icon" src="'. esc_url( plugins_url( '../assets/images/pro-feature-crown.png', __FILE__ ) ) .'" width="16px" height="16px" />',
		);

		$current_tab = isset( $_GET['tab'] ) && isset( $tabs[ $_GET['tab'] ] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : array_key_first( $tabs );
		?>

		<form method="post" action="options.php" class="rpwfr-setting-tabs">
			<nav class="nav-tab-wrapper">
				<div class="rpwfr-tabs-ul">
					<?php
					foreach ( $tabs as $tab => $name ) {
						// CSS class for a current tab.
						$current = $tab === $current_tab ? ' nav-tab-active' : '';
						$url     = admin_url( 'admin.php' );
						// printing the tab link.
						echo wp_kses_post( "<a class=\"nav-tab{$current}\" href=\"{$url}?page=rpwfr_menu&tab={$tab}\">{$name}</a>" );
					}
					?>
				</div>

				<div class="rpwfr-upgrade-pro-btn">
					<a href="https://www.saffiretech.com/woocommerce-related-products-pro/?utm_source=wp_plugin&utm_medium=profield&utm_campaign=free2pro&utm_id=c1&utm_term=upgrade_now&utm_content=rpwfr" target="_blank">
						<button class="rpwfr-upgrade-to-pro-btn"  onclick="window.open('https://www.saffiretech.com/woocommerce-related-products-pro/?utm_source=wp_plugin&utm_medium=profield&utm_campaign=free2pro&utm_id=c1&utm_term=upgrade_now&utm_content=rpwfr', '_blank')">
							<?php esc_html_e( 'Upgrade To Pro!', 'sft-related-products-woocommerce' ); ?>
						</button>
					</a>
				</div>
			</nav>

			<div class="rpwfr-setting-section">
				<?php
					settings_fields( "rpwfr_page_{$current_tab}_settings" );
					do_settings_sections( "rpwfr_page_{$current_tab}" );
				?>
				<div class="rpwfr-submt-btn">
					<span class="rpwfr-<?php echo esc_attr( $tab ); ?>-submit-btn"><?php submit_button(); ?></span>
				</div>
			</div>		
		</form>
	</div>

	<!-- New Footer Banner -->
	<div class="sft-rpwfr-upgrade-to-pro-banner">
		<div class="sft-uppro-inner-container">
			<div class="sft-uppro-main-logo">
				<a href="<?php echo esc_url( plugins_url( '../assets/images/saffiretech_logo.png', __FILE__ ) ); ?>">
					<img src="<?php echo esc_url( plugins_url( '../assets/images/saffiretech_logo.png', __FILE__ ) ); ?>">
				</a>
			</div>
		</div>

		<div class="sft-uppro-hidden-desktop">
			<h2><?php esc_html_e( 'Unlock Advanced Features For Related Products', 'sft-related-products-woocommerce' ); ?></h2>
		</div>

		<div class="sft-uppro-details-container">
			<div class="sft-uppro-money-back-guarantee">
				<div>
					<a href="<?php echo esc_url( plugins_url( '../assets/images/moneyback-badge.png', __FILE__ ) ); ?>">
						<img src="<?php echo esc_url( plugins_url( '../assets/images/moneyback-badge.png', __FILE__ ) ); ?>">
					</a>
				</div>
				<div>
					<h2><?php esc_html_e( 'Unlock Advanced Features For Related Products', 'sft-related-products-woocommerce' ); ?></h2> 
					<h3><?php esc_html_e( '100% Risk-Free Money Back Guarantee!', 'sft-related-products-woocommerce' ); ?></h3>
					<p><?php esc_html_e( 'We guarantee you a complete refund for new purchases or renewals if a request is made within 15 Days of purchase.', 'sft-related-products-woocommerce' ); ?></p>
					<div class="rpwfr-upgrade-pro-btn">
						<a href="https://www.saffiretech.com/woocommerce-related-products-pro/?utm_source=wp_plugin&utm_medium=profield&utm_campaign=free2pro&utm_id=c1&utm_term=upgrade_now&utm_content=rpwfr" target="_blank">
							<button class="rpwfr-upgrade-to-pro-btn"  onclick="window.open('https://www.saffiretech.com/woocommerce-related-products-pro/?utm_source=wp_plugin&utm_medium=profield&utm_campaign=free2pro&utm_id=c1&utm_term=upgrade_now&utm_content=rpwfr', '_blank')">
								<?php esc_html_e( 'Upgrade To Pro!', 'sft-related-products-woocommerce' ); ?>
							</button>
						</a>
					</div>
				</div>
			</div>

			<div class="sft-uppro-features-container">
				<h3> <?php echo esc_html__( 'Pro Features', 'sft-related-products-woocommerce' ); ?></h3>
				<ul>
					<li><img width="15px" height="13px" src="<?php echo esc_url( plugins_url( '../assets/images/footer-green-tick.svg', __FILE__ ) ); ?>"> <strong><?php echo esc_html__( 'Bulk Management:', 'sft-related-products-woocommerce' ); ?></strong> <?php echo esc_html__( 'Bulk Update Related Products, Upsells, and Cross-Sells for your entire store from a single screen.', 'sft-related-products-woocommerce' ); ?></li>
					<li><img width="15px" height="13px" src="<?php echo esc_url( plugins_url( '../assets/images/footer-green-tick.svg', __FILE__ ) ); ?>"> <strong><?php echo esc_html__( 'Custom Shortcode with "AJAX Slider":', 'sft-related-products-woocommerce' ); ?></strong> <?php echo esc_html__( 'Fast-loading, customizable related products showcase, with an efficient shortcode for placement anywhere.', 'sft-related-products-woocommerce' ); ?></li>
					<li><img width="15px" height="13px" src="<?php echo esc_url( plugins_url( '../assets/images/footer-green-tick.svg', __FILE__ ) ); ?>"> <strong><?php echo esc_html__( 'Custom Control:', 'sft-related-products-woocommerce' ); ?></strong> <?php echo esc_html__( 'Handpick each item in the "Related Products" section for tailored product recommendations.', 'sft-related-products-woocommerce' ); ?></li>
					<li><img width="15px" height="13px" src="<?php echo esc_url( plugins_url( '../assets/images/footer-green-tick.svg', __FILE__ ) ); ?>"> <strong><?php echo esc_html__( 'Sales Boost:', 'sft-related-products-woocommerce' ); ?></strong> <?php echo esc_html__( 'Increase average order value and revenue by displaying more relevant products to customers.', 'sft-related-products-woocommerce' ); ?></li>
					<li><img width="15px" height="13px" src="<?php echo esc_url( plugins_url( '../assets/images/footer-green-tick.svg', __FILE__ ) ); ?>"> <strong><?php echo esc_html__( 'AI Powered Product Suggestions:', 'sft-related-products-woocommerce' ); ?></strong> <?php echo esc_html__( 'Boosts sales by using ChatGPT to suggest related products, enhancing customer experience and conversion rates.', 'sft-related-products-woocommerce' ); ?></li>
				</ul>
			</div>

		</div>

	</div>

	<?php
}

add_action( 'admin_init', 'rpwfr_add_tab_setting' );

/**
 * Register all settings.
 */
function rpwfr_add_tab_setting() {

	// ----------------------- General ---------------------------------

	$page_slug    = 'rpwfr_page_general';
	$option_group = 'rpwfr_page_general_settings';

	add_settings_section( 'rpwfr_section', '', '', $page_slug );

	// register fields.
	register_setting( $option_group, 'rpwfr_general_color_picker_btn' );
	register_setting( $option_group, 'rpwfr_general_color_picker_background_front' );
	register_setting( $option_group, 'rpwfr_general_product_image_size' );
	register_setting( $option_group, 'rpwfr_button_arrow_color' );

	add_settings_field(
		'rpwfr_bgcolor_row',
		__( 'Select Background Color', 'sft-related-products-woocommerce' ),
		'rpwfr_general_bgcolor_picker_field',
		$page_slug,
		'rpwfr_section',
	);

	// Field to pick cololr for back and next button.
	add_settings_field(
		'rpwfr_color_picker_row',
		__( 'Select Button Color', 'sft-related-products-woocommerce' ),
		'rpwfr_general_color_picker_field',
		$page_slug,
		'rpwfr_section',
	);

	add_settings_field(
		'rpwfr_arrow_color_row',
		__( 'Select Button Arrow Icon Color', 'sft-related-products-woocommerce' ),
		'rpwfr_color_picker_field_for_arrow_icon',
		$page_slug,
		'rpwfr_section',
	);

	add_settings_field(
		'rpwfr_image_size_row',
		__( 'Product Image Size', 'sft-related-products-woocommerce' ),
		'rpwfr_general_image_size_field',
		$page_slug,
		'rpwfr_section',
	);

	// ----------------------Related Products-----------------------------------------------------.

	$page_slug    = 'rpwfr_page_related';
	$option_group = 'rpwfr_page_related_settings';

	// add section.
	add_settings_section( 'rpwfr_related_section', '', '', $page_slug );

	// register fields.
	register_setting( $option_group, 'rpwfr_display_related_products' );
	register_setting( $option_group, 'rpwfr_display_mode_related_products' );
	register_setting( $option_group, 'rpwfr_theme_column_limit' );
	register_setting( $option_group, 'rpwfr_theme_products_limit' );
	register_setting( $option_group, 'rpwfr_shortcode_mode_related_products' );
	register_setting( $option_group, 'rpwfr_related_title' );
	register_setting( $option_group, 'rpwfr_redirect_see_more_selection' );
	register_setting( $option_group, 'rpwfr_redirect_another_page' );
	register_setting( $option_group, 'rpwfr_desktop' );
	register_setting( $option_group, 'rpwfr_mobile' );
	register_setting( $option_group, 'rpwfr_tab' );
	register_setting( $option_group, 'rpwfr_related_out_of_stock' );

	// add fields.
	add_settings_field(
		'rpwfr_display_related_products',
		__( 'Product Display Mode', 'sft-related-products-woocommerce' ),
		'rpwfr_display_related_products_field',
		$page_slug,
		'rpwfr_related_section',
	);

	add_settings_field(
		'rpwfr_display_mode_related_products',
		__( 'Related Product Display Mode', 'sft-related-products-woocommerce' ),
		'rpwfr_display_mode_related_products_field',
		$page_slug,
		'rpwfr_related_section',
	);

	add_settings_field(
		'rpwfr_theme_column_limit',
		__( 'Number of Columns', 'sft-related-products-woocommerce' ),
		'rpwfr_theme_column_limit_field',
		$page_slug,
		'rpwfr_related_section',
	);

	add_settings_field(
		'rpwfr_theme_products_limit',
		__( 'Number of Products to Display', 'sft-related-products-woocommerce' ),
		'rpwfr_theme_products_limit_field',
		$page_slug,
		'rpwfr_related_section',
	);

	add_settings_field(
		'rpwfr_shortcode_mode_related_products',
		__( 'Ajax Slider Options', 'sft-related-products-woocommerce' ),
		'rpwfr_shortcode_mode_related_products_field',
		$page_slug,
		'rpwfr_related_section',
	);

	add_settings_field(
		'rpwfr_related_title',
		__( 'Title for Widget', 'sft-related-products-woocommerce' ),
		'rpwfr_label_field',
		$page_slug,
		'rpwfr_related_section',
	);

	add_settings_field(
		'rpwfr_proudcts_limit_value',
		__( 'Products Per Row', 'sft-related-products-woocommerce' ),
		'rpwfr_products_per_row_field',
		$page_slug,
		'rpwfr_related_section',
	);

	add_settings_field(
		'rpwfr_related_out_of_stock',
		__( 'Remove Out-of-Stock Products', 'sft-related-products-woocommerce' ) . '<span class="rpwfr-pro">Pro</span>',
		'rpwfr_outofstock_field',
		$page_slug,
		'rpwfr_related_section',
	);

	// --------------------------------Upsells Products-------------------------------------------------

	$page_slug    = 'rpwfr_page_upsells';
	$option_group = 'rpwfr_page_upsells_settings';

	// add section.
	add_settings_section( 'rpwfr_upsells_section', '', '', $page_slug );

	// register fields.
	register_setting( $option_group, 'rpwfr_display_upsells_products' );
	register_setting( $option_group, 'rpwfr_display_mode_upsells_products' );
	register_setting( $option_group, 'rpwfr_upsells_theme_column_limit' );
	register_setting( $option_group, 'rpwfr_upsells_theme_products_limit' );
	register_setting( $option_group, 'rpwfr_shortcode_mode_upsells_products' );
	register_setting( $option_group, 'rpwfr_upsells_title' );
	register_setting( $option_group, 'rpwfr_upsells_desktop' );
	register_setting( $option_group, 'rpwfr_upsells_mobile' );
	register_setting( $option_group, 'rpwfr_upsells_tab' );
	register_setting( $option_group, 'rpwfr_upsells_color_picker_btn' );
	register_setting( $option_group, 'rpwfr_upsells_color_picker_background_front' );
	register_setting( $option_group, 'rpwfr_upsells_product_image_size' );

	// add fields.
	add_settings_field(
		'rpwfr_display_upsells_products',
		__( 'Product Display Mode', 'sft-related-products-woocommerce' ) . '<span class="rpwfr-pro">Pro</span>',
		'rpwfr_display_upsells_products_field',
		$page_slug,
		'rpwfr_upsells_section',
	);

	// add fields.
	add_settings_field(
		'rpwfr_display_mode_upsells_products',
		__( 'UpSells Product Display Mode', 'sft-related-products-woocommerce' ) . '<span class="rpwfr-pro">Pro</span>',
		'rpwfr_display_mode_upsells_products_field',
		$page_slug,
		'rpwfr_upsells_section',
	);

	// add fields.
	add_settings_field(
		'rpwfr_upsells_title',
		__( 'Title for Widget', 'sft-related-products-woocommerce' ) . '<span class="rpwfr-pro">Pro</span>',
		'rpwfr_upsells_widget_title',
		$page_slug,
		'rpwfr_upsells_section',
	);

	// add fields.
	add_settings_field(
		'rpwfr_upsells_proudcts_limit_value',
		__( 'Products Per Row', 'sft-related-products-woocommerce' ) . '<span class="rpwfr-pro">Pro</span>',
		'rpwfr_upsells_products_per_row_field',
		$page_slug,
		'rpwfr_upsells_section',
	);
	// -------------------------------------------------------------------------------
	// ========================api settings======================
	add_settings_section( 'rpwfr-account-settings-group', '', null, 'rpwfr-ai-key-settings-options' );

	// Setting api key enter.
	register_setting( 'rpwfr-api-field-setting', 'rpwfr_openai_api_key' );
	add_settings_field(
		'rpwfr_openai_api_key',
		esc_attr__( 'Enter Open AI API Key', 'woocommerce-related-products-pro' ),
		'rpwfr_get_ai_api_key_field',
		'rpwfr-ai-key-settings-options',
		'rpwfr-account-settings-group'
	);

	// Setting api model select.
	register_setting( 'rpwfr-api-field-setting', 'rpwfr_openai_api_model' );
	add_settings_field(
		'rpwfr_openai_api_model',
		esc_attr__( 'Select OpenAi Model', 'woocommerce-related-products-pro' ),
		'rpwfr_get_ai_api_model_field',
		'rpwfr-ai-key-settings-options',
		'rpwfr-account-settings-group'
	);
	// --------------------------------------------------------------------------------
}

/**
 * Color picker field arrow.
 */
function rpwfr_color_picker_field_for_arrow_icon() {
	$value = get_option( 'rpwfr_button_arrow_color' );
	?>

	<div style="display: flex; align-items: center;margin-bottom: 10px;">
		<?php
		if ( $value ) {
			?>
			<div style="display: flex; align-items: center;">
				<input type="text" class="rpwfr-btn-color" name="rpwfr_button_arrow_color" value="<?php echo get_option( 'rpwfr_button_arrow_color' ); ?>" placeholder="Add label">
			</div>
			<?php
		} else {
			?>
			<div style="display: flex; align-items: center;">
				<input type="text" class="rpwfr-btn-color" name="rpwfr_button_arrow_color" value="#FFF" placeholder="Add label">
			</div>
			<?php
		}
		?>
		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to pick the color to change color of previous and next button within shortcode', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
	<?php

}

// ----------------------------------------------------------------------

/**
 * Api key section.
 */
function rpwfr_api_integration_settings_section() {
	?>
	<div class="pluginHeadingwrap">

		<section class="pluginHeader">
			<div class="headerRight">
			</div>
		</section>

		<main>
			<div class="notificationGrup"></div>

			<!-- Form saving api key -->
			<form method="post" action="options.php">
				<?php
				settings_fields( 'rpwfr-api-field-setting' );
				do_settings_sections( 'rpwfr-ai-key-settings-options' );
				?>
				<input type="submit" name="rpwfr_save_key" class="button button-primary" value="<?php echo esc_html__( 'Save API Key', 'woocommerce-related-products-pro' ); ?>">
			</form><br><br />
		</main>
	</div>
	<?php
}

/**
 * Api Logs section.
 */
function rpwfr_api_integration_logs_settings_section() {

	// If view is set.
	if ( isset( $_GET['view'] ) ) {
		update_option( 'rpwfr_view_hit', 1 );
	}

	if ( ( ! isset( $_GET['tab'] ) ) || ( $_GET['tab'] == 'related_products' ) ) {
		?>
		<div>
			<!-- <div class="rpwfr-log-tab" id="tab2" onclick="showContent('content2')">Previous Logs</div> -->
			<?php echo rpwfr_get_log_request_status(); ?>
		</div>

		<div class="rpwfr-log-content-main-container">
			<div class="rpwfr-log-content-container" id="content2">
			</div>
		</div>
		<?php
	}

	if ( $_GET['tab'] == 'product_recommendation' ) {
		echo 'recommendations';
	}
}

/**
 * To display To get API Key.
 */
function rpwfr_get_ai_api_key_field() {
	$display_key_status = '';
	?>
	<div class="rpwfr-add-api-key-container">
		<input type="text" class="rpwfr-token-invalid" name="rpwfr_openai_api_key" id="rpwfr_api_key" value="<?php echo esc_attr( get_option( 'rpwfr_openai_api_key' ) ); ?>" />
		<input type="button" name="rpwfr_ajax_button" class="rpwfr_ajax_button" id="rpwfr_ajax_button" value="<?php echo esc_html_e( 'Validate API Key', 'woocommerce-related-products-pro' ); ?>" />
		<span style="margin-top: 12px;"><a href="https://www.saffiretech.com/docs/sft-woocommerce-related-products/" target='_blank'><?php echo esc_html__( 'learn more', 'woocommerce-related-products-pro' ); ?></a></span>
	</div>

	<div class="rpwfr-add-api-key-message-container">
		<?php
		if ( get_option( 'rpwfr_api_valid_key_status' ) == 1 ) {
			$display_key_status = '<i class="fas fa-check-circle" style="color: green;"></i> ' . __( 'Your API key is valid!', 'woocommerce-related-products-pro' );
		} else {
			$display_key_status = '<i class="fas fa-times-circle" style="color: red;"></i> ' . __( 'Please Enter Valid API key!', 'woocommerce-related-products-pro' );
		}
		?>
		<span id="rpwfr-key-valid-message"><?php echo wp_kses_post( $display_key_status ); ?></span>
	</div>
	<?php
}

/**
 * To display all chat model name available with this api key.
 */
function rpwfr_get_ai_api_model_field() {

	// Call the request and save data.
	$api_key_data = get_option( 'rpwfr_openai_api_key' );

	if ( $api_key_data == '' ) {
		echo esc_html__( 'API Key is required to fetch models', 'sft-related-products-woocommerce' );
		?>
		<!-- loader status -->
		<p class="rpwfr-ai-message-data"></p>
		<?php
	} else {

		// Check existing models if not found refresh the models again.
		if ( ( false === get_transient( 'rpwfr_set_model_names' ) ) || ( empty( get_transient( 'rpwfr_set_model_names' ) ) ) ) {

			// Get the api response data for model names.
			$response_data = rpwfr_api_server_callback_validation( $api_key_data );
			$model_names   = $response_data['data']['data'];

			// Get the valid model names.
			$model_data = rpwfr_get_valid_model_names( $model_names, $api_key_data );

			// If valid models found.
			if ( $model_data ) {

				// Initally update the first model names for dropdown to option.
				update_option( 'rpwfr_openai_api_model', $model_data[0] );

				// Refresh models after one month.
				set_transient( 'rpwfr_set_model_names', $model_data, 2628000 );

				// Get the selected model name.
				$selected_model = get_option( 'rpwfr_openai_api_model' );

				// Update insufficient quota to empty.
				update_option( 'rpwfr_api_request_created_status', '' );
				?>

				<!-- Load all the valid model names -->
				<select name="rpwfr_openai_api_model" class="rpwfr_openai_api_model">
					<?php
					foreach ( $model_data as $model ) {
						if ( $selected_model == $model ) {
							?>
							<option value="<?php echo esc_html( $model ); ?>" selected><?php echo esc_html( $model ); ?></option>
							<?php
						} else {
							?>
							<option value="<?php echo esc_html( $model ); ?>"><?php echo esc_html( $model ); ?></option>
							<?php
						}
					}
					?>
				</select>

				<!-- loader status -->
				<p class="rpwfr-ai-message-data"></p>
				<?php
			} else {

				// Update insufficient quota.
				update_option( 'rpwfr_api_request_created_status', 'insufficient_quota' );
				?>

				<!-- loader status -->
				<p class="rpwfr-ai-message-data"><?php echo esc_html__( 'It looks like you don\'t have access to the ChatGPT model with your current API key.', 'sft-related-products-woocommerce' ); ?><br/> 
				<?php echo esc_html__( 'To resolve this please check your subscription by visiting the', 'sft-related-products-woocommerce' ); ?> <a href="https://platform.openai.com/settings/organization/billing/"><?php echo esc_html__( 'billing', 'sft-related-products-woocommerce' ); ?></a> <?php echo esc_html__( 'page.', 'sft-related-products-woocommerce' ); ?></p>
				<?php
			}
		} else {

			// All the stored model data.
			$model_data = get_transient( 'rpwfr_set_model_names' );

			// Get the selected model name.
			$selected_model = get_option( 'rpwfr_openai_api_model' );
			?>

			<!-- Load all the valid model names -->
			<select name="rpwfr_openai_api_model" class="rpwfr_openai_api_model">
				<?php
				// If model data exist.
				if ( ! empty( $model_data ) ) {
					foreach ( $model_data as $model ) {

						if ( $model == $selected_model ) {
							?>
							<option value="<?php echo esc_html( $model ); ?>" selected><?php echo esc_html( $model ); ?></option>
							<?php
						} else {
							?>
							<option value="<?php echo esc_html( $model ); ?>"><?php echo esc_html( $model ); ?></option>
							<?php
						}
					}
				} else {
					?>
					<option value="0"><?php echo esc_html( 'No Models Found !', 'sft-related-products-woocommerce' ); ?></option>
					<?php
				}
				?>
			</select>

			<!-- loader status -->
			<p class="rpwfr-ai-message-data"></p>
			<?php
		}
	}
}

/**
 * Request Logs status.
 */
function rpwfr_get_log_request_status() {
	global $wpdb;

	// Option name.
	$option_name  = 'rpwfr_ai_request_logs';
	$all_products = rpwfr_get_all_products_with_variations();
	$iterator     = 1;

	// Get the existing data from the option.
	$data = get_option( $option_name );

	// Get API Request Status.
	$api_key_status = ( get_option( 'rpwfr_api_request_created_status' ) ) ? get_option( 'rpwfr_api_request_created_status' ) : '';

	// Fetch the data from the table.
	$results = $wpdb->get_results(
		"SELECT id, request_time, prompt, product_selection_type,product_details, about_store, response, status, tokens_used 
	FROM {$wpdb->prefix}rpwfr_api_request_log ORDER BY request_time DESC"
	);

	// Get the number of rows.
	$num_rows = count( $results ) + 2;
	?>

	<!-- Log container -->
	<div class="rpwfr-log-main-container">

		<?php
		// IF empty data.
		if ( empty( $data ) ) {
			echo '<p>' . __( 'No data available.', 'woocommerce-related-products-pro' ) . '</p>';
			return;
		} else {
			if ( 'fulfilled' !== $api_key_status ) {

				$current_request_date_time         = get_option( 'rpwfr_current_ai_request' );
				$currrent_datetime_string          = $current_request_date_time;
				list($current_date, $current_time) = explode( ' ', $currrent_datetime_string );
				?>
				<div class="rpwfr-single-log-container rpwfr-log-current-status">
				<?php
				if ( 'created' === $api_key_status || 'pending' === $api_key_status ) {
					?>
						<div class="rpwfr-log-inner rpwfr-log-header">
						<div><?php echo esc_html__( 'Your request is being processed. Please reload the page to check the status update..!', 'woocommerce-related-products-pro' ); ?></div>
							<div class="rpwfr-log-header-details">
								<div class="rpwfr-log-ref-id"><?php echo '#' . $num_rows; ?></div>
								<div><b><?php echo esc_html__( 'Date:', 'woocommerce-related-products-pro' ); ?></b> <?php echo esc_attr( $current_date ); ?></div>
								<div><b><?php echo esc_html__( 'Time:', 'woocommerce-related-products-pro' ); ?></b> <?php echo esc_attr( $current_time ); ?></div>
								<div><span class="rpwfr-log-progress-msg">&#x2941; <?php echo esc_html__( 'Processing', 'woocommerce-related-products-pro' ); ?><span></div>
							</div>
						</div>
						<div class="rpwfr-log-extra-details"> <!-- Initially hide the details -->
							<div class="rpwfr-log-additional-details-container">
								<div class="rpwfr-log-inner">
									<?php
									if ( get_option( 'rpwfr_all_products' ) == 'all_products' ) {
										?>
											<h2><?php echo esc_html__( 'All products Selection', 'woocommerce-related-products-pro' ); ?></h2>
											<div><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Selected Products', 'woocommerce-related-products-pro' ); ?> (<?php echo esc_attr( count( $all_products ) ); ?>)</div>
											<?php
									} elseif ( get_option( 'rpwfr_all_products' ) == 'categories' ) {

										$category_ids = get_option( 'rpwfr_prompt_cat_selection', true );
										?>
											<h2><?php echo esc_html__( 'Categories Selection', 'woocommerce-related-products-pro' ); ?></h2>
											<div><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Selected Categories', 'woocommerce-related-products-pro' ); ?> (<?php echo esc_attr( count( $category_ids ) ); ?>)</div>
											<table class="rpwfr-log-product-table">
												<thead>
													<tr>
														<th><?php echo esc_html__( 'Category Id', 'woocommerce-related-products-pro' ); ?></th>
														<th><?php echo esc_html__( 'Category Name', 'woocommerce-related-products-pro' ); ?></th>
													</tr>
												</thead>
												<tbody>
												<?php
												foreach ( $category_ids as $category_id ) {
													$category = get_term( $category_id, 'product_cat' );

													?>
														<tr>
															<td><?php echo esc_attr( intval( $category_id ) ); ?></td>
															<td><?php echo esc_attr( $category->name ); ?></td>
														</tr>
														<?php
												}
												?>
												</tbody>
											</table>
											<?php

									} elseif ( get_option( 'rpwfr_all_products' ) == 'products' ) {
										$selected_products = get_option( 'rpwfr_product_list' );
										?>
											<h2><?php echo esc_html__( 'Products Selection', 'woocommerce-related-products-pro' ); ?></h2>
											<div>
												<span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Selected Products', 'woocommerce-related-products-pro' ); ?> (<?php echo esc_attr( count( $selected_products ) ); ?>)
											</div>
											<table class="rpwfr-log-product-table">
												<thead>
													<tr>
														<th><?php echo esc_html__( 'Product Id', 'woocommerce-related-products-pro' ); ?></th>
														<th><?php echo esc_html__( 'Product Name', 'woocommerce-related-products-pro' ); ?></th>
													</tr>
												</thead>
												<tbody>
												<?php
												foreach ( $selected_products as $product_id ) {
													$product_name = get_the_title( $product_id );
													?>
														<tr>
															<td><?php echo esc_attr( intval( $product_id ) ); ?></td>
															<td><?php echo esc_attr( $product_name ); ?></td>
														</tr>
														<?php
												}
												?>
												</tbody>
											</table>
											<?php
									}
									?>
								</div>

								<div class="rpwfr-log-inner">
									<h2><?php echo esc_html__( 'Product Details Included', 'woocommerce-related-products-pro' ); ?></h2>
									<div class="rpwfr-log-pr-details-container">
									<?php
									$product_details = get_option( 'rpwfr_product_selected_options' );
									if ( in_array( 'products_name', $product_details ) ) {
										?>
											<span><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Product Name', 'woocommerce-related-products-pro' ); ?></span>
										<?php
									}

									if ( in_array( 'product_url', $product_details ) ) {
										?>
											<span><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Product URL', 'woocommerce-related-products-pro' ); ?></span>
										<?php
									}

									if ( in_array( 'products_desc', $product_details ) ) {
										?>
											<span><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Product Description', 'woocommerce-related-products-pro' ); ?></span>
										<?php
									}

									if ( in_array( 'products_price', $product_details ) ) {
										?>
											<span><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Product Price', 'woocommerce-related-products-pro' ); ?></span>
										<?php
									}
									?>
									</div>
								</div>

								<div class="rpwfr-log-inner">
									<h2><?php echo esc_html__( 'Store Description', 'woocommerce-related-products-pro' ); ?></h2>
									<div>
									<?php
									echo esc_attr( get_option( 'rpwfr_about_store' ) );
									?>
									</div>
								</div>

								<div class="rpwfr-log-inner">
									<h2><?php echo esc_html__( 'Selected Prompt', 'woocommerce-related-products-pro' ); ?></h2>
									<div>
									<?php
									$prompt_text = '';
									if ( get_option( 'rpwfr_ai_prompt_type' ) == 'default' ) {
										$prompt_text = get_option( 'rpwfr_default_ai_prompt' );
									} elseif ( get_option( 'rpwfr_ai_prompt_type' ) == 'edit' ) {
										$prompt_text = get_option( 'rpwfr_ai_request_prompt' );
									}
									echo esc_html( $prompt_text );
									?>
									</div>
								</div>

								<div class="rpwfr-log-inner-last">
									<div><b><?php echo esc_html__( 'Tokens Used: ', 'woocommerce-related-products-pro' ); ?></b><?php echo esc_attr( get_option( 'rpwfr_tokens_used' ) ); ?></div>
								</div>
							</div>
						</div>
						<?php
				} elseif ( 'insufficient_quota' === $api_key_status ) {
					?>
					<div><?php echo esc_html__( 'We\'re sorry, but your current request could not be processed due to insufficient quota remaining on your API key.' ); ?></div>
					<div><?php echo esc_html__( 'It appears that you have used up most of your allocated quota. Please check your API usage or consider upgrading your plan.', 'woocommerce-related-products-pro' ); ?></div>
					<?php
				} elseif ( 'system_overloaded' === $api_key_status ) {
					?>
					<div><?php echo esc_html__( 'Unfortunately, we were unable to fulfill your request at this time because the API system is currently experiencing heavy load.', 'woocommerce-related-products-pro' ); ?></div>
					<div><?php echo esc_html__( 'Our servers are working at full capacity. Please try again in a few moments when the system has stabilized.', 'woocommerce-related-products-pro' ); ?></div>
					<?php
				} else {
					?>
					<div><?php echo esc_html__( 'There is no data available to display at the moment.', 'woocommerce-related-products-pro' ); ?></div>
					<div><?php echo esc_html__( 'Please check your request parameters or try again later for more information.', 'woocommerce-related-products-pro' ); ?></div>
					<?php
				}
				?>
				</div>
				<?php
			}

			if ( $results ) {
				// Display the data
				foreach ( $results as $row ) {

					$datetime_string   = $row->request_time;
					list($date, $time) = explode( ' ', $datetime_string );
					$status            = intval( $row->status ) ? 'success' : 'failed';
					$product_details   = explode( ',', $row->product_details );
					?>

					<div class="rpwfr-single-log-container">

						<div class="rpwfr-log-inner rpwfr-log-header">
							<div class="rpwfr-log-header-details">
								<div class="rpwfr-log-ref-id"><?php echo '#' . $row->id; ?></div>
								<div><b><?php echo esc_html__( 'Date: ', 'woocommerce-related-products-pro' ); ?></b> <?php echo esc_attr( $date ); ?></div>
								<div><b><?php echo esc_html__( 'Time: ', 'woocommerce-related-products-pro' ); ?></b> <?php echo esc_attr( $time ); ?></div>
								<div><span class="rpwfr-log-<?php echo esc_attr( $status ); ?>-msg"><?php echo esc_attr( $status ) == 'success' ? '&check; ' . esc_html__( 'Success', 'woocommerce-related-products-pro' ) : '&#x2715; ' . esc_html__( 'Failed', 'woocommerce-related-products-pro' ); ?></span></div>
							</div>
							<button class="rpwfr-log-toggle-details-btn"><?php echo esc_html__( 'Show Details', 'woocommerce-related-products-pro' ); ?></button>
						</div>


						<div class="rpwfr-log-extra-details" style="display: none;"> <!-- Initially hide the details -->
							<div class="rpwfr-log-additional-details-container">
								<div class="rpwfr-log-inner">

									<?php
									if ( $row->product_selection_type == 'all_products' ) {
										?>
										<h2><?php echo esc_html__( 'All products Selection', 'woocommerce-related-products-pro' ); ?></h2>
										<div><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Selected Products', 'woocommerce-related-products-pro' ); ?> (<?php echo esc_attr( count( $all_products ) ); ?>)</div>
										<?php
									} elseif ( $row->product_selection_type == 'categories' ) {

										$category_ids = get_option( 'rpwfr_prompt_cat_selection', true );
										?>
										<h2><?php echo esc_html__( 'Categories Selection', 'woocommerce-related-products-pro' ); ?></h2>
										<div><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Selected Categories', 'woocommerce-related-products-pro' ); ?> (<?php echo esc_attr( count( $category_ids ) ); ?>)</div>
										<table class="rpwfr-log-product-table">
											<thead>
												<tr>
													<th><?php echo esc_html__( 'Category Id', 'woocommerce-related-products-pro' ); ?></th>
													<th><?php echo esc_html__( 'Category Name', 'woocommerce-related-products-pro' ); ?></th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ( $category_ids as $category_id ) {
													$category = get_term( $category_id, 'product_cat' );

													?>
													<tr>
														<td><?php echo esc_attr( intval( $category_id ) ); ?></td>
														<td><?php echo esc_attr( $category->name ); ?></td>
													</tr>
													<?php
												}
												?>
											</tbody>
										</table>
										<?php

									} elseif ( $row->product_selection_type == 'products' ) {
										$selected_products = get_option( 'rpwfr_product_list' );
										?>
										<h2><?php echo esc_html__( 'Products Selection', 'woocommerce-related-products-pro' ); ?></h2>
										<div><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Selected Products', 'woocommerce-related-products-pro' ); ?> (<?php echo count( $selected_products ); ?>)</div>
										<table class="rpwfr-log-product-table">
											<thead>
												<tr>
													<th><?php echo esc_html__( 'Product Id', 'woocommerce-related-products-pro' ); ?></th>
													<th><?php echo esc_html__( 'Product Name', 'woocommerce-related-products-pro' ); ?></th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ( $selected_products as $product_id ) {
													$product_name = get_the_title( $product_id );
													?>
													<tr>
														<td><?php echo esc_attr( intval( $product_id ) ); ?></td>
														<td><?php echo esc_attr( $product_name ); ?></td>
													</tr>
													<?php
												}
												?>
											</tbody>
										</table>
										<?php
									}
									if ( $iterator == 1 ) {
										?>
										<div class="rpwfr-check-ai-products"><?php echo esc_html__( 'Check Products Set by AI', 'woocommerce-related-products-pro' ); ?></div>
										<?php
									}
									?>
								</div>

								<div class="rpwfr-log-inner">
									<h2><?php echo esc_html__( 'Product Details Included', 'woocommerce-related-products-pro' ); ?></h2>
									<div class="rpwfr-log-pr-details-container">
										<?php

										if ( in_array( 'products_name', $product_details ) ) {
											?>
											<span><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Product Name', 'woocommerce-related-products-pro' ); ?></span>
											<?php
										}

										if ( in_array( 'product_url', $product_details ) ) {
											?>
											<span><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Product URL', 'woocommerce-related-products-pro' ); ?></span>
											<?php
										}

										if ( in_array( 'products_desc', $product_details ) ) {
											?>
											<span><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Product Description', 'woocommerce-related-products-pro' ); ?></span>
											<?php
										}

										if ( in_array( 'products_price', $product_details ) ) {
											?>
											<span><span class="rpwfr-log-green-tick">&check;</span> <?php echo esc_html__( 'Product Price', 'woocommerce-related-products-pro' ); ?></span>
											<?php
										}
										?>
									</div>
								</div>

								<div class="rpwfr-log-inner">
									<h2><?php echo esc_html__( 'Store Description', 'woocommerce-related-products-pro' ); ?></h2>
									<div>
										<?php echo $row->about_store; ?>
									</div>
								</div>

								<div class="rpwfr-log-inner">
									<h2><?php echo esc_html__( 'Selected Prompt', 'woocommerce-related-products-pro' ); ?></h2>
									<div>
									<?php echo $row->prompt; ?>
									</div>
								</div>

								<div class="rpwfr-log-inner">
									<h2><?php echo esc_html__( 'Received Response', 'woocommerce-related-products-pro' ); ?></h2>
									<div><?php echo $status == 'success' ? esc_html__( 'Successfully set Cross sells, Related and Upsell products for the selected products.', 'woocommerce-related-products-pro' ) : esc_html__( 'Request Failed', 'woocommerce-related-products-pro' ); ?></div>
								</div>

								<div class="rpwfr-log-inner-last">
									<div><b><?php echo esc_html__( 'Total Tokens Used: ', 'woocommerce-related-products-pro' ); ?></b><?php echo $row->tokens_used; ?></div>
								</div>
							</div>
						</div>
					</div>

					
					<?php
					$iterator += 1;
				}
			}
		}
		?>
	</div>
	<div class="rpwfr-log-load-more-btn-container">
		<button id="rpwfr-log-load-more-button"><?php echo esc_html__( 'Load More', 'woocommerce-related-products-pro' ); ?></button>
	</div>
	<?php
}
