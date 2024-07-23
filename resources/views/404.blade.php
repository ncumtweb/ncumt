@extends('basic.main')
@section('title',  '404')

@section('content')

    <style>
        .container-fluid {
            padding: 0;
            position: relative;
            height: 90vh;
            overflow: hidden;
        }
        .crop {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
            filter: brightness(0.8) contrast(1.1);
        }
        .overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }
        .overlay h1 {
            font-size: 7rem;
            font-weight: 500;
            margin: 0;
        }
        .overlay p {
            font-size: 4rem;
            font-weight: 600;
            margin-top: 5px;
            margin-bottom: 150px;
        }
        .overlay a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1.2rem;
            font-weight: 450;
            color: #000000;
            background-color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .overlay a:hover {
            background-color: gray;
            color: white;
        }
        .gif-container {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 2;
            display: none;
        }
        .gif-container img {
            width: 100px;
            height: auto;
        }
        .fullscreen-gif-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 3;
        }
        .fullscreen-gif-container img {
            width: 100vw;
            height: 100vh;
            max-height: 100vh;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .overlay h1 {
                font-size: 5.5rem;
            }
            .overlay p {
                font-size: 3rem;
            }
            .overlay a {
                font-size: 1rem;
            }
        }
    </style>

    <div class="container-fluid">
        <img src="" class="crop" id="background-image" alt="">
        <div class="overlay">
            <h1>糟糕</h1>
            <p>迷路了</p>
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
