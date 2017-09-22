@extends('index')

@section('head')
    @parent
@endsection

@section('main')
    <main>
        <section class="main">
            <div class="container">
                <form action="{{ route('parseAtb') }}" method="post" class="contact-form">
                    {{ csrf_field() }}
                    <h1>Парсить АТБ</h1>
                    <input type="submit" value="Парсить">
                </form>
                <form action="{{ route('parseSilpo') }}" method="post" class="contact-form">
                    {{ csrf_field() }}
                    <h1>Парсить Сильпо</h1>
                    <input type="submit" value="Парсить">
                </form>
                <form action="{{ route('parseKlass') }}" method="post" class="contact-form">
                    {{ csrf_field() }}
                    <h1>Парсить Класс</h1>
                    <input type="submit" value="Парсить">
                </form>
                <form action="{{ route('parsePosad') }}" method="post" class="contact-form">
                    {{ csrf_field() }}
                    <h1>Парсить Посад</h1>
                    <input type="submit" value="Парсить">
                </form>
                <form action="{{ route('parseBrusnichka') }}" method="post" class="contact-form">
                    {{ csrf_field() }}
                    <h1>Парсить Брусничку</h1>
                    <input type="submit" value="Парсить">
                </form>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @parent
@endsection