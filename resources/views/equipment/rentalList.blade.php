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
        
        <div class="row justify-content-center">
            <!-- Table -->
            @foreach($rentals as $rental)
                <div class="col-md-10 text-center mb-5">                    
                    <table class="table table-light table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan = 4>租借裝備列表</th>
                            </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">編號</th>
                                <th scope="col">名稱</th>
                                <th scope="col">價格</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rental->rentalEquipment as $rentalEquipment)
                                <tr>
                                    <td>{{ $loop->index + 1}}</td>
                                    <td>{{ $rentalEquipment->equipment_id }}</td>
                                    <td>{{ $rentalEquipment->equipment->description }}</td>
                                    @if(Auth::user()->user >= 0)
                                        <td>{{ $rentalEquipment->equipment->member_price }}</td>
                                    @else
                                        <td>{{ $rentalEquipment->equipment->normal_price }}</td>
                                    @endif                            
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan = 4 >租借資訊</th>
                            </tr>
                            <tr>
                                <td >租借日期</td>
                                <td >{{ $rental->rental_date }}</td>
                                <td >預計歸還日期</td>
                                <td >{{ $rental->return_date }}</td> 
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
        
    </div>    
</section>    
@endsection