@extends('basic.main')

@section('title',  '個人資料')        

@section('content')


<main id="main">
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">個人資料</h1>
          </div>
        </div>
        @if (session('status'))
          <div class="col-lg-12 text-center mb-5">
            <h6 class="alert alert-success">{{ session('status') }}</h6>
          </div>
        @endif
        <!-- start form -->
        <div class="row justify-content-center">
          <div class = "col-md-8 ">
            <div class="form ">
              <form action="{{ route('user.update', $user->id) }}" method="POST" id="createRecordForm" class="createRecordForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="name_zh" class="form-label">中文姓名</label>                    
                    <input type="text" name="name_zh" class="form-control" id="name_zh" value="{{ $user->name_zh }}" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="name_en" class="form-label">英文姓名</label>                    
                    <input type="text" name="name_en" class="form-control" id="name_en" value="{{ $user->name_en }}" required>
                  </div>
                </div> 
                
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="nickname" class="form-label">暱稱</label>                    
                    @if($user->nickname != null)
                      <input type="text" name="nickname" class="form-control" id="nickname" value="{{ $user->nickname }}" >
                    @else
                      <input type="text" name="nickname" class="form-control" id="nickname" placeholder="請輸入你的暱稱">
                    @endif
                  </div>
                  <div class="form-group col-md-6">
                    <label for="position" class="form-label">職位</label>                    
                    <input type="text" name="position" class="form-control" id="position" value="{{ $position[$user->role] }}">
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="studentID" class="form-label">學號</label>                    
                    <input type="text" name="studentID" class="form-control" id="studentID" value="{{ $user->identifier }}" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="phone" class="form-label">手機號碼</label>                    
                    <input type="phone" name="phone" class="form-control" id="phone" value="{{ $user->phone }}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="email" class="form-label">電子郵件</label>                    
                    <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                  </div>
                </div>
                <div class="row">
                  <div class="text-center">
                    <button type="submit">儲存變更</button>
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