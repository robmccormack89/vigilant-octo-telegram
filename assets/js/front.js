jQuery(function(){
  
  // first swiper
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
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
  
  
  var info_swiper = new Swiper('#slideshow_info', {
    slidesPerView: 3,
    spaceBetween: 0,
    // autoplay: {
    //   delay: 4000,
    //   disableOnInteraction: true,
    // },
    // init: false,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      640: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 5,
        spaceBetween: 30,
      },
      960: {
        slidesPerView: 6,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 7,
        spaceBetween: 40,
      },
      1290: {
        slidesPerView: 8,
        spaceBetween: 40,
      },
    }
  });
  
});