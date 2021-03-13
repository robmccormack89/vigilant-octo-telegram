jQuery(function($) {
  // forms
  $("form").addClass("uk-form-stacked");
  $(".woocommerce-form").addClass("uk-form-stacked");
  $(".comment-form").addClass("uk-form-stacked");
  // text/quantity inputs
  $(".input-text").addClass("uk-input");
  $(".comment-form input").addClass("uk-input");
  $("input.qty").addClass("uk-input");
  $("input#wp-comment-cookies-consent").removeClass("uk-input");
  // textarea
  $("textarea").addClass("uk-textarea");
  // radio inputs
  $(".input-radio").addClass("uk-radio");
  // checkboxes
  $(".input-checkbox").addClass("uk-checkbox");
  $(".woocommerce-form__input-checkbox").addClass("uk-checkbox");
  $("input#wp-comment-cookies-consent").addClass("uk-checkbox");
  // form labels
  $("form label").addClass("uk-form-label");
  // selects
  $("select").addClass("uk-select");
  // tables
  $("table").addClass("uk-table");
  // woo onsale badge
  $(".onsale").addClass("uk-card-badge uk-label");
  // woo error
  $("ul.woocommerce-error").addClass("uk-list");
  // woo 1/2 grid
  $(".col2-set").attr("uk-grid", "").addClass("uk-child-width-1-2@m");
});