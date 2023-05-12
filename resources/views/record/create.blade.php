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

        <div class="row justify-content-center">
          <div class = "col-md-12 mb-5">
            <div class="form mt-5">
              <form action="{{ route('record.store') }}" method="POST" id="createRecordForm">
                @csrf
                <div class="form-group">
                  <label for="name" class="form-label">路線名稱</label>                    
                  <input type="text" name="name" class="form-control" id="name" placeholder="請輸入路線名稱" required>
                  <br>
                  <label for="name" class="form-label">封面照</label>
                  <input type="text" name="image" class="form-control" id="image" required>
                  <br>
                  <label for="editor" class="form-label">內容</label>
                  <div id="editor"></div>
                  <input type="hidden" name="content" class="form-control" id="content" required>
                </div>
                <button >建立紀錄</button>
              </form>
            </div>
          </div> 
        </div>

        
      </div>
    </section>
</main><!-- End #main -->
@endsection