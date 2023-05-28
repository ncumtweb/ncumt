@extends('basic.main')

@section('title',  '登入選項')

@section('content')

<!-- ======= Services Section ======= -->
<section id="contact" class="contact mb-2">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-12 text-center mb-5">
        <h1 class="page-title">登入選項</h1>
        @if (session('status'))
          <div class="col-lg-12 text-center">
            <h6 class="alert alert-danger">{{ session('status') }}</h6>
          </div>
        @else
          <a>本系統僅以 Portal 作為登入的系統</a>
        @endif
        
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-5">
        <a href="{{ url('/portal/login') }}">
          <div class="info-item info-item-borders">
            <i class="bi bi-person-check-fill"></i>
            <h3>Portal 帳號登入</h3>
            <p>若為中大師生/已有註冊過Portal帳號，請由此登入</p>
          </div>
        </a>
      </div><!-- End Info Item -->

      <div class="col-md-5">
        <a href = "https://portal.ncu.edu.tw/signup">
          <div class="info-item info-item-borders">
            <i class="bi bi-person-x-fill"></i>
            <h3>訪客登入（無 Portal 帳號）</h3>
            <p>若沒有Portal帳號，請由此註冊帳號</p>
          </div>
        </a>
      </div><!-- End Info Item -->
  </div>
</section><!-- End Services Section -->
@endsection