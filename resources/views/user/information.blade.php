@extends('basic.main')

@section('title',  '個人資料')

@section('content')
    <!--帶入側邊選單的css-->
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    @endpush
    <!--livewire連接側邊選單-->
    @livewire('sidebar-menu')
    <!-- start form --><!-- 基本資料 -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <section id="basic_information"></section>
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">基本資料</h1><!-- 置中標題 -->
                </div>
            </div>
            <div class="row justify-content-center">
                <!--顯示成功訊息-->
                @if (session('status'))
                    <div class="col-md-8 text-center mb-5">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
                <div class="col-md-8 ">
                    <div class="form ">
                        <form action="{{ route('user.updateBasicInformation', $user->id) }}" method="POST" id="createRecordForm"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="studentID" class="form-label">學號</label>
                                    <input type="text" name="studentID" class="form-control" id="studentID"
                                           value="{{ $user->identifier }}" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="department_level" class="form-label">系級</label>
                                    @if($user->department_level != null)
                                        <input type="text" name="department_level" class="form-control" id="department_level"
                                               value="{{ $user->department_level }}">
                                    @else
                                        <input type="text" name="department_level" class="form-control" id="department_level"
                                               placeholder="請輸入你的系級  ex:中文三">
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name_zh" class="form-label required-label">中文姓名</label>
                                    <input type="text" name="name_zh" class="form-control" id="name_zh"
                                           value="{{ $user->name_zh }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name_en" class="form-label required-label">英文姓名</label>
                                    <input type="text" name="name_en" class="form-control" id="name_en"
                                           value="{{ $user->name_en }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="nickname" class="form-label">暱稱</label>
                                    @if($user->nickname != null)
                                        <input type="text" name="nickname" class="form-control" id="nickname"
                                               value="{{ $user->nickname }}">
                                    @else
                                        <input type="text" name="nickname" class="form-control" id="nickname"
                                               placeholder="請輸入你的暱稱">
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="gender" class="form-label required-label">性別</label>
                                    <select name="gender" class="form-control" id="gender" required>
                                        <option value="" disabled selected>請選擇</option>
                                        <option value="0" {{ $user->gender == '0' ? 'selected' : '' }}>男</option>
                                        <option value="1" {{ $user->gender == '1' ? 'selected' : '' }}>女</option>

                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="personal_id" class="form-label required-label">身分證字號</label>
                                    @if($user->personal_id != null)
                                        <input type="text" name="personal_id" class="form-control" id="personal_id"
                                               value="{{ $user->personal_id }}">
                                    @else
                                        <input type="text" name="personal_id" class="form-control" id="personal_id"
                                               placeholder="請輸入你的身分證字號" required>
                                    @endif
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="phone" class="form-label required-label">手機號碼</label>
                                    @if($user->phone != null)
                                        <input type="tel" name="phone" class="form-control" id="phone"
                                               value="{{ $user->phone }}" >
                                    @else
                                        <input type="tel" name="phone" class="form-control" id="phone"
                                               placeholder="請輸入你的手機號碼" required>
                                    @endif

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class="form-label required-label">電子郵件</label>
                                    @if($user->phone != null)
                                        <input type="email" name="email" class="form-control" id="email"
                                               value="{{ $user->email }}" >
                                    @else
                                        <input type="email" name="email" class="form-control" id="email"
                                               placeholder="請輸入你的電子郵件" required>
                                    @endif
                                </div>
                            </div>
                            <!--儲存變更-->
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
    <!-- start form --><!-- 山社角色 -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <section id="club_roles"></section>
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">山社角色</h1><!-- 置中標題 -->
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
                        <form action="{{ route('user.updateClubRoles', $user->id) }}" method="POST" id="createRecordForm"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="role" class="form-label">角色</label>
                                    <select name="role" class="form-control" id="gender" disabled>
                                        <option value="" disabled selected>請選擇</option>
                                        <option value="0" {{ $user->role == '0' ? 'selected' : '' }}>社員</option>
                                        <option value="1" {{ $user->role == '1' ? 'selected' : '' }}>社長</option>
                                        <option value="2" {{ $user->role == '2' ? 'selected' : '' }}>副社長</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="guard" class="form-label">嚮導（非嚮導, 初嚮, 領嚮）</label>
                                    <select name="guard" class="form-control" id="guard" disabled>
                                        <option value="" disabled selected>請選擇</option>
                                        <option value="非嚮導" {{ $user->guard == '非嚮導' ? 'selected' : '' }}>非嚮導</option>
                                        <option value="初嚮" {{ $user->guard == '素' ? 'selected' : '' }}>初嚮</option>
                                        <option value="領嚮" {{ $user->guard == '領嚮' ? 'selected' : '' }}>領嚮</option>
                                    </select>
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
    <!-- start form --><!-- 身體情況 -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <section id="physical_condition"></section>
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">身體情況</h1><!-- 置中標題 -->
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
                        <form action="{{ route('user.updatePhysicalCondition', $user->id) }}" method="POST" id="createRecordForm"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="altitude_sickness" class="form-label required-label">高山症（沒有, 輕微, 嚴重)</label>
                                    <select name="altitude_sickness" class="form-control" id="altitude_sickness" required>
                                        <option value="" disabled selected>請選擇</option>
                                        <option value="0" {{ $user->altitude_sickness == '0' ? 'selected' : '' }}>沒有</option>
                                        <option value="1" {{ $user->altitude_sickness == '1' ? 'selected' : '' }}>輕微</option>
                                        <option value="2" {{ $user->altitude_sickness == '2' ? 'selected' : '' }}>嚴重</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="special_disease" class="form-label required-label">特殊疾病(請加說明，沒有則寫無)</label>
                                    @if($user->special_disease != null)
                                        <input type="text" name="special_disease" class="form-control" id="special_disease"
                                               value="{{ $user->special_disease }}">
                                    @else
                                        <input type="text" name="special_disease" class="form-control" id="special_disease"
                                               placeholder="請輸入你的特殊疾病" required>
                                    @endif
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
    <!-- start form --><!-- 飲食習慣 -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <section id="eating_habit"></section>
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
                        <form action="{{ route('user.updateEatingHabit', $user->id) }}" method="POST" id="createRecordForm"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="dietary_habit" class="form-label required-label">葷素食調查（葷, 素, 蛋奶素）</label>
                                    <select name="dietary_habit" class="form-control" id="dietary_habit" required>
                                        <option value="" disabled selected>請選擇</option>
                                        <option value="0" {{ $user->dietary_habit == '1' ? 'selected' : '' }}>葷</option>
                                        <option value="1" {{ $user->dietary_habit == '2' ? 'selected' : '' }}>素</option>
                                        <option value="2" {{ $user->dietary_habit == '3' ? 'selected' : '' }}>蛋奶素</option>
                                    </select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="favorite_foods" class="form-label">喜歡的食物們</label>
                                    @if($user->favorite_foods != null)
                                        <input type="text" name="favorite_foods" class="form-control" id="favorite_foods"
                                               value="{{ $user->favorite_foods }}">
                                    @else
                                        <input type="text" name="favorite_foods" class="form-control" id="favorite_foods"
                                               placeholder="請輸入你的喜歡的食物">
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="allergic_foods" class="form-label required-label">過敏的食物們</label>
                                    @if($user->allergic_foods != null)
                                        <input type="text" name="allergic_foods" class="form-control" id="allergic_foods"
                                               value="{{ $user->allergic_foods }}" >
                                    @else
                                        <input type="text" name="allergic_foods" class="form-control" id="allergic_foods"
                                               placeholder="請輸入你的過敏的食物(沒有則寫無）" required>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="allergic_foods" class="form-label">討厭的食物們</label>
                                    @if($user->hate_foods != null)
                                        <input type="text" name="hate_foods" class="form-control" id="hate_foods"
                                               value="{{ $user->hate_foods }}" >
                                    @else
                                        <input type="text" name="hate_foods" class="form-control" id="hate_foods"
                                               placeholder="請輸入你的討厭的食物">
                                    @endif
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
    <!-- start form --><!-- 聯絡資料 -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <section id="contact_information"></section>
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">聯絡資料</h1><!-- 置中標題 -->
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
                        <form action="{{ route('user.updateContactInformation', $user->id) }}" method="POST" id="createRecordForm"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="emergency_contact_person" class="form-label required-label">緊急聯絡人</label>
                                    @if($user->emergency_contact_person != null)
                                        <input type="text" name="emergency_contact_person" class="form-control" id="emergency_contact_person"
                                               value="{{ $user->special_disease }}" >
                                    @else
                                        <input type="text" name="emergency_contact_person" class="form-control" id="emergency_contact_person"
                                               placeholder="請輸入你的緊急聯絡人" required>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="emergency_contact_relation" class="form-label required-label">關係</label>
                                    @if($user->emergency_contact_relation != null)
                                        <input type="text" name="emergency_contact_relation" class="form-control" id="emergency_contact_relation"
                                               value="{{ $user->emergency_contact_relation }}" >
                                    @else
                                        <input type="text" name="emergency_contact_relation" class="form-control" id="emergency_contact_relation"
                                               placeholder="請輸入關係" required>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="emergency_contact_phone" class="form-label required-label">緊急聯絡電話</label>
                                    @if($user->emergency_contact_phone != null)
                                        <input type="text" name="emergency_contact_phone" class="form-control" id="emergency_contact_phone"
                                               value="{{ $user->emergency_contact_phone }}" >
                                    @else
                                        <input type="text" name="emergency_contact_phone" class="form-control" id="emergency_contact_phone"
                                               placeholder="請輸入緊急聯絡電話" required>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="home_phone_number" class="form-label required-label">家裡電話</label>
                                    @if($user->home_phone_number != null)
                                        <input type="text" name="home_phone_number" class="form-control" id="home_phone_number"
                                               value="{{ $user->home_phone_number }}" >
                                    @else
                                        <input type="text" name="home_phone_number" class="form-control" id="home_phone_number"
                                               placeholder="請輸入家裡電話" required>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="home_address" class="form-label required-label">家裡住址</label>
                                    @if($user->home_address != null)
                                        <input type="text" name="home_address" class="form-control" id="home_address"
                                               value="{{ $user->home_address }}" >
                                    @else
                                        <input type="text" name="home_address" class="form-control" id="home_address"
                                               placeholder="請輸入家裡住址" required>
                                    @endif
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
            <section id="mountaineering_deeds"></section>
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">登山事蹟</h1><!-- 置中標題 -->
                </div>
            </div>
            <!-- start form -->
            <div class="row justify-content-center">
                @if (session('status'))
                    <div class="col-md-8 text-center mb-5">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="form">
                        <form action="{{ route('user.updateMountaineeringDeeds', $user->id) }}" method="POST" id="createRecordForm" class="php-email-form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="days_in_mountain" class="form-label">在山上的天數</label>
                                    <input type="number" name="days_in_mountain" class="form-control" id="days_in_mountain"
                                           value="{{ old('days_in_mountain', $user->days_in_mountain) }}"
                                           placeholder="請輸入在山上的天數">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="times_climbed_mountain" class="form-label">爬山的次數</label>
                                    <input type="number" name="times_climbed_mountain" class="form-control" id="times_climbed_mountain"
                                           value="{{ old('times_climbed_mountain', $user->times_climbed_mountain) }}"
                                           placeholder="請輸入爬山的次數">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="five_kilograms_running_time" class="form-label">五公里跑步時間(例：00:22:44）</label>
                                    <input type="text" name="five_kilograms_running_time" class="form-control" id="five_kilograms_running_time"
                                           value="{{ old('five_kilograms_running_time', $user->five_kilograms_running_time) }}"
                                           placeholder="請輸入五公里跑步時間">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="join_the_club_time" class="form-label">加入登山社時間</label>
                                    <input type="datetime-local" name="join_the_club_time" class="form-control" id="join_the_club_time"
                                           value="{{ old('join_the_club_time', $user->join_the_club_time ) }}"
                                           placeholder="請輸入加入登山社時間">
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
