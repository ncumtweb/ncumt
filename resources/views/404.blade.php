@extends('basic.main')
@section('title', '404')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/404.css') }}">
    @endpush
    <div class="container-fluid">
        <img src="{{ asset('assets/img/404_' . $randomNumber . '.jpg') }}" class="crop" id="background-image" alt="">
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

        {{--NyanCat小彩蛋--}}
        <script>
            var showGif = true;

            document.addEventListener('DOMContentLoaded', function() {

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
