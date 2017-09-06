@extends('index')

@section('head')
    @parent
@endsection

@section('main')
    <main>
        <section class="about">
            <div class="container">
                <div class="about-inner">
                    @if($page)
                        <h1>{{ $page->h1 }}</h1>
                        <p>{{ $page->content1 }}</p>
                        <img src="{{ asset('images/team.jpg') }}" alt="">
                        <p>{{ $page->content2 }}</p>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @parent
@endsection