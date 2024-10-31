<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'wp_ajax_related_product_filter', 'rpwfr_related_product_filter' );
add_action( 'wp_ajax_nopriv_related_product_filter', 'rpwfr_related_product_filter' );

/**
 * Function to check categories and tag changed on product page to display related prdoucts
 */
function rpwfr_related_product_filter() {

	// Check if the nonce and product filter check are set.
	if ( isset( $_POST['rpwfr_nonce'] ) && isset( $_POST['product_filter_check'] ) ) {

		// Verify the nonce for security.
		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['rpwfr_nonce'] ) ), 'sft-related-products-woocommerce' ) ) {
			wp_die( esc_html__( 'Permission Denied.', 'sft-related-products-woocommerce' ) );
		}

		// Check if any of the category or tag filters are set.
		if ( isset( $_POST['related_products_incl_cat'] ) || isset( $_POST['related_products_excl_cat'] ) || isset( $_POST['related_products_incl_tag'] ) || isset( $_POST['related_products_excl_tag'] ) ) {

			// Sanitize and set the included categories, if set.
			if ( isset( $_POST['related_products_incl_cat'] ) && is_array( $_POST['related_products_incl_cat'] ) ) {
				$category_include = array_map( 'sanitize_text_field', wp_unslash( $_POST['related_products_incl_cat'] ) );
			} else {
				$category_include = array();
			}

			if ( isset( $_POST['related_products_excl_cat'] ) && is_array( $_POST['related_products_excl_cat'] ) ) {
				$category_exclude = array_map( 'sanitize_text_field', wp_unslash( $_POST['related_products_excl_cat'] ) );
			} else {
				$category_exclude = array();
			}

			if ( isset( $_POST['related_products_incl_tag'] ) && is_array( $_POST['related_products_incl_tag'] ) ) {
				$related_products_incl_tag = array_map( 'sanitize_text_field', wp_unslash( $_POST['related_products_incl_tag'] ) );
			} else {
				$related_products_incl_tag = array();
			}

			if ( isset( $_POST['related_products_excl_tag'] ) && is_array( $_POST['related_products_excl_tag'] ) ) {
				$related_products_excl_tag = array_map( 'sanitize_text_field', wp_unslash( $_POST['related_products_excl_tag'] ) );
			} else {
				$related_products_excl_tag = array();
			}

			// Initialize arrays to store product IDs and all products.
			$related_products_incl_cat_ids = array();
			$related_products_excl_cat_ids = array();
			$tags_include_ids              = array();
			$tags_exclude_ids              = array();
			$product_ids                   = array();
			$all_products                  = array();

			// Set up the arguments for the WP_Query to retrieve all products.
			$args = array(
				'posts_per_page' => -1,
				'post_type'      => 'product',
			);

			// Execute the query to retrieve all products.
			$query = new WP_Query( $args );
			foreach ( $query->posts as $product ) {
				array_push( $all_products, $product->ID );
			}

			if ( ! empty( $category_include ) ) {
				$args_category_include = array(
					'posts_per_page' => -1,
					'post_type'      => 'product',
					'tax_query'      => array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => $category_include,
						),
					),
				);

				$query_category_include = new WP_Query( $args_category_include );

				// Product ids with Categories included are obtained.
				foreach ( $query_category_include->posts as $post ) {
					array_push( $related_products_incl_cat_ids, $post->ID );
				}

				// To get only those ids of products which have those categories included.
				$related_products_incl_cat_ids = array_intersect( $all_products, $related_products_incl_cat_ids );

				foreach ( $related_products_incl_cat_ids as $id ) {
					array_push( $product_ids, $id );
				}
			}

			if ( ! empty( $category_exclude ) ) {

				$args_category_exclude = array(
					'posts_per_page' => -1,
					'post_type'      => 'product',
					'tax_query'      => array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => $category_exclude,
						),
					),
				);

				$query_category_exclude = new WP_Query( $args_category_exclude );

				// Product ids with Categories included in query are obtained.
				foreach ( $query_category_exclude->posts as $post ) {
					array_push( $related_products_excl_cat_ids, $post->ID );
				}

				// To get product ids which do not contained selected categories.
				$related_products_excl_cat_ids = array_diff( $all_products, $related_products_excl_cat_ids );

				foreach ( $related_products_excl_cat_ids as $id ) {
					array_push( $product_ids, $id );
				}

				wp_reset_query();
			}

			if ( ! empty( $related_products_incl_tag ) ) {
				$args_related_products_incl_tag = array(
					'posts_per_page' => -1,
					'post_type'      => 'product',
					'tax_query'      => array(
						array(
							'taxonomy' => 'product_tag',
							'field'    => 'slug',
							'terms'    => $related_products_incl_tag,
						),
					),
				);

				$query_related_products_incl_tag = new WP_Query( $args_related_products_incl_tag );

				// Product ids with Tags included in query are obtained.
				foreach ( $query_related_products_incl_tag->posts as $post ) {
					array_push( $tags_include_ids, $post->ID );
				}

				// If there is no element in $product_ids, elements containing selected tag will be pushed to $product_ids.
				if ( ! empty( $product_ids ) ) {

					if ( ! empty( $category_include ) ) {

						$tags_include_ids = array_intersect( $all_products, $tags_include_ids );

						foreach ( $tags_include_ids as $id ) {
							array_push( $product_ids, $id );
						}
					} else {
						$product_ids = array_intersect( $product_ids, $tags_include_ids );
					}
				} elseif ( empty( $product_ids ) && ! empty( $tags_include_ids ) ) {
					$product_ids = $tags_include_ids;
				}
				// No need to check if products included in tag are present in $product_ids or not, the product will be shown if it is a part of $all_products.

				wp_reset_query();
			}

			if ( ! empty( $related_products_excl_tag ) ) {

				$args_related_products_excl_tag = array(
					'posts_per_page' => -1,
					'post_type'      => 'product',
					'tax_query'      => array(
						array(
							'taxonomy' => 'product_tag',
							'field'    => 'slug',
							'terms'    => $related_products_excl_tag,
						),
					),
				);

				$query_related_products_excl_tag = new WP_Query( $args_related_products_excl_tag );

				// Product ids with Tags included in query are obtained.
				foreach ( $query_related_products_excl_tag->posts as $post ) {
					array_push( $tags_exclude_ids, $post->ID );
				}

				// If there is no element in $product_ids, elements not containing selected tag will be pushed to $product_ids.
				if ( ! intval( $product_ids[0] ) ) {
					$tags_exclude_ids = array_diff( $all_products, $tags_exclude_ids );
					foreach ( $tags_exclude_ids as $id ) {
						array_push( $product_ids, $id );
					}
				} else {
					$tags_exclude_ids = array_intersect( $product_ids, $tags_exclude_ids );
					$product_ids      = array_diff( $product_ids, $tags_exclude_ids );
				}
			}

			if ( ! empty( $product_ids ) ) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}
	wp_die();
}
