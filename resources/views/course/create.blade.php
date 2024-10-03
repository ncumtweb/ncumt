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
                    <div class="col-md-8">
                        <div class="form">
                            <form action="{{ route('course.store') }}" method="POST" id="createRecordForm"
                                  class="createRecordForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title" class="form-label">社課名稱</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="請輸入社課名稱" required>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">社課簡介 </label>
                                    <textarea name="description" class="form-control" id="description"
                                              placeholder="請輸入社課簡介"></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="date_start" class="form-label">開始時間</label>
                                        <input type="datetime-local" class="form-control" name="start_date" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="end_date" class="form-label">結束時間</label>
                                        <input type="datetime-local" class="form-control" name="end_date" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="speaker" class="form-label">社課講師</label>
                                        <input type="text" name="speaker" class="form-control" id="speaker"
                                               placeholder="請輸入社課講師" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="location" class="form-label">社課地點</label>
                                        <input type="text" class="form-control" id="location" name="location"
                                               placeholder="請輸入社課地點" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">社課照片</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                           accept="image/gif, image/jpeg, image/png" required>
                                    <img class="img-fluid" id="preview_image" src="#" alt="預覽封面"/>
                                </div>
                                <div class="form-group">
                                    <label for="videoURL" class="form-label">社課影片連結</label>
                                    <input type="url" name="videoURL" class="form-control" id="videoURL"
                                           placeholder="請輸入社課影片連結">
                                </div>
                                <div class="form-group">
                                    <label for="pptURL" class="form-label">社課簡報連結</label>
                                    <input type="url" name="pptURL" class="form-control" id="pptURL"
                                           placeholder="請輸入社課簡報連結">
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
