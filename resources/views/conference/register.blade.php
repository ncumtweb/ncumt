@extends('basic.main')

@section('title', '大專登山研討會報名')

@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">
            <div class="col-lg-12 text-center">
                <h1>113 年度第二十五屆全國大專校院 登山運動研討會</h1>
                <h1 class="page-title">報名表</h1>
            </div>
            <div class="row mb-5 justify-content-center">
                <div class="col-md-10">
                    <livewire:conference.form :mode="App\Enums\Mode::CREATE"/>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h3 class="mt-4">會議資訊</h3>
                    <ul class="list-styled">
                        <li>時間： 113年10月26日 (六) 09:30</li>
                        <li>地點：
                            <a href="https://maps.app.goo.gl/i7wV3SWWxwvBUKwW6" target="_blank"
                               class="text-decoration-underline">
                                國立中央大學管理二館 017 教室(地下一樓)
                            </a>
                        </li>
                    </ul>

                    <h3 class="mt-4">聯絡資訊</h3>
                    <ul class="list-styled">
                        <li>中華民國健行登山會信箱：info@alpineclub.org.tw</li>
                        <li>中央大學登山社粉絲專頁：
                            <a href="https://www.facebook.com/ncumountaineeringclub" target="_blank"
                               class="text-decoration-underline">
                                https://www.facebook.com/ncumountaineeringclub
                            </a>
                        </li>
                    </ul>

                    <h3 class="mt-4">主辦及贊助單位</h3>
                    <ul class="list-styled">
                        <li>指導單位：教育部體育署</li>
                        <li>主辦單位：中華民國健行登山會</li>
                        <li>承辦單位：國立中央大學登山社</li>
                        <li>贊助單位：歐都納戶外體育基金會</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
