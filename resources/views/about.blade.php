@extends('index')

@section('head')
    @parent
@endsection

@section('main')
    <main>
        <section class="about">
            <div class="container">
                <div class="about-inner">
                    <h1>О сайте</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut augue eget ante pretium fringilla.
                        Morbi ultrices scelerisque sem. Integer fermentum, enim et rutrum mollis, massa purus accumsan elit,
                        id pellentesque ante lectus eget augue. Suspendisse vel est quis metus eleifend lacinia a in sem.
                        Duis pulvinar metus vel augue scelerisque lacinia. Vestibulum ante ipsum primis in faucibus orci
                        luctus et ultrices posuere cubilia Curae; Sed mollis arcu sit amet turpis varius, at commodo magna varius.
                    </p>
                    <img src="{{ asset('images/team.jpg') }}" alt="">
                    <p>Phasellus mattis ut augue ac bibendum. Vestibulum posuere ante mauris, ut rhoncus urna vulputate at.
                        Vestibulum eleifend nunc tortor. Suspendisse potenti. Nam condimentum sollicitudin nisi eget imperdiet.
                        Donec feugiat nisl nec dictum commodo. Donec luctus mollis dui nec rutrum. Fusce laoreet faucibus tortor
                        eu tincidunt. Praesent venenatis justo a varius tincidunt. Vivamus hendrerit elit leo, ac semper lacus congue eget.
                        Ut egestas turpis velit, sit amet commodo neque facilisis a. Aliquam vel velit hendrerit ligula vehicula dapibus
                        sodales maximus elit. Sed non iaculis odio, ac elementum diam. Pellentesque ut vulputate dui.
                        Pellentesque vitae arcu at risus blandit hendrerit.</p>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @parent
@endsection