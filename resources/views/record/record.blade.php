@extends('basic.main')

@section('title',  '行程紀錄')

@section('content')
<main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">   
        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">行程紀錄</h1>
            <a>一起來看看我們有哪些精采故事吧</a>
          </div>
        </div>
        @foreach($records as $record)  
          <!-- ======= Post Grid Section ======= -->
          <section id="posts" class="posts">
            <div class="container" data-aos="fade-up">
              <div class="row g-5 justify-content-center">
                <div class="col-lg-8">
                  <div class="post-entry-1 lg">
                    <a href="{{ route('record.show', $record->id) }}"><img src=" {{ asset($record->image) }}" alt="" class="img-fluid"></a>
                    <div class="post-meta">
                      <span class="date">{{ $category_array[$record->category] }}</span> 
                      <span class="mx-1">&bullet;</span> 
                      <span>{{ $record->start_date }}-{{ $record->end_date }}</span>
                    </div>
                    <h2><a href="{{ route('record.show', $record->id )}}">{{ $record->name }}</a></h2>
                    <p class="mb-4 d-block">{{ $record->description }} ... Read more</p>
                  </div>
                </div>
              </div> <!-- End .row -->
            </div>
          </section> <!-- End Post Grid Section -->
        @endforeach
      </div>
    </section>
</main><!-- End #main -->
@endsection