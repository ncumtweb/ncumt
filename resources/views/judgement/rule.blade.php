@extends('basic.main')

@section('title',  '評分紀錄規則')

@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">評分紀錄規則</h1>
                </div>
                <div class="row gy-4 justify-content-center text-center">
                    @include('judgement.includes.rule')
                </div>
            </div>
        </div>
    </section>
@endsection
