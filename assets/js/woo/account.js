jQuery(function($) {
  // navigation
  $(".woocommerce-MyAccount-navigation ul").addClass("uk-subnav uk-subnav-pill");
  // orders table
  $(".woocommerce-orders-table").wrap("<div class='uk-overflow-auto'>", "</div>");
  $(".woocommerce-orders-table").addClass("uk-table-striped uk-table-middle uk-table-justify");
  $(".woocommerce-orders-table .woocommerce-orders-table__cell-order-actions .button").addClass("uk-button uk-button-primary uk-button-small");
  // message button (no orders)
  $(".woocommerce-message .button").addClass("uk-button uk-button-primary uk-button-small uk-margin-small-right");
  $(".woocommerce-info .button").addClass("uk-button uk-button-primary uk-button-small uk-margin-small-right");
  $("button[type=submit]").addClass("uk-button uk-button-primary");
  // Billing Shipping Address Fields
  function AddressFieldsRestyle() {
    $("select").addClass("uk-select");
    $(".input-text").addClass("uk-input");
    $("label").addClass("uk-form-label");
  };
  // Billing Shipping Address Fields - restyle after ajax
  $("body").on('DOMSubtreeModified', ".woocommerce-address-fields", AddressFieldsRestyle);
});