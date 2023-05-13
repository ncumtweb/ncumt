@extends('basic.main')

@section('title',  $record->name)

@section('content')
<main id="main">
    <section class="single-post-content">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 post-content" data-aos="fade-up">

            <!-- ======= Single Post Content ======= -->
            <div class="single-post">
              <div class="post-meta">
                <span class="date">{{ $category_array[$record->category] }}</span> 
                <span class="mx-1">&bullet;</span> 
                <span>{{ $record->start_date . '-' . $record->end_date }}</span>
              </div>
              <h1 class="mb-5">{{ $record->name }}</h1>
              <p>{{ $record->description }}</p>
              <img src="{{ asset($record->image) }}" alt="" class="img-fluid">
              <p>{!! \Illuminate\Support\Str::markdown($record->content) !!}</p>
            </div><!-- End Single Post Content -->
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
@endsection