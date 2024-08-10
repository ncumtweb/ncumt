@extends('basic.main')

@section('title',  '大專登山研討會報名')

@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">
            <div class="col-lg-12 text-center">
                <h1 class="mt-3">113 年度第二十五屆全國大專校院登山運動研討會</h1>
                <h1 class="page-title">研討會報名表</h1>
            </div>
            <livewire:conference.form :mode="App\Enums\Mode::CREATE->value"/>
        </div>
    </section>
@endsection
