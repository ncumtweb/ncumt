@extends('basic.main')

@section('title', 'FAQ')

@section('content')
<main id="main">
  <section id="contact" class="contact mb-5">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="page-title">FAQ</h1>
            </div>
        </div>

        @if (session('status'))
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            </div>
        </div>
        @endif

        <div class="row justify-content-center">
          <div class="col-lg-10 faq">
              <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">
                @foreach($faqs as $faq)
                  <div class="accordion-item"><!-- Start Faq item-->
                    <h1 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-{{ $faq->id }}">
                        <span class="num">{{ $loop->index + 1 }}.</span>
                        {{ $faq->question }}
                      </button>
                    </h1>
                    <div id="faq-content-{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                      <div class="accordion-body">
                      <strong>
                        {{$faq->answer}}
                        @auth
                          @if(Auth::user()->role > 0)
                            <form action="{{ route('faq.destroy', $faq->id) }}" method="POST">
                              <button type = "button" class="bi bi-pencil-square" onclick="window.location='{{ route('faq.edit', $faq->id) }}'"></button>
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="bi bi-trash"></button>
                            </form>
                          @endif
                        @endauth
                      </strong>
                      </div>
                    </div>
                  </div><!-- End Faq item-->
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </section>
</main><!-- End #main -->
@endsection
