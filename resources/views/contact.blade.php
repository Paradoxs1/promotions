@extends('index')

@section('head')
    @parent
@endsection
@section('main')
    <main>
        <section class="contact">
            <div class="container">
                <form action="{{ route('formHandler') }}" method="post" class="contact-form">
                    {{ csrf_field() }}
                    <h1>Связаться с нами</h1>
                    <input type="text" name="name" value="{{ old('name') }}" class="name"
                           placeholder="Введите имя">
                    <input type="text" name="phone" value="{{ old('phone') }}" class="phone"
                           placeholder="Введите телефон">
                    <input type="text" name="email" value="{{ old('email') }}" class="email"
                           placeholder="Введите email">
                    <textarea name="comment"
                              placeholder="Введите текст сообщения">{{ old('comment') }}</textarea>
                    <input type="submit" value="Отправить">
                </form>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @parent
@endsection