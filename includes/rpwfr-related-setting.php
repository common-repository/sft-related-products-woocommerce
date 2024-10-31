<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Related Product field.
 */
function rpwfr_display_related_products_field() {
	?>
	<div style="display: flex; align-items: center;">

		<label class="switch">
			<input type="checkbox" class="rpwfr-display-switch" name="rpwfr_display_related_products" value="1" <?php echo checked( '1', esc_attr( get_option( 'rpwfr_display_related_products' ) ), false ); ?> style="padding-right: 12px;">
			<span class="slider round" ></span>
		</label>

		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to Hide Related Products section on Product page. By default related products will be displayed according to the setting provided .', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>

	</div>  
	<?php
}


/**
 * Display mode field.
 */
function rpwfr_display_mode_related_products_field() {
	?>

	<div style="display: flex; align-items: center;">

		<div class="rpwfr-display-mode">

			<input type="radio" class="rpwfr-display-mode-radio" id="theme" name="rpwfr_display_mode_related_products" value="theme"<?php echo checked( 'theme', esc_attr( get_option( 'rpwfr_display_mode_related_products' ) ), false ); ?> checked="checked">
			<label for="theme"><?php esc_html_e( 'Default Theme View', 'sft-related-products-woocommerce' ); ?></label><br>

			<input type="radio" class="rpwfr-display-mode-radio" id="ajaxslider" name="rpwfr_display_mode_related_products" value="ajaxslider"<?php echo checked( 'ajaxslider', esc_attr( get_option( 'rpwfr_display_mode_related_products' ) ), false ); ?>>
			<label for="ajaxslider"><?php esc_html_e( 'Ajax Slider Display', 'sft-related-products-woocommerce' ); ?></label><br>

		</div>
		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to choose the mode for displaying related products: Default Theme or Shortcode.', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
	</div>

		</div>
	<?php
}


/**
 * Shortcode mode related field.
 */
function rpwfr_shortcode_mode_related_products_field() {
	?>
	<div style="display: flex; align-items: center;">

		<div class="rpwfr-shortcode-option">

			<input type="radio" class="rpwfr-shortcode-option-radio" id="default" name="rpwfr_shortcode_mode_related_products" value="default"<?php echo checked( 'default', esc_attr( get_option( 'rpwfr_shortcode_mode_related_products' ) ), false ); ?>>
			<label for="default"><?php esc_html_e( 'Hook', 'sft-related-products-woocommerce' ); ?></label><br>

			<input type="radio" class="rpwfr-shortcode-option-radio" id="shortcode" name="rpwfr_shortcode_mode_related_products" value="shortcode"<?php echo checked( 'shortcode', esc_attr( get_option( 'rpwfr_shortcode_mode_related_products' ) ), false ); ?>>
			<label for="shortcode"><?php esc_html_e( 'Custom Shortcode.', 'sft-related-products-woocommerce' ); ?><span class = "rpwfr-related-shortcode-text" style=" margin-top: 10px;">        
				<?php esc_html_e( 'Use shortcode [rpwfr_custom_related_products_display]', 'sft-related-products-woocommerce' ); ?>  
				<button class="rpwfr-related-clipboard-button clipboard">&#128203;</button>  
			</span></label><br>

		</div>

		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows user to Opt for a shortcode with or without parameters. If rendered without parameters, the product page will display related products using the default theme.', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
	</div>
	<?php
}

/**
 * Column limit field.
 */
function rpwfr_theme_column_limit_field() {
	$column_limit = get_option( 'rpwfr_theme_column_limit' );
	?>
	<div class='rpwfr-theme-column-limit'>
	<?php
	if ( $column_limit ) {
		?>
		<input type="number" step="1" min="4" max="6" name="rpwfr_theme_column_limit" value="<?php echo esc_attr( get_option( 'rpwfr_theme_column_limit' ) ); ?>" style="
		margin-right: 15px;
		">
		<?php
	} else {
		?>
		<input type="number" step="1" min="4" max="6" name="rpwfr_theme_column_limit" value="4" style="
		margin-right: 15px;
		">
		<?php
	}
	?>
	</div>
	<?php
}

/**
 * Function to display products in provided rows and columns in default woocommerce related products .
 */
function rpwfr_theme_products_limit_field() {
	$product_limit = get_option( 'rpwfr_theme_products_limit' );
	?>
	<div class='rpwfr-theme-products-limit'>
		<?php
		if ( $product_limit ) {
			?>
				<input type="number" step="1" min="4" name="rpwfr_theme_products_limit" value="<?php echo esc_attr( get_option( 'rpwfr_theme_products_limit' ) ); ?>" style="
				margin-right: 15px;
				">
			<?php
		} else {
			?>
				<input type="number" step="1" min="4" name="rpwfr_theme_products_limit" value="4" style="
				margin-right: 15px;
				">
			<?php
		}
		?>
	</div>
	<?php
}

/**
 * Function to change title for related products .
 */
function rpwfr_label_field() {
	?>
	<div style="display: flex; align-items: center;" >
		<input type="text" id="rpwfr_label" class="rpwfr-title" name="rpwfr_related_title" value="<?php echo esc_attr( get_option( 'rpwfr_related_title' ) ); ?>" placeholder="<?php esc_html_e( 'Related Products', 'sft-related-products-woocommerce' ); ?>" style="margin-bottom: 10px;">
		<span class="setting-help-tip">         
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting enables you to specify the title you want to show for "Related Products" widget and shortcode.', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
	</div>
	<?php
}

/**
 * Takes the no of products to display in single row.
 */
function rpwfr_products_per_row_field() {
	// For desktop.
	$desktop_value = get_option( 'rpwfr_desktop' );
	?>

	<div class="rpwfr-resolution-limit">
		<i class="fa fa-desktop" aria-hidden="true" ></i>
		<?php

		if ( $desktop_value ) {
			?>
			<input type="number" step="1" min="4" max="6" name="rpwfr_desktop" value="<?php echo esc_attr( get_option( 'rpwfr_desktop' ) ); ?>" style="
			margin-right: 15px;
			">
			<?php
		} else {
			?>
			<input type="number" step="1" min="4" max="6" name="rpwfr_desktop" value="4" style="
			margin-right: 15px;
			">
			<?php
		}

		// For tab.
		$tab_value = get_option( 'rpwfr_tab' );

		?>
		<i class="fa fa-tablet" aria-hidden="true"></i>
		<?php

		if ( $tab_value ) {
			?>
			<input type="number" step="1" min="3" max="4" name="rpwfr_tab" value="<?php echo esc_attr( get_option( 'rpwfr_tab' ) ); ?>" style="
			margin-right: 15px;
			">
			<?php
		} else {
			?>
			<input type="number" step="1" min="3" max="4" name="rpwfr_tab" value="3" style="
			margin-right: 15px;
			">
			<?php
		}

		// For mobile.
		$mobile_value = get_option( 'rpwfr_mobile' );
		?>
		<i class="fa fa-mobile" aria-hidden="true"></i>
		<?php

		if ( $mobile_value ) {
			?>
			<input type="number" step="1" min="1" max="2" name="rpwfr_mobile" value="<?php echo esc_attr( get_option( 'rpwfr_mobile' ) ); ?>" >
			<?php
		} else {
			?>
			<input type="number" step="1" min="1" max="2" name="rpwfr_mobile" value="2" >
			<?php
		}

		?>
		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to specify the number of products you wish to showcase within the "Related Products" shortcode.', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
	</div>

	<?php
}

/**
 * Field to show/hide out of stock products
 */
function rpwfr_outofstock_field() {
	?>

	<div style="display: flex; align-items: center;">

		<label class="switch">
			<input type="checkbox" class="rpwfr-stock-status-switch pro" name="rpwfr_related_out_of_stock" value="1" <?php echo checked( '1', esc_attr( get_option( 'rpwfr_related_out_of_stock' ) ), false ); ?> style="padding-right: 12px;">
			<span class="slider round" ></span>
		</label>

		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to include or exclude out of stock products. By default all out of stock products are not shown.', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
	</div>
	<?php
}
