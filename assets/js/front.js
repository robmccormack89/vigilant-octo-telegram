jQuery(function(){
  
  var slider_swiper = new Swiper('#slideshow_banner', {
    centeredSlides: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: true,
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'progressbar',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
  
  var info_swiper = new Swiper('#slideshow_info', {
    slidesPerView: 1,
    spaceBetween: 0,
    // autoplay: {
    //   delay: 4000,
    //   disableOnInteraction: true,
    // },
    // init: false,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      960: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 40,
      },
    }
  });
  
  var howto_swiper = new Swiper('#slideshow_howto', {
    slidesPerView: 1,
    spaceBetween: 0,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      960: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    }
  });
  
  var featured_swiper = new Swiper('#slideshow_featured', {
    slidesPerView: 1,
    spaceBetween: 0,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      960: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    }
  });
  
});