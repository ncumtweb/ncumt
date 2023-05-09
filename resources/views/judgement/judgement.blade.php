@extends('basic.main')

@section('title',  '評分系統')

@section('content')
<main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title"><font face = "微軟正黑體" size = "10px" >隊伍難度評分系統</font></h1>
            <a> 此評分系統根據路況、天數及所需體力來量化，並依據分數高低來訂定隊伍難度等級。</a>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class = "col-md-8 mb-5">
            <div class="form mt-5">
              <form action="{{ route('judgement.store') }}" method="POST" class="php-email-form">
                @csrf
                <div class="form-group">
                  <label for="name" class="form-label">路線名稱</label>  
                  <input type="text" name="name" class="form-control" id="name" placeholder="請輸入路線名稱" required>
                </div>
                <div class="row">  
                  <div class="form-group col-md-6">
                    <label for="normal_day" class="form-label">傳統路天數</label>
                    <input type="number" name="normal_day" class="form-control" id="normal_day" min="0" placeholder="請輸入傳統路天數" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="abnormal_day" class="form-label">非傳統路天數</label>
                    <input type="number" name="abnormal_day" class="form-control" id="abnormal_day" min="0" placeholder="請輸入非傳統路天數" required>
                  </div>
                </div>
                <div class="row"> 
                  <div class="form-group col-md-3">
                    <label for="level" class="form-label">路況分級</label>
                    <select id="level" name="level" class="form-select" required>
                      <option selected disabled value="">請選擇路況級別</option>
                      <option value="0">一</option>
                      <option value="1">二</option>
                      <option value="2">三a</option>
                      <option value="3">三b</option>
                      <option value="4">四a</option>
                      <option value="5">四b</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="road" class="form-label">路跡/指標級別</label>
                    <select id="road" name="road" class="form-select" required>
                      <option selected disabled value="">請選擇路跡級別</option>
                      @for($i = 0; $i < 10; $i++) 
                        <option value = {{ $i + 1 }}> {{ $i + 1 }}</option>
                      @endfor
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="terrain" class="form-label">地形級別</label>
                    <select id="terrain" name="terrain" class="form-select" required>
                      <option selected disabled value="">請選擇地形級別</option>
                      @for($i = 0; $i < 10; $i++) 
                        <option value = {{ $i + 1 }}> {{ $i + 1 }}</option>
                      @endfor
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="plant" class="form-label">植被級別</label>
                    <select id="plant" name="plant" class="form-select" required>
                      <option selected disabled value="">請選擇植被級別</option>
                      @for($i = 0; $i < 10; $i++) 
                        <option value = {{ $i + 1 }}> {{ $i + 1 }}</option>
                      @endfor
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="energy" class="form-label">體力級別</label>
                    <select id="energy" name="energy" class="form-select" required>
                      <option selected disabled value="">請選擇體力級別</option>
                      @for($i = 0; $i < 4; $i++) 
                        <option value = {{ $i + 1 }}> {{ $i + 1 }}</option>
                      @endfor
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="energy" class="form-label">多背水天數</label>
                    <input type="number" name="water" class="form-control" id="water" min="0" placeholder="請輸入多背水天數" required>
                  </div>
                </div>
                <div class="my-3">
                  <div class="result-message"></div>
                </div>

                <div class="row">
                  <div class="text-center">
                    <button type="button" onclick = "caculate()" value="store" name="submit_button">開始評分</button>
                    <button type="submit" disabled value="store" id = "store_result" name="store_result">儲存評分結果</button>
                  </div>
                </div>
                
                
              </form>
            </div><!-- End Contact Form -->
          </div>
        </div>

        <!-- 評分紀錄表 -->
        <div class="row gy-4 justify-content-center text-center">
            <h1>評分紀錄表</h1>
            <a>過去隊伍難度的評分紀錄。</a>

          <div class="col-md-10 text-center mb-5 table-responsive">
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
                        <td>{{ $judgement->name }}</td>
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
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>

          </div>
        </div><!-- 難度分級表 End  -->

        <!-- 難度分級表 -->
        <div class="row gy-4 justify-content-center text-center">
            <h1>難度分級表</h1>
            <a>根據量化的分數高低訂定隊伍難度，難度由高至低分成S+到D。</a>

          <div class="col-md-6 text-center mb-5">
            <table class="table table-light table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">難度等級</th>
                  <th scope="col">分數</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>S+</td>
                      <td>>=120</td>
                  </tr>
                  <tr>
                      <td>S</td>
                      <td>100~119</td>
                  </tr>
                  <tr>
                      <td>A</td>
                      <td>80~99</td>
                  </tr>
                  <tr>
                      <td>B</td>
                      <td>60~79</td>
                  </tr>
                  <tr>
                      <td>C</td>
                      <td>40~59</td>
                  </tr>
                  <tr>
                      <td>D</td>
                      <td><=39</td>
                  </tr>
              </tbody>
            </table>

          </div>
        </div><!-- 難度分級表 End  -->

        <!-- 路況分級表 -->
        <div class="row gy-4 justify-content-center text-center">
          <h1>路況分級表</h1>
          <a>路況分級如下表，再根據下表的級別，並參照該路線的路跡/指標、地形、植被，量化成分數。</a>
          
          <div class="col-md-6 text-center mb-5">
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

          <div class="col-md-6 text-center mb-5">
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
                      <td colspan="3">評斷標準為一半以上天數達到上述條件，多背非行動水大於六小時算多背水日。</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!-- 難度分級表 End  -->

      </div>
    </section>

  </main><!-- End #main -->
@endsection
