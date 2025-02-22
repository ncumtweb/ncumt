@extends('basic.main')

@section('title', '已租借清單')

@section('content')
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <!-- Page Title -->
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10 text-center">
                    <h1 class="page-title text-primary">已租借清單</h1>
                </div>
                @if (session('status'))
                    <div class="col-lg-10 text-center">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
            </div>

            <!-- No Rentals -->
            @if($rentals->count() == 0)
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <div class="alert alert-info">目前尚無租借</div>
                    </div>
                </div>
            @else
                <!-- Rentals List -->
                <div class="row justify-content-center">
                    @foreach($rentals as $rental)
                        <div class="col-lg-10 mb-5">
                            <!-- Rental Info Card -->
                            <div class="card shadow-sm text-center">
                                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-center">租借資訊</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Rental Info Table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td class="fw-bold">租借日期</td>
                                                <td>{{ $rental->rental_date }}</td>
                                            </tr>
                                            @if($rental->actual_return_date)
                                                <tr>
                                                    <td class="fw-bold">歸還日期</td>
                                                    <td>{{ $rental->actual_return_date }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="fw-bold">操作</td>
                                                    <td>
                                                        <button type="button"
                                                                onclick="window.location='{{ route('rental.returnPersonalRental', $rental->id) }}'"
                                                                class="btn btn-primary btn-sm">
                                                            歸還
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="fw-bold">總金額</td>
                                                <td>{{ $rental->rental_amount }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Rental Equipment Table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th colspan="4">租借裝備列表</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="text-center">編號</th>
                                                <th scope="col" class="text-center">類型</th>
                                                <th scope="col" class="text-center">簡介</th>
                                                <th scope="col" class="text-center">價格</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($rentalEquipmentMap[$rental->id] as $rentalEquipment)
                                                <tr>
                                                    <td>{{ $rentalEquipment->equipment_id }}</td>
                                                    <td>{{ $rentalEquipment->equipment->category }}</td>
                                                    <td class="text-wrap">{{ $rentalEquipment->equipment->description }}</td>
                                                    <td>{{ $rentalEquipment->equipment->getPrice() }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
