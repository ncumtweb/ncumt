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
                        <div class="row">
                            <!-- Start Video -->
                            @foreach($courses as $course)
                                <div class="col-lg-12 mb-3">
                                    <div class="aside-block">
                                        <div class="video-post">
                                            <h1>
                                                {{ $course->title . ' ' . DateFormatter::formatRange($course->start_date, $course->end_date)}}
                                                @if($course->pptURL)
                                                    &nbsp;
                                                    <a class="bi bi-filetype-ppt" href="{{ asset($course->pptURL) }}"
                                                       target="_blank"></a>
                                                @endif

                                                @auth
                                                    @if(Auth::user()->role > 0)
                                                        <a class="bi bi-pencil-square"
                                                           href="{{ route('course.edit', $course->id) }}"></a>
                                                        <a class="bi bi-trash" onclick="return confirmDeleteCourse();"
                                                           href="{{ route('course.destroy', $course->id) }}"></a>
                                                    @endif
                                                @endauth
                                            </h1>
                                            <a href="{{ asset($course->videoURL) }}" class="glightbox link-video">
                                                <span class="bi-play-fill"></span>
                                                <img src="{{ asset($course->image) }}" loading="lazy" alt=""
                                                     class="img-fluid">
                                            </a>

                                        </div>
                                    </div>
                                </div><!-- End Video -->
                            @endforeach
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
