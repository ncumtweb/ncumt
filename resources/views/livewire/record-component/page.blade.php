<div>
    @foreach($records as $record)
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="post-entry-1 lg">
                        <h2><a href="{{ route('record.show', $record->id )}}">{{ $record->name }}</a></h2>
                        <div class="post-meta">
                            <span class="date">{{ $category_array[$record->category] }}</span>
                            <span class="mx-1">&bullet;</span>
                            <span>{{ $record->start_date }} - {{ $record->end_date }}</span>
                        </div>
                        <a href="{{ route('record.show', $record->id) }}">
                            <img src="{{ asset($record->image) }}" loading="lazy" alt="" class="img-fluid">
                        </a>
                        <p>{{ $record->description }}</p>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="location.href='{{ route('record.show', $record->id )}}'">Read More</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- 分頁導航 -->
    <div class="d-flex justify-content-center mt-4">
        {{ $records->links() }}
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
