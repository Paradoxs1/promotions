/**
 * Created by Paradoxs on 31.08.2017.
 */
$(document).ready(function(){
    $(".toggle-block").click(function(){
        $('.toggle-mnu').addClass("on");
        $('.head-block').addClass('active');
        return false;
    });

    $('header .close').click(function(){
        $('.head-block').removeClass('active');
        $('.toggle-mnu').removeClass("on");
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
        slidesToShow: 8,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 6
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 430,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });

    $("main .tabs .tab").click(function() {
        $("main .tabs .tab").removeClass("active").eq($(this).index()).addClass("active");
        $("main .tab_item").hide().eq($(this).index()).fadeIn()
    }).eq(0).addClass("active");

    $("#popup .tabs .tab").click(function(){
        $("#popup .tabs .tab").removeClass("active").eq($(this).index()).addClass("active");
        $("#popup .tab_item").hide().eq($(this).index()).fadeIn()
    }).eq(0).addClass("active");


    /*********search*********/
    var str = '', content, arr = [], num = 0;

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
        content = $(this).next().text();

        if($(this).prop('checked') != false){
            arr.push($(this).next().text());

            for(var i = 0; i<=arr.length; i++) {

                if (arr.length == 1) {
                    str = content;
                } else if (arr.length != 1) {
                    str = '';
                    for (var key in arr) {
                        str += arr[key] + ', ';
                    }
                }
                $(this).parents('.search-block').find('.search-block-top input').val(str);
            }
        }else if($(this).prop('checked') == false){

            for(var i = 0; i<=arr.length; i++){
                if(content == arr[i]){
                    num = i;
                }
            }

            delete arr[num];

            str = '';
            for (var key in arr) {
                str += arr[key] + ', ';
            }

            $(this).parents('.search-block').find('.search-block-top input').val(str);
        }

    });


    $('.phone').mask('+380 99 999 99 99');

    $('.inline-popups').magnificPopup({
        delegate: 'a',
        removalDelay: 500,
        callbacks: {
            beforeOpen: function() {
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        midClick: true
    });

    var src, title, priceNew, priceOld;
    $('.product-img a').click(function(){
        src = $(this).find('img').attr('src');
        title = $(this).parents('.product-block').find('.product-title').text();
        priceNew = $(this).parents('.product-block').find('.price-new').html();
        priceOld = $(this).parents('.product-block').find('.price-old').html();

        $(this).parents('body').find('#popup img').attr('src', src);
        $(this).parents('body').find('#popup h4').text(title);
        $(this).parents('body').find('#popup .price-new').html(priceNew);
        $(this).parents('body').find('#popup .price-old').html(priceOld);
    });
});

$('main .tab:last').click(function(){
    var map;
    function initMap(){
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 49.988086, lng: 36.232516},
            zoom: 14
        });
    }
    initMap();
});

$('.white-popup .tab:last').click(function(){
    var map;
    function initMap(){
        map = new google.maps.Map(document.getElementById('popup-map'), {
            center: {lat: 49.988086, lng: 36.232516},
            zoom: 14
        });
    }
    initMap();
});
