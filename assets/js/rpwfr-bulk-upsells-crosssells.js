jQuery(document).ready(function () {

  var { __ } = wp.i18n;

  let SearchMessage    = rpwfr_bulk_ajax_obj.rpwfr_search_msg;
  let SearchMessageOne = rpwfr_bulk_ajax_obj.rpwfr_msg_one;
  let SearchMessageTwo = rpwfr_bulk_ajax_obj.rpwfr_msg_two;

  let SearchMessageSave     = rpwfr_bulk_ajax_obj.rpwfr_msg_save;
  let SearchMessageSaveHtml = rpwfr_bulk_ajax_obj.rpwfr_msg_save_html;
  let SearchMessageUpdate   = rpwfr_bulk_ajax_obj.rpwfr_msg_update;
  let SearchMessageError    = rpwfr_bulk_ajax_obj.rpwfr_msg_error;

  let NoticeMessage = rpwfr_bulk_ajax_obj.rpwfr_dismiss_noti;
  let ProMessage    = rpwfr_bulk_ajax_obj.rpwfr_pro_notice;

  // Collpase and expand code
  setTimeout(() => {
    if( jQuery("#collapse-button").attr('aria-expanded') === 'true' ){
      jQuery('.rpwfr-collapse-bulk-screen').empty().html('<svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M200 32H56C42.7 32 32 42.7 32 56V200c0 9.7 5.8 18.5 14.8 22.2s19.3 1.7 26.2-5.2l40-40 79 79-79 79L73 295c-6.9-6.9-17.2-8.9-26.2-5.2S32 302.3 32 312V456c0 13.3 10.7 24 24 24H200c9.7 0 18.5-5.8 22.2-14.8s1.7-19.3-5.2-26.2l-40-40 79-79 79 79-40 40c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H456c13.3 0 24-10.7 24-24V312c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2l-40 40-79-79 79-79 40 40c6.9 6.9 17.2 8.9 26.2 5.2s14.8-12.5 14.8-22.2V56c0-13.3-10.7-24-24-24H312c-9.7 0-18.5 5.8-22.2 14.8s-1.7 19.3 5.2 26.2l40 40-79 79-79-79 40-40c6.9-6.9 8.9-17.2 5.2-26.2S209.7 32 200 32z"/></svg>');
    } else {
      jQuery('.rpwfr-collapse-bulk-screen').empty().html('<svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M9.4 9.4C21.9-3.1 42.1-3.1 54.6 9.4L160 114.7V96c0-17.7 14.3-32 32-32s32 14.3 32 32v96c0 4.3-.9 8.5-2.4 12.2c-1.6 3.7-3.8 7.3-6.9 10.3l-.1 .1c-3.1 3-6.6 5.3-10.3 6.9c-3.8 1.6-7.9 2.4-12.2 2.4H96c-17.7 0-32-14.3-32-32s14.3-32 32-32h18.7L9.4 54.6C-3.1 42.1-3.1 21.9 9.4 9.4zM256 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM114.7 352H96c-17.7 0-32-14.3-32-32s14.3-32 32-32h96 0l.1 0c8.8 0 16.7 3.6 22.5 9.3l.1 .1c3 3.1 5.3 6.6 6.9 10.3c1.6 3.8 2.4 7.9 2.4 12.2v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V397.3L54.6 502.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L114.7 352zM416 96c0-17.7 14.3-32 32-32s32 14.3 32 32v18.7L585.4 9.4c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3L525.3 160H544c17.7 0 32 14.3 32 32s-14.3 32-32 32H448c-8.8 0-16.8-3.6-22.6-9.3l-.1-.1c-3-3.1-5.3-6.6-6.9-10.3s-2.4-7.8-2.4-12.2l0-.1v0V96zM525.3 352L630.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L480 397.3V416c0 17.7-14.3 32-32 32s-32-14.3-32-32V320v0c0 0 0-.1 0-.1c0-4.3 .9-8.4 2.4-12.2c1.6-3.8 3.9-7.3 6.9-10.4c5.8-5.8 13.7-9.3 22.5-9.4c0 0 .1 0 .1 0h0 96c17.7 0 32 14.3 32 32s-14.3 32-32 32H525.3z"/></svg>');
    }
  }, 200);

  // Hide the default view.
  jQuery( "#rpwfr_buc-filter-container, #rpwfr_buc-select-categories, #rpwfr_buc-select-tags, #rpwfr_buc-select-sku, #rpwfr_buc-select-product, .rpwfr_buc-save" ).hide();

  // Expand and collapse div.
  jQuery('.rpwfr-collapse-bulk-screen').click(function(){
    jQuery('#collapse-button').trigger('click');

    if( jQuery("#collapse-menu button").attr('aria-expanded') === 'true' ){
      jQuery('.rpwfr-collapse-bulk-screen').empty().html('<svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M200 32H56C42.7 32 32 42.7 32 56V200c0 9.7 5.8 18.5 14.8 22.2s19.3 1.7 26.2-5.2l40-40 79 79-79 79L73 295c-6.9-6.9-17.2-8.9-26.2-5.2S32 302.3 32 312V456c0 13.3 10.7 24 24 24H200c9.7 0 18.5-5.8 22.2-14.8s1.7-19.3-5.2-26.2l-40-40 79-79 79 79-40 40c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H456c13.3 0 24-10.7 24-24V312c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2l-40 40-79-79 79-79 40 40c6.9 6.9 17.2 8.9 26.2 5.2s14.8-12.5 14.8-22.2V56c0-13.3-10.7-24-24-24H312c-9.7 0-18.5 5.8-22.2 14.8s-1.7 19.3 5.2 26.2l40 40-79 79-79-79 40-40c6.9-6.9 8.9-17.2 5.2-26.2S209.7 32 200 32z"/></svg>');
    } else {
      jQuery('.rpwfr-collapse-bulk-screen').empty().html('<svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M9.4 9.4C21.9-3.1 42.1-3.1 54.6 9.4L160 114.7V96c0-17.7 14.3-32 32-32s32 14.3 32 32v96c0 4.3-.9 8.5-2.4 12.2c-1.6 3.7-3.8 7.3-6.9 10.3l-.1 .1c-3.1 3-6.6 5.3-10.3 6.9c-3.8 1.6-7.9 2.4-12.2 2.4H96c-17.7 0-32-14.3-32-32s14.3-32 32-32h18.7L9.4 54.6C-3.1 42.1-3.1 21.9 9.4 9.4zM256 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM114.7 352H96c-17.7 0-32-14.3-32-32s14.3-32 32-32h96 0l.1 0c8.8 0 16.7 3.6 22.5 9.3l.1 .1c3 3.1 5.3 6.6 6.9 10.3c1.6 3.8 2.4 7.9 2.4 12.2v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V397.3L54.6 502.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L114.7 352zM416 96c0-17.7 14.3-32 32-32s32 14.3 32 32v18.7L585.4 9.4c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3L525.3 160H544c17.7 0 32 14.3 32 32s-14.3 32-32 32H448c-8.8 0-16.8-3.6-22.6-9.3l-.1-.1c-3-3.1-5.3-6.6-6.9-10.3s-2.4-7.8-2.4-12.2l0-.1v0V96zM525.3 352L630.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L480 397.3V416c0 17.7-14.3 32-32 32s-32-14.3-32-32V320v0c0 0 0-.1 0-.1c0-4.3 .9-8.4 2.4-12.2c1.6-3.8 3.9-7.3 6.9-10.4c5.8-5.8 13.7-9.3 22.5-9.4c0 0 .1 0 .1 0h0 96c17.7 0 32 14.3 32 32s-14.3 32-32 32H525.3z"/></svg>');
    }
  })

  // Disable the free version and show custom message on the free version.
  jQuery("#activate-related-products-for-woocommerce").addClass('disable-click').text( ProMessage );

  // Select2 on both filter and category box.
  // jQuery('.rpwfr_buc-filter-box').select2({ width: '400px' });
  // jQuery('.rpwfr_buc-product-filter-box').select2({ width: '400px' });

  jQuery( 'input.select2-search__field' ).removeAttr('style');

  // On change of filter type.
  jQuery("#filter-type").on("change", function () {
  
    jQuery('#rpwfr_buc-filter-container').show();
  
    // Get filter type value.
    let filterType = jQuery(this).val();
  
    switch ( filterType ) {
      case "rpwfr_buc-category":
        jQuery("#rpwfr_buc-select-categories").show();
        jQuery("#rpwfr_buc-select-product, #rpwfr_buc-select-tags,#rpwfr_buc-select-sku").hide();
        break;
      case "rpwfr_buc-tags":
        jQuery("#rpwfr_buc-select-tags").show();
        jQuery("#rpwfr_buc-select-categories, #rpwfr_buc-select-sku, #rpwfr_buc-select-product").hide();
        break;
      case "rpwfr_buc-product":
        jQuery("#rpwfr_buc-select-product").show();
        jQuery("#rpwfr_buc-select-categories, #rpwfr_buc-select-tags, #rpwfr_buc-select-sku").hide();
        break;
      case "rpwfr_buc-sku":
        jQuery("#rpwfr_buc-select-sku").show();
        jQuery("#rpwfr_buc-select-categories, #rpwfr_buc-select-product, #rpwfr_buc-select-tags").hide();
        break; 
      case "filter-by":
        jQuery("#rpwfr_buc-filter-container").css('display', 'none');
        jQuery("#rpwfr_buc-select-categories, #rpwfr_buc-select-product, #rpwfr_buc-select-tags").hide();
        break;
      default:
        break;
    }
  });

  // To search all product based on selected taxonomy.
  jQuery("#rpwfr_buc-search-product").on("click", function () {
    var taxonomyID;

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
      Swal.fire('', SearchMessage, 'warning');
      return;
    }

    if (!(taxonomyID === "")) {
      jQuery.ajax({
        url: rpwfr_bulk_ajax_obj.url,
        type: "POST",
        data: {
          action: "rpwfr_taxonomyID_action",
          nonce: rpwfr_bulk_ajax_obj.nonce,
          filterType: filterType,
          taxonomyID: taxonomyID,
        },
        beforeSend: function () {
          jQuery("#loading-image").show();
        },
        success: function (data) {
          if (!data) {
            Swal.fire('', SearchMessageOne, 'warning');
            jQuery("#products-table").hide();
            jQuery("#loading-image").hide();
            jQuery(".rpwfr_buc-left-way").hide();
          } else {
            jQuery("#products-table").show();
            jQuery("#products-table").html(data);
            jQuery('.rpwfr-select2').select2({ width: '100%', minimumInputLength: 2 });
            jQuery(".rpwfr_buc-save").show();
            
            // Hide laoding image and show the pagignation. 
            jQuery("#loading-image").hide();
            jQuery('.rpwfr_buc-left-way').css('display','flex');

            // Total Product Count.
            let productTotalCount  = parseInt( jQuery(".rpwfr_total").val() );
            let total_page_numbers = Math.ceil( parseFloat( parseInt( productTotalCount ) / parseInt( 5 ) ) );

            // Total Product count on span.
            jQuery(".rpwfr_buc_product_count").html( productTotalCount + " Items  " );

            // Total Page count after of number.
						jQuery(".rpwfr_buc_pages_total").html( Math.ceil( productTotalCount / 5 ) );

            jQuery(".rpwfr_buc_numtext").attr( 'max', Math.ceil( productTotalCount / 5 ) );

            // Set one on new search.
            jQuery( '.rpwfr_buc_numtext' ).val( 1 );

            // Current page no text values.
            let currentPageNo = parseInt( jQuery( '.rpwfr_buc_numtext' ).val() );
  
            // If only one page
            if ( currentPageNo === 1 && total_page_numbers > 1 ) {
              jQuery( '.rpwfr_buc_product_first' ).prop( 'disabled', true );
              jQuery( '.rpwfr_buc_product_prev' ).prop( 'disabled', true );

              jQuery( '.rpwfr_buc_product_next' ).prop( 'disabled', false );
              jQuery( '.rpwfr_buc_product_last' ).prop( 'disabled', false );
            }

            // if both pages are equal disable all.
            if ( currentPageNo == total_page_numbers ) {
              jQuery( '.rpwfr_buc_product_next' ).prop( 'disabled', true );
              jQuery( '.rpwfr_buc_product_last' ).prop( 'disabled', true );

              jQuery( '.rpwfr_buc_product_first' ).prop( 'disabled', true );
              jQuery( '.rpwfr_buc_product_prev' ).prop( 'disabled', true );
            }
          }
          jQuery('.rpwfr-select2').select2({ width: '100%', minimumInputLength: 2 });
        },
      });
    } else {
      Swal.fire('', SearchMessageTwo, 'warning');
    }
  });

  // Hide all rendered things on filter type change.
  jQuery("#filter-type").on("change", function () {
    jQuery("#products-table").hide();
    jQuery(".rpwfr_buc-save").hide();

    // Hide loader and pagignation
    jQuery("#loading-image").hide();
    jQuery(".rpwfr_buc-left-way").hide();
  });

  // To save all ids of related products.
  jQuery(".rpwfr_buc-save").click(function (event) {

    var TableData = []; // initialize array;

    // To hide 'Saving Changes..' popup.
    Swal.fire({
      title: SearchMessageSave,
      html: SearchMessageSaveHtml,
      didOpen: () => {
        Swal.showLoading();
      },
    })

    // Here traverse and read input/select values present in each row, ;
    jQuery("#products-table .product-row").each(function (index, row) {

      var currentRow = null;

      currentRow = jQuery(this);

      TableData[index] = {
        rpwfr_product_id: currentRow.find('.product-name .rpwfr_buc-product-title a').attr("id"),
        rpwfr_product_related_ids: currentRow.find('select.related-token').val(),
      };
    });

    jQuery.ajax({
      url: rpwfr_bulk_ajax_obj.url,
      method: "POST",
      data: {
        action: "rpwfr_save_all_selected_products",
        nonce: rpwfr_bulk_ajax_obj.nonce,
        selected_data: TableData,
      },
      success: function (response) {

        Swal.hideLoading();
        Swal.clickConfirm();  // To hide 'Saving Changes..' popup.
        Swal.fire('', SearchMessageUpdate, 'success');

        if ( 0 == jQuery('#rpwfr-success-massage' ).length) {
          jQuery("#rpwfr-upsells-crosssell").before(
            '<div id="rpwfr-success-massage" class="updated notice is-dismissible"><p>' + SearchMessageUpdate + '</p><button id="rpwfr-dismiss-admin-message" class="notice-dismiss" type="button"><span class="screen-reader-text">' + NoticeMessage + '</span></button></div>'
          );
        }

        jQuery("#rpwfr-dismiss-admin-message").click(function (event) {
          jQuery("#rpwfr-success-massage").remove();
        });
      },
      error: function (jqXHR, textStatus, errorThrown) {

        Swal.fire( SearchMessageError, errorThrown, 'error');

        jQuery("#rpwfr-upsells-crosssell").before(
          '<div id="rpwfr-error-massage" class="error notice is-dismissible"><p>' +
          errorThrown +
          '</p><button id="rpwfr-dismiss-admin-message" class="notice-dismiss" type="button"><span class="screen-reader-text">' + NoticeMessage + '</span></button></div>'
        );

        jQuery("#rpwfr-dismiss-admin-message").click(function (event) {
          jQuery("#rpwfr-error-massage").remove();
        });
      },
    });
  });
});
