jQuery(function($) {
  
  // global shop stuff; to be used fired again after filtering
  window.ShopStyles = function() {
    $("#ProductButtons .button").addClass("uk-button uk-button-small uk-button-primary");
    $(".onsale").addClass("uk-card-badge uk-label");
  };
  // shop filters scroll-to-selected with animation; to be used fired again after filtering
  window.ShopFilterScrollTo = function() {
    var cat_obj = $('.shop-container').attr('data-product-cat-obj');
    var series_obj = $('.shop-container').attr('data-product-series-obj');
    if (cat_obj) {
      var scrollPos1 = $('#' + cat_obj).position().top; // use the text of the span to create an ID and get the top position of that element
      $('.cat-list-panel').animate({ // animate your right div
        scrollTop: scrollPos1 // to the position of the target 
      }, 100); 
    }
    if (series_obj) {
      var scrollPos2 = $('#' + series_obj).position().top; // use the text of the span to create an ID and get the top position of that element
      $('.series-list-panel').animate({ // animate your right div
        scrollTop: scrollPos2 // to the position of the target 
      }, 100); 
    }
  };
  // on load
  $("#ContentSection").load(ShopStyles());
  $("#ContentSection").load(ShopFilterScrollTo());
  $("#ContentSection").load(themePagination());
  // dom modified: on infinite scroll
  $("body").on('DOMSubtreeModified', ".shop-container", ShopStyles);
  
});