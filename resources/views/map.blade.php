@extends('basic.main')

@section('title',  'Map')

@section('content')

<div class="container" data-aos="fade-up">
    <div class="row">
        <div class="col-lg-12 text-center mb-2">
            <h1 class="page-title">山社地圖</h1>
            <a>看看我們曾經去過哪些地方吧</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class = "col-md-8 fill mb-3">
            <div id="map"></div>
        </div>        
    </div>
</div>



<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" ></script>
<style>
    #map {
        width: 100%;
        height: 70vh;
    }
    .fill { 
        border: 2px solid black; 
        height:100%; 
        width:100%;
    }
</style>

<script type="text/javascript">
    window.my_map.display();
</script>


@endsection