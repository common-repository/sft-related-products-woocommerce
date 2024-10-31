<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * UpSells setting section.
 */
function rpwfr_upsells_section() {
}

/**
 * Product display mode checkbox.
 */
function rpwfr_display_upsells_products_field() {
	?>
	<div style="display: flex; align-items: center;">

		<label class="switch">
			<input type="checkbox" class="rpwfr-display-switch pro" name="rpwfr_display_upsells_products" value="1" <?php echo checked( '1', esc_attr( get_option( 'rpwfr_display_upsells_products' ) ), false ); ?> style="padding-right: 12px;">
			<span class="slider round" ></span>
		</label>

		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to Hide UpSells Products section on Product page. By default related products will be displayed according to the setting provided .', 'sft-related-products-woocommerce' ); ?>    
			</div>
		</span>
	</div>  
	<?php
}

/**
 * UpSells product display mode checkbox.
 */
function rpwfr_display_mode_upsells_products_field() {
	?>
	<div style="display: flex; align-items: center;">

		<div class="rpwfr-display-mode">
			<input type="radio" class="rpwfr-display-mode-radio pro" id="theme" name="rpwfr_display_mode_upsells_products" value="theme"<?php echo checked( 'theme', esc_attr( get_option( 'rpwfr_display_mode_upsells_products' ) ), false ); ?>>
			<label for="theme"><?php esc_html_e( 'Default Theme View', 'sft-related-products-woocommerce' ); ?></label><br>

			<input type="radio" class="rpwfr-display-mode-radio pro" id="ajaxslider" name="rpwfr_display_mode_upsells_products" value="ajaxslider"<?php echo checked( 'ajaxslider', esc_attr( get_option( 'rpwfr_display_mode_upsells_products' ) ), false ); ?>>
			<label for="ajaxslider"><?php esc_html_e( 'Ajax Slider Display', 'sft-related-products-woocommerce' ); ?></label><br>
		</div>

		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to choose the mode for displaying related products: Default Theme or Shortcode.', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
		</div>
	<?php
}

/**
 * Function to change title for related products .
 */
function rpwfr_upsells_widget_title() {
	?>
	<div style="display: flex; align-items: center;" >
		<input type="text" id="rpwfr_label" class="rpwfr-title pro" name="rpwfr_upsells_title" value="<?php echo esc_attr( get_option( 'rpwfr_upsells_title' ) ); ?>" placeholder="<?php esc_html_e( 'UpSells Products', 'sft-related-products-woocommerce' ); ?>" style="margin-bottom: 10px;">
		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting enables you to specify the title you want to show for "UpSells Products" widget and shortcode.', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
	</div>
	<?php
}


/**
 * Takes the no of products to display in single row.
 */
function rpwfr_upsells_products_per_row_field() {
	$desktop_value = get_option( 'rpwfr_upsells_desktop' ); // For desktop.
	?>

	<div class="rpwfr-resolution-limit">
		<i class="fa fa-desktop" aria-hidden="true" ></i>
		<?php

		if ( $desktop_value ) {
			?>
			<input type="number" step="1" min="4" max="6" name="rpwfr_upsells_desktop pro" value="<?php echo esc_attr( get_option( 'rpwfr_upsells_desktop' ) ); ?>" style="
			margin-right: 15px;
			">
			<?php
		} else {
			?>
			<input type="number" step="1" min="4" max="6" name="rpwfr_upsells_desktop pro" value="4" style="
			margin-right: 15px;
			">
			<?php
		}

		// For tab.
		$tab_value = get_option( 'rpwfr_upsells_tab' );
		?>
		<i class="fa fa-tablet" aria-hidden="true"></i>
		<?php

		if ( $tab_value ) {
			?>
			<input type="number" step="1" min="3" max="4" name="rpwfr_upsells_tab pro" value="<?php echo esc_attr( get_option( 'rpwfr_upsells_tab' ) ); ?>" style="
			margin-right: 15px;
			">
			<?php
		} else {
			?>
			<input type="number" step="1" min="3" max="4" name="rpwfr_upsells_tab pro" value="3" style="
			margin-right: 15px;
			">
			<?php
		}

		// For mobile.
		$mobile_value = get_option( 'rpwfr_upsells_mobile' );
		?>
		<i class="fa fa-mobile" aria-hidden="true"></i>
		<?php

		if ( $mobile_value ) {
			?>
			<input type="number" step="1" min="1" max="2" name="rpwfr_upsells_mobile pro" value="<?php echo esc_attr( get_option( 'rpwfr_upsells_mobile' ) ); ?>" >
			<?php
		} else {
			?>
			<input type="number" step="1" min="1" max="2" name="rpwfr_upsells_mobile pro" value="2" >
			<?php
		}

		?>
		<span class="setting-help-tip">        
			<div class="tooltipdata">        
				<?php esc_html_e( 'This setting allows you to specify the number of products you wish to showcase within the "UpSells Products" AJAX slider.', 'sft-related-products-woocommerce' ); ?>    
			</div>    
		</span>
	</div>
	<?php
}
