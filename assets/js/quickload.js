// jquery stuff
jQuery(function($) {
  
  // push history on page load; for working with pushState after fetch call
  $(window).bind("popstate", function() {
    window.location = location.href;
  });
  
  // define functions to be re-fired after quickload (inf-scroll pagination, WooShop, scroll-tp-selected filter animations & filtering badges data)
  reShop = function() {

  };
  
  reFilterAnims = function() {
  
    cat_obj = $('.shop-container').attr('data-product-cat-obj');
    series_obj = $('.shop-container').attr('data-product-series-obj');
  
    if (cat_obj) {
      scrollPos1 = $('#' + cat_obj).position().top;
      $(document).ready(function(){
        $('.cat-list-panel').animate({
            scrollTop: scrollPos1
        }, 100); 
      });
    }
  
    if (series_obj) {
      scrollPos2 = $('#' + series_obj).position().top;
      $(document).ready(function(){
        $('.series-list-panel').animate({
            scrollTop: scrollPos2
        }, 100); 
      });
    }
  
  };
  
  reBadges = function() {
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
  };
  
  rePage = function() {

  };
  
});

// the quickoad function, using fetch api
function quickLoad(event) {
  
  var the_link_href = event.target.getAttribute("data-link");
  document.querySelector('.content-container').classList.add('the-loader');
  
  // fetch request with the clicked llnk
  fetch(the_link_href).then(function (response) {
    // The API call was successful!
    return response.text();
  }).then(function (html) {
    // do stuff with the data/results
    var parser = new DOMParser();
    var doc_obj = parser.parseFromString(html, 'text/html');
    var new_content = doc_obj.querySelector('.block-content_wrap');
    var main_container = document.getElementById("MainContent");
    var old_content = document.querySelector('.block-content_wrap');
    main_container.replaceChild(new_content, old_content);
    // add new url to the browser address bar
    window.history.pushState({}, '', the_link_href);
    // refire certain functions after quickload
    reShop();
    reFilterAnims();
    reBadges();
    jQuery(function($) {
        // shop shit
        $(".button").addClass("uk-button");
        $("#ProductButtons .button").addClass("uk-button-small uk-button-primary");
        $(".onsale").addClass("uk-card-badge uk-label");
        // pagination
        if ($(".uk-pagination").length) {
          $('.archive-posts').infiniteScroll({
            path: '.next',
            append: '.item',
            status: '.page-load-status',
            hideNav: '.pagi',
            history: false,
          });
        }
    });
  }).catch(function (error) {
    // There was an error
    console.warn('Something went wrong.', error);
  });
}