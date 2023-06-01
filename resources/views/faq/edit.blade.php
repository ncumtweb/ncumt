@extends('basic.main')

@section('title',  '編輯 FAQ')

@section('content')
<main id="main">
  <section id="contact" class="contact mb-5">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="page-title">編輯 FAQ</h1>
        </div>
      </div>
      <!-- Start Form -->
      <div class="row justify-content-center">
        <div class = "col-md-8 ">
          <div class="form">
            <form action="{{ route('faq.update', $faq->id) }}" method="POST" id="createRecordForm" class="createRecordForm">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="form-group">
                  <label for="question" class="form-label">問題</label>                    
                  <input type="text" name="question" class="form-control" id="question" value="{{ $faq->question }}" required>
                </div>
                <div class="form-group">
                  <label for="answer" class="form-label">答案 </label>                    
                  <textarea name="answer" class="form-control" id="answer" required>{{ $faq->answer}}</textarea>
                </div>
                <div class="text-center">
                  <button type="submit">更新 FAQ</button>
                </div>
              </div>
            </form>
          </div>
        </div> 
      </div>
      <!-- End Form -->
    </div>
  </section>
</main><!-- End #main -->
@endsection