// for the product image gallery
jQuery('#lightSlider').lightSlider({
  gallery: true,
  item: 1,
  loop: true,
  slideMargin: 0,
  thumbItem: 6,
  galleryMargin: 10,
  thumbMargin: 10,
});
// adding classes to comp stuff
jQuery(function($) {
  $("form.buy-now.cart button.single_add_to_cart_button").addClass("uk-button uk-button-default");
  $(".ticket-tab-bar .ticket-tab-bar-item").addClass("uk-button uk-button-primary");
  $(".tickets_numbers_tab .tn").addClass("uk-button uk-button-default");
  $(".lottery-pn-answers li").addClass("uk-button uk-button-default");
  $("p.lottery-end").addClass("uk-hidden");
  $("p.min-pariticipants").addClass("uk-hidden");
  $("p.max-pariticipants").addClass("uk-hidden");
  $("progress").addClass("uk-progress");
  $("input").addClass("uk-input");
  $("form.cart.pick-number button.single_add_to_cart_button").addClass("uk-button uk-button-primary uk-button-large");
});