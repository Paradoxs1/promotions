@extends('index')

@section('head')
    @parent
@endsection

@section('main')
    <main>
        <section class="main">
            <div class="container">
                <h1>Акции и скидки супермаркетов Харькова</h1>
                <div class="main-top clearfix">
                    <div class="right tabs"><span class="tab"><i class="fa fa-list" aria-hidden="true"></i> Список акций</span><span
                                class="tab"><i class="fa fa-map-marker" aria-hidden="true"></i> Карта магазинов</span>
                    </div>
                </div>
                <div class="main-content">
                    <div class="tab_item">
                        <div class="product-container">
                            @foreach($data as $product)
                                <div class="product-block">
                                    <div class="product-top clearfix">
                                        <img src="{{ asset('images/atb.png') }}" class="left" alt="">
                                        <p>
                                            <span class="sale">7 дней, купи не пожалеешь</span><br>
                                            <span class="date">{{ $product->description }}</span>
                                        </p>
                                    </div>
                                    <div class="product-img">
                                        <span class="inline-popups">
                                            <a href="#popup" data-effect="mfp-zoom-out">
                                                <img src="{{ $product->img }}" alt="">
                                            </a>
                                        </span>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-title">{{ $product->name }}</div>
                                        <div class="price-new">{{ $product->price_sale }}</div>
                                        <div class="price-old">{{ $product->price }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab_item">
                        <div class="map" id="map"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @parent
@endsection