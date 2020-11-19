/*  ---------------------------------------------------
Template Name: Ashion
Description: Ashion ecommerce template
Author: Colorib
Author URI: https://colorlib.com/
Version: 1.0
Created: Colorib
---------------------------------------------------------  */

'use strict';

//assets/js/main.js
//Xử lý ajax cho chúc năng Thêm vào giỏ hàng
$(document).ready(function () {
    //Xử lý sự kiện click trên class add-to-cart
    $('.add-to-cart').click(function () {
        //Cần xử lý để lấy ra đc đúng id của sản phẩm vừa
        //click, để khi gọi ajax sẽ truyền id này lên
        //Thêm 1 thuộc tính gì đó chứa id của sản phẩm ngay
        //tại đối tượng đang click, đặt thuộc tính đó = data-id
        var product_id = $(this).attr('data-id');
        //Gọi ajax sử dụng jQuery
        $.ajax({
            //đường dẫn mvc xử lý ajax
            url: 'index.php?controller=cart&action=add',
            // phương thức gửi dữ liệu
            method: 'GET',
            // dữ liệu gửi lên
            data: {
                product_id: product_id
            },
            // nơi nhận kết quả trả về từ url, tất cả dữ liệu
            //đó đc lưu trong tham số data của hàm
            success: function(data) {
                console.log(data);
                //Sử dụng tab Network của trình duyệt để debug
                //các thông tin liên quan đến gọi ajax
                //Đã có sẵn 1 class = ajax-message đang ẩn để
                //chứa các message Thêm giỏ hàng thành công
                $('.ajax-message')
                    .html('Thêm vào giỏ thành công')
                    .addClass('ajax-message-active');
                //Sử dụng hàm setTimeout để set thời gian chuyển
                //đổi cho 1 selector
                //Chờ 3s sẽ ẩn message đi
                setTimeout(function(){
                    $('.ajax-message').removeClass('ajax-message-active')
                }, 3000);
                //Xử lý update số lượng trong giỏ
                //Lấy nội dung của class cart-amount
                var cart_total = $('.cart-amount').html();
                cart_total++;
                //Set lại nội dung mới cho class cart-amount
                $('.cart-amount').html(cart_total);
            }
        });
    });
});


(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Product filter
        --------------------*/
        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.property__gallery').length > 0) {
            var containerEl = document.querySelector('.property__gallery');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });

    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay, .offcanvas__close").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*------------------
		Navigation
	--------------------*/
    $(".header__menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    /*--------------------------
        Banner Slider
    ----------------------------*/
    $(".banner__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*--------------------------
        Product Details Slider
    ----------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: false,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<i class='arrow_carrot-left'></i>","<i class='arrow_carrot-right'></i>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false,
        mouseDrag: false,
        startPosition: 'URLHash'
    }).on('changed.owl.carousel', function(event) {
        var indexNum = event.item.index + 1;
        product_thumbs(indexNum);
    });

    function product_thumbs (num) {
        var thumbs = document.querySelectorAll('.product__thumb a');
        thumbs.forEach(function (e) {
            e.classList.remove("active");
            if(e.hash.split("-")[1] == num) {
                e.classList.add("active");
            }
        })
    }


    /*------------------
		Magnific
    --------------------*/
    $('.image-popup').magnificPopup({
        type: 'image'
    });


    $(".nice-scroll").niceScroll({
        cursorborder:"",
        cursorcolor:"#dddddd",
        boxzoom:false,
        cursorwidth: 5,
        background: 'rgba(0, 0, 0, 0.2)',
        cursorborderradius:50,
        horizrailenabled: false
    });

    /*------------------
		Single Product
	--------------------*/
	$('.product__thumb .pt').on('click', function(){
		var imgurl = $(this).data('imgbigurl');
		var bigImg = $('.product__big__img').attr('src');
		if(imgurl != bigImg) {
			$('.product__big__img').attr({src: imgurl});
		}
    });

    /*-------------------
		Radio Btn
	--------------------- */
    $(".size__btn label").on('click', function () {
        $(".size__btn label").removeClass('active');
        $(this).addClass('active');
    });

})(jQuery);
