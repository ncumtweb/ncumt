@extends('basic.main')

@section('title',  '編輯評分')

@section('content')
<main id="main">
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">編輯評分紀錄</h1>
                </div>
            </div>
            <livewire:judgement-component.form :judgementId="$id" :mode="App\Enums\Mode::EDIT->value"/>
        </div>
    </section>

</main><!-- End #main -->
@endsection
