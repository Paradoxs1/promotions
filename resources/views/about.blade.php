@extends('index')

@section('head')
    @parent
@endsection

@section('main')
    <main>
        <section class="about">
            <div class="container">
                <div class="about-inner">
                    <h1>{{ $h1 }}</h1>
                    <p>{{ $content1 }}</p>
                    <img src="{{ asset('images/team.jpg') }}" alt="">
                    <p>{{ $content2 }}</p>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @parent
@endsection