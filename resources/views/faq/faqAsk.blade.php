@extends('basic.main')

@section('title',  '創建 FAQ')

@section('content')
    <main id="main">
        <section id="contact" class="contact mb-5">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="page-title">我要問問題</h1>
                    </div>
                </div>
                <!-- Start Form -->
                <div class="row justify-content-center">
                    <div class = "col-md-8 ">
                        <div class="form">
                            <form action="{{ route('faq.storeAsk') }}" method="POST" id="createRecordForm" class="createRecordForm">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="question" class="form-label">問題</label>
                                        <textarea type="text" name="question" class="form-control" id="question" placeholder="請輸入問題" required></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit">新增問題</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Form -->
            </div>
        </section>
    </main><!-- End #main -->
@endsection
