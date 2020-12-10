jQuery(function($) {
  
  // website preloader animation
  $(window).load(function() {
    $(".theme-preload").fadeOut("slow");
    $('body').removeClass('no-overflow');
  });
  
  $("#loginform").addClass("uk-form-stacked");
  $("label").addClass("uk-form-label");
  $("#loginform .input").addClass("uk-input");
  $("#loginform [ type=checkbox ]").addClass("uk-checkbox");
  $("#loginform .button.button-primary").addClass("uk-button uk-button-default");
  $(".wpcf7-form").addClass("uk-form-stacked");
  $(".current-menu-item").addClass("uk-active");
  $(".is-active").addClass("uk-active");
  $(".wc-item-meta").addClass("uk-list uk-list-divider");
  // $("button.single_add_to_cart_button").addClass("uk-button uk-button-default");
  $("div.cart-buttons-area .button:first-child").addClass("uk-button uk-button-primary uk-button-small uk-width-1-1");
  $(".button.checkout").addClass("uk-button uk-button-link uk-width-1-1");
  
});




