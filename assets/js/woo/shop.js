jQuery(function($) {
  
  // general shop stuff
  function WooShop() {
    $("#ProductButtons .button").addClass("uk-button uk-button-small uk-button-primary");
    $(".onsale").addClass("uk-card-badge uk-label");
  }
  // shop filters scroll-to-selected with animation
  function WooShopFilters() {
      cat_obj = $('.shop-container').attr('data-product-cat-obj');
      series_obj = $('.shop-container').attr('data-product-series-obj');
      
      if (cat_obj) {
        scrollPos1 = $('#' + cat_obj).position().top; // use the text of the span to create an ID and get the top position of that element
        $(document).ready(function(){
          $('.cat-list-panel').animate({ // animate your right div
              scrollTop: scrollPos1 // to the position of the target 
          }, 100); 
        });
      }
      if (series_obj) {
        scrollPos2 = $('#' + series_obj).position().top; // use the text of the span to create an ID and get the top position of that element
        $(document).ready(function(){
          $('.series-list-panel').animate({ // animate your right div
              scrollTop: scrollPos2 // to the position of the target 
          }, 100); 
        });
      }
    }
  // filter badges
  function WooShopFiltersBadges() {
    // get the data-name attreibute from the active/checked values of the various filters
    view_name = $('#GridList a.uk-active').attr('data-name'),
    cat_name = $('.cat-list input.here').attr('data-name'),
    series_name = $('.series-list input.here').attr('data-name'),
    sort_name = $('.ajax-ordering input.here').attr('data-name'),
    // insert the names into the filter badges
    $( ".badge-view" ).text(view_name);
    $( ".badge-cat" ).text(cat_name);
    $( ".badge-series" ).text(series_name);
    $( ".badge-sort" ).text(sort_name);
  }
  
  // on load
  $("#MainContent").load(WooShop());
  $("#MainContent").load(WooShopFilters());
  $("#MainContent").load(WooShopFiltersBadges());
  // dom modified
  $("body").on('DOMSubtreeModified', ".shop-container", WooShop);
  
});