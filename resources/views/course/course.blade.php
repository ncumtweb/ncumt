@php use App\Utils\DateFormatter; @endphp
@extends('basic.main')

@section('title',  '社課影片')

@section('content')
    <section id="contact" class="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">社課影片</h1>
                    <div>
                    </div>
                    <section id="posts" class="posts">
                        <div class="row gy-4 justify-content-center text-center">
                            <livewire:course-video.page/>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    function confirmDeleteCourse() {
        return confirm('確定要刪除這堂社課嗎？');
    }
</script>
