@extends('basic.main')

@section('title',  '編輯社課')

@section('content')
<main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center">
            <h1 class="page-title">編輯社課</h1>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class = "col-md-8">
            <div class="form mt-5">
              <form action="{{ route('course.update', $course->id) }}" method="POST" id="createRecordForm" class="createRecordForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="title" class="form-label">社課名稱</label>                    
                  <input type="text" name="title" class="form-control" id="title" value="{{ $course->title }}" required>
                </div>
                <div class="form-group">
                  <label for="description" class="form-label">社課簡介 </label>                    
                  <textarea name="description" class="form-control" id="description">{{ $course->description }}</textarea>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="date" class="form-label">社課日期</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $course->date }}" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="speaker" class="form-label">社課講師</label>
                    <input type="text" name="speaker" class="form-control" id="speaker" value="{{ $course->speaker }}" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="location" class="form-label">社課地點</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ $course->location }}" required>
                  </div>
                </div>
                <div class="form-group">
                    <label for="image">社課照片</label>
                    <input type="file" name="image" class="form-control" id="image" accept="image/gif, image/jpeg, image/png">
                    <img class="img-fluid" id="preview_image" src="{{ asset($course->image) }}" alt="預覽封面"/>

                </div>
                <div class="form-group">
                  <label for="videoURL" class="form-label">社課影片連結</label>                    
                  <input type="url" name="videoURL" class="form-control" id="videoURL" value="{{ $course->videoURL }}" >
                </div>
                <div class="form-group">
                  <label for="pptURL" class="form-label">社課簡報連結</label>                    
                  <input type="url" name="pptURL" class="form-control" id="pptURL" value="{{ $course->pptURL }}">
                </div>
                <div class="row">
                  <div class="text-center">
                    <button type="submit">編輯社課</button>
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