jQuery(function($) {
  // checkout
  function WooCheckout() {
    // terms
    $(".input-checkbox").addClass("uk-checkbox");
    // review-order
    $(".woocommerce-checkout-review-order-table").addClass("uk-table uk-table-striped");
    // form-pay
    $("#order_review button").addClass("uk-button uk-button-primary");
    // form-billing
    $(".woocommerce-billing-fields__field-wrapper").attr("uk-grid");
    $(".woocommerce-billing-fields__field-wrapper").addClass("uk-grid-small");
    // payment
    $(".wc_payment_methods").addClass("uk-list uk-list-large uk-list-divider");
    // payment-method
    $(".input-radio").addClass("uk-radio");
    $("label").addClass("uk-form-label");
    // form-shipping
    // form-login
    // form-coupon
    $(".input-text").addClass("uk-input");
    $(".checkout_coupon button").addClass("uk-button uk-button-default");
    // form-checkout
    // general
    $("select").addClass("uk-select");
  };
  // events
  $("form.checkout").load(WooCheckout());
  $("body").on('DOMSubtreeModified', "form.checkout", WooCheckout);
});