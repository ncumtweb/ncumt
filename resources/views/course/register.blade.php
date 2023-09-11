@extends('basic.main')

@section('title',  '報名社課')

@section('content')
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="page-title">社課報名</h1>
            </div>
        </div>
</section>

<section class="mb-5 bg-light">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-between align-items-lg-center">
            <div class="col-lg-7">
                <div class="row justify-content-center thumbnail">
                    <div class="col-9">
                        <img src="{{ asset($course->image) }}" alt="" class="img-fluid">                        
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="post-meta mt-4">Course</div>
                <h2 class="display-4 mb-4">{{ $course->title }}</h2>
                <h3>講者：</h3>
                <h3>時間：</h3>
                <h3>地點：</h3>
                <h3>簡介：</h3>

                <div class="row justify-content-center py-4">
                    <div class="col-lg-4">
                        <button class="black" type="button" onclick = "" value="store" name="submit_button">一鍵報名</button>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</section>

@endsection