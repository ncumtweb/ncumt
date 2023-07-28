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

        @if (session('status'))
            <div class="col-lg-12 text-center mb-2">
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            </div>
        @endif
      <!-- ======= Lifestyle Category Section ======= -->
        <section class="category-section">
            <div class="container" data-aos="fade-up">

                <div class="section-header mb-5">
                    <!-- <h2>大背包</h2>                     -->
                    <nav class="nav nav-pills flex-column flex-sm-row">
                        <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="#">大背包</a>
                        <a class="flex-sm-fill text-sm-center nav-link" href="#">睡袋</a>
                        <a class="flex-sm-fill text-sm-center nav-link" href="#">睡墊</a>
                        <!-- <a class="flex-sm-fill text-sm-center nav-link" href="#">確認租借</a> -->
                    </nav>
                </div>
               
                <div class="equipment row g-5">
                    <div class="col-md-12">
                        <div class="row g-5 mb-5">
                            @foreach($bags as $bag)
                                <div class="col-md-3 border-start custom-border">
                                    <div class="post-entry-1">
                                        <a href="single-post.html"><img src="assets/img/bag25.jpg" alt="" class="img-fluid"></a>
                                        <div class="post-meta">
                                            <span class="date">社員價格：{{ $bag->member_price }}</span><br>
                                            <span>非社員價格：{{ $bag->normal_price }}</span>
                                        </div>
                                        <h3><a>{{ $bag->description }}</a></h3>
                                        <button type="button" onclick = "window.location='{{ route('rental.addEquipment', $bag->id) }}'">租借</button>
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>                
                </div> <!-- End equipment list-->
                @if(session('rental_id'))
                    <div class="equipment row">
                        <button type="button" onclick ="window.location='{{ route('rental.showRental', session('rental_id') ) }}'" style="padding: 20px 10px;"> 查看租借清單</button>
                    </div>
                @endif                
        </div>
        </section><!-- End Lifestyle Category Section -->
    </div>
  </section>

@endsection
