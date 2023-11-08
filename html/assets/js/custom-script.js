$ = jQuery;
$(document).ready(function () {
  $('.owl-3').owlCarousel({
    loop: true,
    margin: 30,
    autoplay: false,
    nav: false,
    dots: false,
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

  $('.owl-country').owlCarousel({
    loop: true,
    margin: 30,
    autoplay: false,
    nav: true,
    dots: false,
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


  // Click mở option search

  var isActive = false;
  $('.filter-btn-esim img').click(function (e) {
    e.preventDefault();
    var parent = $(this).closest('.filter-btn-esim');

    if (isActive) {
      parent.removeClass('active');
      isActive = false;
    } else {
      parent.addClass('active');
      isActive = true;
    }
  });

  $(document).on('click', function (event) {
    if (!$(event.target).closest('.filter-btn-esim, .filter-search-list').length) {
      $('.filter-btn-esim').removeClass('active');
      isActive = false;
    }
  });

  // Slider 1
  var rangeSlider1 = document.getElementById('slider-range');
  var moneyFormat1 = wNumb({
    decimals: 0,
    thousand: ',',
    postfix: ' Day'
  });
  noUiSlider.create(rangeSlider1, {
    start: [1, 30],
    step: 1,
    range: {
      'min': [1],
      'max': [30]
    },
    format: moneyFormat1,
    connect: true
  });

  rangeSlider1.noUiSlider.on('update', function (values, handle) {
    document.getElementById('slider-range-value1').innerHTML = values[0];
    document.getElementById('slider-range-value2').innerHTML = values[1];
  });

  // Slider 2
  var rangeSlider2 = document.getElementById('slider-range2');
  var gbFormat = wNumb({
    decimals: 0,
    thousand: ',',
    postfix: 'GB'
  });
  noUiSlider.create(rangeSlider2, {
    start: [1, 11],
    step: 1,
    range: {
      'min': [1],
      'max': [11]
    },
    format: gbFormat,
    connect: true
  });

  rangeSlider2.noUiSlider.on('update', function (values, handle) {
    document.getElementById('gb-value1').innerHTML = values[0];
    document.getElementById('gb-value2').innerHTML = values[1];
  });

  // Slider 3
  var rangeSlider3 = document.getElementById('slider-range3');
  var dayFormat = wNumb({
    decimals: 0,
    thousand: ',',
    postfix: ' Day'
  });
  noUiSlider.create(rangeSlider3, {
    start: [1, 100],
    step: 1,
    range: {
      'min': [1],
      'max': [100]
    },
    format: dayFormat,
    connect: true
  });

  rangeSlider3.noUiSlider.on('update', function (values, handle) {
    document.getElementById('slider-date-value1').innerHTML = values[0];
    document.getElementById('slider-date-value2').innerHTML = values[1];
  });

  // Slider 4
  var rangeSlider4 = document.getElementById('slider-range4');
  var moneyFormat = wNumb({
    decimals: 0,
    thousand: ',',
    prefix: '$'
  });
  noUiSlider.create(rangeSlider4, {
    start: [1, 100],
    step: 1,
    range: {
      'min': [1],
      'max': [100]
    },
    format: moneyFormat,
    connect: true
  });

  rangeSlider4.noUiSlider.on('update', function (values, handle) {
    document.getElementById('price-value1').innerHTML = values[0];
    document.getElementById('price-value2').innerHTML = values[1];
  });




});