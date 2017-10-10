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


    $('.panel-btn .fa').click(function(){
        $(this).parent().toggleClass('active');
        $('.category-product tbody').slideToggle(1000);
    });

    /*********search*********/
    var str = '', content, arr = [], num = 0, category, text;

    // $('.category-btn, .category>p label').click(function(){
    //     $(this).parent().find('.category-btn').toggleClass('active');
    //     $(this).parent().next().slideToggle();
    // });

    $('.btn-clear').click(function(event){
        event.preventDefault();
        $(this).parents('.search-block').find('.search-block-middle input[type="checkbox"]').prop('checked', false)
            .parents('.search-block').find('.search-block-top input').val('');

    });

    $('.button-search').click(function(){
        $(this).next().slideToggle();
    });


    // $('.category input[type="checkbox"]').click(function(){
    //     if($(this).parent().next().not(':visible')){
    //         $(this).parent().next().slideDown();
    //         $(this).prev().addClass('active');
    //     }
    //     content = $(this).next().text();
    //
    //     if($(this).prop('checked') != false){
    //         arr.push($(this).next().text());
    //
    //         for(var i = 0; i<=arr.length; i++) {
    //
    //             if (arr.length == 1) {
    //                 str = content;
    //             } else if (arr.length != 1) {
    //                 str = '';
    //                 for (var key in arr) {
    //                     str += arr[key] + ', ';
    //                 }
    //             }
    //             $(this).parents('.search-block').find('.search-block-top input').val(str);
    //         }
    //     }else if($(this).prop('checked') == false){
    //
    //         for(var i = 0; i<=arr.length; i++){
    //             if(content == arr[i]){
    //                 num = i;
    //             }
    //         }
    //
    //         delete arr[num];
    //
    //         str = '';
    //         for (var key in arr) {
    //             str += arr[key] + ', ';
    //         }
    //
    //         $(this).parents('.search-block').find('.search-block-top input').val(str);
    //     }
    //
    // });
    // $('.category input[type="checkbox"]').click(function(){
    //     if($(this).parent().next().not(':visible')){
    //         $(this).parent().next().slideDown();
    //         $(this).prev().addClass('active');
    //     }
    //     content = $(this).next().text();
    //
    //     if($(this).prop('checked') != false){
    //         arr.push($(this).next().text());
    //
    //         for(var i = 0; i<=arr.length; i++) {
    //
    //             if (arr.length == 1) {
    //                 str = content;
    //             } else if (arr.length != 1) {
    //                 str = '';
    //                 for (var key in arr) {
    //                     str += arr[key] + ', ';
    //                 }
    //             }
    //             $(this).parents('.search-block').find('.search-block-top input').val(str);
    //         }
    //     }else if($(this).prop('checked') == false){
    //
    //         for(var i = 0; i<=arr.length; i++){
    //             if(content == arr[i]){
    //                 num = i;
    //             }
    //         }
    //
    //         delete arr[num];
    //
    //         str = '';
    //         for (var key in arr) {
    //             str += arr[key] + ', ';
    //         }
    //
    //         $(this).parents('.search-block').find('.search-block-top input').val(str);
    //     }
    //
    // });

    $('.category input[type="checkbox"]').click(function(){

        content = $(this).next().text();

        if($(this).prop('checked') != false){
            arr.push($(this).next().text());

            for(var i = 0; i<=arr.length; i++) {
                str = '';
                for (var key in arr) {
                    str += arr[key] + ', ';
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

    $('body').on('click', '.ui-menu-item', function(){
        text = $(this).text();

        if(arr.length){
            for(var key in arr){
                if(arr[key] != text){
                    arr.push(text);
                    $('.category p').each(function(){
                        category = $(this).find('label').text();
                        if(category === text){
                            $(this).find('label').click();
                        }
                    });
                }
            }
        }else{
            arr.push(text);
            $('.category p').each(function(){
                category = $(this).find('label').text();
                if(category === text){
                    $(this).find('label').click();
                }
            });
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

    var src, title, priceNew, priceOld, desc, path, sale;
    $('.product-img a').click(function(){
        path = $(this).parents('.product-block');

        src = $(this).find('img').attr('src');

        title = path.find('.product-title').text();
        priceNew = path.find('.price-new').html();
        priceOld = path.find('.price-old').html();
        desc = path.find('.product-desc').html();
        sale = path.find('.product-sale').text();

        $(this).parents('body').find('#popup img').attr('src', src);
        $(this).parents('body').find('#popup h4').text(title);
        $(this).parents('body').find('#popup .price-new').html(priceNew);
        $(this).parents('body').find('#popup .price-old').html(priceOld);
        $(this).parents('body').find('#popup .product-desc').html(desc);

        if(sale != ''){
            $(this).parents('body').find('#popup .wrap').html($('<div class="product-sale"></div>'));
            $(this).parents('body').find('#popup .product-sale').html(sale);
        }else{
            $(this).parents('body').find('#popup .product-sale').remove();
        }

    });

    $("select").select2();

});

$(function() {
        var availableTags = [
            'Бакалея',
            'Хлебобулочные',
            'Сладкое и дессерт',
            'Готовые блюда',
            'Овощи и фрукты',
            'Молочные продукты и яйца',
            'Мясо и рыба',
            'Рыбные продукты и икра',
            'Замороженные продукты',
            'Чай и кофе',
            'Напитки',
            'Табак',
            'Товары для животных',
            'Товары для детей',
            'Косметика гигиена',
            'Товары для дома',
            'Косметика и гигиена',
            'Одежда и обувь'
        ];
        function split(val) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }

        $(".input-search").on( "keydown", function( event ) {
            if( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        }).autocomplete({
            minLength: 0,
            source: function( request, response ) {
                response( $.ui.autocomplete.filter(
                    availableTags, extractLast( request.term ) ) );
            },
            focus: function() {
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                terms.pop();
                terms.push( ui.item.value );
                terms.push( "" );
                this.value = terms.join( ", " );
                return false;
            }
        });



});

$('main .tab:last').click(function(){
    var map;
    function initMap(){
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 49.988086, lng: 36.232516},
            zoom: 12
        });

        var iconBase = 'http://promotions/';
        var icons = {
            atb: {
                icon: iconBase + '/images/atb-map.jpg'
            },
            silpo: {
                icon: iconBase + '/images/silpo-map.jpg'
            }
        };

        var features = [
            {
                position: new google.maps.LatLng(50.018822, 36.226844),
                type: 'atb'
            }, {
                position: new google.maps.LatLng(50.026954, 36.220752),
                type: 'silpo'
            }
        ];

        features.forEach(function(feature) {
            var marker = new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                map: map
            });
        });
    }
    initMap();
});

$('.white-popup .tab:last').click(function(){
    var map;
    function initMap() {

        map = new google.maps.Map(document.getElementById('popup-map'), {
            center: {lat: 49.988086, lng: 36.232516},
            zoom: 14
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {

                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                map.setCenter(pos);

                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: 'Your location'
                });
            });

        }

        var iconBase = 'http://promotions/';
        var icons = {
            atb: {
                icon: iconBase + '/images/atb-map.jpg'
            },
            silpo: {
                icon: iconBase + '/images/silpo-map.jpg'
            }
        };

        var features = [
            {
                position: new google.maps.LatLng(50.018822, 36.226844),
                type: 'atb'
            }, {
                position: new google.maps.LatLng(50.026954, 36.220752),
                type: 'silpo'
            }
        ];


        features.forEach(function (feature) {
            var marker = new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                map: map
            });
        });
    }

    initMap();
});
