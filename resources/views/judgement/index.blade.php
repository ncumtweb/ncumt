@extends('basic.main')

@section('title',  '評分系統')

@section('content')
    <main id="main">
        <section id="contact" class="contact mb-5">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12 text-center mb-2">
                        <h1 class="page-title">隊伍難度評分系統</h1>
                        <a> 此評分系統根據路況、天數及所需體力來量化，並依據分數高低來訂定隊伍難度等級。</a>
                    </div>
                </div>
                <livewire:judgement-component.form/>
                <!-- 難度分級表 -->
                <div class="row gy-4 justify-content-center text-center">
                    <h1>難度分級表</h1>
                    <a>根據量化的分數高低訂定隊伍難度，難度由高至低分成 SSS 到 D。</a>
                    <div class="col-md-12 text-center mb-5">
                        <table class="table table-light table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">難度等級</th>
                                <th scope="col">分數範圍</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>SSS</td>
                                <td>120 及以上</td>
                            </tr>
                            <tr>
                                <td>S+</td>
                                <td>115 - 119</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>105 - 114</td>
                            </tr>
                            <tr>
                                <td>S-</td>
                                <td>100 - 104</td>
                            </tr>
                            <tr>
                                <td>A+</td>
                                <td>95 - 99</td>
                            </tr>
                            <tr>
                                <td>A</td>
                                <td>85 - 94</td>
                            </tr>
                            <tr>
                                <td>A-</td>
                                <td>80 - 84</td>
                            </tr>
                            <tr>
                                <td>B+</td>
                                <td>75 - 79</td>
                            </tr>
                            <tr>
                                <td>B</td>
                                <td>65 - 74</td>
                            </tr>
                            <tr>
                                <td>B-</td>
                                <td>60 - 64</td>
                            </tr>
                            <tr>
                                <td>C+</td>
                                <td>55 - 59</td>
                            </tr>
                            <tr>
                                <td>C</td>
                                <td>45 - 54</td>
                            </tr>
                            <tr>
                                <td>C-</td>
                                <td>40 - 44</td>
                            </tr>
                            <tr>
                                <td>D</td>
                                <td>0 - 39</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- 難度分級表 End -->


                <!-- 路況分級表 -->
                <div class="row gy-4 justify-content-center text-center">
                    <h1>路況分級表</h1>
                    <a>路況分級如下表，再根據下表的級別，並參照該路線的路跡/指標、地形、植被，量化成分數。</a>

                    <div class="col-md-12 text-center mb-5">
                        <table class="table table-light table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">級別</th>
                                <th scope="col">指標設施</th>
                                <th scope="col">路基狀況</th>
                                <th scope="col">地形</th>
                                <th scope="col">砍路</th>
                                <th scope="col">路線範例</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>一</td>
                                <td>指標設施</td>
                                <td>部分人為棧道</td>
                                <td>無需考慮</td>
                                <td>否</td>
                                <td>玉山</td>
                            </tr>
                            <tr>
                                <td>二</td>
                                <td>路條</td>
                                <td>路跡清楚的山徑</td>
                                <td>無需考慮</td>
                                <td>否</td>
                                <td>南一段</td>
                            </tr>
                            <tr>
                                <td>三a</td>
                                <td>少數路條</td>
                                <td>局部路基不清的山徑</td>
                                <td>稜線</td>
                                <td>是</td>
                                <td>鐵本山上關山</td>
                            </tr>
                            <tr>
                                <td>三b</td>
                                <td>少數路條</td>
                                <td>局部路基不清的山徑</td>
                                <td>非稜線</td>
                                <td>是</td>
                                <td>西拉歐卡</td>
                            </tr>
                            <tr>
                                <td>四a</td>
                                <td>刀砍痕</td>
                                <td>大部分路基不清或無路跡</td>
                                <td>稜線</td>
                                <td>是</td>
                                <td>卓社大山西稜</td>
                            </tr>
                            <tr>
                                <td>四b</td>
                                <td>刀砍痕</td>
                                <td>大部分路基不清或無路跡</td>
                                <td>非稜線</td>
                                <td>是</td>
                                <td>中之線警備道</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- End 路況分級表 -->

                <!-- 體力分級表 -->
                <div class="row gy-4 justify-content-center text-center">
                    <h1>體力分級表</h1>
                    <a>體力參照標準如下表，再根據下表的級別，量化成分數。</a>

                    <div class="col-md-12 text-center mb-5">
                        <table class="table table-light table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">級別</th>
                                <th scope="col">輕裝</th>
                                <th scope="col">重裝</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>單日步程6~8hr或爬升800m內</td>
                                <td>(空白)</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>單日步程8~11hr或爬升800~1200m</td>
                                <td>單日步程6~8hr或爬升800m內</td>

                            </tr>
                            <tr>
                                <td>3</td>
                                <td>單日步程11hr以上或爬升1200m</td>
                                <td>單日步程8~11hr或爬升800~1200m</td>

                            </tr>
                            <tr>
                                <td>4</td>
                                <td>(空白)</td>
                                <td>單日步程11hr以上或爬升1200m</td>

                            </tr>
                            <tr>
                                <td colspan="3">評斷標準為一半以上天數達到上述條件，多背非行動水大於六小時算多背水日。
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- 難度分級表 End  -->

                <!-- 評分紀錄表 -->
                <div class="row gy-4 justify-content-center text-center">
                    <h1>評分紀錄表</h1>
                    <a>過去隊伍難度的評分紀錄。</a>

                    <div class="col-md-12 text-center mb-5 table-responsive">
                        <table class="table table-light table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">路線名稱</th>
                                <th scope="col">總天數</th>
                                <th scope="col">傳統路</th>
                                <th scope="col">非傳統路</th>
                                <th scope="col">路線</th>
                                <th scope="col">路標</th>
                                <th scope="col">地形</th>
                                <th scope="col">植被</th>
                                <th scope="col">體力</th>
                                <th scope="col">背水天數</th>
                                <th scope="col">難度總分</th>
                                <th scope="col">隊伍難度</th>
                                <!-- 幹部才能編輯 -->
                                @auth
                                    @if(Auth::user()->role > 0)
                                        <th scope="col">編輯/刪除</th>
                                    @endif
                                @endauth
                            </tr>
                            </thead>
                            <tbody>
                            @if (!$judgements->count())
                                <tr>
                                    <td colspan= {{ $judgements_column_number }}>目前暫無評分紀錄</td>
                                </tr>
                            @else
                                @foreach($judgements as $judgement)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        @if ($judgement->trip_tag == 0)
                                            <td>{{ $judgement->name }}</td>
                                        @elseif ($judgement->trip_tag == 1)
                                            <td>{{ $judgement->name }} <span style="color:red">(壓縮行程)</span></td>
                                        @elseif ($judgement->trip_tag == 2)
                                            <td>{{ $judgement->name }} <span style="color:green">(寬鬆行程)</span></td>
                                        @endif
                                        <td>{{ $judgement->normal_day + $judgement->abnormal_day}}</td>
                                        <td>{{ $judgement->normal_day }} 天</td>
                                        <td>{{ $judgement->abnormal_day }} 天</td>
                                        <td>{{ $level_array[$judgement->level] }}</td>
                                        <td>{{ $judgement->road }} 分</td>
                                        <td>{{ $judgement->terrain }} 分</td>
                                        <td>{{ $judgement->plant }} 分</td>
                                        <td>{{ $judgement->energy }}</td>
                                        <td>{{ $judgement->water }} 天</td>
                                        <td>{{ $judgement->score }} 分</td>
                                        <td>{{ $judgement->result_level }}</td>
                                        <!-- 幹部才能編輯 -->
                                        @auth
                                            @if(Auth::user()->role > 0)
                                                <td>
                                                    <form action="{{ route('judgement.destroy', $judgement->id) }}"
                                                          method="POST">
                                                        <button type="button" class="bi bi-pencil-square"
                                                                onclick="window.location='{{ route('judgement.edit', $judgement->id) }}'"></button>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bi bi-trash"></button>
                                                    </form>
                                                </td>
                                            @endif
                                        @endauth
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div><!-- 評分紀錄表 End  -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
