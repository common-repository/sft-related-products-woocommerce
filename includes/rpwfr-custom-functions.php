<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Function to manipulate related product section provided by woocommerce on product page
 *
 * @param mixed $related_posts .
 * @param mixed $product_id .
 * @param mixed $args .
 * @return $related_products_id
 */
function rpwfr_related_products_section( $related_posts, $product_id, $args ) {
	// Initialize an array to store the IDs of related products.
	$related_products_id = array();

	// Initialize an array to store the categories of the product.
	$categories = array();

	// Retrieve individual products selected for related products, if any.
	$individual_products = get_post_meta( get_the_ID(), 'related_products_individual_select', true );

	// Check if individual products are selected for related products.
	if ( ! empty( $individual_products ) ) {
		// Add the selected individual product IDs to the related products array.
		foreach ( $individual_products as $pid ) {
			array_push( $related_products_id, $pid );
		}
	} elseif ( 'default' === (string) get_post_meta( $product_id, 'rpwfr_filter_radio', true ) ) {
		// If the default filter is selected, retrieve related products based on product categories.

		// Get the categories of the current product.
		$cat_terms = wp_get_post_terms( $product_id, 'product_cat' );

		// Add the slugs of the product categories to the categories array.
		foreach ( $cat_terms as $cat ) {
			array_push( $categories, $cat->slug );
		}

		// Set up the arguments for the WP_Query to retrieve products from the same categories.
		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'product',
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $categories,
				),
			),
		);

		// Execute the query to retrieve related products.
		$query = new WP_Query( $args );

		// Add the IDs of the retrieved products to the related products array.
		foreach ( $query->posts as $product ) {
			array_push( $related_products_id, $product->ID );
		}
	} else {
		// If custom filters are selected, retrieve related products based on the selected categories and tags.

		// Define the meta keys for the included and excluded categories and tags.
		$cat_include = 'rpwfr_related_products_category_include_select';
		$cat_exclude = 'rpwfr_related_products_category_exclude_select';
		$tag_include = 'rpwfr_related_products_tag_incldue_select';
		$tag_exclude = 'rpwfr_related_products_tag_exclude_select';

		// Retrieve the related product IDs based on the category and tag filters.
		$related_products_id = rpwfr_category_tag_filter( $product_id, $cat_include, $cat_exclude, $tag_include, $tag_exclude );
	}

	// Check if there are related products.
	if ( ! empty( $related_products_id ) ) {
		// Exclude the current product from the related products array.
		$product_id          = array( get_the_ID() );
		$related_products_id = array_diff( $related_products_id, $product_id );
	}

	// Return the array of related product IDs.
	return $related_products_id;
}


/**
 * Function to display woocommerce related products according to rows and columns .
 *
 * @param mixed $args .
 * @return $args .
 */
function rpwfr_row_column_related_products( $args ) {
	$columns                = (string) get_option( 'rpwfr_theme_column_limit' );
	$products_slider_limit  = (string) get_option( 'rpwfr_theme_products_limit' );
	$args['posts_per_page'] = intval( $products_slider_limit ) ? intval( $products_slider_limit ) : 10; // # of related products
	$args['columns']        = intval( $columns ) ? intval( $columns ) : 4;
	// # of columns per row
	return $args;
}

/**
 * Function to display custom fields on product edit page
 */
function rpwfr_related_product_add_fields() {

	// Retrieve the current value of the radio filter option for related products.
	$display_filter = get_post_meta( get_the_ID(), 'rpwfr_filter_radio', true );

	// If no value is set for the radio button, set the default option.
	if ( '' === $display_filter ) {
		update_post_meta( get_the_ID(), 'rpwfr_filter_radio', 'default' );
	}

	// Display a radio button group for selecting the related-products filter mode.
	woocommerce_wp_radio(
		array(
			'id'          => 'rpwfr_filter_radio',
			'label'       => __( 'Related-Products Filter', 'sft-related-products-woocommerce' ),
			'options'     => array(
				'default'    => __( 'Default', 'sft-related-products-woocommerce' ),
				'categories' => __( 'Categories Only', 'sft-related-products-woocommerce' ),
				'tags'       => __( 'Tags Only', 'sft-related-products-woocommerce' ),
				'both'       => __( 'Categories and Tags', 'sft-related-products-woocommerce' ),
				'individual' => __( 'Individual Pick', 'sft-related-products-woocommerce' ),
			),
			'default'     => 'default',
			'desc_tip'    => 'true',
			'description' => __( 'Related products to be displayed on the Product Page', 'sft-related-products-woocommerce' ),
		)
	);

	// Display a radio button group for selecting the category filter mode (include or exclude).
	woocommerce_wp_radio(
		array(
			'id'          => 'rpwfr_category_radio',
			'label'       => __( 'Category Filter Mode', 'sft-related-products-woocommerce' ),
			'options'     => array(
				'include_cat' => __( 'Include Categories', 'sft-related-products-woocommerce' ),
				'exclude_cat' => __( 'Exclude Categories', 'sft-related-products-woocommerce' ),
			),
			'desc_tip'    => 'true',
			'description' => __( 'Related products to be displayed on the Product Page', 'sft-related-products-woocommerce' ),
		)
	);

	// Display a multi-select dropdown for selecting categories to include in the related products.
	woocommerce_wp_select(
		array(
			'id'                => 'rpwfr_related_products_category_include_select',
			'name'              => 'rpwfr_related_products_category_include_select[]',
			'label'             => __( 'Categories to include', 'sft-related-products-woocommerce' ),
			'type'              => 'select',
			'class'             => 'select short rpwfr-common',
			'options'           => rpwfr_products_level_category(),
			'desc_tip'          => 'true',
			'description'       => __( 'Related products to be displayed on the Product Page', 'sft-related-products-woocommerce' ),
			'custom_attributes' => array(
				'multiple' => 'multiple',
			),
		)
	);

	// Display a multi-select dropdown for selecting categories to exclude from the related products.
	woocommerce_wp_select(
		array(
			'id'                => 'rpwfr_related_products_category_exclude_select',
			'name'              => 'rpwfr_related_products_category_exclude_select[]',
			'label'             => __( 'Categories to exclude', 'sft-related-products-woocommerce' ),
			'type'              => 'select',
			'class'             => 'select short rpwfr-common',
			'options'           => rpwfr_products_level_category(),
			'desc_tip'          => 'true',
			'description'       => __( 'Related products to be displayed on the Product Page', 'sft-related-products-woocommerce' ),
			'custom_attributes' => array(
				'multiple' => 'multiple',
			),
		)
	);

	// Display a radio button group for selecting the tag filter mode (include or exclude).
	woocommerce_wp_radio(
		array(
			'id'          => 'rpwfr_tag_radio',
			'label'       => __( 'Tag Filter Mode', 'sft-related-products-woocommerce' ),
			'options'     => array(
				'include_tag' => __( 'Include Tags', 'sft-related-products-woocommerce' ),
				'exclude_tag' => __( 'Exclude Tags', 'sft-related-products-woocommerce' ),
			),
			'desc_tip'    => 'true',
			'description' => __( 'Related products to be displayed on the Product Page', 'sft-related-products-woocommerce' ),
		)
	);

	// Display a multi-select dropdown for selecting tags to include in the related products.
	woocommerce_wp_select(
		array(
			'id'                => 'rpwfr_related_products_tag_incldue_select',
			'name'              => 'rpwfr_related_products_tag_incldue_select[]',
			'label'             => __( 'Tags to include', 'sft-related-products-woocommerce' ),
			'type'              => 'select',
			'class'             => 'select short rpwfr-common',
			'options'           => rpwfr_products_level_tag(),
			'desc_tip'          => 'true',
			'description'       => __( 'Related products to be displayed on the Product Page', 'sft-related-products-woocommerce' ),
			'custom_attributes' => array(
				'multiple' => 'multiple',
			),
		)
	);

	// Display a multi-select dropdown for selecting tags to exclude from the related products.
	woocommerce_wp_select(
		array(
			'id'                => 'rpwfr_related_products_tag_exclude_select',
			'name'              => 'rpwfr_related_products_tag_exclude_select[]',
			'label'             => __( 'Tags to exclude', 'sft-related-products-woocommerce' ),
			'type'              => 'select',
			'class'             => 'select short rpwfr-common',
			'options'           => rpwfr_products_level_tag(),
			'desc_tip'          => 'true',
			'description'       => __( 'Related products to be displayed on the Product Page', 'sft-related-products-woocommerce' ),
			'custom_attributes' => array(
				'multiple' => 'multiple',
			),
		)
	);

	// Display a multi-select dropdown for selecting individual products to be displayed as related products.
	woocommerce_wp_select(
		array(
			'id'                => 'related_products_individual_select',
			'name'              => 'related_products_individual_select[]',
			'label'             => __( 'Select Individual products', 'sft-related-products-woocommerce' ) . '<span class="rpwfr-individual-pro"></span>',
			'type'              => 'select',
			'class'             => 'select short',
			'options'           => rpwfr_products_level_individual(),
			'desc_tip'          => 'true',
			'description'       => __( 'Related products to be displayed on the Product Page', 'sft-related-products-woocommerce' ),
			'custom_attributes' => array(
				'multiple' => 'multiple',
			),
		)
	);
}

/**
 * Function to get all the categories to be displayed in select2 on product edit page .
 *
 * @return $categories_selection .
 */
function rpwfr_products_level_category() {
	// Retrieve all product categories.
	$categories = get_terms( 'product_cat' );

	// Initialize an array to store the category selections.
	$categories_selection = array();

	// Loop through each category and add its slug to the selection array.
	foreach ( $categories as $cat ) {
		$categories_selection[ $cat->slug ] = $cat->slug;
	}

	// Return the array of category selections.
	return $categories_selection;
}


/**
 * Function to get all the Tags to be displayed in select2 on product edit page .
 *
 * @return $tags_selection .
 */
function rpwfr_products_level_tag() {
	// Retrieve all product tags.
	$tags = get_terms( 'product_tag' );

	// Initialize an array to store the tag selections.
	$tags_selection = array();

	// Loop through each tag and add its slug to the selection array.
	foreach ( $tags as $tag ) {
		$tags_selection[ $tag->slug ] = $tag->slug;
	}

	// Return the array of tag selections.
	return $tags_selection;
}


/**
 * Function to get all the products to be displayed in select2 on product edit page .
 *
 * @return $individual_pick .
 */
function rpwfr_products_level_individual() {
	// Initialize an array to store all product IDs.
	$all_product_ids = array();

	// Initialize an array to store individual picks with product ID as key and title as value.
	$individual_pick = array();

	// Get the current product ID.
	$product_id = array( get_the_ID() );

	// Retrieve all published products.
	$products = wc_get_products(
		array(
			'limit'  => -1, // All products.
			'status' => 'publish', // Only published products.
		)
	);

	// Loop through each product and add its ID to the all_product_ids array.
	foreach ( $products as $product ) {
		array_push( $all_product_ids, $product->get_id() );
	}

	// Exclude the current product from the list.
	$final_products_ids = array_diff( $all_product_ids, $product_id );

	// Loop through each remaining product and add its ID and title to the individual_pick array.
	foreach ( $final_products_ids as $id ) {
		$title                  = get_the_title( $id );
		$individual_pick[ $id ] = $title;
	}

	// Return the array of individual picks.
	return $individual_pick;
}

/**
 * Function to save the value selected in cuatom fields on product edit page .
 *
 * @param integer $post_id .
 */
function rpwfr_product_custom_fields_save( $post_id ) {

	// nonce verification.
	$secure_nonce      = wp_create_nonce( 'sft-related-products-woocommerce' );
	$id_nonce_verified = wp_verify_nonce( $secure_nonce, 'sft-related-products-woocommerce' );

	if ( ! $id_nonce_verified ) {
		wp_die( esc_html__( 'Nonce Not verified', 'sft-related-products-woocommerce' ) );
	}

	// Save the selected categories to include in related products.
	if ( isset( $_POST['rpwfr_related_products_category_include_select'] ) ) {
		$selected_values = array_map( 'sanitize_text_field', wp_unslash( $_POST['rpwfr_related_products_category_include_select'] ) );
		update_post_meta( $post_id, 'rpwfr_related_products_category_include_select', $selected_values );
	} else {
		update_post_meta( $post_id, 'rpwfr_related_products_category_include_select', '' );
	}

	// Save the selected categories to exclude from related products.
	if ( isset( $_POST['rpwfr_related_products_category_exclude_select'] ) ) {
		$selected_values = array_map( 'sanitize_text_field', wp_unslash( $_POST['rpwfr_related_products_category_exclude_select'] ) );
		update_post_meta( $post_id, 'rpwfr_related_products_category_exclude_select', $selected_values );
	} else {
		update_post_meta( $post_id, 'rpwfr_related_products_category_exclude_select', '' );
	}

	// Save the selected tags to include in related products.
	if ( isset( $_POST['rpwfr_related_products_tag_incldue_select'] ) ) {
		$selected_values = array_map( 'sanitize_text_field', wp_unslash( $_POST['rpwfr_related_products_tag_incldue_select'] ) );
		update_post_meta( $post_id, 'rpwfr_related_products_tag_incldue_select', $selected_values );
	} else {
		update_post_meta( $post_id, 'rpwfr_related_products_tag_incldue_select', '' );
	}

	// Save the selected tags to exclude from related products.
	if ( isset( $_POST['rpwfr_related_products_tag_exclude_select'] ) ) {
		$selected_values = array_map( 'sanitize_text_field', wp_unslash( $_POST['rpwfr_related_products_tag_exclude_select'] ) );
		update_post_meta( $post_id, 'rpwfr_related_products_tag_exclude_select', $selected_values );
	} else {
		update_post_meta( $post_id, 'rpwfr_related_products_tag_exclude_select', '' );
	}

	// Save the selected individual products for related products.
	if ( isset( $_POST['related_products_individual_select'] ) ) {
		$selected_values = array_map( 'sanitize_text_field', wp_unslash( $_POST['related_products_individual_select'] ) );
		update_post_meta( $post_id, 'related_products_individual_select', $selected_values );
	} else {
		update_post_meta( $post_id, 'related_products_individual_select', '' );
	}

	// Save the selected filter mode for related products.
	$filter_radio = isset( $_POST['rpwfr_filter_radio'] ) ? sanitize_text_field( wp_unslash( $_POST['rpwfr_filter_radio'] ) ) : '';
	update_post_meta( $post_id, 'rpwfr_filter_radio', $filter_radio );

	// Save the selected category filter mode for related products.
	$filter_radio = isset( $_POST['rpwfr_category_radio'] ) ? sanitize_text_field( wp_unslash( $_POST['rpwfr_category_radio'] ) ) : '';
	update_post_meta( $post_id, 'rpwfr_category_radio', $filter_radio );

	// Save the selected tag filter mode for related products.
	$filter_radio = isset( $_POST['rpwfr_tag_radio'] ) ? sanitize_text_field( wp_unslash( $_POST['rpwfr_tag_radio'] ) ) : '';
	update_post_meta( $post_id, 'rpwfr_tag_radio', $filter_radio );
}


/**
 * Function to replace woocommerce's related product section with hook with ajax slider.
 */
function rpwfr_custom_related_products_section() {

	// Retrieve the slider limit for desktop view from the arguments or set it to 0 if not provided.
	$slider_limit_desktop = isset( $args['desktop_limit'] ) ? intval( $args['desktop_limit'] ) : 0;

	// Retrieve the slider limit for tablet view from the arguments or set it to 0 if not provided.
	$slider_limit_tab = isset( $args['tab_limit'] ) ? intval( $args['tab_limit'] ) : 0;

	// Retrieve the slider limit for mobile view from the arguments or set it to 0 if not provided.
	$slider_limit_mobile = isset( $args['tab_limit'] ) ? intval( $args['mobile_limit'] ) : 0;

	// Get the individual products selected for related products, if any, or set to an empty array.
	$individual = get_post_meta( intval( get_the_ID() ), 'related_products_individual_select', true ) ? get_post_meta( intval( get_the_ID() ), 'related_products_individual_select', true ) : array();

	// Display the related products using the shortcode with the specified limits for different screen sizes.
	rpwfr_shortcode_products_display( $individual, get_the_ID(), $slider_limit_desktop, $slider_limit_tab, $slider_limit_mobile );
}


/**
 * Shortcode will be used on product page and related products section will not appear.
 *
 * @param integer $args .
 */
function rpwfr_custom_shortcode( $args ) {

	// Convert $args to an array and extract slider limits for different devices.
	$args                 = (array) $args;
	$slider_limit_desktop = isset( $args['desktop_limit'] ) ? intval( $args['desktop_limit'] ) : 0;
	$slider_limit_tab     = isset( $args['tab_limit'] ) ? intval( $args['tab_limit'] ) : 0;
	$slider_limit_mobile  = isset( $args['tab_limit'] ) ? intval( $args['mobile_limit'] ) : 0;
	$product_id           = isset( $args['id'] ) ? intval( $args['id'] ) : 0;

	// Check if the current page is not a product page.
	if ( ! is_product() ) {
		// Check if a valid product ID is provided and the product is published.
		if ( $product_id && 'publish' === get_post_status( $product_id ) ) {
			// Retrieve individual products selected for related products, if any.
			$individual = get_post_meta( intval( $product_id ), 'related_products_individual_select', true ) ? get_post_meta( intval( $product_id ), 'related_products_individual_select', true ) : array();
			// Start output buffering.
			ob_start();
				// Display the products using the custom shortcode.
				rpwfr_shortcode_products_display( $individual, $product_id, $slider_limit_desktop, $slider_limit_tab, $slider_limit_mobile );
			// Get the buffered content and clean the buffer.
			$content = ob_get_clean();
			// Return the content.
			return $content;
		}
	} else {
		// Check the display mode options for related products on product pages.
		$check  = get_option( 'rpwfr_display_mode_related_products' );
		$check2 = get_option( 'rpwfr_shortcode_mode_related_products' );

		// Check if the display mode is set to 'ajaxslider' and shortcode mode is enabled.
		if ( 'ajaxslider' === $check && 'shortcode' === $check2 && ! $product_id ) {
			// Retrieve individual products selected for related products, if any.
			$individual = get_post_meta( intval( get_the_ID() ), 'related_products_individual_select', true ) ? get_post_meta( intval( get_the_ID() ), 'related_products_individual_select', true ) : array();
			// Start output buffering.
			ob_start();
				// Display the products using the custom shortcode.
				rpwfr_shortcode_products_display( $individual, get_the_ID(), $slider_limit_desktop, $slider_limit_tab, $slider_limit_mobile );
			// Get the buffered content and clean the buffer.
			$content = ob_get_clean();
			// Return the content.
			return $content;
		}
	}
}


/**
 * Function filters products to be displayed according to category/tag include/exclude.
 *
 * @param array  $product_id .
 * @param string $cat_include .
 * @param string $cat_exclude .
 * @param string $tag_include .
 * @param string $tag_exclude .
 * @return $product_ids .
 */
function rpwfr_category_tag_filter( $product_id, $cat_include, $cat_exclude, $tag_include, $tag_exclude ) {

	$cat_include_ids  = array();
	$cat_exclude_ids  = array();
	$tags_include_ids = array();
	$tags_exclude_ids = array();
	$product_ids      = array();
	$all_products     = array();

	$args = array(
		'posts_per_page' => -1,
		'post_type'      => 'product',
	);

	$query = new WP_Query( $args );

	foreach ( $query->posts as $product ) {
		array_push( $all_products, $product->ID );
	}

	// For categories include.
	$category_include = get_post_meta( $product_id, $cat_include, true );

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
			array_push( $cat_include_ids, $post->ID );
		}

		// To get only those ids of products which have those categories included.
		$cat_include_ids = array_intersect( $all_products, $cat_include_ids );

		foreach ( $cat_include_ids as $id ) {
			array_push( $product_ids, $id );
		}
	}

	// For categories exclude.
	$category_exclude = get_post_meta( $product_id, $cat_exclude, true );

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
			array_push( $cat_exclude_ids, $post->ID );
		}

		// To get product ids which do not contained selected categories.
		$cat_exclude_ids = array_diff( $all_products, $cat_exclude_ids );

		foreach ( $cat_exclude_ids as $id ) {
			array_push( $product_ids, $id );
		}

		wp_reset_query();
	}

	// For tags include.

	$tag_include = get_post_meta( $product_id, $tag_include, true );

	if ( ! empty( $tag_include ) ) {
		$args_tag_include = array(
			'posts_per_page' => -1,
			'post_type'      => 'product',
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_tag',
					'field'    => 'slug',
					'terms'    => $tag_include,
				),
			),
		);

		$query_tag_include = new WP_Query( $args_tag_include );

		// Product ids with Tags included in query are obtained.
		foreach ( $query_tag_include->posts as $post ) {
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

	// For tags exclude.
	$tag_exclude = get_post_meta( $product_id, $tag_exclude, true );

	if ( ! empty( $tag_exclude ) ) {

		$args_tag_exclude = array(
			'posts_per_page' => -1,
			'post_type'      => 'product',
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_tag',
					'field'    => 'slug',
					'terms'    => $tag_exclude,
				),
			),
		);

		$query_tag_exclude = new WP_Query( $args_tag_exclude );

		// Product ids with Tags included in query are obtained.
		foreach ( $query_tag_exclude->posts as $post ) {
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

	wp_reset_query();

	// Remove duplicate product IDs.
	$product_ids = array_unique( $product_ids );

	// Return the filtered product IDs.
	return $product_ids;
}


/**
 * Function to display products in shortcode.
 *
 * @param array   $product_ids_array .
 * @param integer $slider_limit_desktop .
 * @param integer $slider_limit_tab .
 * @param integer $slider_limit_mobile .
 * @param string  $feature_name .
 */
function rpwfr_display_products( $product_ids_array, $slider_limit_desktop, $slider_limit_tab, $slider_limit_mobile, $feature_name ) {

	// Convert the array of product IDs into a comma-separated string and then back into an array.
	$products_imploded_array = implode( ',', $product_ids_array );
	$product_ids_array       = explode( ',', $products_imploded_array );
	// Retrieve the color settings for the button and row background.
	$button_color = (string) get_option( 'rpwfr_general_color_picker_btn' );
	$row_bg_color = (string) get_option( 'rpwfr_general_color_picker_background_front' );

	$arrow_color = get_option( 'rpwfr_button_arrow_color' ) ? (string)get_option( 'rpwfr_button_arrow_color' ) : '#fff';
	// Initialize an array to store the IDs of products that are in stock.
	$in_stock_products = array();

	// Check the stock status of each product and add in-stock products to the array.
	foreach ( $product_ids_array as $id ) {

		$stock = get_post_meta( $id, '_stock_status', true );
		if ( 'instock' === $stock ) {
			array_push( $in_stock_products, $id );
		}
	}

	// If there are in-stock products, update the array of product IDs to include only those products.
	if ( count( $in_stock_products ) ) {
		$products_imploded_array = implode( ',', $in_stock_products );
	}

	$iterator = 0;

	// Set default values for the row background color and button color if they are not set.
	if ( '' === $row_bg_color ) {
		$row_bg_color = '#e8e8e8';
	}

	if ( '' === $button_color ) {
		$button_color = '#000000';
	}

	// Set default values for the slider limits if they are not set.
	if ( ! intval( $slider_limit_desktop ) ) {
		$slider_limit_desktop = 4;
	}

	if ( ! intval( $slider_limit_tab ) ) {
		$slider_limit_tab = 3;
	}

	if ( ! intval( $slider_limit_mobile ) ) {
		$slider_limit_mobile = 2;
	}

	// Determine the class to be added for the number of columns based on the slider limits for desktop view.
	if ( 4 === $slider_limit_desktop ) {
		$desktop = 'four';
	} elseif ( 5 === $slider_limit_desktop ) {
		$desktop = 'five';
	} elseif ( 6 === $slider_limit_desktop ) {
		$desktop = 'six';
	} elseif ( 2 === $slider_limit_desktop ) {
		$desktop = 'two';
	} elseif ( 3 === $slider_limit_desktop ) {
		$desktop = 'three';
	} elseif ( 1 === $slider_limit_desktop ) {
		$desktop = 'one';
	}

	// Determine the class to be added for the number of columns based on the slider limits for tablet view.
	if ( 3 === $slider_limit_tab ) {
		$tab = 'three';
	} elseif ( 4 === $slider_limit_tab ) {
		$tab = 'four';
	} elseif ( 2 === $slider_limit_tab ) {
		$tab = 'two';
	} elseif ( 1 === $slider_limit_tab ) {
		$tab = 'one';
	}

	// Determine the class to be added for the number of columns based on the slider limits for mobile view.
	if ( 1 === $slider_limit_mobile ) {
		$mobile = 'one';
	} elseif ( 2 === $slider_limit_mobile ) {
		$mobile = 'two';
	}

	// Create a nonce for AJAX requests.
	$nonce = wp_create_nonce( 'sft-related-products-woocommerce' );
	?>

	<!-- Include JavaScript to handle AJAX requests for the product slider -->
	<script>
		jQuery(document).ready(function() {
			var productArray = '<?php echo esc_js( $products_imploded_array ); ?>';
			var featureName  = '<?php echo esc_js( $feature_name ); ?>';
			var sliderLimit= 4;

			// Determine the appropriate slider limit based on the screen width.
			if( jQuery(window).width() > 1200 ){
				sliderLimit= <?php echo esc_js( $slider_limit_desktop ); ?>;
				} else if( jQuery(window).width() > 767 && jQuery(window).width() <= 1200){
					sliderLimit= <?php echo esc_js( $slider_limit_tab ); ?>;
				} else if( jQuery(window).width() > 320 && jQuery(window).width() <= 767 ){
					sliderLimit= <?php echo esc_js( $slider_limit_mobile ); ?>;
				}

			sliderLimit= parseInt(sliderLimit);

			// Make an AJAX request to display the products in the slider.
			jQuery.ajax({
				type: "POST",
				url: "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>",
				data: {
					action: 'action_shortcode_slider',
					rpwfr_nonce: '<?php echo esc_js( $nonce ); ?>',
					slider_pagination_one: 1,
					product_ids_array: productArray,
					feature_name: featureName,
					products_limit_front: sliderLimit,
				},
				success: function (response) {

					// Update the slider container with the response.
					jQuery('.rpwfr-<?php echo esc_js( $feature_name ); ?>-parent-front-container').attr('data-limit', sliderLimit);
					jQuery('.rpwfr-<?php echo esc_js( $feature_name ); ?>-back-button').show();
					jQuery('.rpwfr-<?php echo esc_js( $feature_name ); ?>-next-button').show();
					jQuery('.rpwfr-<?php echo esc_js( $feature_name ); ?>-parent-front-container').empty().html(response);
					jQuery('.rpwfr-<?php echo esc_js( $feature_name ); ?>-parent-front-container').attr('data-page_count', '1');

					// Update the pagination attributes.
					var pages = <?php echo esc_js( count( $product_ids_array ) ); ?> / sliderLimit;
					pages = Math.ceil(pages);
					jQuery('.rpwfr-<?php echo esc_js( $feature_name ); ?>-parent-front-container').attr('data-pages', pages );	
					var page_count = parseInt(jQuery('.rpwfr-<?php echo esc_js( $feature_name ); ?>-parent-front-container').attr('data-page_count'));
					jQuery('.rpwfr-<?php echo esc_js( $feature_name ); ?>-page-display').html('Page 1 of ' + parseInt(pages));	

					// Hide the navigation buttons if there is only one page.
					if( page_count === pages  ){
						jQuery('.rpwfr-<?php echo esc_js( $feature_name ); ?>-next-button').hide();
						jQuery('.rpwfr-<?php echo esc_js( $feature_name ); ?>-back-button').hide();
					}

				}
			})

		})
	</script>

	<!-- Parent container to display related-products, related-products and related on sale, related-products related, purchase history related, back and next button, image loader -->
	<div class="rpwfr-product-list-wrap rpwfr-desktop-<?php echo esc_html( $desktop ); ?>-columns rpwfr-tab-<?php echo esc_html( $tab ); ?>-columns rpwfr-mobile-<?php echo esc_html( $mobile ); ?>-columns">

		<!-- div for back button  -->
		<div class="rpwfr-parent-back-button" >
			<button class="rpwfr-back-button rpwfr-<?php echo esc_html( $feature_name ); ?>-back-button" type="button" value="<" style="background:<?php echo esc_html( $button_color ); ?> !important; border-radius: 4px;"><i class="fa fa-caret-left" aria-hidden="true" style="color:<?php echo esc_html( $arrow_color ); ?> !important;font-size: 20px;"></i></button>
		</div>	

		<!-- Parent container to display product image, title -->
		<div class="rpwfr-parent-front-product-container rpwfr-<?php echo esc_html( $feature_name ); ?>-parent-front-container" data-limit="4" data-limit-desktop="<?php echo esc_html( $slider_limit_desktop ); ?>" data-limit-tablet="<?php echo esc_html( $slider_limit_tab ); ?>" data-limit-mobile="<?php echo esc_html( $slider_limit_mobile ); ?>" data-array="<?php print_r( $products_imploded_array ); ?>" data-name="<?php echo esc_html( $feature_name ); ?>" data-page_count="1" data-page_count_back="0" data-pages="1" style="background:<?php echo esc_html( $row_bg_color ); ?> !important;">

			<?php
			// Display placeholders for the products initially.
			foreach ( $product_ids_array as $id ) {
				if ( intval( $id ) !== 0 && $iterator < $slider_limit_desktop ) {

					?>
					<div class="rpwfr-product-container" >
						<a href="<?php echo esc_url( plugins_url( '../assets/images/shimmer-loader5.gif', __FILE__ ) ); ?>">
							<img src="<?php echo esc_url( plugins_url( '../assets/images/shimmer-loader5.gif', __FILE__ ) ); ?>" style="width: 100%;">
						</a>
						<a href="<?php echo esc_url( plugins_url( '../assets/images/shimmer-title-loader.gif', __FILE__ ) ); ?>">
							<img src="<?php echo esc_url( plugins_url( '../assets/images/shimmer-title-loader.gif', __FILE__ ) ); ?>" style="width: 100%;">
						</a>
					</div>
					<?php
					// $iterator += 1;
					++$iterator;
				}
			}

			?>
		</div>

		<!-- Container for the next button -->
		<div class="rpwfr-parent-next-button">
			<button class="rpwfr-next-button rpwfr-<?php echo esc_html( $feature_name ); ?>-next-button" type="button" value=">" style="background:<?php echo esc_html( $button_color ); ?> !important; border-radius: 4px;"><i class="fa fa-caret-right" aria-hidden="true" style="color:<?php echo esc_html( $arrow_color ); ?> !important;font-size: 20px;"></i></button>
		</div>

	</div> 
	<?php
}

/**
 * Get the related products.
 *
 * @param int $product_id The ID of the product for which related products are to be retrieved.
 * @return array An array of related product IDs.
 */
function rpwfr_get_related_products( $product_id ) {
	// Retrieve the array of related product IDs stored in the post meta.
	$related_products_ids = get_post_meta( intval( $product_id ), 'related_products_individual_select', true );

	// Return the array of related product IDs.
	return $related_products_ids;
}


/**
 * Function to get product id and return array of products related to it .
 *
 * @param integer $product_id .
 * @return $related_products_id .
 */
function rpwfr_display_related_products( $product_id ) {
	// Initialize an array to store the IDs of related products.
	$related_products_id = array();

	// Initialize an array to store the categories of the product.
	$categories = array();

	// Retrieve individual products selected for related products, if any.
	$individual = get_post_meta( intval( $product_id ), 'related_products_individual_select', true );

	if ( $individual ) {
		// Add the selected individual product IDs to the related products array.
		foreach ( $individual as $id ) {
			array_push( $related_products_id, $id );
		}
	} else {
		// Define the meta keys for the included and excluded categories and tags.
		$cat_include = 'rpwfr_related_products_category_include_select';
		$cat_exclude = 'rpwfr_related_products_category_exclude_select';
		$tag_include = 'rpwfr_related_products_tag_incldue_select';
		$tag_exclude = 'rpwfr_related_products_tag_exclude_select';

		// Retrieve the related product IDs based on the category and tag filters.
		$related_products_id = rpwfr_category_tag_filter( $product_id, $cat_include, $cat_exclude, $tag_include, $tag_exclude );
	}

	// Check if there are related products.
	if ( ! count( $related_products_id ) ) {
		// Retrieve the product categories if no related products are found.
		$cats = wp_get_post_terms( $product_id, 'product_cat' );

		// Add the slugs of the product categories to the categories array.
		foreach ( $cats as $cat ) {
			array_push( $categories, $cat->slug );
		}

		// Set up the arguments for the WP_Query to retrieve products from the same categories.
		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'product',
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $categories,
				),
			),
		);

		// Execute the query to retrieve related products.
		$query = new WP_Query( $args );

		// Add the IDs of the retrieved products to the related products array.
		foreach ( $query->posts as $product ) {
			array_push( $related_products_id, $product->ID );
		}
	}

	// Exclude the current product from the related products array.
	$product_id          = array( $product_id );
	$related_products_id = array_diff( $related_products_id, $product_id );

	// Return the array of related product IDs.
	return $related_products_id;
}


/**
 * Display products in ajax slider
 *
 * @param array $individual .
 * @param int   $product_id .
 * @param int   $slider_limit_desktop .
 * @param int   $slider_limit_tab .
 * @param int   $slider_limit_mobile .
 */
function rpwfr_shortcode_products_display( $individual, $product_id, $slider_limit_desktop, $slider_limit_tab, $slider_limit_mobile ) {

	// Determine the slider type based on the provided limits.
	$slider_slug = 'related-products';
	if ( $slider_limit_desktop || $slider_limit_tab || $slider_limit_mobile ) {
		$slider_slug = 'related-products-mini';
	}

	// Convert slider limits to strings and set default values if necessary.
	$slider_limit_desktop = (string) $slider_limit_desktop;
	$slider_limit_tab     = (string) $slider_limit_tab;
	$slider_limit_mobile  = (string) $slider_limit_mobile;

	if ( intval( $slider_limit_desktop ) === 0 ) {
		$slider_limit_desktop = (string) get_option( 'rpwfr_desktop' );
	}
	if ( intval( $slider_limit_tab ) === 0 ) {
		$slider_limit_tab = (string) get_option( 'rpwfr_tab' );
	}
	if ( intval( $slider_limit_mobile ) === 0 ) {
		$slider_limit_mobile = (string) get_option( 'rpwfr_mobile' );
	}
	if ( intval( $slider_limit_desktop ) === 0 ) {
		$slider_limit_desktop = '4';
	}

	// Initialize arrays to store related product IDs and categories.
	$related_products_id = array();
	$categories          = array();

	// Check if individual products are selected for related products.
	if ( ! empty( $individual ) ) {
		foreach ( $individual as $pid ) {
			array_push( $related_products_id, $pid );
		}
	} elseif ( 'default' === (string) get_post_meta( $product_id, 'rpwfr_filter_radio', true ) ) {
		// If the default filter is selected, retrieve related products based on product categories.
		$cats = wp_get_post_terms( $product_id, 'product_cat' );
		foreach ( $cats as $cat ) {
			array_push( $categories, $cat->slug );
		}

		// Set up the arguments for the WP_Query to retrieve products from the same categories.
		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'product',
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $categories,
				),
			),
		);

		// Execute the query to retrieve related products.
		$query = new WP_Query( $args );
		foreach ( $query->posts as $product ) {
			array_push( $related_products_id, $product->ID );
		}
	} else {
		// If custom filters are selected, retrieve related products based on the selected categories and tags.
		$cat_include = 'rpwfr_related_products_category_include_select';
		$cat_exclude = 'rpwfr_related_products_category_exclude_select';
		$tag_include = 'rpwfr_related_products_tag_incldue_select';
		$tag_exclude = 'rpwfr_related_products_tag_exclude_select';

		$related_products_id = rpwfr_category_tag_filter( $product_id, $cat_include, $cat_exclude, $tag_include, $tag_exclude );
	}

	// Exclude the current product from the related products array.
	if ( ! empty( $related_products_id ) ) {
		$product             = array( $product_id );
		$related_products_id = array_diff( $related_products_id, $product );

		// Display the title for the related products section.
		?>
		<!-- Displays title for related-products -->
		<div class="rpwfr-related-parent">
			<div class="rpwfr-related-products-front-title">
				<?php
				$title = get_option( 'rpwfr_related_title' );

				if ( ! $title ) {
					echo '<b>' . esc_html__( 'Related Products', 'sft-related-products-woocommerce' ) . '</b>';
				} else {
					echo '<b>' . esc_html( $title ) . '</b>';
				}

				?>

				<!-- Displays pagination and start over on right corner of row -->
				<div style="float: right; display: flex;gap: 15px;">
					<div class="rpwfr-<?php echo esc_html( $slider_slug ); ?>-page-display rpwfr-page-display" style="font-size: medium;margin-right: 5px;"><?php esc_html_e( 'Page no', 'sft-related-products-woocommerce' ); ?></div>
					<div class="rpwfr-<?php echo esc_html( $slider_slug ); ?>-start-over rpwfr-start-over" onMouseOver="this.style.color='#CD5C5C'"
					onMouseOut="this.style.color='#4682B4'" style="font-size: small;right: 0;top: 0; margin: 5px; color: #4682B4; display:none; z-index:200;" data-name="<?php echo esc_html( $slider_slug ); ?>"><?php esc_html_e( 'Start over', 'sft-related-products-woocommerce' ); ?></div>
				</div>
			</div>

			<?php
			// Display the related products using the custom function.
			rpwfr_display_products( $related_products_id, intval( $slider_limit_desktop ), intval( $slider_limit_tab ), intval( $slider_limit_mobile ), $slider_slug, 'related' );

			?>
		</div>
		<?php
	}
}