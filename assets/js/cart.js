jQuery(function($) {
  // cart
  function WooCart() {
    $(".woocommerce-cart-form").addClass("uk-overflow-auto");
    $(".woocommerce-cart-form .shop_table").addClass("uk-table uk-table-justify uk-table-divider");
    $(".woocommerce-cart-form .product-thumbnail").addClass("uk-width-small");
    $(".woocommerce-cart-form .product-thumbnail img").addClass("uk-border-circle uk-preserve-width");
    $(".woocommerce-cart-form .product-quantity").addClass("uk-width-small");
    $(".woocommerce-cart-form .input-text").addClass("uk-input");
    $(".woocommerce-cart-form .actions").addClass("uk-padding-remove-horizontal");
    $(".woocommerce-cart-form .button").addClass("uk-button uk-button-primary uk-width-1-1");
    $(".woocommerce-cart-form .coupon .button").addClass("uk-margin-small-top uk-margin-small-bottom");
    $(".woocommerce-cart-form .coupon label").hide();
    $(".woocommerce-cart-form .quantity .screen-reader-text").hide();
  };
  // cart-shipping
  function WooCartShip() {
    $("#shipping_method").addClass("uk-list");
  };
  // cart-totals
  function WooCartTot() {
    $(".cart_totals h2").addClass("uk-h3 uk-margin-top");
    $(".cart_totals .shop_table").addClass("uk-table uk-table-striped");
  };
  // proceed-to-checkout-button
  function WooCartCheck() {
    $(".checkout-button").addClass("uk-button uk-button-primary uk-width-1-1");
  };
  // shipping-calculator
  function WooShipCalc() {
    $(".shipping-calculator-form").addClass("uk-margin-top");
    $(".woocommerce-shipping-calculator .button").addClass("uk-button uk-button-default uk-button-small");
    $(".woocommerce-shipping-calculator select").addClass("uk-select");
    $(".woocommerce-shipping-calculator .input-text").addClass("uk-input");
  };
  // events
  $(".woocommerce-cart-form").load(WooCart());
  $(".woocommerce-cart-form").load(WooCartShip());
  $(".woocommerce-cart-form").load(WooCartTot());
  $(".woocommerce-cart-form").load(WooCartCheck());
  $(".woocommerce-shipping-calculator").load(WooShipCalc());
  $("body").on('DOMSubtreeModified', ".woocommerce-cart-form", WooCart);
  $("body").on('DOMSubtreeModified', ".woocommerce-cart-form", WooCartShip);
  $("body").on('DOMSubtreeModified', ".woocommerce-cart-form", WooCartTot);
  $("body").on('DOMSubtreeModified', ".woocommerce-cart-form", WooCartCheck);
  $("body").on('DOMSubtreeModified', ".woocommerce-cart-form", WooShipCalc);
  $("body").on('DOMSubtreeModified', ".woocommerce-shipping-calculator", WooShipCalc);
});