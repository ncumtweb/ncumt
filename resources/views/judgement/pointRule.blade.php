@extends('basic.main')

@section('title',  '評分標準')

@section('content')
    <section id="contact" class="contact mb-5">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">分數計算規則</h1>
                </div>
                <div class="row gy-4 justify-content-center text-center">
                    <h1>天數</h1>
                    <div class="col-md-12 text-center mb-5">
                        <table class="table table-light table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">天數</th>
                                <th scope="col">傳統路分數</th>
                                <th scope="col">非傳統路分數</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>5</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>10</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>10</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>15</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>15</td>
                                <td>30</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>20</td>
                                <td>35</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>20</td>
                                <td>40</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>20</td>
                                <td>45</td>
                            </tr>
                            <tr>
                                <td>9+</td>
                                <td>25</td>
                                <td>50</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <h1>路況</h1>
                    <a>路況分數 = 路況分數 + (路跡 * 0.3 + 地形 * 0.4 + 植被 * 0.3) * 1.5</a>
                    <div class="col-md-12 text-center mb-5">
                        <table class="table table-light table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">路況分級</th>
                                <th scope="col">分數</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>一</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>二</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>三a</td>
                                <td>21</td>
                            </tr>
                            <tr>
                                <td>三b</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td>四a</td>
                                <td>31</td>
                            </tr>
                            <tr>
                                <td>四b</td>
                                <td>36</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <h1>體力</h1>
                    <a>體力分數 = 體力分級 * 7 + 背水天數 * 2</a>

                    <h1>行程加權</h1>
                    <a>壓縮行程 -> 總分 * 1.1</a>
                    <a>寬鬆行程 -> 總分 * 0.9</a>
                </div><!-- 分數計算規則 End -->
            </div>
        </div>
    </section>
@endsection
