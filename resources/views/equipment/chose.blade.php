@extends('basic.main')

@section('title', 'Equipment Rental')

@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">個人裝備租借</h1>
                </div>
            </div>
            <livewire:equipment.equipment-rental/>
        </div>
    </section>
@endsection
