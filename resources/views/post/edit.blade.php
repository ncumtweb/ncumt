@extends('basic.main')

@section('title',  '編輯公告')

@section('content')
<main id="main">
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title"><font face = "微軟正黑體" size = "10px" >編輯公告</font></h1>
                </div>
            </div>
             <!-- Start Form -->
            <div class="row justify-content-center">
                <div class = "col-md-8 ">
                <div class="form">
                    <form action="{{ route('post.update', $post->id) }}" method="POST" id="createRecordForm" class="createRecordForm">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title" class="form-label">公告標題</label>                    
                        <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}" required>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                        <label for="type" class="form-label">公告類別</label>
                        <select id="type" name="type" class="form-select" value="{{ $post->type }}" required>
                            <option value="0" {{ $post->type == 0 ? 'selected' : ''}}>隊伍相關</option>
                            <option value="1" {{ $post->type == 1 ? 'selected' : ''}}>社課相關</option>
                            <option value="2" {{ $post->type == 2 ? 'selected' : ''}}>其他</option>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="pin" class="form-label">公告置頂</label>
                        <select id="pin" name="pin" class="form-select" required>
                            <option value="0" {{ $post->pin == 0 ? 'selected' : ''}}>非置頂</option>
                            <option value="1" {{ $post->pin == 1 ? 'selected' : ''}}>置頂</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="expired_at">過期時間</label>
                        <input type="datetime-local" class="form-control" id="expired_at" name="expired_at" value="{{ $post->expired_at }}" required>
                    </div>
                    <div class="form-group">
                        <label for="content" class="form-label">公告內容 </label>                    
                        <textarea rows="10" style="height:100%" name="content" class="form-control" id="CKeditor" required>{{ $post->content }}</textarea>
                    </div>
                    
                    
                    <div class="row">
                        <div class="text-center">
                        <button type="submit">更新公告</button>
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

<script src="{{ asset('assets/vendor/create-record-form/createRecordForm.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/ckeditor5-build-classic-with-image-resize@12.4.0/build/ckeditor.min.js"></script> -->

<script>
    ClassicEditor.create(document.querySelector("#CKeditor"), {
        toolbar: [ 'undo', 'redo', '|', 'Heading', 
        '|', 'bold', 'italic', 'link', 'numberedList', 'bulletedList' ],
    }).catch((error) => {
       console.error(error);
    });
</script>
@endsection