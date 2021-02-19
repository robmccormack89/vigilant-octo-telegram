jQuery(function($) {
  // account button
  $("main .button").addClass("uk-button-primary");
  // account navigation
  $(".woocommerce-MyAccount-navigation ul").addClass("uk-subnav uk-subnav-pill");
  // account orders
  $(".woocommerce-orders-table").addClass("uk-table-striped uk-table-middle uk-table-justify");
  $(".woocommerce-orders-table").wrap("<div class='uk-overflow-auto'>", "</div>");
  $(".woocommerce-orders-table .woocommerce-orders-table__cell-order-actions .button").addClass("uk-button-small");
  // things to add back after ajax calls
  function MyAccountRestyleAfterAjax() {
    $("select").addClass("uk-select");
    $(".input-text").addClass("uk-input");
    $("label").addClass("uk-form-label");
  };
  // on dom modified
  $("body").on('DOMSubtreeModified', ".woocommerce-address-fields", MyAccountRestyleAfterAjax);
  
});