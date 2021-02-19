jQuery(function($) {
  
  // shop stuff
  function WooShop() {
    $("#ProductButtons .button").addClass("uk-button-small uk-button-primary");
    $(".onsale").addClass("uk-card-badge uk-label");
  };
  // on load
  $("#MainProductArchive").load(WooShop());
  // on dom modified
  $("body").on('DOMSubtreeModified', "#MainProductArchive", WooShop);
  
});