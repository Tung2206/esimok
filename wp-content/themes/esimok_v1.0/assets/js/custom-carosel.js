$ = jQuery;
$(document).ready(function () {
  $('.owl-3').owlCarousel({
    loop: true,
    margin: 30,
    autoplay: false,
    nav: false,
    responsive: {
      0: {
        items: 1,
        autoHeight: true,
        autoHeightClass: 'owl-height'
      },
      600: {
        items: 2
      },
      1000: {
        items: 3
      }
    }
  });

});