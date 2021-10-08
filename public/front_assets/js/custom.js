/** 
  * Template Name: Daily Shop
  * Version: 1.0  
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS
  

  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER 
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER) 
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER) 
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER 
  13. RELATED ITEM SLIDER (SLICK SLIDER)

  
**/

jQuery(function ($) {


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */

  jQuery(".aa-cartbox").hover(function () {
    jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
  }
    , function () {
      jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
    }
  );

  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */
  jQuery('[data-toggle="tooltip"]').tooltip();
  jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER 
  /* ----------------------------------------------------------- */

  jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
    loading_image: 'demo/images/loading.gif'
  });

  jQuery('#demo-1 .simpleLens-big-image').simpleLens({
    loading_image: 'demo/images/loading.gif'
  });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

  jQuery('.aa-popular-slider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });


  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

  jQuery('.aa-featured-slider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */
  jQuery('.aa-latest-slider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

  jQuery('.aa-testimonial-slider').slick({
    dots: true,
    infinite: true,
    arrows: false,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true
  });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

  jQuery('.aa-client-brand-slider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */

  jQuery(function () {
    if ($('body').is('.productPage')) {
      var skipSlider = document.getElementById('skipstep');
      noUiSlider.create(skipSlider, {
        range: {
          'min': 0,
          '10%': 10,
          '20%': 20,
          '30%': 30,
          '40%': 40,
          '50%': 50,
          '60%': 60,
          '70%': 70,
          '80%': 80,
          '90%': 90,
          'max': 100
        },
        snap: true,
        connect: true,
        start: [20, 70]
      });
      // for value print
      var skipValues = [
        document.getElementById('skip-value-lower'),
        document.getElementById('skip-value-upper')
      ];

      skipSlider.noUiSlider.on('update', function (values, handle) {
        skipValues[handle].innerHTML = values[handle];
      });
    }
  });



  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

  jQuery(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $('.scrollToTop').fadeIn();
    } else {
      $('.scrollToTop').fadeOut();
    }
  });

  //Click event to scroll to top

  jQuery('.scrollToTop').click(function () {
    $('html, body').animate({ scrollTop: 0 }, 800);
    return false;
  });

  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

  jQuery(window).load(function () { // makes sure the whole site is loaded      
    jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out      
  })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function (e) {
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function (e) {
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

  jQuery('.aa-related-item-slider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

});

function change_product_color_iamge(img, color) {
  jQuery('#color-val-id').val(color);

  var asset = "{{ asset('storage/media/product/' ." + img + ") }}";
  var prev_image = '<a data-lens-image="' + img + '" class="simpleLens-lens-image"><img src="' + img + '" class="simpleLens-big-image"></a>';
  jQuery('.simpleLens-big-image-container').html(prev_image);
}

function showColor(size) {
  jQuery('#size-val-id').val(size);
  jQuery('.product-color').hide();
  jQuery('.' + size).show();
  jQuery('.size-id-class').css('border', 'none');
  jQuery('#size_id_' + size).css('border', '1px solid');
}





function add_to_cart(pid, color_id, size_id, qty = '') {
  if (size_id == '' && color_id == '') {
    var size = jQuery('#size-val-id').val();
    var color = jQuery('#color-val-id').val();

  } else {
    var size = size_id;
    var color = color_id;
  }

  if (size == '') {
    jQuery('#cart_msg').text('no size selected');
  } else if (color == '') {
    jQuery('#cart_msg').text('no color selected');
  } else {

    jQuery('#size-val-id').val(size);
    jQuery('#color-val-id').val(color);

    jQuery('#cart_msg').text('Thanks');
    jQuery('#product_id').val(pid);
    if (qty == '') {
      var qty = jQuery('#qty-select-id').val();
    }
    jQuery('#qty').val(qty);

    jQuery.ajax({
      url: '/add_to_cart',
      data: jQuery('#formAddToCart').serialize(),
      type: 'post',
      success: function (result) {
        alert('product ' + result.msg);
        if(result.cartTotalCount == 0){
          jQuery('.aa-cart-notify').html('0');
          jQuery('.aa-cartbox-summary').remove();
        }else{

          jQuery('.aa-cart-notify').html(result.cartTotalCount);
          var html = ' <div class="aa-cartbox-summary"><ul>';
          jQuery.each(result.cartResult, function(arrkey,arrval){

              /* Lets make the whole cart dropdown */
              html+= '<li><a class="aa-cartbox-img" href="#"><img src="" alt="img"></a><div class="aa-cartbox-info"><h4><a href="#"> '+arrVal.name +' </a></h4><p></p></div><a onclick="deleteQty()" class="aa-remove-product" href="javascript:void(0)"><spanclass="fa fa-times"></span></a></li>';
            });

          html+= '</ul></div>'
          jQuery('#cartboxid').after(html);

        }
      }
    });
    

  }
}

function home_add_to_cart(pid, color_id, size_id) {
  var size = size_id;
  var color = color_id;
  add_to_cart(pid, color, size, 1);
}


function updateQty(pid, color, size, attr_id, cart_id, price) {
  jQuery('#size-val-id').val(size);
  jQuery('#color-val-id').val(color);
  var qty = jQuery('#qty_cart_' + cart_id).val();
  jQuery('#qty').val(qty);

  var tota_price = qty * price;
  jQuery('#total_cart_' + cart_id).text('RS ' + tota_price);

  add_to_cart(pid, color, size, qty);
}

function deleteQty(pid, color, size, attr_id, cart_id) {
  jQuery('#size-val-id').val(size);
  jQuery('#color-val-id').val(color);
  var qty = 0;
  jQuery('#qty').val(qty);

  jQuery('#cart_box' + cart_id).remove();
  add_to_cart(pid, color, size, qty);
}