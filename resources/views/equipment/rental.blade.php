@extends('basic.main')

@section('title',  '目前租借清單')

@section('content')

  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
    <div class="row gy-4 justify-content-center text-center">
          <h1>目前租借清單</h1>
          @if (session('status'))
            <div class="col-lg-12 text-center mb-2">
              <h6 class="alert alert-success">{{ session('status') }}</h6>
            </div>
          @endif
          <div class="col-md-12 text-center mb-5">
            <table class="table table-light table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">編號</th>
                  <th scope="col">名稱</th>
                  <th scope="col">價格</th>
                  <th scope="col">移除</th>
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
                        <form action="{{ route('rentalEquipment.remove', $rentalEquipment->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="bi bi-trash"></button>
                        </form>
                      </td>
                  </tr>
                @endforeach
                <tr>
                  <td colspan="5">總共租金為：{{ $rental->rental_amount}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!--  租借清單 End  -->

    </div>
  </section>

@endsection
