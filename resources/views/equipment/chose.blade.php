@extends('basic.main')

@section('title',  '個人裝備選項')

@section('content')

<!-- ======= Services Section ======= -->
<section id="contact" class="contact mb-2">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-12 text-center mb-4">
        <h1 class="page-title">裝備選項</h1>
        <a>請選擇你要租借的個人裝備</a>
      </div>
    </div>
    @if (session('status'))
        <div class="col-lg-12 text-center mb-2">
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        </div>
    @endif
    <div class="row justify-content-center">
      <div class="col-md-4">
        <a href="{{ route('equipment.index', '大背包') }}">
          <div class="info-item info-item-borders">
            <i class="bi bi-bag-dash"></i>
            <h3>大背包</h3>            
          </div>
        </a>
      </div><!-- End Info Item -->

      <div class="col-md-4">
        <a href="{{ route('equipment.index', '睡袋') }}">
          <div class="info-item info-item-borders">
            <i class="bi bi-person-x-fill"></i>
            <h3>睡袋</h3>
          </div>
        </a>
      </div><!-- End Info Item -->

      <div class="col-md-4">
        <a href="{{ route('equipment.index', '睡墊') }}">
          <div class="info-item info-item-borders">
            <i class="bi bi-person-x-fill"></i>
            <h3>睡墊</h3>
          </div>
        </a>
      </div><!-- End Info Item -->
  </div>
</section><!-- End Services Section -->
@endsection