<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'wp_ajax_rpwfr_save_all_selected_products', 'rpwfr_save_all_selected_products' );
add_action( 'wp_ajax_nopriv_rpwfr_save_all_selected_products', 'rpwfr_save_all_selected_products' );

/**
 * To save all upsell and cross-sell product ids on submit.
 * Sanitizing a multi-dimensional array reference: https://github.com/WordPress/WordPress-Coding-Standards/issues/1660.
 */
function rpwfr_save_all_selected_products() {

	if ( isset( $_POST['nonce'] ) && current_user_can( 'edit_products' ) && isset( $_POST['selected_data'] ) && ! empty( $_POST['selected_data'] ) ) {

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'sft-related-products-woocommerce' ) ) {
			wp_die( esc_html__( 'Permission Denied.', 'sft-related-products-woocommerce' ) );
		}

		$selected_data = map_deep( wp_unslash( $_POST['selected_data'] ), 'sanitize_text_field' );

		// Saved all selected related products.
		foreach ( $selected_data as $selected_product ) {

			$product_id = intval( $selected_product['rpwfr_product_id'] );
			$product    = wc_get_product( $product_id );

			if ( $product ) {

				// Related products.
				$related_product_ids = array_map( 'intval', (array) $selected_product['rpwfr_product_related_ids'] );

				$related_key = array_search( $product_id, $related_product_ids, true );

				if ( false !== $related_key ) {
					unset( $related_product_ids[ $related_key ] );
				}

				update_post_meta( $product_id, 'related_products_individual_select', $related_product_ids );

				// Save Related products.
				$product->save();
			}
		}
	}

	die();
}

// ----------------------------- Load all produt based on selection on bulk edit ----------------------------.

/**
 * To return all categories names with ID for select2 options .
 *
 * @return string $categories_option .
 */
function rpwfr_select2_get_all_categories() {

	$categories_option = '';

	$args = array(
		'taxonomy'   => 'product_cat',
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true,
	);

	$product_categories = get_terms( $args );

	foreach ( $product_categories as $category ) {
		$category_slug      = $category->slug ? ' ( ' . $category->slug . ' )' : false;
		$categories_option .= '<option value="' . esc_attr( intval( $category->term_id ) ) . '">' . esc_attr( $category->name . ' ' . $category_slug ) . '</option >';
	}

	return $categories_option;
}

/**
 * To return all tags names with ID for select2 options .
 *
 * @return string $tags_option .
 */
function rpwfr_select2_get_all_tags() {
	$tags_option = '';

	$args = array(
		'taxonomy'   => 'product_tag',
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true,

	);

	$product_tags = get_terms( $args );
	$all_tags     = array();

	foreach ( $product_tags as $tag ) {
		$tag_id       = strval( $tag->term_id );
		$all_tags[]   = array(
			'tag_id' => intval( $tag_id ),
			'label'  => 'ID:' . esc_attr( $tag->term_id ) . ' ' . esc_attr( $tag->name ),
		);
		$tags_option .= '<option value="' . esc_attr( intval( $tag->term_id ) ) . '">ID:' . esc_attr( $tag->term_id ) . ' ' . esc_attr( $tag->name ) . '</option >';
	}

	return $tags_option;
}

/**
 * To return all products SKU for select2 options.
 *
 * @return string $sku_option .
 */
function rpwfr_select2_get_all_product_sku() {

	$sku_option = '';

	$products_id = wc_get_products(
		array(
			'limit'  => -1, // All products.
			'status' => 'publish', // Only published products.
			'return' => 'ids',
		)
	);

	foreach ( $products_id as $product_id ) {
		$product     = wc_get_product( $product_id );
		$sku_option .= '<option value="' . intval( $product_id ) . '">ID:' . esc_attr( $product_id ) . ' ' . esc_html( wp_strip_all_tags( $product->get_formatted_name() ) ) . '</option >';
	}

	return $sku_option;
}

// ----------------------------------- Load all product in mutiselect box at bulk edit-----------------------.

/**
 * All products in required format.
 *
 * @return array $all_products .
 */
function rpwfr_get_all_products() {

	// Store all products.
	$all_products = array();

	// Get all products id.
	$products_id = wc_get_products(
		array(
			'limit'  => -1, // All products.
			'status' => 'publish', // Only published products.
			'return' => 'ids',
		)
	);

	// return all product is required format.
	foreach ( $products_id as $product_id ) {
		$product = wc_get_product( $product_id );

		$all_products[] = array(
			'product_id' => intval( $product_id ),
			'label'      => 'ID:' . esc_attr( $product_id ) . ' ' . esc_html( wp_strip_all_tags( $product->get_formatted_name() ) ),
		);
	}

	return $all_products;
}

// ----------------------------------------- Get product ids with offset ------------------------------------.

/**
 * To return products Ids for given tag_ids.
 *
 * @param array $tag_ids array of tag ids.
 * @return array $product_ids .
 */
function rpwfr_get_tags_products_ids( $tag_ids ) {
	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$id_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $id_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	$terms_slug  = array(); // Stores all term slug.
	$product_ids = array(); // Store all product id.

	foreach ( $tag_ids as $tag_id ) {
		$term = get_term( $tag_id );
		array_push( $terms_slug, $term->slug );
	}

	// All product count with selected categories.
	$product_id_count = wc_get_products(
		array(
			'tag'    => $terms_slug,
			'limit'  => -1,
			'status' => 'publish',
			'return' => 'ids',
		)
	);

	// set product limit.
	$product_id = wc_get_products(
		array(
			'tag'    => $terms_slug,
			'limit'  => isset( $_POST['limit_data'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['limit_data'] ) ) ) : 5,
			'offset' => isset( $_POST['offset_data'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['offset_data'] ) ) ) : 0,
			'status' => 'publish',
			'return' => 'ids',
		)
	);

	array_push( $product_ids, ...$product_id );

	return array(
		'count' => count( $product_id_count ),
		'data'  => array_unique( $product_ids ),
	);
}

/**
 * To return products Ids for given category_ids.
 *
 * @param array $category_ids array of category ids.
 * @return array $product_ids .
 */
function rpwfr_get_category_products_ids( $category_ids ) {
	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$id_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $id_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	$terms_slug  = array(); // Stores all term slug.
	$product_ids = array(); // Store all product id.

	// Gets all term slug.
	foreach ( $category_ids as $category_id ) {
		$term = get_term( $category_id );
		array_push( $terms_slug, $term->slug );
	}

	// All product count with selected categories.
	$product_id_count = wc_get_products(
		array(
			'category' => $terms_slug,
			'limit'    => -1,
			'status'   => 'publish',
			'return'   => 'ids',
		)
	);

	// Get all product ids.
	$product_id = wc_get_products(
		array(
			'category' => $terms_slug,
			'limit'    => isset( $_POST['limit_data'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['limit_data'] ) ) ) : 5,
			'offset'   => isset( $_POST['offset_data'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['offset_data'] ) ) ) : 0,
			'status'   => 'publish',
			'return'   => 'ids',
		)
	);

	array_push( $product_ids, ...$product_id );

	return array(
		'count' => count( $product_id_count ),
		'data'  => array_unique( $product_ids ),
	);
}

/**
 * To return products Ids for given tag_ids.
 *
 * @param array $product_ids array of product ids.
 * @return array $product_ids .
 */
function rpwfr_get_products_ids_products( $product_ids ) {

	// Nonce verification.
	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$id_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $id_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	// Stores all product id.
	$product_id_array = array();

	foreach ( $product_ids as $product_id ) {
		array_push( $product_id_array, $product_id );
	}

	// Set product limit.
	$product_with_limits = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => isset( $_POST['limit_data'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['limit_data'] ) ) ) : 5,
		'offset'         => isset( $_POST['offset_data'] ) ? intval( sanitize_text_field( wp_unslash( $_POST['offset_data'] ) ) ) : 0,
		'post__in'       => array_unique( $product_ids ),
		'fields'         => 'ids',
	);

	$products_posts = new WP_Query( $product_with_limits );

	return array(
		'count' => count( array_unique( $product_id_array ) ),
		'data'  => array_unique( $products_posts->posts ),
	);
}
