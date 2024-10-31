<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Settings section callback.
 */
function rpwfr_general_settings_section() {
}

/**
 * Field to pick background color for front shortcodes
 */
function rpwfr_general_bgcolor_picker_field() {
	$bg_value = get_option( 'rpwfr_general_color_picker_background_front' );
	?>
	<div style="display: flex; align-items: center;margin-bottom: 10px;">
		<?php
		if ( $bg_value ) {
			?>
			<div style="display: flex; align-items: center;">
				<input type="text" class="rpwfr-btn-color" name="rpwfr_general_color_picker_background_front" value="<?php echo esc_attr( get_option( 'rpwfr_general_color_picker_background_front' ) ); ?>" placeholder="<?php esc_html_e( 'Add label', 'sft-related-products-woocommerce' ); ?>">
			</div>
			<?php
		} else {
			?>
			<div style="display: flex; align-items: center;">
				<input type="text" class="rpwfr-btn-color" name="rpwfr_general_color_picker_background_front" value="#e8e8e8" placeholder="<?php esc_html_e( 'Add label', 'sft-related-products-woocommerce' ); ?>">
			</div>
			<?php
		}
		?>
		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to pick the background color to change background color of products slider', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
	</div>
	<?php
}

/**
 * Field to pick color for back and next button.
 */
function rpwfr_general_color_picker_field() {
	$btn_color = get_option( 'rpwfr_general_color_picker_btn' );
	if ( $btn_color ) {
		?>
		<div style="display: flex; align-items: center;">
			<input type="text" class="rpwfr-btn-color" name="rpwfr_general_color_picker_btn" value="<?php echo esc_attr( get_option( 'rpwfr_general_color_picker_btn' ) ); ?>" placeholder="<?php esc_html_e( 'Add label', 'sft-related-products-woocommerce' ); ?>">
			<span class="setting-help-tip">        
				<div class="tooltipdata">        
					<?php esc_html_e( 'This setting allows you to pick the color to change color of previous and next button within shortcode', 'sft-related-products-woocommerce' ); ?>    
				</div>    
			</span>
		</div>
		<?php
	} else {
		?>
		<div style="display: flex; align-items: center;">
			<input type="text" class="rpwfr-btn-color" name="rpwfr_general_color_picker_btn" value="#000000" placeholder="<?php esc_html_e( 'Add label', 'sft-related-products-woocommerce' ); ?>">
			<span class="setting-help-tip">        
				<div class="tooltipdata">        
					<?php esc_html_e( 'This setting allows you to pick the color to change color of previous and next button within shortcode', 'sft-related-products-woocommerce' ); ?>    
				</div>    
			</span>
		</div>
		<?php
	}

}

/**
 * Get size of product image .
 */
function rpwfr_general_image_size_field() {
	?>
	<div style="display: flex; align-items: center;margin-bottom: 10px;">

		<div class="rpwfr-product-image">
			<input type="radio" class="image_size" id="thumbnail" name="rpwfr_general_product_image_size" value="thumbnail"<?php echo checked( 'thumbnail', esc_attr( get_option( 'rpwfr_general_product_image_size' ) ), false ); ?> checked="checked">
			<label for="thumbnail"><?php esc_html_e( 'Thumbnail', 'sft-related-products-woocommerce' ); ?></label>
			<br/>
			<input type="radio" class="image_size" id="full" name="rpwfr_general_product_image_size" value="full"<?php echo checked( 'full', esc_attr( get_option( 'rpwfr_general_product_image_size' ) ), false ); ?>>
			<label for="full"><?php esc_html_e( 'Full Size', 'sft-related-products-woocommerce' ); ?></label><br>
		</div>

		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to select image size you wish to display to users', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>

	</div>
	<?php
}

/**
 * Function to display/hide reorder button on order detail page.
 */
function rpwfr_reorder_field() {
	?>
	<div style="display: flex; align-items: center;">
		<label class="switch">
			<input type="checkbox" class="rpwfr_display_reorder pro" name="rpwfr_display_reorder" value="1" checked="checked" style="padding-right: 12px;">
			<span class="slider round" ></span>
		</label>
		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to enable/disable Re-order button on Order detail page in My Account', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
	</div>
	<?php
}
