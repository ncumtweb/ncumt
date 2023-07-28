@extends('basic.main')

@section('title',  '個人裝備租借')

@section('content')

  <section id="contact" class="contact mb-5">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="page-title">個人裝備</h1>
        </div>
      </div>

      <!-- ======= Lifestyle Category Section ======= -->
        <section class="category-section">
            <div class="container" data-aos="fade-up">

                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h2>大背包</h2>                    
                </div>

                <div class="row g-5" name = "bags">
                    <div class="col-md-12">
                        <div class="row g-5">
                            @foreach($bags as $bag)
                                <div class="col-md-3 border-start custom-border">
                                    <div class="post-entry-1">
                                        <a href="single-post.html"><img src="assets/img/bag25.jpg" alt="" class="img-fluid"></a>
                                        <div class="post-meta">
                                            <span class="date">社員價格：{{ $bag->member_price }}</span><br>
                                            <span>非社員價格：{{ $bag->normal_price }}</span>
                                        </div>
                                        <h3><a>{{ $bag->description }}</a></h3>
                                        <button type="button" onclick = "window.location='{{ route('rental.addEquipment', $bag->id) }}'" value="store" name="submit_button">加入租借清單</button>
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- <div class="col-lg-2 border-start custom-border">
                        <div class="aside-block">
                            <h3 class="aside-title">個人裝備</h3>
                            <ul class="aside-links list-unstyled">
                                <li><a href="{{ url('/equipment') }}"><i class="bi bi-chevron-right"></i> 大背包</a></li>
                                <li><a href="{{ url('/equipment') }}"><i class="bi bi-chevron-right"></i> 睡袋</a></li>
                                <li><a href="{{ url('/equipment') }}"><i class="bi bi-chevron-right"></i> 睡墊</a></li>                        
                            </ul>
                        </div>
                    </div> End Categories -->
                </div> <!-- End .row -->
        </div>
        </section><!-- End Lifestyle Category Section -->

    </div>
  </section>

@endsection
