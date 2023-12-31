
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

    // Load slider range
    
    // Thêm sự kiện cho slider 1
    rangeSlider1.noUiSlider.on('update', function (values, handle) {
      document.getElementById('slider-range-value1').innerHTML = values[0];
      document.getElementById('slider-range-value2').innerHTML = values[1];

      // Thực hiện Ajax call để tải dữ liệu khi giá trị slider thay đổi
      loadData('esimok_validity', values);
    });

    // Thêm sự kiện cho slider 2
    rangeSlider2.noUiSlider.on('update', function (values, handle) {
      document.getElementById('gb-value1').innerHTML = values[0];
      document.getElementById('gb-value2').innerHTML = values[1];
      loadData('esimok_size', values);
    });

    // Thêm sự kiện cho slider 3
    rangeSlider3.noUiSlider.on('update', function (values, handle) {
      document.getElementById('slider-date-value1').innerHTML = values[0];
      document.getElementById('slider-date-value2').innerHTML = values[1];
      loadData('esimok_validity', values);
    });

    // Thêm sự kiện cho slider 4
    rangeSlider4.noUiSlider.on('update', function (values, handle) {
      document.getElementById('price-value1').innerHTML = values[0];
      document.getElementById('price-value2').innerHTML = values[1];
      loadData('esimok_price', values);
    });

    document.querySelector('.clear').addEventListener('click', function () {
      // Reset giá trị của các slider
      rangeSlider2.noUiSlider.reset();
      rangeSlider3.noUiSlider.reset();
      rangeSlider4.noUiSlider.reset();

      // Reset giá trị của các checkbox
      document.getElementById('flexSwitchCheckDefault1').checked = false;
      document.getElementById('flexSwitchCheckDefault2').checked = false;
      document.getElementById('flexSwitchCheckDefault3').checked = false;
      document.getElementById('flexSwitchCheckDefault4').checked = false;

      // Xóa giá trị của các mục hiển thị giá trị
      document.getElementById('gb-value1').innerHTML = '';
      document.getElementById('gb-value2').innerHTML = '';
      document.getElementById('slider-date-value1').innerHTML = '';
      document.getElementById('slider-date-value2').innerHTML = '';
      document.getElementById('price-value1').innerHTML = '';
      document.getElementById('price-value2').innerHTML = '';

      // Thực hiện Ajax call để tải lại danh sách sản phẩm ban đầu
      loadData();
    });


    function loadData(type, values) {
      var $productContainer = $('.product-row-container .offers-list');
      var loading = false;

      // Thực hiện Ajax call để lấy dữ liệu sản phẩm
      if (loading) {
        return;
      }
      loading = true;

      var postData = {
        action: 'load_products',
      };

      // Thêm tham số vào dữ liệu Ajax nếu có
      if (type && values) {
        postData.type = type;
        postData.min = values[0];
        postData.max = values[1];
      }

      $.ajax({
        url: esimok_vars.ajax_url,
        type: 'POST',
        data: postData,
        success: function (data) {
          $productContainer.html(data);
          loading = false;
        },
        error: function (errorThrown) {
          console.log(errorThrown);
        }
      });
    }




    // function loadData(minValue1, maxValue1) {

    //   var $productContainer = $('.product-row-container .offers-list');
    //   var loading = false;
    //   // Thực hiện Ajax call để lấy dữ liệu sản phẩm
    //   if (loading) {
    //     return;
    //   }
    //   loading = true;
    //   $.ajax({
    //     url: esimok_vars.ajax_url, // Thay thế bằng đường dẫn của bạn
    //     type: 'POST',
    //     data: {
    //       action: 'load_products',
    //       minValue: minValue1,
    //       maxValue: maxValue1,
    //     },
    //     success: function (data) {
    //       $productContainer.html(data);
    //       loading = false;
    //     },
    //     error: function (errorThrown) {
    //       console.log(errorThrown);
    //     }
    //   });
    // }


  });
})(jQuery);
