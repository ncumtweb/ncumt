@extends('basic.main')

@section('title',  '社課報名')

@section('content')
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">社課報名</h1>
                </div>
            </div>

            @if (session('status'))
            <div class="col-lg-12 text-center">
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            </div>
            @endif
    </section>

    @if($courses->count() == 0)
        <section class="mb-5">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-between">
                    <div class="col-lg-12 text-center">
                        <h2>目前沒有社課可以報名</h2>
                    </div>
                </div>
            </div>
        </section>
    @else
        @foreach($courses as $course)
            <section class="mb-5">
                <div class="container" data-aos="fade-up">
                    <div class="row justify-content-between align-items-lg-center">
                        <div class="col-lg-7">
                            <div class="row justify-content-center thumbnail">
                                <div class="col-9">
                                    <img src="{{ asset($course->image) }}" alt="" class="img-fluid">                        
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4 mb-lg-0">
                            <div class="post-meta mt-4">Course</div>
                            <h2 class="display-4 mb-4">{{ $course->title }}
                                @auth
                                    @if(Auth::user()->role > 0)
                                        <a class="bi bi-pencil-square" href="{{ route('course.edit', $course->id) }}"></a>
                                        <a class="bi bi-trash" onclick="return confirmDelete();" href="{{ route('course.destroy', $course->id) }}"></a>
                                        <a class="bi bi-info-circle" href="{{ route('course.showAllRecords', $course->id) }}"></a>
                                    @endif
                                @endauth
                            </h2>
                            <h3>講者： {{ $course->speaker }}</h3>
                            <h3>日期： {{ $course->date }}</h3>
                            <h3>地點： {{ $course->location }}</h3>
                            @if( $course->description )
                                <h3>簡介：{{ $course->description }}</h3>
                            @endif
                            @if( !$course->users->contains(Auth::user()) )
                                <div class="row justify-content-center py-4">
                                    <div class="col-lg-4">                                
                                        <form action="{{ route('course.register', $course->id) }}" method="POST">
                                            @csrf                            
                                            <button class="black" type="submit">一鍵報名</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="row justify-content-center py-4">
                                    <div class="col-lg-4">                                
                                        <button class="black" type="submit">已報名完成</button>    
                                    </div>
                                </div>         
                            @endif                            
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
@endsection

<script>
function confirmDelete() {
    return confirm('確定要刪除這堂社課嗎？');
}
</script>