<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('assets/img/favicon.png') }}" alt="">
            <h1>NCUMT</h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li class="dropdown"><a><span>登山研討會</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="{{ url('conference/register') }}">研討會報名表</a></li>
                        <li><a href="{{ url('conference/search') }}">研討會查詢</a></li>
                        @auth
                            @if(Auth::user()->role > App\Enums\Role::MEMBER->value)
                                <li><a href="{{ url('conference/result') }}">研討會報名結果</a></li>
                            @endif
                        @endauth
                    </ul>
                <li><a href="{{ url('/aboutus') }}">關於我們</a></li>
                <li class="dropdown"><a><span>社課資訊</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="{{ route('course.showRegister') }}">社課報名</a></li>
                        <li><a href="{{ url('/course') }}">社課影片</a></li>
                    </ul>
                <li class="dropdown"><a><span>難度評分</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="{{ route('judgement.index') }}">評分系統</a></li>
                        <li><a href="{{ route('judgement.record') }}">評分紀錄</a></li>
                        <li><a href="{{ route('judgement.rule') }}">評分規則</a></li>
                        <li><a href="{{ route('judgement.pointRule') }}">分數計算</a></li>
                    </ul>
                @guest
                    <li><a href="{{ route('record.index') }}">所有紀錄</a></li>
                @endguest

                @auth
                    <li class="dropdown"><a><span>系統</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            @if(Auth::user()->role > App\Enums\Role::MEMBER->value)
                                <li><a href="{{ route('equipment.select') }}">個人裝備租借系統</a></li>
                            @endif
                        </ul>
                    </li>

                    <li class="dropdown"><a><span>行程記錄</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="{{ route('record.index') }}">所有紀錄</a></li>
                            <!-- 幹部才能新增紀錄 -->
                            @if(Auth::user()->role > App\Enums\Role::MEMBER->value)
                                <li><a href="{{ route('record.create') }}">新增紀錄</a></li>
                            @endif
                        </ul>
                    </li>
                @endauth

                @guest
                    <li><a href="{{ route('faq.index') }}">FAQ</a></li>
                @endguest

                @auth
                    @if(Auth::user()->role > App\Enums\Role::MEMBER->value)
                        <li class="dropdown"><a><span>FAQ</span> <i
                                    class="bi bi-chevron-down dropdown-indicator"></i></a>
                            <ul>
                                <li><a href="{{ route('faq.index') }}">FAQ</a></li>
                                <li><a href="{{ route('faq.create') }}">新增FAQ</a></li>
                            </ul>
                    @endif
                @endauth


                @auth
                    @if(Auth::user()->role > App\Enums\Role::MEMBER->value)
                        <li class="dropdown"><a><span>幹部專區</span><i
                                    class="bi bi-chevron-down dropdown-indicator"></i></a>
                            <ul>
                                <li><a href="{{ route('record.create') }}">新增紀錄</a></li>
                                <li><a href="{{ route('post.create') }}">新增公告</a></li>
                                <li><a href="{{ route('calendar.create') }}">新增活動</a></li>
                                <li><a href="{{ route('course.create') }}">新增社課</a></li>
                                <li><a href="{{ route('faq.create') }}">新增FAQ</a></li>
                            </ul>
                        </li>
                    @endif
                @endauth

                @guest
                    <li><a href="/portal">{{ __('登入') }}</a></li>
                @endguest

                @if(Auth::check())
                    <li class="dropdown"><a><span>{{Auth::user()->name_zh . ' 您好'}}</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="{{ route('user.show', Auth::user()->id )}}">{{ __('個人資料') }}</a></li>
                            <li><a href="{{ route('course.showRecord') }}">{{ __('已報名社課') }}</a></li>
                            <li><a href="{{ route('rental.index') }}">{{ __('已租借清單') }}</a></li>
                            <li><a href="/portal/logout">{{ __('登出') }}</a></li>
                        </ul>
                @endif
            </ul>
        </nav><!-- .navbar -->

        <div class="position-relative">
            <a href="https://www.facebook.com/ncumountaineeringclub" target="_blank" class="mx-2"><span
                    class="bi-facebook"></span></a>
            <a href="https://www.instagram.com/ncumountaineeringclub/" target="_blank" class="mx-2"><span
                    class="bi-instagram"></span></a>
            <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
            <i class="bi bi-list mobile-nav-toggle"></i>

            <!-- ======= Search Form ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="search-result.html" class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text" placeholder="Search" class="form-control">
                    <button class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div><!-- End Search Form -->

        </div>

    </div>

</header><!-- End Header -->
