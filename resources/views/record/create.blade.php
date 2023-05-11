@extends('basic.main')

@section('title',  '創建紀錄')

@section('content')
<main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">創建紀錄</h1>
          </div>
        </div>

        <div class="row">
            <div id="editor"></div>
        </div>
      </div>
    </section>
</main><!-- End #main -->

<!-- <script src="{{ asset('js/app.js') }}"></script> -->
@endsection