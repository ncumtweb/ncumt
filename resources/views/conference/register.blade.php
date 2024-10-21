@extends('basic.main')

@section('title', '大專登山研討會報名')

@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">
            <div class="col-lg-12 text-center">
                <h1>113 年度第二十五屆全國大專校院 登山運動研討會</h1>
                <h1 class="page-title">報名表</h1>
            </div>
            <div class="row mt-3 justify-content-center">
                <div class="col-md-10 text-center">
                    <h3>「線上報名已截止，若想參加請直接到會場參加即可，但將不會提供午餐與禮品。 」</h3>
                    <h3>如有任何問題，請私訊聯絡<a style="color: blue;"
                                                   href="https://www.facebook.com/ncumountaineeringclub"
                                                   target="_blank"
                                                   class="text-decoration-underline">粉絲專頁</a></h3>
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
                    <a href="{{ asset('pdfs/第二十五屆全國大專校院登山運動研討會議程表.pdf') }}" class="btn btn-primary"
                       download>下載會議資訊 PDF</a>
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
