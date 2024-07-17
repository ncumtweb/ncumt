@extends('basic.main')

@section('title',  '評分系統')

@section('content')
    <main id="main">
        <section id="contact" class="contact mb-5">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12 text-center mb-2">
                        <h1 class="page-title">隊伍難度評分系統</h1>
                        <a> 此評分系統根據路況、天數及所需體力來量化，並依據分數高低來訂定隊伍難度等級。</a>
                    </div>
                </div>

                <!-- 評分表單 -->
                <livewire:judgement-component.form :judgement="null" :mode="'create'"/>

                <!-- 評分紀錄表 -->
                <div class="row gy-4 justify-content-center text-center">
                    <h1>評分紀錄表</h1>
                    <a>過去隊伍難度的評分紀錄。</a>
                    <livewire:judgement-component.page/>
                </div><!-- 評分紀錄表 End  -->

                @include('judgement.includes.rule')
            </div>
        </section>

    </main><!-- End #main -->
@endsection
