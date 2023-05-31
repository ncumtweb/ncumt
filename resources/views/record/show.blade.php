@extends('basic.main')

@section('title',  $record->name)

@section('content')
<main id="main">
    <section class="single-post-content">
      <div class="container">
        <div class="row mb-2">
          <div class="col-lg-12 text-center">
          <h1 class="page-title">
            {{ $record->name }}
            @auth
                @if(Auth::user()->role > 0)
                    <a class="bi bi-pencil-square" href="{{ route('record.edit', $record->id) }}"></a>
                    <a class="bi bi-trash" href="{{ route('record.delete', $record->id) }}"></a>
                @endif
            @endauth
          </h1>
            <div class="post-meta">
              <span class="date">{{ $category_array[$record->category] }}</span> 
              <span class="mx-1">&bullet;</span> 
              <span>{{ $record->start_date . '-' . $record->end_date }}</span>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-12 post-content" data-aos="fade-up">
            <!-- ======= Single Post Content ======= -->
            <div class="single-post">
              <p>{{ $record->description }}</p>
              <img src="{{ asset($record->image) }}" alt="" class="img-fluid">
              <div class="content">
                <p>{!! $record->content !!}</p>
              </div>
            </div><!-- End Single Post Content -->
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- <style>
  figure {
    max-width: 100%;
  }

  img {
    max-width: 100%;
    
  }
  </style> -->
@endsection