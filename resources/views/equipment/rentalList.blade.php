@extends('basic.main')

@section('title',  '已租借清單')

@section('content')

    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center">
                <div class="col-lg-10 text-center mb-2">
                    <h1 class="page-title">已租借清單</h1>
                </div>
                @if (session('status'))
                    <div class="col-lg-10 text-center mb-2">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
            </div>
            @if($rentals->count() == 0)
                <div class="row justify-content-center">
                    <div class="col-md-10 text-center mb-5">
                        <table class="table table-light table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td colspan = 4> 目前尚無租借</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <!-- Table -->
                    @foreach($rentals as $rental)
                        <div class="col-md-10 text-center mb-5">                    
                            <table class="table table-light table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th colspan = 3>租借裝備列表</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">編號</th>
                                        <th scope="col">名稱</th>
                                        <th scope="col">價格</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rentalEquipments as $rentalEquipment)
                                        <tr>
                                            <td>{{ $rentalEquipment->equipment_id }}</td>
                                            <td>{{ $rentalEquipment->equipment->description }}</td>
                                            @if(Auth::user()->user >= 0)
                                                <td>{{ $rentalEquipment->equipment->member_price }}</td>
                                            @else
                                                <td>{{ $rentalEquipment->equipment->normal_price }}</td>
                                            @endif                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table table-light table-bordered table-striped" style="table-layout: fixed;">
                                <tbody>
                                    <tr>
                                        <th colspan = 4 >租借資訊</th>
                                    </tr>
                                    <tr>
                                        <td colspan = 2>租借日期</td>
                                        <td colspan = 2>{{ $rental->rental_date }}</td>
                                    </tr>                                    
                                    <tr>
                                        <td colspan = 2>預計歸還日期</td>
                                        <td colspan = 2>{{ $rental->return_date }}</td> 
                                    </tr>                         
                                    <tr>
                                        <td >總金額</td>
                                        <td >{{ $rental->rental_amount }}</td>
                                        @if($rental->actual_return_date)
                                            <td>實際歸還日期</td>
                                            <td>{{ $rental->actual_return_date }}</td>
                                        @else                        
                                            <td colspan = 2>
                                                <div class="equipment">
                                                    <button type="button" onclick="window.location='{{ route('rental.return', $rental->id) }}'" style="padding: 1px 50px;">歸還</button>
                                                </div>                                    
                                            </td>
                                        @endif
                                    </tr>   
                                </tbody>
                            </table>
                        </div>    
                    @endforeach
                    <!-- End Table -->
                </div>
            @endif
            
        </div>    
    </section>    
@endsection