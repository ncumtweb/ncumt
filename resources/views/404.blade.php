@extends('basic.main')
@section('title', '404')

@section('content')
    <div class="container-fluid">
        <img src="" class="crop" id="background-image" alt="">
        <div class="overlay">
            <h1>糟糕，迷路了</h1>
            <p>此網頁不存在</p>
            <a href="{{ route('index') }}">返回首頁</a>
        </div>
        <div class="gif-container" id="gif-container">
            <img src="{{ asset('assets/img/nyancat.gif') }}" alt="" id="nyancat-gif">
        </div>
        <div class="fullscreen-gif-container" id="fullscreen-gif-container">
            <img src="{{ asset('assets/img/nyancat_fullscreen.gif') }}" alt="">
        </div>
    </div>


        <script>
            var showGif = true;
            var images = [
                "{{ asset('assets/img/404_1.jpg') }}",
                "{{ asset('assets/img/404_2.jpg') }}",
                "{{ asset('assets/img/404_3.jpg') }}",
                "{{ asset('assets/img/404_4.jpg') }}"
            ];

            document.addEventListener('DOMContentLoaded', function() {
                var randomImage = images[Math.floor(Math.random() * images.length)];
                document.getElementById('background-image').src = randomImage;

                if (showGif) {
                    if (Math.random() < 0.1) {
                        document.getElementById('gif-container').style.display = 'block';
                    }
                } else {
                    document.getElementById('gif-container').style.display = 'block';
                }
            });

            document.getElementById('nyancat-gif').addEventListener('click', function() {
                var gifContainer = document.getElementById('gif-container');
                var fullscreenContainer = document.getElementById('fullscreen-gif-container');

                gifContainer.style.display = 'none';
                fullscreenContainer.style.display = 'flex';

                setTimeout(function() {
                    fullscreenContainer.style.display = 'none';
                }, 2000);
            });
        </script>

@endsection
