<div>
    @foreach($records as $record)
        <div wire:key="record-{{ $record->id }}">
            <div class="container mb-4">
                <div class="row align-items-center">
                    <!-- 圖片區 -->
                    <div class="col-md-6 d-flex justify-content-center mb-3 mb-md-0">
                        <a href="{{ route('record.show', $record->id) }}">
                            <img src="{{ asset($record->image) }}" loading="lazy" alt="" class="img-fluid record-img">
                        </a>
                    </div>

                    <!-- 文字區 -->
                    <div class="col-md-6 d-flex flex-column align-items-center text-center">
                        <div class="post-entry-1 lg">
                            <h2><a href="{{ route('record.show', $record->id )}}">{{ $record->name }}</a></h2>
                            <div class="record-meta">
                                <span class="date">{{ $category_array[$record->category] }}</span>
                                <span class="mx-1">&bullet;</span>
                                @php
                                    $startYear = \Carbon\Carbon::parse($record->start_date)->format('Y');
                                    $endYear = \Carbon\Carbon::parse($record->end_date)->format('Y');
                                    $startMonth = \Carbon\Carbon::parse($record->start_date)->format('m');
                                    $endMonth = \Carbon\Carbon::parse($record->end_date)->format('m');
                                @endphp

                                @if($startYear != $endYear)
                                    <span>{{ \Carbon\Carbon::parse($record->start_date)->format('Y.m.d') }} - {{ \Carbon\Carbon::parse($record->end_date)->format('Y.m.d') }}</span>
                                @else
                                    @if($startMonth != $endMonth)
                                        <span>{{ \Carbon\Carbon::parse($record->start_date)->format('Y.m.d') }} - {{ \Carbon\Carbon::parse($record->end_date)->format('m.d') }}</span>
                                    @else
                                        <span>{{ \Carbon\Carbon::parse($record->start_date)->format('Y.m.d') }} - {{ \Carbon\Carbon::parse($record->end_date)->format('d') }}</span>
                                    @endif
                                @endif

                            </div>
                            <p class="record-description">{{ $record->description }}</p>
                            <button type="button" class="btn btn-dark record-btn mt-2"
                                    onclick="location.href='{{ route('record.show', $record->id )}}'">詳細內容
                            </button>
                        </div>
                    </div>
                </div> <!-- End .row -->
            </div> <!-- End .container -->
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
