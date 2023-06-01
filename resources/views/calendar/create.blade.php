@extends('basic.main')

@section('title',  '創建活動')

@section('content')
<main id="main">
  <section id="contact" class="contact mb-5">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="page-title">創建活動</h1>
        </div>
      </div>
      <!-- Start Form -->
      <div class="row justify-content-center">
        <div class = "col-md-8 ">
          <div class="form">
            <form action="{{ route('calendar.store') }}" method="POST" id="createRecordForm" class="createRecordForm">
              @csrf
              <div class="row">
                <div class="form-group col-md-8">
                  <label for="title" class="form-label">公告標題</label>                    
                  <input type="text" name="title" class="form-control" id="title" placeholder="請輸入活動標題" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="category" class="form-label">活動類別</label>
                  <select id="category" name="category" class="form-select" required>
                    <option selected disabled value="">請選擇活動類別</option>
                    <option value="0">爬山</option>
                    <option value="1">溯溪</option>
                    <option value="2">社課</option>
                    <option value="3">開會</option>
                    <option value="4">山防</option>
                  </select>
                </div>
              </div>
              <div class="form-group ">
                <label for="start">開始時間</label>
                <input type="datetime-local" class="form-control" id="start" name="start" required>
              </div>
              <div class="form-group ">
                <label for="end">結束時間</label>
                <input type="datetime-local" class="form-control" id="end" name="end" required>
              </div>
              <div class="row">
                <div class="text-center">
                  <button type="submit">新增活動</button>
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