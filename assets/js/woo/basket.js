jQuery(function($) {

  // cart
  function CartForm() {
    $(".woocommerce-cart-form").addClass("uk-overflow-auto");
    $(".woocommerce-cart-form .shop_table").addClass("uk-table uk-table-justify uk-table-divider");
    $(".woocommerce-cart-form .product-thumbnail").addClass("uk-width-small");
    $(".woocommerce-cart-form .product-thumbnail img").addClass("uk-preserve-width");
    $(".woocommerce-cart-form .product-quantity").addClass("uk-width-small");
    $(".woocommerce-cart-form .product-name a").addClass("uk-link-text dont-underline");
    $(".woocommerce-cart-form .input-text").addClass("uk-input");
    $(".woocommerce-cart-form .actions").addClass("uk-padding-remove-horizontal");
    $(".woocommerce-cart-form .button").addClass("uk-button uk-width-1-1");
    $(".woocommerce-cart-form .coupon .button").addClass("uk-button-primary uk-margin-small-top uk-margin-small-bottom");
  }
  // cart totals
  function CartTotals() {
    $(".cart_totals h2").addClass("uk-h3 uk-margin-top");
    $(".cart_totals .shop_table").addClass("uk-table uk-table-striped");
    $(".cart_totals .button").addClass("uk-button uk-button-primary");
  }
  // cart checkout
  function CartCheckout() {
    $(".wc-proceed-to-checkout .checkout-button").addClass("uk-button uk-button-primary");
  }
  // cart shipping
  function ShipMethod() {
    $("#shipping_method").addClass("uk-list");
  }
  // cart shipping calc
  function ShipCalc() {
    $(".shipping-calculator-form").addClass("uk-margin-top");
    $(".woocommerce-shipping-calculator .button").addClass("uk-button uk-button-default uk-button-small");
    $(".woocommerce-shipping-calculator select").addClass("uk-select");
    $(".woocommerce-shipping-calculator .input-text").addClass("uk-input");
  }
  // on load
  $(".woocommerce").load(CartForm());
  $(".woocommerce").load(CartTotals());
  $(".woocommerce").load(CartCheckout());
  $(".woocommerce").load(ShipMethod());
  $(".woocommerce").load(ShipCalc());
  // on dom modified
  $("body").on('DOMSubtreeModified', ".woocommerce", CartForm);
  $("body").on('DOMSubtreeModified', ".woocommerce", CartTotals);
  $("body").on('DOMSubtreeModified', ".woocommerce", CartCheckout);
  $("body").on('DOMSubtreeModified', ".woocommerce", ShipMethod);
  $("body").on('DOMSubtreeModified', ".woocommerce", ShipCalc);
});