@extends('basic.main')

@section('title',  '編輯活動')

@section('content')
<main id="main">
  <section id="contact" class="contact mb-5">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="page-title">編輯活動</h1>
        </div>
      </div>
      <!-- Start Form -->
      <div class="row justify-content-center">
        <div class = "col-md-8 ">
          <div class="form">
            <form action="{{ route('calendar.update', $event->id) }}" method="POST" id="createRecordForm" class="createRecordForm">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="form-group col-md-8">
                  <label for="title" class="form-label">公告標題</label>                    
                  <input type="text" name="title" class="form-control" id="title" value="{{ $event->title }}" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="category" class="form-label">活動類別</label>
                  <select id="category" name="category" class="form-select" required>
                    <option selected disabled value="">請選擇活動類別</option>
                    <option value="0" {{ $event->category == 0 ? 'selected' : ''}}>爬山</option>
                    <option value="1" {{ $event->category == 1 ? 'selected' : ''}}>溯溪</option>
                    <option value="2" {{ $event->category == 2 ? 'selected' : ''}}>社課</option>
                    <option value="3" {{ $event->category == 3 ? 'selected' : ''}}>開會</option>
                  </select>
                </div>
              </div>
              <div class="form-group ">
                <label for="start">開始時間</label>
                <input type="datetime-local" class="form-control" id="start" name="start" value="{{ $event->start }}">
              </div>
              <div class="form-group ">
                <label for="end">結束時間</label>
                <input type="datetime-local" class="form-control" id="end" name="end" value="{{ $event->end }}">
              </div>
              <div class="row">
                <div class="text-center">
                  <button type="submit">更新活動</button>
                  <form action="{{ route('calendar.destroy', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:#AB3B3A">刪除活動</button>
                  </form>
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