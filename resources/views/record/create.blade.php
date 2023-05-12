@extends('basic.main')

@section('title',  '創建紀錄')

@section('content')
<main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">創建紀錄</h1>
            <a> 請告訴我們你的精采故事吧</a>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class = "col-md-8 mb-5">
            <div class="form mt-5">
              <form action="{{ route('record.store') }}" method="POST" id="createRecordForm" class="createRecordForm">
                @csrf
                <div class="form-group">
                  <label for="name" class="form-label">路線名稱</label>                    
                  <input type="text" name="name" class="form-control" id="name" placeholder="請輸入路線名稱" required>
                </div>
                <div class="form-group">
                  <label for="category" class="form-label">路線類別</label>
                  <select id="category" name="category" class="form-select" required>
                    <option selected disabled value="">請選擇路線類別</option>
                    <option value="0">中級山</option>
                    <option value="1">高山</option>
                    <option value="2">溯溪</option>
                  </select>
                </div>
                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="start_date">出發日期</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="end_date">結束日期</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="image">封面照</label>
                    <input type="file" name="image" class="form-control" id="image" required >
                  </div>
                </div>
                <div class="form-group">  
                    <label for="editor" class="form-label">內容</label>
                    <div id="editor"></div>
                    <input type="hidden" name="content" class="form-control" id="content" required>
                </div>
                <div class="row">
                  <div class="text-center">
                    <button type="submit">創建紀錄</button>
                  </div>
                </div>
              </form>
            </div>
          </div> 
        </div>

        
      </div>
    </section>
</main><!-- End #main -->
@endsection