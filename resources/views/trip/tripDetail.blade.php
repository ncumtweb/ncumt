@extends('basic.main')

@section('title',  'Coming Soon')

@section('content')

    <div class="toc">
        <h2>目錄</h2>
        <ul>
            <li><a href = "#詳細行程">詳細行程</a></li>
            <li><a href = "#特色介紹">特色介紹</a></li>
            <li><a href = "#行程費用">行程費用</a></li>
            <li><a href = "#時間安排">時間安排</a></li>
        </ul>
    </div>

    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content" data-aos="fade-up">

                    <!-- ======= Single Post Content ======= -->
                    <div class="single-post">

                        <div class="content">
                            <div class="namedate">
                                <h1>毒龍潭</h1>
                                <strong><span>中級山</span> <span>&bullet;</span> <span>2024.07.22</span>
                                </strong>
                                <strong><span>領隊名稱：林序樺</span></strong>
                            </div>


                            <hr>

                            <div id = '詳細行程' class="content-adjust">
                                <h3>詳細行程</h3>
                                <p>D0 6/2(四) 18:00中央大學≧21:30鎮西堡登山口 (C0)</p>
                                <p>D1 6/3(五) (日出：05:05，日落：18:40) C0 05:00出發→06:40 B區神木岔→08:30馬望海三岔路口營地(整裝)-->09:30 H2385鞍部-->10:00 H2438山頭-->10:30 H2484山頭-->11:20馬望海山(60min午餐) -->15:30馬望海三岔路口營地C1</p>
                                <p>D2 6/4(六) (日出：05:05，日落：18:40) C1 05:00出發-->05:50塔克金溪支流溪底-->07:00檜木獵人營地-->07:30稜線岔路營地-->08:00馬望女苦山-->09:20 H2384峰(282261,2713789)-->10:40留倉賀山(午餐30min) -->14:00馬望女苦山-->14:30稜線岔路營地-->15:50塔克金溪支流溪底(取水)-->17:15 C2(同C1)</p>
                                <p>D3 6/5(日) (日出：05:05，日落：18:41) C2 06:00→06:30馬洋毒龍潭岔→09:00 H2370鞍部(278850,2714059)→11:30 H2494峰前鞍部(毒龍潭岔)(279102,2713934) → 13:00毒龍潭(午餐30min) →(視情況前往AB神木區)→17:00鎮西堡登山口</p>
                            </div>

                            <hr>

                            <div id = '特色介紹' class="content-adjust">
                                <h3>特色介紹</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus at error explicabo inventore iste, molestiae numquam perferendis ut vel. Ab asperiores consectetur dicta fugit inventore ipsum laborum quas quisquam, soluta!</p>
                            </div>

                            <hr>

                            <div id = '行程費用' class="content-adjust">
                                <h3>行程費用</h3>
                                <div class="amount">
                                    <span class="number" id="amount"> 0 </span>
                                </div>
                            </div>

                            <hr>

                            <div id = '時間安排' class="content-adjust">
                                <h3>時間安排</h3>
                                <table class="styled-table">
                                    <thead>
                                    <tr>
                                        <th>報名截止時間</th>
                                        <th>公佈錄取時間</th>
                                        <th>行前會議時間</th>
                                        <th>鳥隊時間</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>date</td>
                                        <td>date</td>
                                        <td>date</td>
                                        <td>date</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
