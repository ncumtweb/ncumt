@extends('basic.main')

@section('title',  '創建紀錄')

@section('content')
    <main id="main">
        <section id="contact" class="contact mb-5">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-12 text-center mb-2">
                        <h1 class="page-title">創建紀錄</h1>
                        <a> 請告訴我們你的精采故事吧</a>
                    </div>
                </div>

                @if (session('status'))
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h6 class="alert alert-danger">{{ session('status') }}</h6>
                        </div>
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form">
                            <form action="{{ route('record.store') }}" method="POST" id="createRecordForm"
                                  class="createRecordForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">路線名稱</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="請輸入路線名稱"
                                           value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">路線簡介 </label>
                                    <textarea name="description" class="form-control" id="description"
                                              placeholder="請輸入路線簡介" required>{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category" class="form-label">路線類別</label>
                                    <select id="category" name="category" class="form-select" required>
                                        @if(old('category'))
                                            <option value="0" {{ old('category') == 0 ? 'selected' : '' }}>中級山
                                            </option>
                                            <option value="1" {{ old('category') == 1 ? 'selected' : '' }}>高山</option>
                                            <option value="2" {{ old('category') == 2 ? 'selected' : '' }}>溯溪</option>
                                        @else
                                            <option selected disabled value="">請選擇路線類別</option>
                                            <option value="0">中級山</option>
                                            <option value="1">高山</option>
                                            <option value="2">溯溪</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        @error('end_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="start_date">出發日期</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                               value="{{ old('start_date') }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="end_date">結束日期</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                               value="{{ old('end_date') }}" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="image">封面照</label>
                                    <div class="form-group col-md-12">
                                        @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="file" name="image" class="form-control" id="image"
                                           accept="image/gif, image/jpeg, image/png">
                                    <img class="img-fluid" id="preview_image" src="#" alt="預覽封面"/>
                                </div>
                                <div class="form-group">
                                    <label for="CKeditor" class="form-label">內容</label>
                                    <div class="col-md-12">
                                        @error('CKeditor')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <textarea class="form-control" id="CKeditor"
                                              name="CKeditor">{!! old('CKeditor') !!}</textarea>
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

    <script src="{{ asset('assets/vendor/create-record-form/createRecordForm.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector("#CKeditor"), {
            ckfinder: {
                uploadUrl: "{{ route('record.callImgurApi', ['_token' => csrf_token()]) }}",
            },
            link: {
                addTargetToExternalLinks: true
            }
        }).catch((error) => {
            console.error(error);
        });

    </script>
    <style>
        .ck-editor__editable {
            min-height: 800px;
        }
    </style>
@endsection
