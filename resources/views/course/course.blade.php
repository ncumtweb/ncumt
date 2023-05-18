@extends('basic.main')

@section('title',  '社課影片')

@section('content')
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">社課影片</h1>
            <!-- Start Video -->
            <div class="aside-block">
                <div class="video-post">
                <a href="https://www.youtube.com/watch?v=V8RUXSVqmg0" class="glightbox link-video">
                    <span class="bi-play-fill"></span>
                    <img src="{{ asset('assets/img/course.jpg') }}" alt="" class="img-fluid">
                </a>
                </div>
            </div><!-- End Video -->

            <!-- Start Video -->
            <div class="aside-block">
                <div class="video-post">
                <a href="https://youtu.be/pUrgLNcRj84" class="glightbox link-video">
                    <span class="bi-play-fill"></span>
                    <img src="{{ asset('assets/img/course2.jpg') }}" alt="" class="img-fluid">
                </a>
                </div>
            </div><!-- End Video -->
        </div>
    </div>
</div>
@endsection