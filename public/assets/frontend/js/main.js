$(window).on("load", function () {
  $("body").removeClass("overflow");
});
$(document).ready(function () {
  /************************************ Menu ************************************/
  if ($(window).width() <= 767) {
    $(".menu-btn").click(function () {
      $(".header-nav").addClass("active");
      $("body").addClass("overflow");
      $(".overlay").fadeIn();
    });
    $(".close-btn,.overlay").click(function () {
      $(".header-nav").removeClass("active");
      $("body").removeClass("overflow");
      $(".overlay").fadeOut();
    });
  }

  /************************************ Search ************************************/
  $(".search-trigger").click(function () {
    $(".search-trigger").toggleClass("active");
    $(".search-form").fadeToggle();
  });

  /************************************ Main Slider ************************************/
  var mainSwiper = new Swiper(".main-slider .swiper", {
    a11y: {
      enabled: false,
    },
    spaceBetween: 10,
    loop: true,
    navigation: {
      nextEl: ".main-slider .swiper-btn-next",
      prevEl: ".main-slider .swiper-btn-prev",
    },
    pagination: {
      el: ".main-slider .slider-pagination",
      clickable: true,
    },
  });

  /************************************ Statistics ************************************/
  var a = 0;
  $(window).scroll(function () {
    if ($("section").hasClass("statistics-section")) {
      if (
        a == 0 &&
        $(this).scrollTop() >= $(".statistics-section").offset().top - 500
      ) {
        $(".statistics-item .item-value span").each(function () {
          $(this)
            .prop("Counter", 0)
            .animate(
              {
                Counter: $(this).text(),
              },
              {
                duration: 1000,
                easing: "swing",
                step: function (now) {
                  $(this).text(Math.floor(now));
                },
                complete: function () {
                  $(this).text($(this).data("count"));
                },
              }
            );
        });
        a++;
      }
    }
  });

  /************************************ Blog Slider ************************************/
  var blogSwiper = new Swiper(".blog-slider .swiper", {
    a11y: {
      enabled: false,
    },
    spaceBetween: 10,
    loop: true,
    navigation: {
      nextEl: ".blog-slider .swiper-btn-next",
      prevEl: ".blog-slider .swiper-btn-prev",
    },
    pagination: {
      el: ".blog-slider .slider-pagination",
      clickable: true,
    },
  });

  /************************************ Blog Slider ************************************/
  $(".filter-btn").click(function () {
    $(".filter-btn").toggleClass("active");
    $(".filter-body").slideToggle();
  });
});
