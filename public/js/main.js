/**
 * Created by Paradoxs on 31.08.2017.
 */
$(document).ready(function(){
    $(".toggle-block").click(function(){
        $('.toggle-mnu').toggleClass("on");
        $('.menu').slideToggle(500);
        return false;
    });

    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('.button-top').fadeIn();
        } else {
            $('.button-top').fadeOut();
        }
    });
    $('.button-top').click(function() {
        $('body,html').animate({scrollTop:0},800);
    });

    $('.slider-market').slick({
        infinite: true,
        dots: false,
        arrows: true,
        autoplay: true,
        centerMode: true,
        centerPadding: '20px',
        slidesToShow: 8,
        slidesToScroll: 1
    });

    $(".tabs .tab").click(function() {
        $(".tabs .tab").removeClass("active").eq($(this).index()).addClass("active");
        $(".tab_item").hide().eq($(this).index()).fadeIn()
    }).eq(0).addClass("active");


    /*********search*********/
    var str = '', content;

    $('.category-btn, .category>p label').click(function(){
        $(this).parent().find('.category-btn').toggleClass('active');
        $(this).parent().next().slideToggle();
    });

    $('.btn-clear').click(function(event){
        event.preventDefault();
        $(this).parents('.search-block').find('.search-block-middle input[type="checkbox"]').prop('checked', false)
            .parents('.search-block').find('.search-block-top input').val('');

    });

    $('.button-search').click(function(){
        $(this).next().slideToggle();
    });


    $('.category input[type="checkbox"]').click(function(){
        if($(this).parent().next().not(':visible')){
            $(this).parent().next().slideDown();
            $(this).prev().addClass('active');
        }


        // content = $(this).next().text();
        // if($(this).prop('checked') != false && str != content){
        //     str += content + ', ';
        //     $(this).parents('.search-block').find('.search-block-top input').val(str);
        // }else if($(this).prop('checked') == false){
        //     str -= content;
        // }


    });


    //$('.phone').mask('+380 99 999 99 99');
});

$('.tab:last').click(function(){
    var map;
    function initMap(){
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 49.988086, lng: 36.232516},
            zoom: 14
        });
    }
    initMap();
});
