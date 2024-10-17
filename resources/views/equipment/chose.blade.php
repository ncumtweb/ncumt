@extends('basic.main')

@section('title', 'Equipment Rental')

@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">
            <livewire:equipment.equipment-rental/>
        </div>
    </section>
@endsection
