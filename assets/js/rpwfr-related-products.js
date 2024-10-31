jQuery(document).ready(function () {

  // Change the fisrt menu url.
  jQuery( 'li.wp-first-item > a[href="admin.php?page=rpwfr_menu"]' ).text('Settings');

  // Disable reorder chekbox.
  jQuery( '.rpwfr_display_reorder' ).attr( 'disabled', 'disabled' );

  
  // On Check of Product Display Mode checkbox.
  if ( ! jQuery('.rpwfr-display-switch').is(':checked') ) {

    // Hide the no of columns.
    jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').hide();

    jQuery('.rpwfr-shortcode-option-radio, .rpwfr-display-mode-radio, .rpwfr-title, .rpwfr-see-more-redirect-option, .rpwfr-redirect-page-selection, input[name="rpwfr_desktop"], input[name="rpwfr_tab"], input[name="rpwfr_mobile"], .rpwfr-stock-status-switch').attr('disabled', 'disabled');
    jQuery('input[name="rpwfr_upsells_desktop"], input[name="rpwfr_upsells_tab"], input[name="rpwfr_upsells_mobile"], .rpwfr-stock-status-switch').attr('disabled', 'disabled');

    jQuery('.rpwfr-stock-status-switch').prop('checked', false);

  } else {

    // If theme option is checked only then show.
    if ( jQuery('div.rpwfr-display-mode input[value="theme"]').attr('checked') == 'checked' ) {
      jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').show();
    } else {
      jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').hide();
    }

    jQuery('.rpwfr-shortcode-option-radio, .rpwfr-title, .rpwfr-see-more-redirect-option, .rpwfr-redirect-page-selection, input[name="rpwfr_desktop"], input[name="rpwfr_tab"], input[name="rpwfr_mobile"]').attr('disabled', 'disabled');
    jQuery('input[name="rpwfr_upsells_desktop"], input[name="rpwfr_upsells_tab"], input[name="rpwfr_upsells_mobile"]').attr('disabled', 'disabled');
    jQuery( '.rpwfr-display-mode-radio').prop( 'disabled', false );
    jQuery('.rpwfr-stock-status-switch').prop('checked', true);
  }

  // On Change of Product Display Mode checkbox.
  jQuery( '.rpwfr-display-switch' ).on('change', function() {
    // jQuery('.rpwfr-display-mode-radio, .rpwfr-shortcode-option-radio').prop('checked', false);
    jQuery('div.rpwfr-display-mode input[value="theme"]').prop('checked', true);
    jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').show();

    if ( ! jQuery('.rpwfr-display-switch').is(':checked') ) {

      // Hide the no of columns.
      jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').hide();
  
      jQuery('.rpwfr-shortcode-option-radio, .rpwfr-display-mode-radio, .rpwfr-title, .rpwfr-see-more-redirect-option, .rpwfr-redirect-page-selection, input[name="rpwfr_desktop"], input[name="rpwfr_tab"], input[name="rpwfr_mobile"], .rpwfr-stock-status-switch').attr('disabled', 'disabled');
      jQuery('input[name="rpwfr_upsells_desktop"], input[name="rpwfr_upsells_tab"], input[name="rpwfr_upsells_mobile"], .rpwfr-stock-status-switch').attr('disabled', 'disabled');
  
      jQuery('.rpwfr-stock-status-switch').prop('checked', false);
    } else {
  
      // If theme option is checked only then show.
      if ( jQuery('div.rpwfr-display-mode input[value="theme"]').attr('checked') == 'checked' ) {
        jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').show();
      } else {
        jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').hide();
      }
  
      jQuery('.rpwfr-shortcode-option-radio, .rpwfr-title, .rpwfr-see-more-redirect-option, .rpwfr-redirect-page-selection, input[name="rpwfr_desktop"], input[name="rpwfr_tab"], input[name="rpwfr_mobile"]').attr('disabled', 'disabled');
      jQuery('input[name="rpwfr_upsells_desktop"], input[name="rpwfr_upsells_tab"], input[name="rpwfr_upsells_mobile"]').attr('disabled', 'disabled');
      jQuery( '.rpwfr-display-mode-radio').prop( 'disabled', false );
      jQuery('.rpwfr-stock-status-switch').prop('checked', true);
    }
    
  })


  // On Change of Product Display Mode checkbox and Related Product Display Mode checkbox.
  if ( jQuery('.rpwfr-display-mode-radio').is(':checked') && jQuery('.rpwfr-display-switch').is(':checked')){
    
    var valueDisplayMode = jQuery('.rpwfr-display-mode-radio:checked').val();

    if ( valueDisplayMode == 'theme' ) {

      jQuery('.rpwfr-shortcode-option-radio, .rpwfr-title, .rpwfr-see-more-redirect-option, .rpwfr-redirect-page-selection, input[name="rpwfr_desktop"], input[name="rpwfr_tab"], input[name="rpwfr_mobile"]').attr('disabled', 'disabled');
      jQuery(' input[name="rpwfr_upsells_desktop"], input[name="rpwfr_upsells_tab"], input[name="rpwfr_upsells_mobile"]').attr('disabled', 'disabled');
      jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').show();
    } else if( valueDisplayMode == 'ajaxslider' ) {
      jQuery('.rpwfr-shortcode-option-radio, .rpwfr-title, .rpwfr-see-more-redirect-option, .rpwfr-redirect-page-selection, input[name="rpwfr_desktop"], input[name="rpwfr_tab"], input[name="rpwfr_mobile"]').removeAttr('disabled');
      jQuery('input[name="rpwfr_upsells_desktop"], input[name="rpwfr_upsells_tab"], input[name="rpwfr_upsells_mobile"]').removeAttr('disabled');
      jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').hide();
    }
  }

  // Related Product Display Mode checkbox
  jQuery('.rpwfr-display-mode-radio').change(function() {
    var valueDisplayMode = jQuery(this).val();

    if ( valueDisplayMode == 'theme' ) {
      jQuery('.rpwfr-shortcode-option-radio, .rpwfr-title, .rpwfr-see-more-redirect-option, .rpwfr-redirect-page-selection, input[name="rpwfr_desktop"], input[name="rpwfr_tab"], input[name="rpwfr_mobile"]').attr('disabled', 'disabled');
      jQuery('input[name="rpwfr_upsells_desktop"], input[name="rpwfr_upsells_tab"], input[name="rpwfr_upsells_mobile"]').attr('disabled', 'disabled');
      jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').show();
    } else if( valueDisplayMode == 'ajaxslider' ){
      jQuery('div.rpwfr-shortcode-option input[value="default"]').prop('checked', true);
      jQuery('.rpwfr-shortcode-option-radio, .rpwfr-title, .rpwfr-see-more-redirect-option, .rpwfr-redirect-page-selection, input[name="rpwfr_desktop"], input[name="rpwfr_tab"], input[name="rpwfr_mobile"]').removeAttr('disabled');
      jQuery('input[name="rpwfr_upsells_desktop"], input[name="rpwfr_upsells_tab"], input[name="rpwfr_upsells_mobile"]').removeAttr('disabled');
      jQuery('.rpwfr-theme-column-limit, .rpwfr-theme-products-limit').parents('tr').hide();
      jQuery('.rpwfr-stock-status-switch').prop('checked', true);
    }
  });


  jQuery('.rpwfr-stock-status-switch').prop('disabled', true);


  // moving from one page to other for upsells and crossells .

  jQuery( 'a[href="admin.php?page=rpwfr_upsells_crossells_menu"]' ).click( function( event ) {
    event.preventDefault();
    window.location.assign( rpwfr_ajax_obj.admin_url + 'edit.php?post_type=product&page=bulk-edit-upsells-crosssells');
  });

  // END.

  // pro message on click of the pro text.
  
  jQuery('.rpwfr-pro').css('cursor', 'pointer');

  jQuery('.rpwfr-pro, .rpwfr_buc-save.pro, .rpwfr-individual-pro').click(function(){

    var rpwfrUpgradeNow = rpwfr_ajax_obj.rpwfr_free_to_pro_upgrade;
    var lineOne = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_line_one;
    var lineTwo = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_line_two;
    var lineThree = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_listing_one;
    var lineFour = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_listing_two;
    var lineFive = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_listing_three;
    var lineSix = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_listing_four;

    Swal.fire({
      title: '<div class="pro-alert-header"> Pro Field Alert! </div>',
      showCloseButton: true,
      html: '<div class="pro-crown"><svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="0 0 640 512"><path fill="#f8c844" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5 .4 5.1 .8 7.7 .8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"/></svg></div><div class="popup-text-one">' + lineOne + '</div><div class="popup-text-two">' + lineTwo + '</div> <ul><b><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>' + lineThree + '</li><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>' + lineFour +'</li><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>' + lineFive + '</li><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>' + lineSix + '</li></b></ul>' + '<button class="rpwfr-upgrade-now" style="border: none"><a href="https://www.saffiretech.com/woocommerce-related-products-pro/?utm_source=wp_plugin&utm_medium=profield&utm_campaign=free2pro&utm_id=c1&utm_term=upgrade_now&utm_content=rpwfr" target="_blank" class="purchase-pro-link">'+rpwfrUpgradeNow+'</a></button>',
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
  jQuery( '.rpwfr-popup > .swal2-content > .swal2-html-container > ul ' ).css( 'text-align', 'justify' );
  jQuery( '.rpwfr-popup > .swal2-content > .swal2-html-container > ul ' ).css( 'padding-left', '25px' );
  jQuery( '.rpwfr-popup > .swal2-content > .swal2-html-container > ul ' ).css( 'padding-right', '25px' );
  jQuery( '.rpwfr-popup > .swal2-content > .swal2-html-container > ul ' ).css( 'line-height', '2em' );
  jQuery( '.popup-text-two' ).css( 'padding', '10px' );
  jQuery( '.popup-text-two' ).css( 'font-weignt', '500');
  jQuery( '.rpwfr-popup > .swal2-content > .swal2-html-container > ul, .popup-text-one, .popup-text-two').css('color', '#061727' );

  })

  // END

  jQuery( 'input[name="rpwfr_filter_radio"]' ).change(function(){

      var valueProductFilter = jQuery(this).val();
      jQuery('input[name="rpwfr_category_radio"], input[name="rpwfr_tag_radio"]').prop('checked',false);
      jQuery( '#rpwfr_related_products_category_include_select, #rpwfr_related_products_category_exclude_select, #rpwfr_related_products_tag_incldue_select, #rpwfr_related_products_tag_exclude_select, #related_products_individual_select').val('').change();

      if(valueProductFilter == 'default'){

          jQuery('.rpwfr_category_radio_field, .rpwfr_tag_radio_field, .rpwfr_related_products_category_include_select_field, .rpwfr_related_products_category_exclude_select_field, .rpwfr_related_products_tag_incldue_select_field, .rpwfr_related_products_tag_exclude_select_field, .related_products_individual_select_field').hide();

      } else if(valueProductFilter == 'categories'){

          jQuery('.rpwfr_category_radio_field').show();
          jQuery('.rpwfr_tag_radio_field, .rpwfr_related_products_category_include_select_field, .rpwfr_related_products_category_exclude_select_field, .rpwfr_related_products_tag_incldue_select_field, .rpwfr_related_products_tag_exclude_select_field, .section.related.products, .related_products_individual_select_field').hide();

      } else if( valueProductFilter == 'tags'){

          jQuery('.rpwfr_tag_radio_field').show();
          jQuery('.rpwfr_category_radio_field, .rpwfr_related_products_category_include_select_field, .rpwfr_related_products_category_exclude_select_field, .rpwfr_related_products_tag_incldue_select_field, .rpwfr_related_products_tag_exclude_select_field, .related_products_individual_select_field').hide();

      } else if( valueProductFilter == 'both'){

          jQuery('.rpwfr_category_radio_field, .rpwfr_tag_radio_field').show();
          jQuery('.rpwfr_related_products_category_include_select_field, .rpwfr_related_products_category_exclude_select_field, .rpwfr_related_products_tag_incldue_select_field, .rpwfr_related_products_tag_exclude_select_field, .related_products_individual_select_field').hide();

      } else if( valueProductFilter == 'individual'){

          jQuery('.related_products_individual_select_field').show();
          jQuery('.rpwfr_category_radio_field, .rpwfr_tag_radio_field, .rpwfr_related_products_category_include_select_field, .rpwfr_related_products_category_exclude_select_field, .rpwfr_related_products_tag_incldue_select_field, .rpwfr_related_products_tag_exclude_select_field').hide();

      }
  })

  if ( jQuery('input[name="rpwfr_filter_radio"]').is(':checked')){
      var valueProductFilter = jQuery('input[name="rpwfr_filter_radio"]:checked').val();

      if(valueProductFilter == 'default'){

          jQuery('.rpwfr_category_radio_field, .rpwfr_tag_radio_field, .rpwfr_related_products_category_include_select_field, .rpwfr_related_products_category_exclude_select_field, .rpwfr_related_products_tag_incldue_select_field, .rpwfr_related_products_tag_exclude_select_field, .related_products_individual_select_field').hide();

      } else if(valueProductFilter == 'categories'){

          jQuery('.rpwfr_category_radio_field').show();
          jQuery('.rpwfr_tag_radio_field, .rpwfr_related_products_category_include_select_field, .rpwfr_related_products_category_exclude_select_field, .rpwfr_related_products_tag_incldue_select_field, .rpwfr_related_products_tag_exclude_select_field, .related_products_individual_select_field').hide();

      } else if( valueProductFilter == 'tags'){

          jQuery('.rpwfr_tag_radio_field').show();
          jQuery('.rpwfr_category_radio_field, .rpwfr_related_products_category_include_select_field, .rpwfr_related_products_category_exclude_select_field, .rpwfr_related_products_tag_incldue_select_field, .rpwfr_related_products_tag_exclude_select_field, .related_products_individual_select_field').hide();

      } else if( valueProductFilter == 'both'){

          jQuery('.rpwfr_category_radio_field, .rpwfr_tag_radio_field').show();
          jQuery('.rpwfr_related_products_category_include_select_field, .rpwfr_related_products_category_exclude_select_field, .rpwfr_related_products_tag_incldue_select_field, .rpwfr_related_products_tag_exclude_select_field, .related_products_individual_select_field').hide();

      } else if( valueProductFilter == 'individual'){

          jQuery('.related_products_individual_select_field').show();
          jQuery('.rpwfr_category_radio_field, .rpwfr_tag_radio_field, .rpwfr_related_products_category_include_select_field, .rpwfr_related_products_category_exclude_select_field, .rpwfr_related_products_tag_incldue_select_field, .rpwfr_related_products_tag_exclude_select_field').hide();

      }
  }


  jQuery('input[name="rpwfr_category_radio"]').change(function(){

      var valueCategory = jQuery(this).val();
      jQuery('#rpwfr_related_products_category_include_select, #rpwfr_related_products_category_exclude_select').val('').change();

      if( valueCategory == 'include_cat' ){
          jQuery( '.rpwfr_related_products_category_include_select_field' ).show();
          jQuery('.rpwfr_related_products_category_exclude_select_field').hide();
      } else if( valueCategory == 'exclude_cat' ){
          jQuery( '.rpwfr_related_products_category_exclude_select_field' ).show();
          jQuery('.rpwfr_related_products_category_include_select_field').hide();
      }
  })

  if( jQuery('input[name="rpwfr_category_radio"]').is(':checked') ){
      var valueCategory = jQuery('input[name="rpwfr_category_radio"]:checked').val();
  
      if( valueCategory == 'include_cat' ){
          jQuery( '.rpwfr_related_products_category_include_select_field' ).show();
          jQuery('.rpwfr_related_products_category_exclude_select_field').hide();
      } else if( valueCategory == 'exclude_cat' ){
          jQuery( '.rpwfr_related_products_category_exclude_select_field' ).show();
          jQuery('.rpwfr_related_products_category_include_select_field').hide();
      }
  }


  jQuery('input[name="rpwfr_tag_radio"]').change(function(){
      var valueTag = jQuery(this).val();

      jQuery('#rpwfr_related_products_tag_incldue_select, #rpwfr_related_products_tag_exclude_select').val('').change();
      if( valueTag == 'include_tag' ){
          jQuery( '.rpwfr_related_products_tag_incldue_select_field' ).show();
          jQuery('.rpwfr_related_products_tag_exclude_select_field').hide();
      } else if( valueTag == 'exclude_tag' ){
          jQuery( '.rpwfr_related_products_tag_exclude_select_field' ).show();
          jQuery('.rpwfr_related_products_tag_incldue_select_field').hide();
      }
  })

  if( jQuery('input[name="rpwfr_tag_radio"]').is(':checked') ){
      var valueTag = jQuery('input[name="rpwfr_tag_radio"]:checked').val();

      if( valueTag == 'include_tag' ){
          jQuery( '.rpwfr_related_products_tag_incldue_select_field' ).show();
          jQuery('.rpwfr_related_products_tag_exclude_select_field').hide();
      } else if( valueTag == 'exclude_tag' ){
          jQuery( '.rpwfr_related_products_tag_exclude_select_field' ).show();
          jQuery('.rpwfr_related_products_tag_incldue_select_field').hide();
      }
  }


  var displayRelatedProducts = parseInt( rpwfr_ajax_obj.display_related_section );
  var displayShortcode = parseInt( rpwfr_ajax_obj.display_shortcode );
  
  if( (displayRelatedProducts != '1' || displayShortcode == '1') ){
    jQuery('section.related.products, .wp-block-woocommerce-related-products').hide();
  } else {
    jQuery('section.related.products, .wp-block-woocommerce-related-products').show();
  }

  // AJAX slider click functions.

  jQuery(".rpwfr-back-button").click(function (e){
    var featureName = jQuery(this).parent().next().attr('data-name');
    back_button_func(featureName);
  });
  
  jQuery(".rpwfr-next-button").click(function (e){
    var featureName = jQuery(this).parent().prev().attr('data-name');
    next_button_func(featureName);
  });
  
  jQuery(".rpwfr-start-over").click(function (e){
    var featureName = jQuery(this).attr('data-name');
    start_over_button_func(featureName);
  });
  

  function back_button_func( featureName ){
    var productIdsArray = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-array');
    var featureName = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-name');
    var pageCount = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count');

    var pages = parseInt(jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-pages'));
    var pageCountBack = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count_back');
    var productLimit = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-limit');
    productLimit = parseInt( productLimit );
    var startIndex = parseInt(jQuery('.rpwfr-' + featureName + '-product-container:first-child').attr('data-index'));

    if (parseInt(pageCount) > 2) {
      jQuery('.rpwfr-' + featureName + '-start-over').show();
    } else {
      jQuery('.rpwfr-' + featureName + '-start-over').hide();
    }
  
    jQuery.ajax({
        type: "POST",
        url: rpwfr_ajax_obj.url,
        data: {
          action: 'action_shortcode_slider',
          rpwfr_nonce: rpwfr_ajax_obj.nonce,
          back_btn: 1,
          start_index_back: startIndex,
          product_ids_array: productIdsArray,
          feature_name: featureName,
          products_limit_back: productLimit,
          page_count: parseInt(pageCount) - 1,
          page_count_back: parseInt(pageCountBack) + 1,
        },
        success: function (response) {

          if (parseInt(pageCount) === 1) {
            jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count', pages);
            jQuery('.rpwfr-' + featureName + '-start-over').show();
          } else {
            jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count', parseInt(pageCount) - 1);
          }
  
          jQuery('.rpwfr-' + featureName + '-parent-front-container').empty().html(response);
  
          if( jQuery('.rpwfr-' + featureName + '-parent-front-container').length ){
            jQuery('.rpwfr-' + featureName + '-loader, .rpwfr-' + featureName + '-title-loader').show();
            setTimeout( loaderFuncHide, 250, featureName);
          }
        
          jQuery('.rpwfr-' + featureName + '-page-display').html('page ' + parseInt(jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count')) + ' of ' + parseInt(pages));
          
        }
    })
  }
  
  function next_button_func( featureName ){

    var productIdsArray = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-array');
    var featureName = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-name');
    var pageCount = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count');
    var pages = parseInt(jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-pages'));

    var productLimit = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-limit');
    productLimit = parseInt(productLimit);
    var endIndex = parseInt(jQuery('.rpwfr-' + featureName + '-product-container:nth-child(' + productLimit + ')').attr('data-index'));

    if (parseInt(pageCount) > 0 && parseInt(pageCount) != parseInt(pages)) {
      jQuery('.rpwfr-' + featureName + '-start-over').show();
    }

    jQuery.ajax({
      type: "POST",
      url: rpwfr_ajax_obj.url,
      data: {
        action: 'action_shortcode_slider',
        rpwfr_nonce: rpwfr_ajax_obj.nonce,
        next_btn: 1,
        start_index_next: endIndex,
        product_ids_array: productIdsArray,
        feature_name: featureName,
        products_limit_next: productLimit,
        pages: pages,
        page_count: parseInt(pageCount) + 1,
      },
      success: function (response) {

        if (parseInt(jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count')) == parseInt(jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-pages'))) {
          jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count', 1);
        } else {
          jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count', parseInt(pageCount) + 1);
        }

        jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count_back', "0");
        jQuery('.rpwfr-' + featureName + '-parent-front-container').empty().html(response);
        if( jQuery('.rpwfr-' + featureName + '-parent-front-container').length ){
          jQuery('.rpwfr-' + featureName + '-loader, .rpwfr-' + featureName + '-title-loader').show();
          setTimeout( loaderFuncHide, 250, featureName);
        }

        jQuery('.rpwfr-' + featureName + '-page-display').html('page ' + parseInt(jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count')) + ' of ' + parseInt(pages));

        if (parseInt(jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count')) == 1) {
          jQuery('.rpwfr-' + featureName + '-start-over').hide();
        }

      }
    })

  }
  
  function start_over_button_func(featureName){

    var productIdsArray = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-array');
    var featureName = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-name');
    var pages = parseInt(jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-pages'));
    var productLimit = jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-limit');
    productLimit = parseInt(productLimit);

    jQuery.ajax({
      type: "POST",
      url: rpwfr_ajax_obj.url,
      data: {
        action: 'action_shortcode_slider',
        rpwfr_nonce: rpwfr_ajax_obj.nonce,
        start_over_btn: 1,
        product_ids_array: productIdsArray,
        feature_name: featureName,
        products_limit_startover: productLimit,

      },
      success: function (response) {

        jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count_back', "0");
        jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count', "1");
        jQuery('.rpwfr-' + featureName + '-parent-front-container').empty().html(response);

        if( jQuery('.rpwfr-' + featureName + '-parent-front-container').length ){
          jQuery('.rpwfr-' + featureName + '-loader, .rpwfr-' + featureName + '-title-loader').show();
          setTimeout( loaderFuncHide, 250, featureName);
        }
        jQuery('.rpwfr-' + featureName + '-page-display').html('page ' + parseInt(jQuery('.rpwfr-' + featureName + '-parent-front-container').attr('data-page_count')) + ' of ' + parseInt(pages));
        jQuery('.rpwfr-' + featureName + '-start-over').hide();
      }
    })

  }
  
  function loaderFuncHide( featureName ){
    jQuery('.rpwfr-' + featureName + '-loader, .rpwfr-' + featureName + '-title-loader').hide();
  }

  // END

  jQuery('.rpwfr-see-more-redirect-option').change(function () {
    var seeMoreOption = jQuery(this).val();
    if (seeMoreOption == 'new') {
      jQuery('.rpwfr-redirect-page-selection').parents('tr').show();
      jQuery('.rpwfr-back-shortcode-text').show();

    } else {
      jQuery('.rpwfr-redirect-page-selection').parents('tr').hide();
      jQuery('.rpwfr-back-shortcode-text').hide();
      jQuery('.rpwfr-redirect-page-selection').val('').change();
    }
  })

  if (jQuery('.rpwfr-see-more-redirect-option').is(':checked')) {
    var seeMoreOption = jQuery('.rpwfr-see-more-redirect-option:checked').val();
    if (seeMoreOption == 'new') {
      jQuery('.rpwfr-redirect-page-selection').parents('tr').show();
      jQuery('.rpwfr-back-shortcode-text').show();

    } else {
      jQuery('.rpwfr-redirect-page-selection').parents('tr').hide();
      jQuery('.rpwfr-back-shortcode-text').hide();
      jQuery('.rpwfr-redirect-page-selection').val('').change();
    }
  }

  jQuery('.rpwfr-see-more').click(function(e){
    e.preventDefault();
    var post_id = rpwfr_ajax_obj.current_post;
    jQuery.ajax({
      type: "POST",
          url: rpwfr_ajax_obj.url,
          data: {
            action: 'action_shortcode_slider',
            rpwfr_nonce: rpwfr_ajax_obj.nonce,
            back_post_id : post_id,
          },
          success: function (response) {
  
            jQuery('.rpwfr-related-back-all-products').empty().html(response);
          }
    })
  })

  // ========== Hide related products ajax slider if there is no product =========

  if( jQuery('.rpwfr-related-products-parent-front-container').attr('data-array') == "" ){
    jQuery('.rpwfr-related-products-parent-front-container, .rpwfr-related-products-front-title').hide();
  }

  // END

  // copy the clipboard text when button is clicked.
  jQuery(".rpwfr-related-clipboard-button").click(function (e) {
    e.preventDefault();
    var shotcodetext = "[rpwfr_custom_related_products_display]";
    navigator.clipboard.writeText(shotcodetext);
    Swal.fire({
      text: 'Shortcode Copied !',
      width: 300,
      heightAuto: false,
      icon: 'success',
    })
  });

  // Hide extra div of related product so it will display only one time.
  jQuery('div.entry-summary .rpwfr-related-parent').each( function( i, val ) {
    if ( i == 1 ) {
      jQuery(this).hide();
    }
  });

  // Adds the extra class to the custom linked product.
  jQuery( '#linked_product_data' ).addClass('rpwfr-custom-product-radio')

  //Add pro icon on product page for individual selection
  jQuery( '.rpwfr-individual-pro' ).empty().html('<svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 640 512"><path fill="#f8c844" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5 .4 5.1 .8 7.7 .8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"/></svg>');

  jQuery( '.pro-alert-header' ).parents('.swal2-popup ').css( 'background', 'yellow' );

  // Delay in notice click of 2 sec.
  setTimeout( () => {
    // AJAX to show notice of new features.
    jQuery('div[data-notice="rpwfr_new_features_notice"] .notice-dismiss').on('click', function(e){
        e.preventDefault();
        jQuery.ajax({
            type: "POST",
            url: rpwfr_ajax_obj.url,
            data: {
                action: 'rpwfr_update_new_feature_notice_read',
            },
            success: (res) => {
            }
        });
        console.log("dimissed");
    })
  }, 2000);
})

// SVG notice.
function rpwfr_call_notice() {

  var rpwfrUpgradeNow = rpwfr_ajax_obj.rpwfr_free_to_pro_upgrade;
  var lineOne = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_line_one;
  var lineTwo = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_line_two;
  var lineThree = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_listing_one;
  var lineFour = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_listing_two;
  var lineFive = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_listing_three;
  var lineSix = rpwfr_ajax_obj.rpwfr_free_to_pro_popup_listing_four;

  Swal.fire({
    title: '<div class="pro-alert-header"> Pro Field Alert! </div>',
    showCloseButton: true,
    html: '<div class="pro-crown"><svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="0 0 640 512"><path fill="#f8c844" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5 .4 5.1 .8 7.7 .8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"/></svg></div><div class="popup-text-one">' + lineOne + '</div><div class="popup-text-two">' + lineTwo + '</div> <ul><b><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>' + lineThree + '</li><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>' + lineFour +'</li><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>' + lineFive + '</li><li><svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><path fill="#ff3d3d" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>' + lineSix + '</li></b></ul>' + '<button class="rpwfr-upgrade-now" style="border: none"><a href="https://www.saffiretech.com/woocommerce-related-products-pro/?utm_source=wp_plugin&utm_medium=profield&utm_campaign=free2pro&utm_id=c1&utm_term=upgrade_now&utm_content=rpwfr" target="_blank" class="purchase-pro-link">'+rpwfrUpgradeNow+'</a></button>',
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
}
