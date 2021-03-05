jQuery(function($) {
  
  // shop stuff
  function WooShop() {
    $("#ProductButtons .button").addClass("uk-button-small uk-button-primary");
    $(".onsale").addClass("uk-card-badge uk-label");
  };
  // on load
  $("#MainContent").load(WooShop());
  // on dom modified
  $("body").on('DOMSubtreeModified', "main", WooShop);
  
});

jQuery(function(){
  
  // banner swiper
  var slider_swiper = new Swiper('#slideshow_banner', {
    centeredSlides: true,
    // autoplay: {
    //   delay: 4000,
    //   disableOnInteraction: true,
    // },
    pagination: {
      el: '.swiper-pagination',
      type: 'progressbar',
      clickable: true,
    },
    // navigation: {
    //   nextEl: '.swiper-button-next',
    //   prevEl: '.swiper-button-prev',
    // },
  });
  
  // series swiper
  var info_swiper = new Swiper('#slideshow_info', {
    slidesPerView: 3,
    spaceBetween: 10,
    // autoplay: {
    //   delay: 4000,
    //   disableOnInteraction: true,
    // },
    // init: false,
    pagination: {
      el: '.swiper-pagination',
      dynamicBullets: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 5,
        spaceBetween: 10,
      },
      960: {
        slidesPerView: 6,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 7,
        spaceBetween: 20,
      },
      1290: {
        slidesPerView: 10,
        spaceBetween: 50,
      },
    }
  });
  
  // featured products swiper
  var featured_swiper = new Swiper('#slideshow_featured', {
    slidesPerView: 2,
    spaceBetween: 10,
    // autoplay: {
    //   delay: 4000,
    //   disableOnInteraction: true,
    // },
    // init: false,
    pagination: {
      el: '.swiper-pagination',
      dynamicBullets: true,
    },
    breakpoints: {
      // 640: {
      //   slidesPerView: 4,
      //   spaceBetween: 10,
      // },
      768: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
      960: {
        slidesPerView: 4,
        spaceBetween: 15,
      },
      // 1024: {
      //   slidesPerView: 7,
      //   spaceBetween: 20,
      // },
      1290: {
        slidesPerView: 5,
        spaceBetween: 15,
      },
    }
  });
  
});