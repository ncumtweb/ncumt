@extends('basic.main')

@section('title',  '行程紀錄')

@section('content')
<main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h1 class="page-title">行程紀錄</h1>
            <a>一起來看看我們有哪些精采故事吧</a>
          </div>
        </div>
        <!-- ======= Post Grid Section ======= -->
          <section id="posts" class="posts">
            @foreach($records as $record)
              <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                  <div class="col-md-10">
                    <div class="post-entry-1 lg">
                      <h2><a href="{{ route('record.show', $record->id )}}">{{ $record->name }}</a></h2>
                      <div class="post-meta">
                        <span class="date">{{ $category_array[$record->category] }}</span>
                        <span class="mx-1">&bullet;</span>
                        <span>{{ $record->start_date }}-{{ $record->end_date }}</span>
                      </div>
                      <a href="{{ route('record.show', $record->id) }}" >
                          <img src="{{ asset($record->image) }}" loading="lazy" alt="" class="img-fluid">
                      </a>
                      <p>{{ $record->description }}</p>
                       <button type = "button" class="btn btn-outline-primary btn-sm" onclick="location.href='{{ route('record.show', $record->id )}}'">Read More</button>
                      <!-- <p class="d-block">{{ $record->description }}<a href="{{ route('record.show', $record->id )}}"> Read more</a></p> -->
                    </div>
                  </div>
                </div> <!-- End .row -->
              </div>
            @endforeach
          </section> <!-- End Post Grid Section -->
      </div>
    </section>
</main><!-- End #main -->
@endsection
