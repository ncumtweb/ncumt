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
                    <nav class="nav nav-pills flex-column flex-sm-row">
                        <a class="flex-sm-fill text-sm-center nav-link {{ $name == '大背包' ? 'active' : ''}}" aria-current="page" href="{{ route('equipment.index', '大背包') }}">大背包</a>
                        <a class="flex-sm-fill text-sm-center nav-link {{ $name == '睡袋' ? 'active' : ''}}" href="{{ route('equipment.index', '睡袋') }}">睡袋</a>
                        <a class="flex-sm-fill text-sm-center nav-link {{ $name == '睡墊' ? 'active' : ''}}" href="{{ route('equipment.index', '睡墊') }}">睡墊</a>
                    </nav>
                </div>
                @if($equipments->count() == 0)               
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">目前{{ $name }}都被借光了 🥺</h1>
                </div>
                @else
                    <div class="equipment row g-5">
                        <div class="col-md-12">
                            <div class="row g-5 mb-5">
                                @foreach($equipments as $equipment)
                                    <div class="col-md-3 border-start custom-border">
                                        <div class="post-entry-1">
                                            <a><img src="{{ asset($equipment->image) }}" alt="" class="img-fluid"></a>
                                            <div class="post-meta">
                                                <span class="date">社員價格：{{ $equipment->member_price }}</span><br>
                                                <span>非社員價格：{{ $equipment->normal_price }}</span>
                                            </div>
                                            <h3><a>{{ $equipment->description }}</a></h3>
                                            <button type="button" onclick = "window.location='{{ route('rental.addEquipment', $equipment->id) }}'">租借</button>
                                            
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
                @endif
        </div>
        </section><!-- End Lifestyle Category Section -->
    </div>
  </section>

@endsection
