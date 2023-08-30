@extends('basic.main')

@section('title',  '目前租借清單')

@section('content')

  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
      <div class="row gy-4 justify-content-center text-center">
        @if (session('status'))
          <div class="col-lg-10 text-center mb-2">
            <h6 class="alert alert-success">{{ session('status') }}</h6>
          </div>
        @endif
      </div><!--  租借清單 End  -->
      <!-- Start Form -->
      <div class="row justify-content-center mb-5">          
        <div class = "col-md-8">
          <div class="form">
            <form action="{{ route('rental.update', $rental->id) }}" method="POST" id="createRecordForm" class="createRecordForm">
              @csrf
              @method('PUT')
              <div class="row mb-3 text-center">
                <h2>{{ $rental->user->name_zh}}您好，以下是您目前的租借清單</h2>
              </div>
              <!-- Table -->
              <div class="col-md-12 text-center mb-2">                
                <table class="table table-light table-bordered table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">編號</th>
                      <th scope="col">名稱</th>
                      <th scope="col">價格</th>
                      <th scope="col">取消</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($rentalEquipments as $rentalEquipment)
                      <tr>
                          <td>{{ $loop->index + 1}}</td>
                          <td>{{ $rentalEquipment->equipment_id }}</td>
                          <td>{{ $rentalEquipment->equipment->description }}</td>
                          @if(Auth::user()->user >= 0)
                            <td>{{ $rentalEquipment->equipment->member_price }}</td>
                          @else
                            <td>{{ $rentalEquipment->equipment->normal_price }}</td>
                          @endif
                          <td>
                            <button type = "button" class="bi bi-trash" onclick="window.location='{{ route('rentalEquipment.remove', $rentalEquipment->id) }}'"></button>
                          </td>
                      </tr>
                    @endforeach
                    <tr>
                      <td colspan="5" style="font-size:20px; font-family:bold;">總共租金為：{{ $rental->rental_amount}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- End Table -->
              <div class="form-group ">
                <label for="start">租借日期</label>
                <input type="date" class="form-control" id="start" name="rental_date" required>
              </div>
              <div class="form-group ">
                <label for="end">預計歸還日期</label>
                <input type="date" class="form-control" id="end" name="return_date" required>
              </div>
              <div class="row">
                <div class="text-center">
                  <button type="button" onclick ="window.location='{{ route('equipment.index', '大背包', session('rental_id') ) }}'" style="background: #393939;">繼續租借</button>                    
                  <button type="submit" style="background: #A6B18F;">確認租借</button>
                </div>
              </div>
            </form>
          </div>
        </div> 
      </div>
      <!-- End Form -->
      </div>
    </div>
  </section>

@endsection
