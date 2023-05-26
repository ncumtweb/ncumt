@extends('basic.main')

@section('title',  '新增社課')

@section('content')
<main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center">
            <h1 class="page-title">新增社課</h1>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class = "col-md-8">
            <div class="form mt-5">
              <form action="{{ route('course.store') }}" method="POST" id="createRecordForm" class="createRecordForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="title" class="form-label">社課名稱</label>                    
                  <input type="text" name="title" class="form-control" id="title" placeholder="請輸入社課名稱" required>
                </div>
                <div class="form-group">
                  <label for="date">社課日期</label>
                  <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="image">社課照片</label>
                    <input type="file" name="image" class="form-control" id="image" accept="image/gif, image/jpeg, image/png" required >
                    <img class="img-fluid" id="preview_image" src="#" alt="預覽封面"/>
                </div>
                <div class="form-group">
                  <label for="videoURL" class="form-label">社課影片連結</label>                    
                  <input type="url" name="videoURL" class="form-control" id="videoURL" placeholder="請輸入社課影片連結">
                </div>
                <div class="form-group">
                  <label for="pptURL" class="form-label">社課簡報連結</label>                    
                  <input type="url" name="pptURL" class="form-control" id="pptURL" placeholder="請輸入社課簡報連結">
                </div>
                <div class="row">
                  <div class="text-center">
                    <button type="submit">新增社課</button>
                  </div>
                </div>
              </form>
            </div>
          </div> 
        </div>

        
      </div>
    </section>
</main><!-- End #main -->

<script src="{{ asset('assets/vendor/create-record-form/createRecordForm.js') }}"></script>
@endsection