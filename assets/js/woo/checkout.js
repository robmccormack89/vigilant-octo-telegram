jQuery(function($) {
  // checkout
  function CheckoutRestyle() {
    // form inputs/elements
    $(".input-radio").addClass("uk-radio");
    $(".input-text").addClass("uk-input");
    $(".input-checkbox").addClass("uk-checkbox");
    $("label").addClass("uk-form-label");
    $("select").addClass("uk-select");
    // order review table
    $(".woocommerce-checkout-review-order-table").addClass("uk-table uk-table-divider");
    // payments methods
    $(".wc_payment_methods").addClass("uk-list uk-list-large uk-list-divider");
    // buttons on checkout
    $(".button").addClass("uk-button uk-button-primary");
  }
  $("form.checkout").load(CheckoutRestyle());
  $("body").on('DOMSubtreeModified', "form.checkout", CheckoutRestyle);
});