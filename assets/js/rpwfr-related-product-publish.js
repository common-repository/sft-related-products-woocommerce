jQuery(document).ready(function(){
    var product_page = parseInt( rpwfr_related_ajax_obj.is_product );

  if( product_page === 1 ){
  // ============= validation on product page for product filter =============
  // ===================================================== On Change ===============================.

    // Published button click. 
    jQuery( '#publishing-action > .button' ).click( function( e ) {

      let include_tag = jQuery('#rpwfr_related_products_tag_incldue_select').val().length;
      let exclude_tag = jQuery('#rpwfr_related_products_tag_exclude_select').val().length;
      let include_cat = jQuery('#rpwfr_related_products_category_include_select').val().length;
      let exclude_cat = jQuery('#rpwfr_related_products_category_exclude_select').val().length;
      let individual_picks = jQuery('#related_products_individual_select').val().length;
      
      // If value selected is not default.
      if ( jQuery('input[name="rpwfr_filter_radio"]:checked').val() != 'default' ) {
        if ( !include_tag && !exclude_tag && !include_cat && !exclude_cat && !individual_picks ) {

          jQuery( '#publishing-action > .button' ).attr( 'type', 'button' ); 
          Swal.fire({
            icon: 'error',
            title:"Error",
            html: 'Please Select Categories/ Tags/ Individual Products to save changes',
            confirmButtonText: "Ok",
          });
        } else {
          if( !individual_picks ){
            jQuery.ajax({
              type: "POST",
              url: rpwfr_related_ajax_obj.url,
              data: {
                action: 'related_product_filter',
                rpwfr_nonce: rpwfr_related_ajax_obj.nonce,
                product_filter_check: 1,
                related_products_incl_tag : jQuery('#rpwfr_related_products_tag_incldue_select').val(),
                related_products_excl_tag : jQuery('#rpwfr_related_products_tag_exclude_select').val(),
                related_products_incl_cat : jQuery('#rpwfr_related_products_category_include_select').val(),
                related_products_excl_cat : jQuery('#rpwfr_related_products_category_exclude_select').val(),
              },
              success: function (response) {

                if ( parseInt( response ) != 1 ) {
                    Swal.fire({
                      icon: 'error',
                      title: "Error",
                      html: 'Selected Crieterias doesnot contains any product',
                      confirmButtonText: "Ok",
                    });
                } else {
                  jQuery( '#publishing-action > .button' ).attr( 'type', 'submit' ); 
                }
              }
            })
          } else {
            jQuery('#publishing-action > .button').attr( 'type', 'submit' ); 
          }
        }
      } else {
        jQuery('#publishing-action > .button').attr( 'type', 'submit' ); 
      }

    })
  }
})