jQuery(function($) {
  // global
  function DoAllWoo(){
    // form login
    $(".woocommerce-form-login .woocommerce-form-login__submit").addClass("uk-button-primary uk-margin-top");
    // buttons
    $(".button").addClass("uk-button");
    $("input.submit").addClass("uk-button uk-button-primary");
    $(".woocommerce-message .button").addClass("uk-button-primary uk-button-small");
    // forms
    $(".woocommerce-form__input-checkbox").addClass("uk-checkbox");
    $("input#wp-comment-cookies-consent").addClass("uk-checkbox");
    $(".input-radio").addClass("uk-radio");
    $(".input-text").addClass("uk-input");
    $(".input-checkbox").addClass("uk-checkbox");
    $(".comment-form input").addClass("uk-input");
    $("input#wp-comment-cookies-consent").removeClass("uk-input");
    $("input.qty").addClass("uk-input");
    $("form label").addClass("uk-form-label");
    $(".woocommerce-form").addClass("uk-form-stacked");
    $(".comment-form").addClass("uk-form-stacked");
    $("form").addClass("uk-form-stacked");
    $("em").addClass("uk-text-danger");
    $("select").addClass("uk-select");
    $("textarea").addClass("uk-textarea");
    $("label").addClass("uk-form-label");
    // tables
    $("table").addClass("uk-table");
    // onsale badge
    $(".onsale").addClass("uk-card-badge uk-label");
    $("ul.woocommerce-error").addClass("uk-list");
    $("ul.woocommerce-error .uk-button").addClass("uk-button-primary");
    // login/register
    $(".col2-set").attr("uk-grid", "");
    $(".col2-set").addClass("uk-child-width-1-2@m");
  };
  // filter badges
  function FilterBadgesRe() {
    // get the data-name attreibute from the active/checked values of the various filters
    view_name = $('#GridList a.uk-active').attr('data-name'),
    cat_name = $('.cat-list a.active').attr('data-name'),
    series_name = $('.series-list a.active').attr('data-name'),
    sort_name = $('.ajax-ordering a.active').attr('data-name'),
    // insert the names into the filter badges
    $( ".badge-view" ).text(view_name);
    $( ".badge-cat" ).text(cat_name);
    $( ".badge-series" ).text(series_name);
    $( ".badge-sort" ).text(sort_name);
  };
  // on load
  $(".woocommerce").load(DoAllWoo());
  $(".woocommerce").load(FilterBadgesRe());
  // on dom modified
  $("body").on('DOMSubtreeModified', "#BlockContent", DoAllWoo);
});