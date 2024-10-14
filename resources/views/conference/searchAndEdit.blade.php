@extends('basic.main')

@section('title',  '查詢報名資訊')

@section('content')
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="col-lg-12 text-center">
                <h1 class="mt-3">113 年度第二十五屆全國大專校院 登山運動研討會</h1>
                <h1 class="page-title">報名資訊查詢</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <livewire:conference.search/>
                </div>
            </div>
        </div>
    </section>
@endsection
