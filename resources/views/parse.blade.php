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
                    <h1>Парсить атб</h1>
                    <input type="submit" value="Парсить">
                </form>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @parent
@endsection