jQuery(function($) {
  // my-account
  // general
  $(".button").addClass("uk-button uk-button-primary");
  // form/s
  $("form").addClass("uk-form-stacked");
  $(".input-text").addClass("uk-input");
  $("label").addClass("uk-form-label");
  $("em").addClass("uk-text-danger");
  $("woocommerce-form__input-checkbox").addClass("uk-checkbox");
  // navigation
  $(".woocommerce-MyAccount-navigation ul").addClass("uk-subnav uk-subnav-pill");
  // orders
  $(".woocommerce-orders-table").addClass("uk-table uk-table-striped uk-table-middle");
  $(".woocommerce-orders-table").wrap("<div class='uk-overflow-auto'>", "</div>");
  $(".woocommerce-orders-table .woocommerce-orders-table__cell-order-actions .button").addClass("uk-button-small");
  // login/register
  $(".col2-set").attr("uk-grid", "");
  $(".col2-set").addClass("uk-child-width-1-2@m");
});