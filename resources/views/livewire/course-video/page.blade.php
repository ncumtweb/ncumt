<div>
    @foreach($courses as $course)
        <div wire:key="course-{{ $course->id }}">
            <div class="container mb-4">
                <div class="row align-items-center">
                    <!-- Video -->
                    <div class="col-md-5 d-flex justify-content-center mb-3 mb-md-0">
                        <a href="{{ asset($course->videoURL) }}" class="glightbox link-video">
                            <span class="bi-play-fill"></span>
                            <img src="{{ asset($course->image) }}" loading="lazy" alt="" class="img-fluid">
                        </a>
                    </div>
                    <!-- Video end -->
                    <!-- doc -->
                    <div class="col-md-7 d-flex flex-column align-items-center text-center">
                        <div class="post-entry-1 lg">
                            <h2>{{$course->title}}
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
                            </h2>
                            <div class="record-meta">
                                <span>{{\Carbon\Carbon::parse($course->date)->format('Y.m.d')}}</span>
                            </div>
                            <p class="record-description">{!! $course->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- 分頁導航 -->
    <div class="d-flex justify-content-center mt-4">
        {{ $courses->links() }}
    </div>
    <!-- 滾動到頂端的 JavaScript -->
    <script>
        document.addEventListener('scroll-to-top', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</div>

