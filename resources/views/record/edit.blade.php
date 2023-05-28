@extends('basic.main')

@section('title',  '創建紀錄')

@section('content')
<main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center">
            <h1 class="page-title">編輯紀錄</h1>
            <a> 請告訴我們你的精采故事吧</a>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class = "col-md-8 mb-5">
            <div class="form mt-5">
              <form action="{{ route('record.update', $record->id) }}" method="POST" id="editRecordForm" class="createRecordForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="name" class="form-label">路線名稱</label>                    
                  <input type="text" name="name" class="form-control" id="name" value="{{ $record->name }}" required>
                </div>
                <div class="form-group">
                  <label for="description" class="form-label">路線簡介 </label>                    
                  <textarea name="description" class="form-control" id="description" required>{{ $record->description }}</textarea>
                </div>
                <div class="form-group">
                  <label for="category" class="form-label">路線類別</label>
                  <select id="category" name="category" class="form-select" required>
                    <option value="0" {{ $record->category == 0 ? 'selected' : ''}}>中級山</option>
                    <option value="1" {{ $record->category == 1 ? 'selected' : ''}}>高山</option>
                    <option value="2" {{ $record->category == 2 ? 'selected' : ''}}>溯溪</option>
                  </select>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="start_date">出發日期</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $record->start_date }}" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="end_date">結束日期</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $record->end_date }}" required>
                  </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="image">封面照</label>
                    <input type="file" name="image" class="form-control" id="image" accept="image/gif, image/jpeg, image/png" >
                    <img class="img-fluid" id="preview_image" src="{{ asset($record->image) }}" alt="預覽封面"/>
                </div>
                <div class="form-group">  
                    <label for="editor" class="form-label">內容</label>
                    
                    <div>
                      <div id="editor"></div>
                    </div>
                    <input type="hidden" id="oldContent" value="{{ $record->content }}">
                </div>
                <div class="row">
                  <div class="text-center">
                    <input type="hidden" name="content" class="form-control" id="content" required>
                    <button type="submit">更新紀錄</button>
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