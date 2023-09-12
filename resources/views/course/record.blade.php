@extends('basic.main')

@section('title',  '已報名社課')

@section('content')

    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center">
                <div class="col-lg-10 text-center mb-5">
                    <h1 class="page-title">已報名社課</h1>
                </div>
                @if (session('status'))
                    <div class="col-lg-10 text-center mb-2">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
            </div>
            @if($courseRecords->count() == 0)
                <div class="row justify-content-center">
                    <div class="col-md-10 text-center mb-5">
                        <table class="table table-light table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td colspan = 4> 目前尚無報名的社課</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <!-- Table -->
                    @foreach($courseRecords as $courseRecord)
                        <div class="col-md-10 text-center mb-5">                    
                            <table class="table table-light table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">時間</th>
                                        <th scope="col">名稱</th>
                                        <th scope="col">講者</th>
                                        <th scope="col">地點</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $courseRecord->course->date }}</td>
                                        <td>{{ $courseRecord->course->title }}</td>  
                                        <td>{{ $courseRecord->course->speaker }}</td>
                                        <td>{{ $courseRecord->course->location }}</td>
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