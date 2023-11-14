
(function ($) {
  'use strict';

  // var ajax_url = $('#ajax_url').val();
  var allProducts = $('.product-row');
  $(document).ready(function () {
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

    // Load slider range
    rangeSlider1.noUiSlider.on('change', function (values, handle) {
      // Gọi hàm Ajax khi giá trị slider thay đổi
      var minValue1 = values[0];
      var maxValue1 = values[1];
      loadData(minValue1, maxValue1);
    });

    function loadData(minValue1, maxValue1) {

      var startDate = someConversionFunction(minValue1);
      var endDate = someConversionFunction(maxValue1);
      var $productContainer = $('.product-row-container .offers-list');
      var loading = false;
      // Thực hiện Ajax call để lấy dữ liệu sản phẩm
      if (loading) {
        return;
      }
      loading = true;
      $.ajax({
        url: esimok_vars.ajax_url, // Thay thế bằng đường dẫn của bạn
        type: 'POST',
        data: {
          action: 'load_products',
          startDate: startDate,
          endDate: endDate,
        },
        success: function (data) {
          $productContainer.html(data);
          loading = false;
        },
        error: function (errorThrown) {
          console.log(errorThrown);
        }
      });
    }


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

    // Sort dữ liệu

    var defaultProductOrder = $('.product-row').toArray();
    // Hàm để sắp xếp sản phẩm
    function sortProducts(selectedValue) {
      var allProducts = $('.product-row');

      if (selectedValue === 'esimok') {
        $('.product-row').remove();
        $('.product-row-container .offers-list').append(defaultProductOrder);
      } else if (selectedValue === 'best-price') {
        // Sắp xếp danh sách sản phẩm theo giá thấp đến cao
        var sortedProducts = allProducts.toArray().sort(function (a, b) {
          var priceA = parseFloat($(a).find('.price-product').text().replace(/\D/g, ''));
          var priceB = parseFloat($(b).find('.price-product').text().replace(/\D/g, ''));
          console.log(sortedProducts);
          return priceA - priceB;

        });
        $('.product-row').remove();
        $('.product-row-container .offers-list').append(sortedProducts);
      } else if (selectedValue === 'largest-gb') {
        // Sắp xếp danh sách sản phẩm theo giá cao đến thấp
        var sortedProducts = allProducts.toArray().sort(function (a, b) {
          var priceA = parseFloat($(a).find('.price-product').text().replace(/\D/g, ''));
          var priceB = parseFloat($(b).find('.price-product').text().replace(/\D/g, ''));
          return priceB - priceA;
        });
        $('.product-row').remove();
        $('.product-row-container .offers-list').append(sortedProducts);
      } else if (selectedValue === 'longest-validity') {
        // Sắp xếp danh sách sản phẩm theo thời hạn lâu nhất
        var sortedProducts = allProducts.toArray().sort(function (a, b) {
          var validityA = parseInt($(a).find('.validity').text());
          var validityB = parseInt($(b).find('.validity').text());
          return validityB - validityA;
        });
        $('.product-row').remove();
        $('.product-row-container .offers-list').append(sortedProducts);
      }
    }
    $('ul.nav-tabs li:first').addClass('active');

    // Xử lý sự kiện khi click vào tab
    $('ul.nav-tabs li').click(function () {
      // Loại bỏ lớp 'active' từ tất cả các tab
      $('ul.nav-tabs li').removeClass('active');

      // Thêm lớp 'active' cho tab được click
      $(this).addClass('active');

      var selectedValue = $(this).data('type');
      sortProducts(selectedValue);
    });




  });
})(jQuery);
