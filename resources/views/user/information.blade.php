@extends('basic.main')

@section('title',  '個人資料')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    @endpush
    @livewire('sidebar-menu')
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">基本資料</h1><!-- 置中標題 -->
                    <!--<label for="basic_information" style="font-size: 30px; color: #1c6149">基本資料</label>-->
                </div>
            </div>

            <!-- start form --><!-- 基本資料 -->
            <div class="row justify-content-center">
                @if (session('status'))
                    <div class="col-md-8 text-center mb-5">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
                <div class="col-md-8 ">
                    <div class="form ">
                        <section id="basic_information"></section>

                        <form action="{{ route('user.update', $user->id) }}" method="POST" id="createRecordForm"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name_zh" class="form-label">中文姓名</label>
                                    <input type="text" name="name_zh" class="form-control" id="name_zh"
                                           value="{{ $user->name_zh }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name_en" class="form-label">英文姓名</label>
                                    <input type="text" name="name_en" class="form-control" id="name_en"
                                           value="{{ $user->name_en }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nickname" class="form-label">暱稱</label>
                                    @if($user->nickname != null)
                                        <input type="text" name="nickname" class="form-control" id="nickname"
                                               value="{{ $user->nickname }}">
                                    @else
                                        <input type="text" name="nickname" class="form-control" id="nickname"
                                               placeholder="請輸入你的暱稱">
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="position" class="form-label">職位</label>
                                    <input type="text" name="position" class="form-control" id="position"
                                           value="{{ $position[$user->role] }}" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="studentID" class="form-label">學號</label>
                                    <input type="text" name="studentID" class="form-control" id="studentID"
                                           value="{{ $user->identifier }}" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="department_level" class="form-label">系級</label>
                                    <input type="text" name="department_level" class="form-control"
                                           id="department_level" value="{{ $user->department_level }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="phone" class="form-label">手機號碼</label>
                                    <input type="phone" name="phone" class="form-control" id="phone"
                                           value="{{ $user->phone }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class="form-label">電子郵件</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           value="{{ $user->email }}" required>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- start form --><!-- 飲食習慣 -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">飲食習慣</h1><!-- 置中標題 -->
                    <!--<label for="basic_information" style="font-size: 30px; color: #1c6149">飲食習慣</label>-->
                </div>
            </div>
            <!-- start form -->
            <div class="row justify-content-center">
                @if (session('status'))
                    <div class="col-md-8 text-center mb-5">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
                <div class="col-md-8 ">
                    <div class="form ">
                        <section id="eating_habit"></section>
                        <form action="{{ route('user.update', $user->id) }}" method="POST" id="createRecordForm"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="normal_or_vegetarian" class="form-label">葷素食調查</label>
                                    <input type="text" name="normal_or_vegetarian" class="form-control"
                                           id="normal_or_vegetarian" value="{{ $user->normal_or_vegetarian }}"
                                           required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="favorite_foods" class="form-label">喜歡的食物</label>
                                    <input type="text" name="favorite_foods" class="form-control"
                                           id="favorite_foods" value="{{ $user->favorite_foods }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="allergic_foods" class="form-label">過敏的食物</label>
                                    <input type="text" name="allergic_foods" class="form-control"
                                           id="allergic_foods" value="{{ $user->allergic_foods }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hate_foods" class="form-label">討厭的食物</label>
                                    <input type="text" name="hate_foods" class="form-control" id="hate_foods"
                                           value="{{ $user->hate_foods }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <button type="submit">儲存變更</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- start form --><!-- 緊急聯絡 -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">緊急聯絡</h1><!-- 置中標題 -->
                    <!--<label for="basic_information" style="font-size: 30px; color: #1c6149">緊急聯絡</label>-->
                </div>
            </div>
            <!-- start form -->
            <div class="row justify-content-center">
                @if (session('status'))
                    <div class="col-md-8 text-center mb-5">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
                <div class="col-md-8 ">
                    <div class="form ">
                        <section id="emergency_contact"></section>
                        <form action="{{ route('user.update', $user->id) }}" method="POST" id="createRecordForm"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="emergency_contact_person_one" class="form-label">緊急聯絡人1</label>
                                    <input type="text" name="emergency_contact_person_one" class="form-control"
                                           id="emergency_contact_person_one"
                                           value="{{ $user->emergency_contact_person_one }}" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="emergency_contact_relation_one" class="form-label">關係</label>
                                    <input type="text" name="emergency_contact_relation_one" class="form-control"
                                           id="emergency_contact_relation_one"
                                           value="{{ $user->emergency_contact_relation_one }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="emergency_contact_phone_one"
                                           class="form-label">緊急聯絡電話1</label>
                                    <input type="text" name="emergency_contact_phone_one" class="form-control"
                                           id="emergency_contact_phone_one"
                                           value="{{ $user->emergency_contact_phone_one }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="emergency_contact_person_two" class="form-label">緊急聯絡人2</label>
                                    <input type="text" name="emergency_contact_person_two" class="form-control"
                                           id="emergency_contact_person_two"
                                           value="{{ $user->emergency_contact_person_two }}" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="emergency_contact_relation_two" class="form-label">關係</label>
                                    <input type="text" name="emergency_contact_relation_two" class="form-control"
                                           id="emergency_contact_relation_two"
                                           value="{{ $user->emergency_contact_relation_two }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="emergency_contact_phone_two"
                                           class="form-label">緊急聯絡電話2</label>
                                    <input type="text" name="emergency_contact_phone_two" class="form-control"
                                           id="emergency_contact_phone_two"
                                           value="{{ $user->emergency_contact_phone_two }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <button type="submit">儲存變更</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- start form --><!-- 登山事蹟 -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">基本資料</h1><!-- 置中標題 -->
                    <!--<label for="basic_information" style="font-size: 30px; color: #1c6149">基本資料</label>-->
                </div>
            </div>
            <!-- start form -->
            <div class="row justify-content-center">
                @if (session('status'))
                    <div class="col-md-8 text-center mb-5">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
                <div class="col-md-8 ">
                    <div class="form ">
                        <section id="mountaineering_deeds"></section>
                        <label for="mountaineering_deeds" style="font-size: 30px; color: #1c6149">登山事蹟</label>
                        <form action="{{ route('user.update', $user->id) }}" method="POST" id="createRecordForm"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="days_in_the_mountain" class="form-label">在山上的天數</label>
                                    <input type="text" name="days_in_the_mountain" class="form-control"
                                           id="days_in_the_mountain" value="{{ $user->days_in_the_mountain }}"
                                           required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="the_mountain_I_climbed" class="form-label">爬過的幾次山</label>
                                    <input type="text" name="the_mountain_I_climbed" class="form-control"
                                           id="the_mountain_I_climbed" value="{{ $user->the_mountain_I_climbed }}"
                                           required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="five_kilograms_running_time"
                                           class="form-label">五公里跑步時間</label>
                                    <input type="text" name="five_kilograms_running_time" class="form-control"
                                           id="five_kilograms_running_time"
                                           value="{{ $user->five_kilograms_running_time }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="join_the_club_time" class="form-label">加入登山社時間</label>
                                    <input type="text" name="join_the_club_time" class="form-control"
                                           id="join_the_club_time" value="{{ $user->five_kilograms_running_time }}"
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <button type="submit">儲存變更</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
