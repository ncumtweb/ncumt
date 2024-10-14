@extends('basic.main')

@section('title', $course->title )

@section('content')

    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center">
                <div class="col-lg-10 text-center mb-5">
                    <h1 class="page-title">{{ $course->title }}</h1>
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
                                    <td colspan = 4> 目前無人報名</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <!-- Table -->

                        <div class="col-md-10 text-center mb-5">
                            <table class="table table-light table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th colspan = 4>已報名列表</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">學號</th>
                                        <th scope="col">姓名</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">報名時間</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courseRecords as $courseRecord)
                                    <tr>
                                        <td>{{ $courseRecord->user->student_id }}</td>
                                        <td>{{ $courseRecord->user->name_zh }}</td>
                                        <td>{{ $courseRecord->user->email }}</td>
                                        <td>{{ $courseRecord->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    <!-- End Table -->
                </div>
            @endif

        </div>
    </section>
@endsection
