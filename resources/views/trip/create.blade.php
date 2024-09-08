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
                    <div class="col-md-8 mb-5">
                        <div class="form mt-5">
                            <!--更新成功提示-->
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <!-- 更新失敗提示 -->
                            <div class="form-group col-md-12">
                                @error('expected_cadre_count')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                @error('actual_fee')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                @error('expected_member_count')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                @error('expected_fee')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                @error('prepare_day')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                @error('end_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                @error('quit_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                @error('start_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                @error('registration_close')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                @error('registration_open')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                @error('pre_departure_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <form action="{{ route('trip.create') }}" method="POST" id="createRecordForm"
                                  class="createRecordForm" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name" class="form-label">隊伍名稱</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="請輸入隊伍名稱"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">隊伍簡介 </label>
                                    <textarea name="description" class="form-control" id="description"
                                              placeholder="請輸入隊伍簡介" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category" class="form-label">路線類別</label>
                                    <select id="category" name="category" class="form-select" required>
                                        <option selected disabled value="">請選擇評分類別</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->value }}" {{ old('category', $categories) == $category->value ? 'selected' : '' }}>
                                                {{ $category->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="judgements_id" class="form-label">路線難度等級</label>
                                    <select id="judgements_id" name="judgements_id" class="form-select" required>
                                        <option selected disabled value="">請選擇路線類別</option>
                                        @foreach ($judgement_ids as $judgement_id)
                                            <option value="{{ $judgement_id->value }}" {{ old('judgement_id', $judgement_ids) == $judgement_id->value ? 'selected' : '' }}>
                                                {{ $judgement_id->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="registration_open">隊伍報名開始日期</label>
                                        <input type="date" class="form-control" id="registration_open"
                                               name="registration_open" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="registration_close">隊伍報名結束日期</label>
                                        <input type="date" class="form-control" id="registration_close"
                                               name="registration_close" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="quit_date">鳥隊期限</label>
                                        <input type="date" class="form-control" id="quit_date" name="quit_date"
                                               required>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="pre_departure_time">行前會日期</label>
                                        <input type="date" class="form-control" id="pre_departure_time"
                                               name="pre_departure_time" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="start_date">隊伍出發日期</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                               required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="end_date">隊伍結束日期</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prepare_day" class="form-label">預備天天數</label>
                                    <input type="text" name="prepare_day" class="form-control" id="prepare_day"
                                           placeholder="請輸入預備天天數" required>
                                </div>

                                <div class="form-group">
                                    <label for="quit_rule" class="form-label">鳥隊規定</label>
                                    <textarea class="form-control" id="quit_rule" name="quit_rule"
                                              placeholder="請輸入鳥隊規定說明"></textarea>
                                    <!-- <input type="hidden" name="content" class="form-control" id="content" required> -->
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="image">封面照</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                           accept="image/gif, image/jpeg, image/png" required>
                                    <img class="img-fluid" id="preview_image" src="#" alt="預覽封面"/>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="expected_fee" class="form-label">預期隊費</label>
                                        <input type="text" name="expected_fee" class="form-control" id="expected_fee"
                                               placeholder="請輸入隊費金額" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="actual_fee" class="form-label">實際隊費</label>
                                        <input type="text" name="actual_fee" class="form-control" id="actual_fee"
                                               placeholder="請輸入隊費金額" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="expected_cadre_count" class="form-label">預計錄取幹部人數</label>
                                        <input type="text" name="expected_cadre_count" class="form-control"
                                               id="expected_cadre_count" placeholder="請輸入預計錄取幹部人數" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="expected_member_count" class="form-label">預計錄取隊員人數</label>
                                        <input type="text" name="expected_member_count" class="form-control"
                                               id="expected_member_count" placeholder="請輸入預計錄取隊員人數" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="additional_content" class="form-label">其他內容</label>
                                    <textarea class="form-control" id="additional_content"
                                              name="additional_content"></textarea>
                                </div>

                                <div class="row">
                                    <div class="text-center">
                                        <button type="submit" name="action" value="update">暫存紀錄</button>
                                        <button type="submit" name="action" value="publish">儲存並發布</button>
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
