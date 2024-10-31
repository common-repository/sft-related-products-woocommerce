<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add Related settings menu function callback.
 */
function rpwfr_bulk_edit_upsells_submenu_page_callback() {
	?>
	<div class="rpwfr_buc-headingwrap">

		<section class="rpwfr_buc-header">
			<div>
				<h1><?php echo esc_attr__( 'Bulk Management: Set Related Products, UpSells & CrossSells in One Go', 'sft-related-products-woocommerce' ); ?> </h1>
			</div>
			<!-- --------------------------------------------------------------------------------------------------------- -->
			<button id="rpwfr-popup-button" class="button button-secondary">
				<svg fill="#FFFFFF" height="24px" width="24px" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M12,17c0.8-4.2,1.9-5.3,6.1-6.1c0.5-0.1,0.8-0.5,0.8-1s-0.3-0.9-0.8-1C13.9,8.1,12.8,7,12,2.8C11.9,2.3,11.5,2,11,2 c-0.5,0-0.9,0.3-1,0.8C9.2,7,8.1,8.1,3.9,8.9C3.5,9,3.1,9.4,3.1,9.9s0.3,0.9,0.8,1c4.2,0.8,5.3,1.9,6.1,6.1c0.1,0.5,0.5,0.8,1,0.8 S11.9,17.4,12,17z"></path> <path d="M22,24c-2.8-0.6-3.4-1.2-4-4c-0.1-0.5-0.5-0.8-1-0.8s-0.9,0.3-1,0.8c-0.6,2.8-1.2,3.4-4,4c-0.5,0.1-0.8,0.5-0.8,1 s0.3,0.9,0.8,1c2.8,0.6,3.4,1.2,4,4c0.1,0.5,0.5,0.8,1,0.8s0.9-0.3,1-0.8c0.6-2.8,1.2-3.4,4-4c0.5-0.1,0.8-0.5,0.8-1 S22.4,24.1,22,24z"></path> <path d="M29.2,14c-2.2-0.4-2.7-0.9-3.1-3.1c-0.1-0.5-0.5-0.8-1-0.8c-0.5,0-0.9,0.3-1,0.8c-0.4,2.2-0.9,2.7-3.1,3.1 c-0.5,0.1-0.8,0.5-0.8,1s0.3,0.9,0.8,1c2.2,0.4,2.7,0.9,3.1,3.1c0.1,0.5,0.5,0.8,1,0.8c0.5,0,0.9-0.3,1-0.8 c0.4-2.2,0.9-2.7,3.1-3.1c0.5-0.1,0.8-0.5,0.8-1S29.7,14.1,29.2,14z"></path> <path d="M5.7,22.3C5.4,22,5,21.9,4.6,22.1c-0.1,0-0.2,0.1-0.3,0.2c-0.1,0.1-0.2,0.2-0.2,0.3C4,22.7,4,22.9,4,23s0,0.3,0.1,0.4 c0.1,0.1,0.1,0.2,0.2,0.3c0.1,0.1,0.2,0.2,0.3,0.2C4.7,24,4.9,24,5,24c0.1,0,0.3,0,0.4-0.1s0.2-0.1,0.3-0.2 c0.1-0.1,0.2-0.2,0.2-0.3C6,23.3,6,23.1,6,23s0-0.3-0.1-0.4C5.9,22.5,5.8,22.4,5.7,22.3z"></path> <path d="M28,7c0.3,0,0.5-0.1,0.7-0.3C28.9,6.5,29,6.3,29,6s-0.1-0.5-0.3-0.7c-0.1-0.1-0.2-0.2-0.3-0.2c-0.2-0.1-0.5-0.1-0.8,0 c-0.1,0-0.2,0.1-0.3,0.2C27.1,5.5,27,5.7,27,6c0,0.3,0.1,0.5,0.3,0.7C27.5,6.9,27.7,7,28,7z"></path> </g> </g></svg>
				<div><?php echo esc_html__( 'Setup With AI !', 'sft-related-products-woocommerce' ); ?></div>
				<div class="rpwfr-popup-btn-tooltip-container" data-tooltip="Configuring Related, Upsell, and Cross-Sell Products with AI.">
					<svg width="18px" height="18px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(5.88,5.88), scale(0.51)"><rect x="0" y="0" width="24.00" height="24.00" rx="12" fill="#000000" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.048"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM12 17.75C12.4142 17.75 12.75 17.4142 12.75 17V11C12.75 10.5858 12.4142 10.25 12 10.25C11.5858 10.25 11.25 10.5858 11.25 11V17C11.25 17.4142 11.5858 17.75 12 17.75ZM12 7C12.5523 7 13 7.44772 13 8C13 8.55228 12.5523 9 12 9C11.4477 9 11 8.55228 11 8C11 7.44772 11.4477 7 12 7Z" fill="#ffffff"></path> </g></svg>
					<div class="rpwfr-ai-popup-btn-tooltip"><?php echo esc_html__( 'Configure Related, Upsell, and Cross-Sell Products with AI.', 'sft-related-products-woocommerce' ); ?></div>
				</div>
			</button>
			<!-- --------------------------------------------------------------------------------------------------------- -->
			<div class="rpwfr-collapse-bulk-screen"></div>
		</section>

		<main>
			<form method="get" id="rpwfr_buc-upsells-crosssell" action="options.php" style="width: 99.45%;">
				<?php
					settings_fields( 'rpwfr_buc-section' );
					do_settings_sections( 'rpwfr_bulk-edit-upsells-crosssells' );
				?>
				<div class="footerSavebutton">
					<button type="button" class="rpwfr_buc-save" id="rpwfr_buc-save-bottom" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 416c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg> <?php esc_html_e( 'Save', 'sft-related-products-woocommerce' ); ?></button>
				</div>
			</form>
		</main>

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
	</div>
	<?php
}

add_action( 'admin_init', 'rpwfr_bulk_edit_settings_function' );

/**
 * Function to add setting field for realted bulk edit.
 */
function rpwfr_bulk_edit_settings_function() {
	add_settings_section( 'rpwfr_buc-section', '', null, 'rpwfr_bulk-edit-upsells-crosssells' );
	add_settings_field( 'rpwfr_buc-product-categories', '', 'rpwfr_products_table', 'rpwfr_bulk-edit-upsells-crosssells', 'rpwfr_buc-section', array( 'class' => 'rpwfr_buc-settings-field' ) );
}

/**
 * Setting field callback function for filter dropdown and select field.
 */
function rpwfr_products_table() {

	// All allowed html tags.
	$allowed_html = array(
		'select' => array(
			'id'       => array(),
			'name'     => array(),
			'class'    => array(),
			'value'    => array(),
			'multiple' => array(),
		),
		'option' => array(
			'id'       => array(),
			'value'    => array(),
			'selected' => array(),
		),
	);
	?>

	<!-- Main bulk edit top header -->
	<div class="rpwfr_buc-filter-dropdown">
		<div id="rpwfr_buc-filter-header">

			<!-- Table header -->
			<div> 
				<select name="filter-type" id="filter-type">
					<option value="filter-by"><?php esc_html_e( 'Select Filter', 'sft-related-products-woocommerce' ); ?></option>
					<option id="rpwfr_buc-category" value="rpwfr_buc-category"><?php esc_html_e( 'Category', 'sft-related-products-woocommerce' ); ?></option>
					<option id="rpwfr_buc-tags" value="rpwfr_buc-tags"><?php esc_html_e( 'Tags', 'sft-related-products-woocommerce' ); ?></option>
					<option id="rpwfr_buc-sku" value="rpwfr_buc-sku"><?php esc_html_e( 'SKU', 'sft-related-products-woocommerce' ); ?></option>
					<option id="rpwfr_buc-product" value="rpwfr_buc-product"><?php esc_html_e( 'Product Name', 'sft-related-products-woocommerce' ); ?></option>
				</select>
			</div>

			<!-- Filter container of bulk edit -->
			<div id="rpwfr_buc-filter-container"> 

				<!-- Categoty select box -->
				<div id="rpwfr_buc-select-categories">
					<select class="rpwfr_buc-filter-box" id="rpwfr_buc-multiple-categories" name="rpwfr_buc-multiple-categories[]" data-placeholder="<?php echo esc_attr__( 'Search for categories…', 'sft-related-products-woocommerce' ); ?>" multiple="multiple">
						<?php echo wp_kses( rpwfr_select2_get_all_categories(), $allowed_html ); ?>
					</select>
				</div>

				<!-- Tag select box -->
				<div id="rpwfr_buc-select-tags">
					<select class="rpwfr_buc-filter-box" id="rpwfr_buc-multiple-tags" name="rpwfr_buc-multiple-tags[]" data-placeholder="<?php echo esc_attr__( 'Search for tags…', 'sft-related-products-woocommerce' ); ?>" multiple="multiple">
						<?php echo wp_kses( rpwfr_select2_get_all_tags(), $allowed_html ); ?>
					</select>
				</div>

				<!-- SKU select box -->
				<div id="rpwfr_buc-select-sku">
					<select class="rpwfr_buc-filter-box" id="rpwfr_buc-multiple-sku" name="rpwfr_buc-multiple-sku[]" data-placeholder="<?php echo esc_attr__( 'Search for SKU…', 'sft-related-products-woocommerce' ); ?>" multiple="multiple">
						<?php echo wp_kses( rpwfr_select2_get_all_product_sku(), $allowed_html ); ?>
					</select>
				</div>

				<!-- Single product select box -->
				<div id="rpwfr_buc-select-product">
					<select class="rpwfr_buc-product-filter-box" id="rpwfr_buc-single-product" name="rpwfr_buc-single-product[]" data-placeholder="<?php echo esc_attr__( 'Type any product name...', 'sft-related-products-woocommerce' ); ?>" multiple="multiple">
						<option value=""></option >
						<?php
						$all_products = rpwfr_get_all_products();

						foreach ( $all_products as $rpwfr_product ) {
							echo '<option value="' . esc_attr( $rpwfr_product['product_id'] ) . '">' . esc_attr( $rpwfr_product['label'] ) . '</option >';
						}
						?>
					</select>
				</div>
			</div>

			<!-- Searching and saving button -->
			<div class="rpwfr_buc-search">
				<button type="button" class="button rpwfr_buc-search-product" id="rpwfr_buc-search-product" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/></svg><?php esc_html_e( 'Search', 'sft-related-products-woocommerce' ); ?></button>
				<button type="button" class="rpwfr_buc-save rpwfr_buc-save-top" id="rpwfr_buc-save-top" > <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 416c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg><?php esc_html_e( 'Save', 'sft-related-products-woocommerce' ); ?> 
			</div>
		</div>
	</div>
	<br/>

	<!-- Pagignation section upper -->
	<div class="rpwfr_buc-left-way">

		<!-- product number to show 5 only in dropdown -->
		<div class="rpwfr-number-filter">
			<label for="rpwfr-number"><?php echo __( 'Product Count', 'sft-related-products-woocommerce' ); ?></label>
			<select name="rpwfr-number" id="rpwfr-number">
				<option value="5">5</option>
				<option value="">10 <?php echo __( '(Pro Version)', 'sft-related-products-woocommerce' ); ?></option>
				<option value="">15 <?php echo __( '(Pro Version)', 'sft-related-products-woocommerce' ); ?></option>
				<option value="">25 <?php echo __( '(Pro Version)', 'sft-related-products-woocommerce' ); ?></option>
			</select>&nbsp;&nbsp;
			<span><svg class="bucw_pro_notice" onclick="rpwfr_call_notice()" xmlns="http://www.w3.org/2000/svg" height="20" width="22" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#f8c844" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5 .4 5.1 .8 7.7 .8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"/></svg> <?php echo esc_html__( 'Now, manage 50 products in one go with our', 'sft-related-products-woocommerce' ); ?> <a href="https://www.saffiretech.com/woocommerce-related-products-pro/?utm_source=wp_plugin&utm_medium=profield&utm_campaign=free2pro&utm_id=c1&utm_term=related-product-pro-for-woocommerce&utm_content=rpwfr">PRO plugin!</a></span>
		</div>

		<!-- pagignation button and text div -->
		<div class="rpwfr-pagig-div">
			<div class="rpwfr-inside">
				<span class="rpwfr_product_count"></span>

				<button type="button" class="rpwfr_buc_product_first width_but" onclick="rpwfr_buc_first_get_data()">&laquo;</button>
				<button type="button" class="rpwfr_buc_product_prev width_but" onclick="rpwfr_buc_prev_get_data( this )">&lsaquo;</button>

				<span class="rpwfr_buc_product_num">
					<input type="number" class="rpwfr_buc_numtext upf" min="1" value="1" onkeypress="rpwfr_buc_get_text_data( this, event )">
				</span> <?php echo __( 'of', 'sft-related-products-woocommerce' ); ?> <span class="rpwfr_buc_pages_total"></span>

				<button type="button" class="rpwfr_buc_product_next width_but" onclick="rpwfr_buc_next_get_data()">&rsaquo;</button>
				<button type="button" class="rpwfr_buc_product_last width_but" onclick="rpwfr_buc_last_get_data()">&raquo;</button>
			</div>
		</div>
	</div>
	<br/><br/>

	<!-- on search Loader image -->
	<div id="rpwfr_buc_loader">
		<img id="loading-image" src="<?php echo esc_url( plugins_url() . '/sft-related-products-woocommerce/assets/images/loader.gif' ); ?>" style="display:none;"/>
	</div>

	<!-- Main Product Table to show all upsells cross-sells and relatd products-->
	<div id="products-table" class="products-table"></div><br/>

	<!-- Pagignation section lower -->
	<div class="rpwfr_buc-left-way rpwfr_buc_bottom">

		<!-- pagignation div -->
		<div class="rpwfr-pagig-div">
			<span class="rpwfr_buc_product_count"></span>

			<button type="button" class="rpwfr_buc_product_first width_but" onclick="rpwfr_buc_first_get_data()">&laquo;</button>
			<button type="button" class="rpwfr_buc_product_prev width_but" onclick="rpwfr_buc_prev_get_data( this )">&lsaquo;</button>

			<span class="rpwfr_buc_product_num">
				<input type="number" class="rpwfr_buc_numtext dpf" min="1" value="1" onkeypress="bucw_buc_get_text_data( this, event )">
			</span> <?php esc_html_e( 'of', 'sft-related-products-woocommerce' ); ?> <span class="rpwfr_buc_pages_total"></span>

			<button type="button" class="rpwfr_buc_product_next width_but" onclick="rpwfr_buc_next_get_data()">&rsaquo;</button>
			<button type="button" class="rpwfr_buc_product_last width_but" onclick="rpwfr_buc_last_get_data()">&raquo;</button>
		</div>
	</div>
	<br/><br/>
	<?php

	// Key valid status.
	$validation_key_status = get_option( 'rpwfr_api_valid_key_status' ) ? get_option( 'rpwfr_api_valid_key_status' ) : '';

	// Response status.
	$key_response_status = get_option( 'rpwfr_api_request_created_status' ) ? get_option( 'rpwfr_api_request_created_status' ) : '';

	// Api created status.
	$api_request_status = get_option( 'rpwfr_api_request_created_status' ) ? get_option( 'rpwfr_api_request_created_status' ) : '';

	// All product categories.
	$product_categories = get_terms( 'product_cat', array( 'hide_empty' => false ) );

	// All product id with variation.
	$all_products = rpwfr_get_all_products();

	$data_type_selection = get_option( 'rpwfr_all_products' );

	$selected_products = get_option( 'rpwfr_product_list' );

	$selected_categories = get_option( 'rpwfr_prompt_cat_selection' );

	// AI Api settings page url.
	$api_settings_page = admin_url( 'admin.php?page=rpwfr_api_setting_page' );

	$display_prompt = get_option( 'rpwfr_default_ai_prompt' );

	$tokens_used = get_option( 'rpwfr_tokens_used' ) ? get_option( 'rpwfr_tokens_used' ) : '2000';
	?>

	<script>

		// On first button click.
		function rpwfr_buc_first_get_data() {
			var taxonomyID;

			var filterType   = jQuery("#filter-type").val();
			let selectedData = 5;

			if ("rpwfr_buc-category" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-categories").val();
			} else if ("rpwfr_buc-tags" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-tags").val();
			} else if ("rpwfr_buc-product" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-single-product").val();
			} else if ("rpwfr_buc-sku" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-sku").val();
			} else {
				Swal.fire('', __('Please select a filter ( product category, tags, product name or SKU) to search your products.', 'sft-related-products-woocommerce'), 'warning');
				return;
			}

			if (!(taxonomyID === "")) {
				jQuery.ajax({
					url: '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>',
					type: "POST",
					data: {
						action: "rpwfr_taxonomyID_action",
						nonce: '<?php echo esc_js( wp_create_nonce( 'sft-related-products-woocommerce' ) ); ?>',
						filterType: filterType,
						taxonomyID: taxonomyID,
						limit_data : selectedData,
						offset_data: 0,
					},
					beforeSend: function () {
						jQuery("#loading-image").show();
					},
					success: function (data) {
						if (!data) {
							Swal.fire('', __('No products found on current on selected search criteria. Please change filter or search for other products.', 'sft-related-products-woocommerce'), 'warning');
							jQuery("#products-table").hide();
							jQuery("#loading-image").hide();
							jQuery(".rpwfr_buc-left-way").hide();
						} else {
							jQuery("#products-table").show();
							jQuery("#products-table").html(data);
							jQuery('.rpwfr-select2').select2({ width: '100%', minimumInputLength: 2 });
							jQuery(".rpwfr_buc-save").show();

							jQuery("#loading-image").hide();
							jQuery(".rpwfr_buc-left-way").css('display','flex');

							// Total Product Count.
							let productTotalCount  = parseInt( jQuery(".rpwfr_total").val() );
							let totalPageNumbers = Math.ceil( parseFloat( parseInt( productTotalCount ) / parseInt( selectedData ) ) );

							// Total Product count.
							jQuery(".rpwfr_buc_product_count").html( productTotalCount + " Items  " );

							// Total Page count after of number.
							jQuery(".rpwfr_buc_pages_total").html( Math.ceil( productTotalCount / selectedData ) );

							// Default value one.
							jQuery(".rpwfr_buc_numtext").val(1);

							jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', true);
							jQuery( '.rpwfr_buc_product_first' ).prop('disabled', true);

							jQuery( '.rpwfr_buc_product_next' ).prop('disabled', false);
							jQuery( '.rpwfr_buc_product_last' ).prop('disabled', false);
						}
					},
				});
			} else {
				Swal.fire('', __('Please input  keywords/ terms for the chosen filter for the products you wish to update', 'sft-related-products-woocommerce'), 'warning');
			}
		}

		// On previous button click.
		function rpwfr_buc_prev_get_data( predata ) {
			var taxonomyID;

			var filterType   = jQuery("#filter-type").val();
			let selectedData = 5

			if ("rpwfr_buc-category" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-categories").val();
			} else if ("rpwfr_buc-tags" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-tags").val();
			} else if ("rpwfr_buc-product" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-single-product").val();
			} else if ("rpwfr_buc-sku" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-sku").val();
			} else {
				Swal.fire('', __('Please select a filter ( product category, tags, product name or SKU) to search your products.', 'sft-related-products-woocommerce'), 'warning');
				return;
			}

			if (!(taxonomyID === "")) {

				// Current textbox value.
				let currentbox = jQuery( predata ).siblings('.rpwfr_buc_product_num').children('.rpwfr_buc_numtext').val();

				// Current page number.
				let current_page_number = parseInt( currentbox );

				// Set dynamic page number to textbox.
				jQuery('.rpwfr_buc_numtext.upf').val( Math.ceil( ( current_page_number !== 1 ) ? current_page_number - 1 : 1 ) );
				jQuery('.rpwfr_buc_numtext.dpf').val( Math.ceil( ( current_page_number !== 1 ) ? current_page_number - 1 : 1 ) );

				// get the value.
				let new_page = jQuery(predata).siblings('.rpwfr_buc_product_num').children('.rpwfr_buc_numtext').val( Math.ceil( ( current_page_number !== 1 ) ? current_page_number - 1 : 1 ) );

				// Get the current data.
				let page_data = new_page.val();

				jQuery.ajax({
					url: '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>',
					type: "POST",
					data: {
						action: "rpwfr_taxonomyID_action",
						nonce: '<?php echo esc_js( wp_create_nonce( 'sft-related-products-woocommerce' ) ); ?>',
						filterType: filterType,
						taxonomyID: taxonomyID,
						limit_data : selectedData,
						offset_data: ( page_data != 1 ) ? ( page_data ) * parseInt( selectedData ) - parseInt( selectedData ) : 0,
					},
					beforeSend: function () {
						jQuery("#loading-image").show();
					},
					success: function (data) {
						if (!data) {
							Swal.fire('', __('No products found on current on selected search criteria. Please change filter or search for other products.', 'sft-related-products-woocommerce'), 'warning');
							jQuery("#products-table").hide();
							jQuery("#loading-image").hide();
							jQuery(".rpwfr_buc-left-way").hide();
						} else {
							jQuery("#products-table").show();
							jQuery("#products-table").html(data);
							jQuery('.rpwfr-select2').select2({ width: '100%', minimumInputLength: 2 });
							jQuery(".rpwfr_buc-save").show();

							jQuery("#loading-image").hide();
							jQuery(".rpwfr_buc-left-way").css('display','flex');

							// Total Product Count.
							let productTotalCount  = parseInt( jQuery(".rpwfr_total").val() );
							let totalPageNumbers = Math.ceil( parseFloat( parseInt( productTotalCount ) / parseInt( selectedData ) ) );

							// Total Product count.
							jQuery(".rpwfr_buc_product_count").html( productTotalCount + " Items  " );

							// Total Page count after of number.
							jQuery(".rpwfr_buc_pages_total").html( Math.ceil( productTotalCount / selectedData ) );

							// Current textbox value.
							let currentPageVal = parseInt( new_page.val() );

							if ( currentPageVal == 1 ) {
								jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', true);
								jQuery( '.rpwfr_buc_product_first' ).prop('disabled', true);

								jQuery( '.rpwfr_buc_product_next' ).prop('disabled', false);
								jQuery( '.rpwfr_buc_product_last' ).prop('disabled', false);
							} else {
								jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', false);
								jQuery( '.rpwfr_buc_product_first' ).prop('disabled', false);

								jQuery( '.rpwfr_buc_product_next' ).prop('disabled', false);
								jQuery( '.rpwfr_buc_product_last' ).prop('disabled', false);
							}
						}
					},
				});
			} else {
				Swal.fire('', __('Please input  keywords/ terms for the chosen filter for the products you wish to update', 'sft-related-products-woocommerce'), 'warning');
			}
		}

		// On input enter change.
		function rpwfr_buc_get_text_data( curdata, event ) {

			var key = event.keyCode || event.which;

			// On enter key press.
			if ( key == 13 ) {
				var taxonomyID;

				var filterType   = jQuery("#filter-type").val();
				let selectedData = 5;

				if ("rpwfr_buc-category" == filterType) {
					var taxonomyID = jQuery("#rpwfr_buc-multiple-categories").val();
				} else if ("rpwfr_buc-tags" == filterType) {
					var taxonomyID = jQuery("#rpwfr_buc-multiple-tags").val();
				} else if ("rpwfr_buc-product" == filterType) {
					var taxonomyID = jQuery("#rpwfr_buc-single-product").val();
				} else if ("rpwfr_buc-sku" == filterType) {
					var taxonomyID = jQuery("#rpwfr_buc-multiple-sku").val();
				} else {
					Swal.fire('', __('Please select a filter ( product category, tags, product name or SKU) to search your products.', 'sft-related-products-woocommerce'), 'warning');
					return;
				}

				if (!(taxonomyID === "")) {

					// Get page maximum value. 
					let pageMax = parseInt( jQuery(curdata).attr( 'max' ) );

					// Get current page no.
					var current_page_number = parseInt( jQuery(curdata).val() );

					// Set default page number.
					if ( current_page_number > 0 && current_page_number < pageMax ) {
						current_page_number = Math.ceil( current_page_number );

						jQuery(curdata).val( current_page_number );
						jQuery(".rpwfr_buc_numtext.upf").val( current_page_number );
						jQuery(".rpwfr_buc_numtext.dpf").val( current_page_number );
					} else if ( current_page_number <  0 || current_page_number === 0 ) {
						current_page_number = 1;

						jQuery(curdata).val( current_page_number );
						jQuery(".rpwfr_buc_numtext.upf").val( current_page_number );
						jQuery(".rpwfr_buc_numtext.dpf").val( current_page_number );
					} else if ( current_page_number > pageMax || current_page_number == pageMax ) {
						current_page_number = pageMax;

						jQuery(curdata).val( current_page_number );
						jQuery(".rpwfr_buc_numtext.upf").val( current_page_number );
						jQuery(".rpwfr_buc_numtext.dpf").val( current_page_number );
					}

					jQuery.ajax({
						url: '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>',
						type: "POST",
						data: {
							action: "rpwfr_taxonomyID_action",
							nonce: '<?php echo esc_js( wp_create_nonce( 'sft-related-products-woocommerce' ) ); ?>',
							filterType: filterType,
							taxonomyID: taxonomyID,
							limit_data : selectedData,
							offset_data: ( current_page_number != 1 ) ? ( current_page_number ) * parseInt( selectedData ) - parseInt( selectedData ) : 0,
						},
						beforeSend: function () {
							jQuery("#loading-image").show();
						},
						success: function (data) {
							if (!data) {
								Swal.fire('', __('No products found on current on selected search criteria. Please change filter or search for other products.', 'sft-related-products-woocommerce'), 'warning');
								jQuery("#products-table").hide();
							} else {
								jQuery("#products-table").show();
								jQuery("#products-table").html(data);
								jQuery('.rpwfr-select2').select2({ width: '100%', minimumInputLength: 2 });
								jQuery(".rpwfr_buc-save").show();

								jQuery("#loading-image").hide();
								jQuery(".rpwfr_buc-left-way").css('display','flex');

								// Total Product Count.
								let productTotalCount  = parseInt( jQuery(".rpwfr_total").val() );
								let totalPageNumbers = Math.ceil( parseFloat( parseInt( productTotalCount ) / parseInt( selectedData ) ) );

								// Total Product count on span.
								jQuery(".rpwfr_buc_product_count").html( productTotalCount + " Items  " );

								// Total Page count after of number.
								jQuery(".rpwfr_buc_pages_total").html( Math.ceil( productTotalCount / selectedData ) );

								// Set default page number.
								if ( current_page_number > 0 && current_page_number < totalPageNumbers ) {
									jQuery(curdata).val( Math.ceil( current_page_number ) );
									jQuery(".rpwfr_buc_numtext.upf").val( Math.ceil( current_page_number ) );
									jQuery(".rpwfr_buc_numtext.dpf").val( Math.ceil( current_page_number ) );
								} else if ( current_page_number <  0 ) {
									jQuery(curdata).val( 1 );
									jQuery(".rpwfr_buc_numtext.upf").val( 1 );
									jQuery(".rpwfr_buc_numtext.dpf").val( 1 );
								} else if ( current_page_number > totalPageNumbers ) {
									jQuery(curdata).val( totalPageNumbers );
									jQuery(".rpwfr_buc_numtext.upf").val( totalPageNumbers );
									jQuery(".rpwfr_buc_numtext.dpf").val( totalPageNumbers );
								}

								// Current page no.
								let currentPageNo = parseInt( jQuery(curdata).val() );

								// If only one page
								if ( currentPageNo === 1 && totalPageNumbers > 1 ) {
									jQuery( '.rpwfr_buc_product_first' ).prop('disabled', true);
									jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', true);

									jQuery( '.rpwfr_buc_product_next' ).prop('disabled', false);
									jQuery( '.rpwfr_buc_product_last' ).prop('disabled', false);
								}

								if ( currentPageNo == totalPageNumbers ) {
									jQuery( '.rpwfr_buc_product_next' ).prop('disabled', true);
									jQuery( '.rpwfr_buc_product_last' ).prop('disabled', true);

									jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', false);
									jQuery( '.rpwfr_buc_product_first' ).prop('disabled', false);

								} else if ( currentPageNo > 1 && totalPageNumbers > 1 ) {
									jQuery( '.rpwfr_buc_product_next' ).prop('disabled', false);
									jQuery( '.rpwfr_buc_product_last' ).prop('disabled', false);

									jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', false);
									jQuery( '.rpwfr_buc_product_first' ).prop('disabled', false);
								}
							}
						},
					});
				} else {
					Swal.fire('', __('Please input  keywords/ terms for the chosen filter for the products you wish to update', 'sft-related-products-woocommerce'), 'warning');
				}
			}
		}

		// On next button click.
		function rpwfr_buc_next_get_data() {
			var taxonomyID;

			var filterType   = jQuery("#filter-type").val();
			let selectedData = 5;

			if ("rpwfr_buc-category" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-categories").val();
			} else if ("rpwfr_buc-tags" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-tags").val();
			} else if ("rpwfr_buc-product" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-single-product").val();
			} else if ("rpwfr_buc-sku" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-sku").val();
			} else {
				Swal.fire('', __('Please select a filter ( product category, tags, product name or SKU) to search your products.', 'sft-related-products-woocommerce'), 'warning');
				return;
			}

			if (!(taxonomyID === "")) {

				// Get maximum page value.
				let pageMax = parseInt( jQuery(".rpwfr_buc_numtext").attr( 'max' ) );

				// Get current page number.
				let current_page_number = parseInt( jQuery(".rpwfr_buc_numtext").val() );

				jQuery.ajax({
					url: '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>',
					type: "POST",
					data: {
						action: "rpwfr_taxonomyID_action",
						nonce: '<?php echo esc_js( wp_create_nonce( 'sft-related-products-woocommerce' ) ); ?>',
						filterType: filterType,
						taxonomyID: taxonomyID,
						limit_data : selectedData,
						offset_data: current_page_number * parseInt( selectedData ),
					},
					beforeSend: function () {
						jQuery("#loading-image").show();
					},
					success: function (data) {
						if (!data) {
							Swal.fire('', __('No products found on current on selected search criteria. Please change filter or search for other products.', 'sft-related-products-woocommerce'), 'warning');
							jQuery("#products-table").hide();
							jQuery('#loading-image').hide();
							jQuery('.rpwfr_buc-left-way').hide();
						} else {
							jQuery("#products-table").show();
							jQuery("#products-table").html(data);
							jQuery('.rpwfr-select2').select2({ width: '100%', minimumInputLength: 2 });
							jQuery(".rpwfr_buc-save").show();

							// Hide loading image and show pagignation.
							jQuery('#loading-image').hide();
							jQuery('.rpwfr_buc-left-way').css('display','flex');

							// Total Product count.
							let productTotalCount  = parseInt( jQuery(".rpwfr_total").val() );
							let totalPageNumbers = Math.ceil( parseFloat( parseInt( productTotalCount ) / parseInt( selectedData ) ) );

							// Total Product count on span.
							jQuery(".rpwfr_buc_product_count").html( productTotalCount + " Items  " );

							// Total Page count after of number.
							jQuery(".rpwfr_buc_pages_total").html( Math.ceil( productTotalCount / selectedData ) );

							// Dynamic text box value.
							jQuery(".rpwfr_buc_numtext").val( Math.ceil( ( current_page_number !== totalPageNumbers ) ? current_page_number + 1 : totalPageNumbers ) );

							let currentPageVal = parseInt( jQuery(".rpwfr_buc_numtext").val() );

							if ( currentPageVal == totalPageNumbers ) {
								jQuery( '.rpwfr_buc_product_next' ).prop('disabled', true);
								jQuery( '.rpwfr_buc_product_last' ).prop('disabled', true);

								jQuery( '.rpwfr_buc_product_first' ).prop('disabled', false);
								jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', false);
							} else {
								jQuery( '.rpwfr_buc_product_next' ).prop('disabled', false);
								jQuery( '.rpwfr_buc_product_last' ).prop('disabled', false);

								jQuery( '.rpwfr_buc_product_first' ).prop('disabled', false);
								jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', false);
							}
						}
					},
				});
			} else {
				Swal.fire('', __('Please input  keywords/ terms for the chosen filter for the products you wish to update', 'sft-related-products-woocommerce'), 'warning');
			}
		}

		// On last button click.
		function rpwfr_buc_last_get_data() {
			var taxonomyID;

			let pageTotal = Math.ceil( jQuery(".rpwfr_total_pages").val() );
			let pageMax   = parseInt( jQuery(".rpwfr_buc_numtext").attr( 'max' ) );

			var filterType   = jQuery("#filter-type").val();
			let selectedData = 5

			if ("rpwfr_buc-category" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-categories").val();
			} else if ("rpwfr_buc-tags" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-tags").val();
			} else if ("rpwfr_buc-product" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-single-product").val();
			} else if ("rpwfr_buc-sku" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-sku").val();
			} else {
				Swal.fire('', __('Please select a filter ( product category, tags, product name or SKU) to search your products.', 'sft-related-products-woocommerce'), 'warning');
				return;
			}

			if (!(taxonomyID === "")) {

				// Total pages count.
				let productTotalCount  = parseInt( jQuery(".rpwfr_total").val() );
				let totalPageNumbers = Math.ceil( parseFloat( parseInt( productTotalCount ) / parseInt( selectedData ) ) );

				jQuery.ajax({
					url: '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>',
					type: "POST",
					data: {
						action: "rpwfr_taxonomyID_action",
						nonce: '<?php echo esc_js( wp_create_nonce( 'sft-related-products-woocommerce' ) ); ?>',
						filterType: filterType,
						taxonomyID: taxonomyID,
						limit_data : selectedData,
						offset_data: ( totalPageNumbers - 1 ) * parseInt( selectedData ),
					},
					beforeSend: function () {
						jQuery("#loading-image").show();
					},
					success: function (data) {
						if (!data) {
							Swal.fire('', __('No products found on current on selected search criteria. Please change filter or search for other products.', 'sft-related-products-woocommerce'), 'warning');
							jQuery("#products-table").hide();
							jQuery("#loading-image").hide();
							jQuery(".rpwfr_buc-left-way").hide();
						} else {
							jQuery("#products-table").show();
							jQuery("#products-table").html(data);
							jQuery('.rpwfr-select2').select2({ width: '100%', minimumInputLength: 2 });
							jQuery(".rpwfr_buc-save").show();

							jQuery("#loading-image").hide();
							jQuery(".rpwfr_buc-left-way").css('display','flex');

							// Total Product count.
							let productTotalCount  = parseInt( jQuery(".rpwfr_total").val() );
							let totalPageNumbers = Math.ceil( parseFloat( parseInt( productTotalCount ) / parseInt( selectedData ) ) );

							// Total Product count.
							jQuery(".rpwfr_buc_product_count").html( productTotalCount + " Items  " );

							// Total Page count after of number.
							jQuery(".rpwfr_buc_pages_total").html( Math.ceil( productTotalCount / selectedData ) );

							// Total page count set to textbox.
							jQuery(".rpwfr_buc_numtext").val( Math.ceil( totalPageNumbers ) );

							jQuery( '.rpwfr_buc_product_next' ).prop('disabled', true);
							jQuery( '.rpwfr_buc_product_last' ).prop('disabled', true);

							jQuery( '.rpwfr_buc_product_first' ).prop('disabled', false);
							jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', false);
						}
					},
				});
			} else {
				Swal.fire('', __('Please input  keywords/ terms for the chosen filter for the products you wish to update', 'sft-related-products-woocommerce'), 'warning');
			}
		}

		// On select of data.
		function rpwfr_buc_get_products( data ) {
			var taxonomyID;

			let pageTotal    = Math.ceil( jQuery(".rpwfr_total_pages").val() );
			let pageMax      = parseInt( jQuery(".rpwfr_buc_numtext").attr( 'max' ) );
			let selectedData = 5

			var filterType = jQuery("#filter-type").val();

			if ("rpwfr_buc-category" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-categories").val();
			} else if ("rpwfr_buc-tags" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-tags").val();
			} else if ("rpwfr_buc-product" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-single-product").val();
			} else if ("rpwfr_buc-sku" == filterType) {
				var taxonomyID = jQuery("#rpwfr_buc-multiple-sku").val();
			} else {
				Swal.fire('', __('Please select a filter ( product category, tags, product name or SKU) to search your products.', 'sft-related-products-woocommerce'), 'warning');
				return;
			}

			if (!(taxonomyID === "")) {

				jQuery.ajax({
					url: '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>',
					type: "POST",
					data: {
						action: "rpwfr_taxonomyID_action",
						nonce: '<?php echo esc_js( wp_create_nonce( 'sft-related-products-woocommerce' ) ); ?>',
						filterType: filterType,
						taxonomyID: taxonomyID,
						limit_data : selectedData,
						offset_data: 0,
					},
					beforeSend: function () {
						jQuery("#loading-image").show();
					},
					success: function (data) {
						if (!data) {
							Swal.fire('', __('No products found on current on selected search criteria. Please change filter or search for other products.', 'sft-related-products-woocommerce'), 'warning');
							jQuery("#products-table").hide();
							jQuery("#loading-image").hide();
							jQuery(".rpwfr_buc-left-way").hide();
						} else {
							jQuery("#products-table").show();
							jQuery("#products-table").html(data);
							jQuery('.rpwfr-select2').select2({ width: '100%', minimumInputLength: 2 });
							jQuery(".rpwfr_buc-save").show();

							jQuery("#loading-image").hide();
							jQuery(".rpwfr_buc-left-way").css('display','flex');

							// Total Product count.
							let productTotalCount  = parseInt( jQuery(".rpwfr_total").val() );
							let totalPageNumbers = Math.ceil( parseFloat( parseInt( productTotalCount ) / parseInt( selectedData ) ) );

							// Total Product count before item text.
							jQuery(".rpwfr_buc_product_count").html( productTotalCount + " Items  " );

							// Total Page count after of number.
							jQuery(".rpwfr_buc_pages_total").html( Math.ceil( productTotalCount / selectedData ) );

							// Total page count set to textbox.
							jQuery(".rpwfr_buc_numtext").val( Math.ceil( 1 ) );

							if ( totalPageNumbers == 1 ) {
								jQuery( '.rpwfr_buc_product_next' ).prop('disabled', true);
								jQuery( '.rpwfr_buc_product_last' ).prop('disabled', true);
								jQuery( '.rpwfr_buc_product_first' ).prop('disabled', true);
								jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', true);
							} else if( totalPageNumbers > 1 ) {
								jQuery( '.rpwfr_buc_product_next' ).prop('disabled', false);
								jQuery( '.rpwfr_buc_product_last' ).prop('disabled', false);
								jQuery( '.rpwfr_buc_product_first' ).prop('disabled', true);
								jQuery( '.rpwfr_buc_product_prev' ).prop('disabled', true);
							}
						}
					},
				});
			} else {
				Swal.fire('', __('Please input  keywords/ terms for the chosen filter for the products you wish to update', 'sft-related-products-woocommerce'), 'warning');
			}
		}

		// ------------------------------------------ Buc AI settings ------------------------------------.

		jQuery(document).ready(function() {

			// AI Button Click.
			jQuery('#rpwfr-popup-button').click(function(e) {

				e.preventDefault();

				// Validation Status.
				let validation_status = '<?php echo esc_js( $validation_key_status ); ?>';

				// Response status.
				let response_status = '<?php echo esc_js( $key_response_status ); ?>';

				// Api request status.
				let request_status = '<?php echo esc_js( $api_request_status ); ?>';

				if ( validation_status != 1 ) {

					// For invalid Api key.
					Swal.fire({
						text: '<?php echo esc_html__( 'Please Enter Your Valid API Key First !', 'sft-related-products-woocommerce' ); ?>',
						icon: "warning",
						showCancelButton: true,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						confirmButtonText: '<?php echo esc_html__( 'Configure API Key', 'sft-related-products-woocommerce' ); ?>'
						}).then((result) => {
						if (result.isConfirmed) {
							// Move to Api key settings page.
							window.location.assign( '<?php echo esc_url( $api_settings_page ); ?>' );
						}
					}); 
				} else {

					// If response is insufficient quota.
					if ( response_status != 'insufficient_quota' ) {

						// Api response status
						if ( ( response_status != 'created' ) && ( response_status != 'pending' ) ) {

							// Make api request.
							Swal.fire({
								title: '<div class="rpwfr-ai-popup-heading"><?php echo esc_html__( 'AI PRODUCT SUGGESTIONS', 'sft-related-products-woocommerce' ); ?></div>',
								showCloseButton: true,
								html: `<div class="rpwfr-ai-popup">

										<div class="rpwfr-ai-outer-container">
											<div>
												<?php echo esc_html__( 'Select Products or Categories for AI Product Suggestions:', 'sft-related-products-woocommerce' ); ?><span class="rpwfr-required">*</span>
												<div class="rpwfr-popup-btn-tooltip-container">
													<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/information-icon.svg' ); ?>" width="15px" height="15px" class="rpwfr-popup-tooltip-icon">
													<div class="rpwfr-ai-popup-btn-tooltip"><?php echo esc_html__( 'Choose specific products or categories for AI to suggest Related Products, Upsells, and Cross-Sells.', 'sft-related-products-woocommerce' ); ?></div>
												</div>
											</div>

											<div class="rpwfr-ai-radio-container">
												<div>
													<div>
														<input type="radio" id="rpwfr_all_products" value="all_products" disabled/>
														<span>
														<label for="rpwfr_all_products" style="display:flex;"><?php echo esc_html__( 'Select All Products', 'sft-related-products-woocommerce' ); ?>
															<div class="rpwfr-pro-lock-tooltip-container">
																<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/pro-crown-logo.svg' ); ?>" width="15px" height="15px" title="Available in Pro Version" class="rpwfr-pro-version-lock alt">
																<div class="rpwfr-pro-lock-btn-tooltip">
																	<?php echo esc_html__( 'Feature Available in ', 'sft-related-products-woocommerce' ); ?>
																	<a href="https://www.saffiretech.com/woocommerce-related-products-pro/">
																		<?php echo esc_html__( 'Pro Version', 'sft-related-products-woocommerce' ); ?> 
																	</a>
																</div>
															</div>
														</label>
														</span>
													</div>
												</div>

												<div>
													<div>
														<input type="radio" id="rpwfr_multiple_categories" value="categories"  disabled/>
														<span>
															<label for="rpwfr_multiple_categories" style="display:flex;"><?php echo esc_html__( 'Select Categories', 'sft-related-products-woocommerce' ); ?>
																<div class="rpwfr-pro-lock-tooltip-container">
																	<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/pro-crown-logo.svg' ); ?>" width="15px" height="15px" title="Available in Pro Version" class="rpwfr-pro-version-lock alt">
																	<div class="rpwfr-pro-lock-btn-tooltip">
																		<?php echo esc_html__( 'Feature Available in ', 'sft-related-products-woocommerce' ); ?>
																		<a href="https://www.saffiretech.com/woocommerce-related-products-pro/">
																			<?php echo esc_html__( 'Pro Version', 'sft-related-products-woocommerce' ); ?> 
																		</a>
																	</div>
																</div>
															</label>
														</span>
													</div>
												</div>

												<div>
													<div>
													<input type="radio" id="rpwfr_multiple_products" name="rpwfr_all_products" value="products" checked="checked" />
													<span><label for="rpwfr_multiple_products">Select Individual Products</label></span>
													</div>
													<div class="rpwfr-select-field-container">
													<div class="rpwfr_max_select_warning">Note: You can select only <b>5 Products.</b></div>
														<select class="rpwfr_product_list" name="rpwfr_product_list" id="rpwfr_product_list" multiple>
															<?php
															foreach ( $all_products as $product ) {

																if ( ! empty( $selected_products ) && in_array( $product['product_id'], $selected_products ) ) {
																	?>
																	<option selected="selected" value='<?php echo esc_attr( $product['product_id'] ); ?>'><?php echo esc_html( $product['label'] ); ?></option>
																	<?php
																} else {
																	?>
																	<option value='<?php echo esc_attr( $product['product_id'] ); ?>'><?php echo esc_html( $product['label'] ); ?></option>
																	<?php
																}
															}
															?>
														</select>
														<div><?php echo esc_html( 'Use placeholder {selected_products} in prompt', 'sft-related-products-woocommerce' ); ?><button class="clipboard rpwfr-selected-products-clipboard">&#128203;</button><span class="rpwfr-text-copied"></span></div>
													</div>
												</div>
											</div>
										</div>

										<div class="rpwfr-ai-outer-container">

											<div>
												<?php echo esc_html__( 'Select Product Details for AI Prompt:', 'sft-related-products-woocommerce' ); ?> <span class="rpwfr-required">*</span>
												<div class="rpwfr-popup-btn-tooltip-container">
													<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/information-icon.svg' ); ?>" width="15px" height="15px" class="rpwfr-popup-tooltip-icon">
													<div class="rpwfr-ai-popup-btn-tooltip"><?php echo esc_html__( 'Customize the AI prompt by selecting product details to include, such as name, description, URL, or price. Providing comprehensive details can enhance the accuracy of product recommendations.', 'sft-related-products-woocommerce' ); ?></div>
												</div>
											</div>

											<div class="rpwfr-ai-checkbox-container">

												<div>
													<input type="checkbox" class="rpwfr_ai_checkbox" id="rpwfr_products_name" name="rpwfr_products_name" checked onclick="return false"/>
													<label for="rpwfr_products_name"><?php echo esc_html__( 'Product Name', 'sft-related-products-woocommerce' ); ?></label>
												</div>

												<div>
													<input type="checkbox" class="rpwfr_ai_checkbox" id="rpwfr_products_desc" name="rpwfr_products_desc" checked onclick="return false"/>
													<label for="rpwfr_products_desc"><?php echo esc_html__( 'Product Description (Short)', 'sft-related-products-woocommerce' ); ?></label>
												</div>

												<div>
													<input type="checkbox" class="rpwfr_ai_checkbox" id="rpwfr_products_url" disabled/>
													<label for="rpwfr_products_url" style="display:flex;">
														<?php echo esc_html__( 'Product URL', 'sft-related-products-woocommerce' ); ?>
														<div class="rpwfr-pro-lock-tooltip-container">
															<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/pro-crown-logo.svg' ); ?>" width="15px" height="15px" title="Available in Pro Version" class="rpwfr-pro-version-lock alt">
															<div class="rpwfr-pro-lock-btn-tooltip">
																<?php echo esc_html__( 'Feature Available in ', 'sft-related-products-woocommerce' ); ?>
																<a href="https://www.saffiretech.com/woocommerce-related-products-pro/">
																	<?php echo esc_html__( 'Pro Version', 'sft-related-products-woocommerce' ); ?> 
																</a>
															</div>
														</div>
													</label>
												</div>

												<div>
													<input type="checkbox" class="rpwfr_ai_checkbox" id="rpwfr_products_price" disabled/>
													<label for="rpwfr_products_price" style="display: flex;"><?php echo esc_html__( 'Product Price', 'sft-related-products-woocommerce' ); ?>
														<div class="rpwfr-pro-lock-tooltip-container">
															<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/pro-crown-logo.svg' ); ?>" width="15px" height="15px" title="Available in Pro Version" class="rpwfr-pro-version-lock alt">
															<div class="rpwfr-pro-lock-btn-tooltip">
																<?php echo esc_html__( 'Feature Available in ', 'sft-related-products-woocommerce' ); ?>
																<a href="https://www.saffiretech.com/woocommerce-related-products-pro/">
																	<?php echo esc_html__( 'Pro Version', 'sft-related-products-woocommerce' ); ?> 
																</a>
															</div>
														</div>
													</label>
												</div>

											</div>
										</div>

										<div class="rpwfr-ai-outer-container">

											<div>
												<?php echo esc_html__( 'Choose the Type of Product Suggestions:', 'sft-related-products-woocommerce' ); ?> <span class="rpwfr-required">*</span>
												<div class="rpwfr-popup-btn-tooltip-container">
													<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/information-icon.svg' ); ?>" width="15px" height="15px" class="rpwfr-popup-tooltip-icon">
													<div class="rpwfr-ai-popup-btn-tooltip"><?php echo esc_html__( 'Select the type of product suggestions you want AI to generate. You can pick from options like Related Products, Upsells, or Cross-Sells to maximize your recommendation strategy.', 'sft-related-products-woocommerce' ); ?></div>
												</div>
												<div class="rpwfr-pro-lock-tooltip-container">
													<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/pro-crown-logo.svg' ); ?>" width="15px" height="15px" title="Available in Pro Version" class="rpwfr-pro-version-lock alt">
													<div class="rpwfr-pro-lock-btn-tooltip">
														<?php echo esc_html__( 'Feature Available in ', 'sft-related-products-woocommerce' ); ?>
														<a href="https://www.saffiretech.com/woocommerce-related-products-pro/">
															<?php echo esc_html__( 'Pro Version', 'sft-related-products-woocommerce' ); ?> 
														</a>
													</div>
												</div>
											</div>

											<div class="rpwfr-ai-checkbox-container">
												<div>
													<input type="checkbox" class="rpwfr_ai_checkbox" id="rpwfr_ai_update_related" name="rpwfr_ai_update_related" checked="checked"/>
													<label for="rpwfr_ai_update_related"><?php echo esc_html__( 'Related', 'sft-related-products-woocommerce' ); ?></label>
												</div>
												<div>
													<input type="checkbox" class="rpwfr_ai_checkbox" id="rpwfr_ai_update_upsells" name="rpwfr_ai_update_upsells" disabled>
													<label for="rpwfr_ai_update_upsells"><?php echo esc_html__( 'Upsells', 'sft-related-products-woocommerce' ); ?></label>
												</div>
												<div>
													<input type="checkbox" class="rpwfr_ai_checkbox" id="rpwfr_ai_update_crosssells" name="rpwfr_ai_update_crosssells" disabled/>
													<label for="rpwfr_ai_update_crosssells"><?php echo esc_html__( 'Cross-Sells', 'sft-related-products-woocommerce' ); ?></label>
												</div>
											</div>
										</div>

										<div class="rpwfr-ai-outer-container">

											<div>
												<?php echo esc_html__( 'Set Number of Product Suggestions per Product:', 'sft-related-products-woocommerce' ); ?> <span class="rpwfr-required">*</span>
												<div class="rpwfr-popup-btn-tooltip-container">
													<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/information-icon.svg' ); ?>" width="15px" height="15px" class="rpwfr-popup-tooltip-icon">
													<div class="rpwfr-ai-popup-btn-tooltip"><?php echo esc_html__( 'Specify how many suggestions you want for each product. Suggestions for Related Products, Upsells and Cross-sells are counted separately.', 'sft-related-products-woocommerce' ); ?></div>
												</div>
												<div class="rpwfr-pro-lock-tooltip-container">
													<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/pro-crown-logo.svg' ); ?>" width="15px" height="15px" title="Available in Pro Version" class="rpwfr-pro-version-lock alt">
													<div class="rpwfr-pro-lock-btn-tooltip">
														<?php echo esc_html__( 'Feature Available in ', 'sft-related-products-woocommerce' ); ?>
														<a href="https://www.saffiretech.com/woocommerce-related-products-pro/">
															<?php echo esc_html__( 'Pro Version', 'sft-related-products-woocommerce' ); ?> 
														</a>
													</div>
												</div>
											</div>

											<div class="rpwfr-ai-checkbox-container">
												<div>
												<input type="number" id="rpwfr_ai_recommendations_limit" name="rpwfr_ai_recommendations_limit" min="1" max="10" value="5" disabled>
												</div>
												<p id="rpwfr-limit-message" style="color: red; display: none;"><?php echo esc_html__( 'Please enter a number between 1 and 10.', 'sft-related-products-woocommerce' ); ?></p>
											</div>
										</div>

										<div class="rpwfr-ai-sub-section rpwfr-ai-outer-container">

											<div>
												<?php echo esc_html__( 'Describe Your Store:', 'sft-related-products-woocommerce' ); ?><span class="rpwfr-required">*</span>
												<div class="rpwfr-popup-btn-tooltip-container">
													<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/information-icon.svg' ); ?>" width="15px" height="15px" class="rpwfr-popup-tooltip-icon">
													<div class="rpwfr-ai-popup-btn-tooltip"><?php echo esc_html__( 'Provide a brief description of your store to help AI understand your business better. This will enable more personalized and relevant product suggestions', 'sft-related-products-woocommerce' ); ?></div>
												</div>
											</div>

											<div class="rpwfr-ai-checkbox-container">
												<textarea id="rpwfr_about_store" name="rpwfr_about_store" rows="3"><?php echo esc_html( get_option( 'rpwfr_about_store' ) ); ?></textarea>
											</div>
										</div>

										<div class="send_prompt rpwfr-ai-outer-container">

											<div>
												<?php echo esc_html__( 'AI Prompt:', 'sft-related-products-woocommerce' ); ?><span class="rpwfr-required">*</span>
												<div class="rpwfr-popup-btn-tooltip-container">
													<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/information-icon.svg' ); ?>" width="15px" height="15px" class="rpwfr-popup-tooltip-icon">
													<div class="rpwfr-ai-popup-btn-tooltip"><?php echo esc_html__( 'The default AI prompt is optimized to work seamlessly with your products, but you can edit it to suit your needs. Personalize the prompt for more targeted and specific results.', 'sft-related-products-woocommerce' ); ?></div>
												</div>
											</div>

											<div class="rpwfr-prompt-default-edit-radio">
												<div>
													<input type="radio" class="rpwfr_ai_prompt_default" id="rpwfr_ai_prompt_default" name="rpwfr_ai_prompt_type" value="default" checked="checked" />
													<label for="rpwfr_ai_prompt_default"><?php echo esc_html__( 'Use Default Prompt', 'sft-related-products-woocommerce' ); ?></label>
												</div>
												<div>
													<input type="radio" class="rpwfr_ai_prompt_edit" id="rpwfr_ai_prompt_edit" name="rpwfr_ai_prompt_type" value="edit" />
													<label for="rpwfr_ai_prompt_edit" style="display:flex;">
														<?php echo esc_html__( 'Customize Default Prompt', 'sft-related-products-woocommerce' ); ?>
														<div class="rpwfr-pro-lock-tooltip-container">
															<img src="<?php echo esc_attr( plugin_dir_url( dirname( __FILE__, 1 ) ) . 'assets/images/pro-crown-logo.svg' ); ?>" width="15px" height="15px" title="Available in Pro Version" class="rpwfr-pro-version-lock alt">
															<div class="rpwfr-pro-lock-btn-tooltip">
																<?php echo esc_html__( 'Feature Available in ', 'sft-related-products-woocommerce' ); ?>
																<a href="https://www.saffiretech.com/woocommerce-related-products-pro/">
																	<?php echo esc_html__( 'Pro Version', 'sft-related-products-woocommerce' ); ?> 
																</a>
															</div>
														</div>
													</label>
												</div>
											</div>

											<div class="rpwfr-ai-prompt-container" id="rpwfr_textarea_container">
												<textarea id="rpwfr_ai_request_prompt" name="rpwfr_ai_request_prompt" rows="4"><?php echo esc_html( $display_prompt ); ?></textarea>
											</div>

											<div class="rpwfr-tokens-request-container">
												<span class="rpwfr-token-status"></span>
												<div class="rpwfr-ai-request-warning"></div>
												<button id="rpwfr-send-prompt-btn" class="rpwfr-btn"><?php echo esc_html__( 'Create AI Request', 'sft-related-products-woocommerce' ); ?></button><span class="rpwfr-request-loader"></span><div class="display-response"></div>
											</div>
										</div>
									</div>`,
								customClass: "rpwfr-popup",
								showConfirmButton: false,
							});

							// Get all category ids.
							let productIds = new Set();
							// let detailsIds = new Set();

							// Make multiselect field.
							jQuery('select.rpwfr_product_list').multiSelect();
							jQuery('#rpwfr_ai_update_upsells, #rpwfr_ai_update_crosssells, #rpwfr_ai_update_related, #rpwfr_products_name, #rpwfr_products_desc').closest('div').css('pointer-events', 'none');

							//Disable all remaining products after limit is reached
							jQuery('select.rpwfr_product_list').change( function() {
								if (jQuery('select.rpwfr_product_list option:selected').length >= 5){

									var nonSelectedProducts = jQuery('.rpwfr_product_list option').not(':selected');

									nonSelectedProducts.each(function() {
										var productOption = jQuery('input[value="' + jQuery(this).val() + '"]');
										productOption.prop('disabled', true);
									});

								}else{

									jQuery('.rpwfr_product_list option').each(function() {
										var productOption = jQuery('input[value="' + jQuery(this).val() + '"]');
										productOption.prop('disabled', false);
									});
								}
							});

							// let promptField = jQuery( '.rpwfr-token-status' )
							let tokensUsed = <?php echo $tokens_used; ?>;
							jQuery( '.rpwfr-token-status' ).empty().append( tokensUsed + ' <?php echo esc_html__( 'tokens will be used out of 4096', 'sft-related-products-woocommerce' ); ?>' );

							// ----------------------------------- Change event ---------------------------------------.

							// On change of multiple product.
							jQuery(document).on('change', '#rpwfr_multiple_products', function() {
								if (jQuery('#rpwfr_multiple_products').is(':checked')) {
									jQuery('.rpwfr-all-cat-selection').hide();
									jQuery('.rpwfr-all-products-list').slideDown(100);
								} else {
									jQuery('.rpwfr-all-products-list').slideUp(100);
								}
							});

							// --------------------------- Z-index of Select2 Popup ------........-------------------.

							jQuery(".swal2-container.swal2-center.swal2-backdrop-show").css("z-index", "100000");

							// ----------------------------------- ClipBoard ----------------------------------------.

							// copy the clipboard text when button is clicked.
							jQuery("button.rpwfr-selected-products-clipboard").click(function(e) {
								e.preventDefault();
								let shotcodetext = "{selected_products}";
								// Copy the text to the clipboard
								navigator.clipboard.writeText(shotcodetext).then(() => {
									// Render the "Text Copied!" message
									jQuery('.rpwfr-text-copied').empty().text("<?php _e( 'Text Copied!', 'sft-related-products-woocommerce' ); ?>");

									// Set a timeout to clear the text after a few seconds (e.g., 2 seconds)
									setTimeout(function() {
										jQuery('.rpwfr-text-copied').empty(); // Clear the text after the interval
									}, 2000); // 2000 milliseconds = 2 seconds
								}).catch(err => {
									console.error('Failed to copy text: ', err);
								});
							});

							//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

							jQuery(document).on('change', 'input[name=rpwfr_ai_prompt_type]', function(){
								if( jQuery( 'input[name=rpwfr_ai_prompt_type]:checked' ).val() == 'default' ){
									jQuery( 'textarea#rpwfr_ai_request_prompt' ).val('')
									jQuery( 'textarea#rpwfr_ai_request_prompt' ).val('<?php echo get_option( 'rpwfr_default_ai_prompt' ); ?>').attr('disabled','disabled');
									// jQuery( 'textarea#rpwfr_ai_request_prompt' ).hide();
									jQuery( '#rpwfr_textarea_container.rpwfr-ai-prompt-container' ).slideUp();
								} else if( jQuery( 'input[name=rpwfr_ai_prompt_type]:checked' ).val() == 'edit' ) {
									// jQuery( 'textarea#rpwfr_ai_request_prompt' ).show();
									jQuery( '#rpwfr_textarea_container.rpwfr-ai-prompt-container' ).slideDown();
									// jQuery( 'textarea#rpwfr_ai_request_prompt' ).removeAttr('disabled');
								}
							})

							//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

							if( jQuery( 'input[name=rpwfr_ai_prompt_type]:checked' ).val() == 'default' ){
								jQuery( 'textarea#rpwfr_ai_request_prompt' ).val('')
								jQuery( 'textarea#rpwfr_ai_request_prompt' ).val('<?php echo get_option( 'rpwfr_default_ai_prompt' ); ?>').attr('disabled','disabled');
								jQuery( '#rpwfr_textarea_container.rpwfr-ai-prompt-container' ).hide();
							} else if( jQuery( 'input[name=rpwfr_ai_prompt_type]:checked' ).val() == 'edit' ) {
								jQuery( '#rpwfr_textarea_container.rpwfr-ai-prompt-container' ).show();
								// jQuery( '#rpwfr_textarea_container.rpwfr-ai-prompt-container' ).slideDown();
								// jQuery( 'textarea#rpwfr_ai_request_prompt' ).slideDown();
								// jQuery( 'textarea#rpwfr_ai_request_prompt' ).removeAttr('disabled');
								jQuery( 'textarea#rpwfr_ai_request_prompt' ).val('')
								jQuery( 'textarea#rpwfr_ai_request_prompt' ).val('<?php echo get_option( 'rpwfr_ai_request_prompt' ); ?>')
							}

							jQuery( 'input[name=rpwfr_about_store]' ).change( function(){

								jQuery.ajax({
									url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
									type: 'POST',
									data: {
										action: 'rpwfr_ai_send_prompt',
										about_store: jQuery('input[name=rpwfr_about_store]').val(),
									},
									success: function(response) {

									},
								});
							})

							//-------------------------------------- Send Prompt----------------------------------------.

							// Send prompt button.
							jQuery('#rpwfr-send-prompt-btn').click(function() {	
								<?php
								if ( (string) get_option( 'rpwfr_openai_api_key' ) == '' ) {
									?>
									Swal.fire('', 'Please enter valid api key before sending request!', 'error');
									<?php
								} else {
									?>

									let selectedOptions = ['products_name', 'products_desc'];

									productIds.clear();

									// Get all the selected ids.
									jQuery.each(jQuery('select.rpwfr_product_list option:selected'), function() {
										productIds.add(jQuery(this).val());
									});

									let productIdsArray = Array.from(productIds);
									let selectedProductType = 'products';
									let sendRequest = 1;

									if (productIdsArray.length > 5){
										productIdsArray = productIdsArray.slice(0, 5);
									}

									if (productIdsArray.length === 0) {
										sendRequest = 0;
									}

									if( jQuery('#rpwfr_ai_request_prompt').val() == '' ){
										sendRequest = 0;
									}

									if( jQuery('#rpwfr_about_store').val() == '' ){
										sendRequest = 0;
									}

									if( sendRequest == 1 ){
										jQuery('#rpwfr-send-prompt-btn').empty().text('Requesting....');

										jQuery.ajax({
											url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
											type: 'POST',
											data: {
												action: 'rpwfr_ai_send_prompt',
												prompt: '<?php echo esc_html( $display_prompt ); ?>',
												selected_options: selectedOptions,
												selected_product_type: selectedProductType,
												selected_products: productIdsArray,
												prompt_type: 'default',
												about_store: jQuery('#rpwfr_about_store').val(),
											},
											success: function(response) {
												jQuery('#rpwfr-send-prompt-btn').empty().text( '<?php _e( 'Request Created', 'sft-related-products-woocommerce' ); ?>');

												Swal.fire({
													title: "",
													text: "<?php _e( 'Your request was initiated successfully!', 'sft-related-products-woocommerce' ); ?>",
													icon: "success",
													customClass: "rpwfr-request-sent",
												}).then(() => {
													location.reload(); // This will refresh the page after the Swal modal is closed
												});

											},
										});
									}else {
										jQuery('#rpwfr-send-prompt-btn').empty().text( '<?php _e( 'Create Request', 'sft-related-products-woocommerce' ); ?>');

										jQuery( '.rpwfr-ai-request-warning' ).empty().text( '<?php _e( 'Please ensure products are selected from field above before submitting your request.', 'sft-related-products-woocommerce' ); ?>' );
									}
									<?php
								}
								?>
							});

							jQuery('.rpwfr-popup').css('width', '800px');
							jQuery('.rpwfr-popup').css('text-align', 'left');
							jQuery('.rpwfr-popup > .swal2-header').css('background', '#0a2845');
							jQuery('.rpwfr-popup > .swal2-header').css('margin', '-20px');
							jQuery('.pro-alert-header').css('padding-top', '25px');
							jQuery('.pro-alert-header').css('padding-bottom', '20px');
							jQuery('.pro-alert-header').css('color', 'white');
						} else {
							Swal.fire('', 'Your Last request is Processing..!', 'warning');
						}
					} else {

						// For expired tokens status.
						Swal.fire({
							text: '<?php echo esc_html__( 'Your API token credit limit has expired !', 'sft-related-products-woocommerce' ); ?>',
							icon: "warning",
							showDenyButton: true,
							showCloseButton: true,
							confirmButtonText: '<?php echo esc_html__( 'Renew Credits', 'sft-related-products-woocommerce' ); ?>',
							denyButtonText: '<?php echo esc_html__( 'Configure API Key', 'sft-related-products-woocommerce' ); ?>',
							denyButtonColor: "#32CD32",
							confirmButtonColor: "#6CB4EE",
							}).then((result) => {
							if (result.isConfirmed) {

								// Move to billing page.
								window.location.assign('https://platform.openai.com/settings/organization/billing/');
							} else if (result.isDenied) {

								// Move to settings page.
								window.location.assign( '<?php echo esc_url( $api_settings_page ); ?>' );
							}
						});
					}
				}
			});
		});
	</script>
	<?php
}

// ------------------------------------------ Rating popup to show --------------------------------------.

add_action( 'wp_ajax_rpwfr_update', 'rpwfr_ajax_update_notice' );
add_action( 'wp_ajax_nopriv_rpwfr_update', 'rpwfr_ajax_update_notice' );

/**
 * Update rating Notice to be done after 10 days.
 */
function rpwfr_ajax_update_notice() {
	global $current_user;

	if ( isset( $_POST['nonce'] ) && ! empty( $_POST['nonce'] ) ) {
		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'sft-related-products-woocommerce' ) ) {
			wp_die( esc_html__( 'Permission Denied.', 'sft-related-products-woocommerce' ) );
		}

		update_user_meta( $current_user->ID, 'rpwfr_rate_notices', 'rated' );
		echo esc_url( network_admin_url() );
	}
	wp_die();
}

add_action( 'admin_notices', 'rpwfr_plugin_notice' );

/**
 * Rating notice widget.
 * Save the date to display notice after 10 days.<svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="0 0 640 512"><path fill="#f8c844" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5 .4 5.1 .8 7.7 .8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"/></svg><h5><b>' + 'Looking for this cool feature? Go Pro!<br> Go with our premium version to unlock the following features:' + '</b></h5><button class="rpwfr-upgrade-now" style="border: none"><a href="https://www.saffiretech.com" target="_blank" class="purchase-pro-link">
 */
function rpwfr_plugin_notice() {
	global $current_user;

	wp_enqueue_script( 'jquery' );

	// Current user id.
	$user_id = $current_user->ID;

	// if plugin is activated and date is not set then set the next 10 days.
	$today_date = strtotime( 'now' );

	// Update after 10 day date.
	if ( ! get_user_meta( $user_id, 'rpwfr_notices_time' ) ) {
		$after_10_day = strtotime( '+10 day', $today_date );
		update_user_meta( $user_id, 'rpwfr_notices_time', $after_10_day );
	}

	// gets the option of user rating status and week status.
	$rate_status = get_user_meta( $user_id, 'rpwfr_rate_notices', true );
	$next_w_date = get_user_meta( $user_id, 'rpwfr_notices_time', true );

	// show if user has not rated the plugin and it has been 10 days.
	if ( 'rated' !== $rate_status && $today_date > $next_w_date ) {
		?>
		<!-- Notice warning div -->
		<div class="notice notice-warning is-dismissible">
			<p><span><?php esc_html_e( "Awesome, you've been using", 'sft-related-products-woocommerce' ); ?></span><span><?php echo '<strong> Related Products for WooCommerce </strong>'; ?><span><?php esc_html_e( 'for more than 1 week', 'sft-related-products-woocommerce' ); ?></span></p>
			<p><?php esc_html_e( 'If you like our plugin would you like to rate our plugin at WordPress.org ?', 'sft-related-products-woocommerce' ); ?></p>
			<span><a href="https://wordpress.org/plugins/sft-related-products-woocommerce/#reviews" target="_blank"><?php esc_html_e( "Yes, I'd like to rate it!", 'sft-related-products-woocommerce' ); ?></a></span>&nbsp; - &nbsp;<span><a class="rpwfr_hide_rate" href="#"><?php esc_html_e( 'I already did!', 'sft-related-products-woocommerce' ); ?></a></span>
			<br/><br/>
		</div>
		<?php
	}
	?>

	<!-- Run the AJAX and mark as rated -->
	<script>
		let rpwfrAjaxURL = "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>";
		let rpwfrNonce = "<?php echo esc_attr( wp_create_nonce( 'sft-related-products-woocommerce' ) ); ?>";

		// redirect to same page after rated link is pressed.
		jQuery(".rpwfr_hide_rate").click(function (event) {
			event.preventDefault();

			jQuery.ajax({
				method: 'POST',
				url: rpwfrAjaxURL,
				data: {
					action: 'rpwfr_update',
					nonce: rpwfrNonce,
				},
				success: (res) => {
					window.location.href = window.location.href
				}
			});
		});
	</script>
	<?php
}

// -------------------------------------------- END -----------------------------------------------------.

// --------------------------------------- Call on chnage of notice -------------------------------------.

add_action( 'wp_ajax_rpwfr_taxonomyID_action', 'rpwfr_taxonomy_id_callback' );
add_action( 'wp_ajax_nopriv_rpwfr_taxonomyID_action', 'rpwfr_taxonomy_id_callback' );

/**
 * To display all products in tabular format for upsell and cross-sell .
 */
function rpwfr_taxonomy_id_callback() {

	if ( isset( $_POST['nonce'] ) && isset( $_POST['filterType'] ) && ! empty( $_POST['filterType'] ) && isset( $_POST['taxonomyID'] ) && ! empty( $_POST['taxonomyID'] ) ) {

		// Verify nonce.
		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'sft-related-products-woocommerce' ) ) {
			wp_die( esc_html__( 'Permission Denied.', 'sft-related-products-woocommerce' ) );
		}

		$filter_type = sanitize_text_field( wp_unslash( $_POST['filterType'] ) );
		$taxonomy_id = array_map( 'intval', wp_unslash( $_POST['taxonomyID'] ) );

		// Select the filter type.
		switch ( $filter_type ) {
			case 'rpwfr_buc-category':
				$products_ids = rpwfr_get_category_products_ids( $taxonomy_id );
				break;
			case 'rpwfr_buc-tags':
				$products_ids = rpwfr_get_tags_products_ids( $taxonomy_id );
				break;
			case 'rpwfr_buc-product':
				$products_ids = rpwfr_get_products_ids_products( $taxonomy_id );
				break;
			case 'rpwfr_buc-sku':
				$products_ids = rpwfr_get_products_ids_products( $taxonomy_id );
				break;
			default:
				break;
		}

		if ( ! empty( $products_ids ) && ! ( null === $products_ids ) ) {
			?>

			<!-- Show headers of tables -->
			<div>
				<span><?php esc_html_e( 'Product Name', 'sft-related-products-woocommerce' ); ?></span> 
				<span>
					<?php esc_html_e( 'Related Products', 'sft-related-products-woocommerce' ); ?>
				</span> 
				<span>
					<?php esc_html_e( 'UpSells', 'sft-related-products-woocommerce' ); ?>
					<svg class="rpwfr_pro_notice" onclick="rpwfr_call_notice()" xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#f8c844" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5 .4 5.1 .8 7.7 .8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"/></svg>
				</span>
				<span>
				<?php esc_html_e( 'Cross-Sells', 'sft-related-products-woocommerce' ); ?>
					<svg class="rpwfr_pro_notice" onclick="rpwfr_call_notice()" xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#f8c844" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5 .4 5.1 .8 7.7 .8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"/></svg>
				</span>
			</div>

			<?php
			// Get all products.
			$all_products        = rpwfr_get_all_products_with_variations();
			$all_simple_products = rpwfr_get_all_products();

			// Iterate all products ids.
			foreach ( $products_ids['data'] as $product_id ) {
				$product                 = wc_get_product( $product_id );
				$product_title           = $product->get_title();
				$related_products_ids    = get_post_meta( intval( $product_id ), 'related_products_individual_select', true );
				$product_sku             = $product->get_sku() ? ' (' . $product->get_sku() . ')' : false;
				$thumbnail               = $product->get_image( 'woocommerce_thumbnail' );
				$de_related_products_ids = empty( $related_products_ids ) ? array() : maybe_unserialize( $related_products_ids )[0];
				?>

				<!-- Each product row -->
				<div class="product-row">

					<!-- Product name image and title -->
					<div class ="product-name">
						<div class="rpwfr_buc-product-thumbnail">
							<a href="<?php echo esc_url( $product->get_permalink() ); ?>" target="_blank">
							<?php
							if ( $product->get_image_id() > 0 ) {
								echo wp_kses_post( $thumbnail );
							} else {
								$source = wc_placeholder_img_src( 'woocommerce_thumbnail' );
								echo '<img src="' . esc_url( $source ) . '">';
							}
							?>
							</a>
						</div>

						<div>
							<span class="rpwfr_buc-product-name"><?php esc_html_e( 'Product Name', 'sft-related-products-woocommerce' ); ?></span>
							<span class="rpwfr_buc-product-title"><a id="<?php echo esc_attr( $product_id ); ?>" href="<?php echo esc_url( $product->get_permalink() ); ?>" target="_blank"><?php echo 'ID:' . esc_attr( $product_id ) . ' ' . esc_attr( $product_title ) . ' ' . esc_attr( $product_sku ); ?></a></span>
						</div>
					</div>

					<!-- Related product bulk selection -->
					<div class="rpwfr-related-products">
						<select class="rpwfr-select2 related-token" id="<?php echo 'related-' . esc_attr( $product_id ); ?>" name="<?php echo 'related-' . esc_attr( $product_id ) . '[]'; ?>" data-placeholder="<?php echo esc_attr__( 'Search for a product…', 'sft-related-products-woocommerce' ); ?>" multiple="multiple">
							<?php
							foreach ( $all_simple_products as $rpwfr_product ) {
								if ( in_array( $rpwfr_product['product_id'], (array) $related_products_ids ) ) {
									echo '<option selected="selected" value="' . esc_attr( $rpwfr_product['product_id'] ) . '">' . esc_attr( $rpwfr_product['label'] ) . '</option >';
								} elseif ( $product_id !== $rpwfr_product['product_id'] ) {
									echo '<option value="' . esc_attr( $rpwfr_product['product_id'] ) . '">' . esc_attr( $rpwfr_product['label'] ) . '</option >';
								}
							}
							?>
						</select>
					</div>

					<!-- UpSells selection -->
					<div class="rpwfr-upsells-products related-pro-upsells" style="position:relative">
						<div style="filter: blur(2.3px); position:relative">
							<span class="rpwfr_buc-upsells"><?php esc_html_e( 'Upsells', 'sft-related-products-woocommerce' ); ?></span>
							<select class="rpwfr-select2 related-pro-plug upsells-token" id="<?php echo 'upsell-' . esc_attr( $product_id ); ?>" name="<?php echo 'upsell-' . esc_attr( $product_id ) . '[]'; ?>" data-placeholder="<?php echo esc_attr__( 'Search for a product…', 'sft-related-products-woocommerce' ); ?>" multiple="multiple">	
								<option selected="selected" value="38" data-select2-id="214">ID:38 Beanie with Logo (Woo-beanie-logo)</option>
								<option selected="selected" value="39">ID:39 Logo Collection (logo-collection)</option>
								<option selected="selected" value="28">ID:28 Polo (woo-polo)</option>
								<option selected="selected" value="29" data-select2-id="215">ID:29 Album (woo-album)</option>
							</select>
						</div>
						<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 100;">
							<button class="rpwfr-pro-button" onclick="rpwfr_call_notice(event)">
								<i class="fa fa-lock" style="font-size: 14px; color: #F8C844; padding-right: 10px;"></i>Upgrade Now
							</button>
						</div>
					</div>

					<!-- Cross-Sells selection -->
					<div class="rpwfr-crosssell-products related-pro-upsells" style="position:relative">
						<div style="filter: blur(2.3px); position:relative">
							<span class="rpwfr_buc-crosssells"><?php esc_html_e( 'Cross-sells', 'sft-related-products-woocommerce' ); ?></span>
							<select class="rpwfr-select2 related-pro-plug crosssells-token" id="<?php echo 'cross-sell-' . esc_attr( $product_id ); ?>" name="<?php echo 'cross-sell-' . esc_attr( $product_id ) . '[]'; ?>" data-placeholder="<?php echo esc_attr__( 'Search for a product…', 'sft-related-products-woocommerce' ); ?>" multiple="multiple">
								<option selected="selected" value="38" data-select2-id="214">ID:38 Beanie with Logo (Woo-beanie-logo)</option>
								<option selected="selected" value="39">ID:39 Logo Collection (logo-collection)</option>
								<option selected="selected" value="28">ID:28 Polo (woo-polo)</option>
								<option selected="selected" value="29" data-select2-id="215">ID:29 Album (woo-album)</option>
							</select>
						</div>
						<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 100;">
							<button class="rpwfr-pro-button" onclick="rpwfr_call_notice(event)">
								<i class="fa fa-lock" style="font-size: 14px; color: #F8C844; padding-right: 10px;"></i>Upgrade Now
							</button>
						</div>
					</div>
				</div>
				<?php
			}

			// Gets the product & page count.
			$product_total_count = intval( $products_ids['count'] );
			$total_page_numbers  = floatval( $product_total_count / 5 );

			if ( ! $total_page_numbers % 5 ) {
				++$product_total_count;
			}
			?>

			<!-- Page No showing -->
			<div class="pager">
				<div id="pageNumbers">
					<input type="hidden" value="<?php echo esc_html( $product_total_count ); ?>" class="rpwfr_total"/>
					<input type="hidden" value="<?php echo esc_html( $total_page_numbers ); ?>" class="rpwfr_total_pages"/>
				</div>
			</div>
			<?php
		}
	}
	?>

	<script>
		jQuery( '.rpwfr-pro-button' ).click( function(e){
			e.preventDefault();
		})

		var myTimeout = setTimeout(() => {
			jQuery( '.related-pro-upsells span.select2-selection--multiple  ul.select2-selection__rendered li.select2-selection__choice span.select2-selection__choice__remove' ).text('');

			// Pro field alert.
			jQuery( 'div.related-pro-upsells .select2-container .select2-selection--multiple .select2-selection__rendered li.select2-search > input.select2-search__field' ).on( 'keypress', function (e) {
				e.preventDefault();
				var rpwfrAlertMessage = 'Looking for this cool feature? Go Pro!';
				var rpwfrUpgradeNow = "Upgrade Now!";

				Swal.fire({
					title: '<div class="pro-alert-header"> Pro Field Alert! </div>',
					showCloseButton: true,
					html: '<div class="pro-crown"><svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#f8c844" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5 .4 5.1 .8 7.7 .8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"/></svg></div><div class="popup-text-one">Looking for this cool feature? Go Pro!</div><div class="popup-text-two">Go with our premium version to unlock the following features:</div> <ul><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg> Bulk Update  Related Products, Upsells, and Cross-Sells from a single screen.</li><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg> Custom Related Products  Shortcode with AJAX Slider. </li><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg> More Control for Related Products : Show Ratings, Sale Price, Widget Location & more. </li><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg> Sales Boost: Increase average order value and revenue. </li> </ul>' + '<button class="rpwfr-upgrade-now" style="border: none"><a href="https://www.saffiretech.com/woocommerce-related-products-pro?utm_source=wp_plugin&utm_medium=profield&utm_campaign=free2pro&utm_id=c1&utm_term=upgrade_now&utm_content=rpwfr" target="_blank" class="purchase-pro-link">'+rpwfrUpgradeNow+'</a></button>',
					customClass: "rpwfr-popup",
					showConfirmButton: false,
				});

				jQuery( '.rpwfr-popup' ).css('width', '800px');
				jQuery( '.rpwfr-popup > .swal2-header').css('background', '#061727' );
				jQuery( '.rpwfr-popup > .swal2-header').css('margin', '-20px' );
				jQuery( '.pro-alert-header' ).css('padding-top', '25px' );
				jQuery( '.pro-alert-header' ).css('padding-bottom', '20px' );
				jQuery( '.pro-alert-header' ).css( 'color', 'white' );
				jQuery( '.pro-crown' ).css( 'margin-top', '20px' );
				jQuery( '.popup-text-one').css( 'font-size', '30px' );
				jQuery( '.popup-text-one' ).css( 'font-weight', '600' );
				jQuery( '.popup-text-one' ).css( 'padding-bottom', '10px' );
				jQuery( '.rpwfr-popup > .swal2-content > .swal2-html-container > ul' ).css( 'text-align', 'justify' );
				jQuery( '.rpwfr-popup > .swal2-content > .swal2-html-container > ul' ).css( 'padding-left', '25px' );
				jQuery( '.rpwfr-popup > .swal2-content > .swal2-html-container > ul' ).css( 'padding-right', '25px' );
				jQuery( '.rpwfr-popup > .swal2-content > .swal2-html-container > ul' ).css( 'line-height', '2em' );
				jQuery( '.popup-text-two' ).css( 'padding', '10px' );
				jQuery( '.popup-text-two' ).css( 'font-weignt', '500');
				jQuery( '.rpwfr-popup > .swal2-content > .swal2-html-container > ul, .popup-text-one, .popup-text-two').css('color', '#061727' );

			});
		}, 200 );
	</script>

	<?php
	wp_die();
}
