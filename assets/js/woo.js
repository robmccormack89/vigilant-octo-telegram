// adding classes
jQuery(function($) {
  
  // add to cart button triggers modal when item is added to cart
  $(document).on('added_to_cart', function(e, fragments, cart_hash, this_button) {
    var modal = UIkit.modal("#MiniCartModal");
    modal.show();
  });
  
  // global
  // quantity input
  $(".quantity .screen-reader-text").hide();
  // form login
  $(".woocommerce-form-login").addClass("uk-form-stacked");
  $(".woocommerce-form-login label").addClass("uk-form-label");
  $(".woocommerce-form-login #username").addClass("uk-input");
  $(".woocommerce-form-login #password").addClass("uk-input");
  $(".woocommerce-form-login #rememberme").addClass("uk-checkbox");
  $(".woocommerce-form-login .woocommerce-form-login__submit").addClass("uk-button uk-button-primary uk-margin-top");
  // mini-cart
  function WooMiniCart() {
    $(".woocommerce-mini-cart__buttons .button:first-child").addClass("uk-button uk-button-primary uk-button-small uk-width-1-1");
    $(".woocommerce-mini-cart__buttons .button.checkout").addClass("uk-button uk-button-link uk-width-1-1");
  };
  $(".widget_shopping_cart_content").load(WooMiniCart());
  $("body").on('DOMSubtreeModified', ".widget_shopping_cart_content", WooMiniCart);
  
});