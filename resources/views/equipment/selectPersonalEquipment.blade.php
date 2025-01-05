@extends('basic.main')

@section('title', '個人裝備租借')

@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">
            <livewire:equipment.personal-rental/>
        </div>
    </section>
@endsection
