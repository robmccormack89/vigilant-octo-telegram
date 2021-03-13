jQuery(function($) {
  
  // global shop stuff; to be used fired again after filtering
  window.ShopStyles = function() {
    $("#ProductButtons .button").addClass("uk-button uk-button-small uk-button-primary");
    $(".onsale").addClass("uk-card-badge uk-label");
  };
  // on load
  $("#MainContent").load(ShopStyles());
  $("#MainContent").load(ShopFilterScrollTo());
  $("#MainContent").load(themePagination());
  // dom modified: on infinite scroll
  $("body").on('DOMSubtreeModified', ".shop-container", ShopStyles);
  
});