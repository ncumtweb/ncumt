 <!-- ======= Header ======= -->
 <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('assets/img/ncumt.png') }}" alt="">
        <h1>NCUMT</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ url('/commingsoon') }}">社課影片</a></li>
          <li><a href="{{ url('/judgement') }}">評分系統</a></li>
          <li class="dropdown"><a><span>行程記錄</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="{{ url('/record') }}">所有紀錄</a></li>
              <!-- 幹部才能新增紀錄 -->
              @auth 
                @if(Auth::user()->role > 0) 
                  <li><a href="{{ route('record.create') }}">新增紀錄</a></li>
                @endif
              @endauth
            </ul>
          </li>

          <li><a href="{{ url('/commingsoon') }}">關於我們</a></li>
          <li><a href="{{ url('/commingsoon') }}">聯絡我們</a></li>
          <li><a href="{{ url('/commingsoon') }}">FAQ</a></li>
          @guest
            <li><a href="/portal">{{ __('登入') }}</a></li>
          @endguest

          @if(Auth::check())
            <li class="dropdown"><a><span>{{Auth::user()->name_zh . ' 您好'}}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li><a href="{{ route('user.show', Auth::user()->id )}}">{{ __('個人資料') }}</a></i>
                @auth 
                  @if(Auth::user()->role > 0) 
                    <li><a href="{{ route('post.create') }}">新增公告</a></i>
                    @endif
                @endauth
                <li><a href="/portal/logout">{{ __('登出') }}</a></li>
              </ul>
          @endif
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <a href="https://www.facebook.com/ncumountaineeringclub" target = "_blank" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="https://www.instagram.com/ncumountaineeringclub/" target = "_blank" class="mx-2"><span class="bi-instagram"></span></a>
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