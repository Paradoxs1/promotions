@extends('index')

@section('head')
    @parent
@endsection

@section('main')
    <main>
        <section class="contact">
            <div class="container">
                <form action="#" method="post" class="contact-form">
                    <h1>Связаться с нами</h1>
                    <input type="text" name="name" class="name" placeholder="Введите имя">
                    <input type="text" name="phone" class="phone" placeholder="Введите телефон">
                    <input type="text" name="email" class="email" placeholder="Введите email">
                    <textarea name="comment" placeholder="Введите текст сообщения"></textarea>
                    <input type="submit" value="Отправить">
                </form>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @parent
@endsection