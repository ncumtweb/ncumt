@extends('basic.main')

@section('title', '行程紀錄')

@section('content')
    <main id="main">
        <section id="contact" class="contact mb-5">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="page-title">行程紀錄</h1>
                        <a>一起來看看我們有哪些精采故事吧</a>
                    </div>
                </div>

                <!-- 插入 Livewire 分頁組件 -->
                <section id="posts" class="posts">
                    <div class="row gy-4 justify-content-center text-center">
                        <livewire:record-component.page/>
                    </div>
                </section>
            </div>
        </section>
    </main>
@endsection
