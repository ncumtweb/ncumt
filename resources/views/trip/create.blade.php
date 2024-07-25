@extends('basic.main')

@section('title',  '創建紀錄')

@section('content')
<main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center">
            <h1 class="page-title">創建隊伍</h1>

          </div>
        </div>

        <div class="row justify-content-center">
          <div class = "col-md-8 mb-5">
            <div class="form mt-5">
                <!--更新成功提示-->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
              <form action="{{ route('trip.create') }}" method="POST" id="createRecordForm" class="createRecordForm" enctype="multipart/form-data">
                @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label for="name" class="form-label">隊伍名稱</label>
                      <input type="text" name="name" class="form-control" id="name" placeholder="請輸入隊伍名稱" required>
                  </div>
                  <div class="form-group">
                      <label for="description" class="form-label">隊伍簡介 </label>
                      <textarea name="description" class="form-control" id="description" placeholder="請輸入隊伍簡介" required></textarea>
                  </div>
                  <!--
                <div class="form-group">
                    <label for="trip-schedule" class="form-label">隊伍行程 </label>
                    <textarea name="trip-schedule" class="form-control" id="trip-schedule" placeholder="請輸入隊伍行程" required></textarea>
                </div>
                -->

                  <div class="form-group">
                      <label for="category" class="form-label">路線類別</label>
                      <select id="category" name="category" class="form-select" required>
                          <option selected disabled value="">請選擇路線類別</option>
                          <option value="0">中級山</option>
                          <option value="1">高山</option>
                          <option value="2">溯溪</option>
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="judgements_id" class="form-label">路線難度等級</label>
                      <select id="judgements_id" name="judgements_id" class="form-select" required>
                          <option selected disabled value="">請選擇路線類別</option>
                          <option value="0">A</option>
                          <option value="1">B</option>
                          <option value="2">C</option>
                          <option value="3">D</option>
                      </select>
                  </div>

                  <div class="row">
                      <div class="form-group col-md-4">
                          <label for="registration_open">隊伍報名開始日期</label>
                          <input type="date" class="form-control" id="registration_open" name="registration_open" required>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="registration_close">隊伍報名結束日期</label>
                          <input type="date" class="form-control" id="registration_close" name="registration_close" required>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="pre_departure_time">行前會日期</label>
                          <input type="date" class="form-control" id="pre_departure_time" name="pre_departure_time" required>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-md-4">
                          <label for="start_date">隊伍出發日期</label>
                          <input type="date" class="form-control" id="start_date" name="start_date" required>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="end_date">隊伍結束日期</label>
                          <input type="date" class="form-control" id="end_date" name="end_date" required>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="quit_date">鳥隊期限</label>
                          <input type="date" class="form-control" id="quit_date" name="quit_date" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="prepare-day" class="form-label">有無預備天</label>
                      <select id="prepare-day" name="prepare-day" class="form-select" required>
                          <option selected disabled value="">請選擇有/無</option>
                          <option value="0">有</option>
                          <option value="1">無</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="quit-rule" class="form-label" >鳥隊規定</label>

                      <textarea class="form-control" id="quit-rule" name="quit-rule" placeholder="請輸入鳥隊規定說明"></textarea>
                      <!-- <input type="hidden" name="content" class="form-control" id="content" required> -->
                  </div>
                  <div class="form-group col-md-12">
                      <label for="image">封面照</label>
                      <input type="file" name="image" class="form-control" id="image" accept="image/gif, image/jpeg, image/png" required >
                      <img class="img-fluid" id="preview_image" src="#" alt="預覽封面"/>
                  </div>

                  <div class="row">
                      <div class="form-group col-md-6">
                          <label for="expected_fee" class="form-label">預期隊費</label>
                          <input type="text" name="expected_fee" class="form-control" id="expected_fee" placeholder="請輸入隊費金額" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="actual_fee" class="form-label">實際隊費</label>
                          <input type="text" name="actual_fee" class="form-control" id="actual_fee" placeholder="請輸入隊費金額" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="fee-description" class="form-label">隊費說明</label>

                      <textarea class="form-control" id="fee-description" name="fee-description"></textarea>
                      <!-- <input type="hidden" name="content" class="form-control" id="content" required> -->
                  </div>
                  <div class="row">
                      <div class="form-group col-md-6">
                          <label for="expected_cadre_count" class="form-label">預計錄取幹部人數</label>
                          <input type="text" name="expected_cadre_count" class="form-control" id="expected_cadre_count" placeholder="請輸入體能標準" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="expected_member_count" class="form-label">預計錄取隊員人數</label>
                          <input type="text" name="expected_member_count" class="form-control" id="expected_member_count" placeholder="請輸入體能標準" required>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-md-6">
                          <label for="requirement-man" class="form-label">體能標準(男)</label>
                          <input type="text" name="requirement-man" class="form-control" id="requirement-man" placeholder="請輸入體能標準" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="requirement-woman" class="form-label">體能標準(女)</label>
                          <input type="text" name="requirement-woman" class="form-control" id="requirement-woman" placeholder="請輸入體能標準" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="requirement-description" class="form-label">體訓要求 </label>
                      <textarea name="requirement-description" class="form-control" id="requirement-description" placeholder="請輸入體訓要求/說明" required></textarea>
                  </div>




                  <!-- 領隊資訊 -->

                  <div class="row">
                      <div class="form-group col-md-4">
                          <label for="leader_name" class="form-label">領隊</label>
                          <input type="text" name="leader_name" class="form-control" id="leader_name" placeholder="請輸入領隊姓名" required>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="leader_id" class="form-label">領隊學號</label>
                          <input type="text" name="leader_id" class="form-control" id="leader_id" placeholder="請輸入領隊學號" required>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="leader_phone" class="form-label">領隊電話</label>
                          <input type="text" name="leader_phone" class="form-control" id="leader_phone" placeholder="請輸入領隊電話號碼" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="leader_contact" class="form-label">其他領隊聯絡方式</label>
                      <input type="text" name="leader_contact" class="form-control" id="leader_contact" placeholder="請輸入領隊的其他聯絡方式，例如：FB:易大佬" required>
                  </div>
                  <div class="form-group">

                      <div class="form-group">
                          <label for="others" class="form-label">其他內容</label>

                          <textarea class="form-control" id="others" name="others"></textarea>

                      </div>

                      <div class="row">
                          <div class="text-center">
                              <button type="submit">暫存紀錄</button>
                              <button type="submit">儲存並發布</button>
                          </div>
                      </div>
                      <!-- 不知道要不要加入過去的相關隊伍紀錄文，就是創建者自己選擇該貼文，資料庫就可以存貼文編號 -->
              </form>
            </div>
          </div>
        </div>


      </div>
    </section>
</main><!-- End #main -->

<script src="{{ asset('assets/vendor/create-record-form/createRecordForm.js') }}"></script>

<style>
    .ck-editor__editable {
        min-height: 800px;
    }
</style>
@endsection
