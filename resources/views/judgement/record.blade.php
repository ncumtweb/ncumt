@extends('basic.main')

@section('title',  '隊伍難度評分紀錄表')

@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">隊伍難度評分紀錄表</h1>
                    <a>過去隊伍難度的評分紀錄。</a>
                </div>
                <div class="row gy-4 justify-content-center text-center">
                    <livewire:judgement-component.page/>
                </div>
            </div>
        </div>
    </section>
@endsection
