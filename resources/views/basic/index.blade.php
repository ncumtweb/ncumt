@extends('basic.main')

@section('title',  '首頁')

@section('content')
    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
        <div class="container-md" data-aos="fade-in">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="swiper sliderFeaturedPosts">
                        <div class="swiper-wrapper">
                            @foreach($records as $record)
                                <div class="swiper-slide">
                                    <a href="{{ route('record.show', $record->id )}}"
                                       class="img-bg d-flex align-items-end"
                                       style="background-image: url({{ asset($record->image) }});" loading="lazy">
                                        <div class="img-bg-inner">
                                            <h2>{{ $record->start_date . "-" . $record->end_date }}</h2>
                                            <h2>{{ $record->name }}</h2>
                                            <p>{{ $record->description }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="custom-swiper-button-next">
                            <span class="bi-chevron-right"></span>
                        </div>
                        <div class="custom-swiper-button-prev">
                            <span class="bi-chevron-left"></span>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Hero Slider Section -->

    <!-- start post -->
    <section class="signa-table-section clearfix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h1 class="page-title text-center ">公告</h1>
                    <table id="post-table" class="table table-hover" style="font-size:20px">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">類別</th>
                            <th scope="col">標題</th>
                            <!-- 幹部才能編輯 -->
                            @auth
                                @if(Auth::user()->role > 0)
                                    <th scope="col">編輯/刪除</th>
                                @endif
                            @endauth
                        </tr>
                        </thead>
                        <tbody>
                        @if($posts->count() > 0)
                            @foreach($posts as $post)
                                <!-- 置頂 -->
                                @if($post->pin == 1)
                                    <tr data-bs-toggle="modal" data-bs-target="#x{{ $post->id }}">
                                        <td class="postshow" data-toggle="modal" data-target="#Modal"><i
                                                class="bi bi-pin-angle-fill"></i> {{ $loop->index + 1 }} </td>
                                        <td><span class="badge"
                                                  style="background-color: {{ $tag_array[$post->type] }}; color:black;">{{ $type_array[$post->type] }}</span>
                                        </td>
                                        <td> {{ $post->title }}</td>
                                        @auth
                                            @if(Auth::user()->role > 0)
                                                <td>
                                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                        <button type="button" class="bi bi-pencil-square"
                                                                onclick="window.location='{{ route('post.edit', $post->id) }}'"></button>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bi bi-trash"></button>
                                                    </form>
                                                </td>
                                            @endif
                                        @endauth
                                    </tr>
                                    <!-- 非置頂 -->
                                @else
                                    <tr data-bs-toggle="modal" data-bs-target="#x{{ $post->id }}">
                                        <td class="postshow" data-toggle="modal" data-target="#Modal"><i
                                                class="bi bi-card-text"></i> {{ $loop->index + 1 }} </td>
                                        <td><span class="badge"
                                                  style="background-color: {{ $tag_array[$post->type] }}; color:black;">{{ $type_array[$post->type] }}</span>
                                        </td>
                                        <td> {{ $post->title }}</td>

                                        @auth
                                            @if(Auth::user()->role > 0)
                                                <td>
                                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                        <button type="button" class="bi bi-pencil-square"
                                                                onclick="window.location='{{ route('post.edit', $post->id) }}'"></button>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bi bi-trash"></button>
                                                    </form>
                                                </td>
                                            @endif
                                        @endauth
                                    </tr>
                                @endif
                                <!-- Modal -->
                                <div class="modal fade" id="x{{ $post->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ $post->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {!!  $post->content !!}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    關閉
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan='4'>目前暫無公告</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section><!-- end post -->



    <div class="container-md" data-aos="fade-in">
        <div class="row justify-content-center">
            <div class="col-lg-12 mb-5">
                <h1 class="page-title text-center mb-4">山社行事曆</h1>
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <!-- Event Modal -->
    <div class="modal fade" id="calendarEvent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="calendarEventTitle"></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>開始時間：<span id="calendarEventStart"></span></h5>
                    <h5>結束時間：<span id="calendarEventEnd"></span></h5>
                </div>
                <div class="modal-footer">
                    @auth
                        @if(auth::user()->role > 0)
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="editEvent">
                                編輯
                            </button>

                        @endif
                    @endauth
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="deleteEvent">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Event Modal -->

    <script>
        $(document).ready(function () {
            var events = @json($calendar_events);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, today, next, title',
                    center: '',
                    right: '',
                },
                events: events,
                selectable: true,
                selectHelper: true,
                displayEventTime: false,
                theme: true,
                eventClick: function (event) {

                    $('#calendarEventTitle').html(event.title);
                    $('#calendarEventStart').html(moment(event.start).locale('zh-Tw').format('LLLL'));
                    $('#calendarEventEnd').html(moment(event.end).locale('zh-Tw').format('LLLL'));
                    $('#calendarEvent').modal('toggle');
                    document.getElementById("editEvent").addEventListener("click", function () {
                        console.log(event.id);
                        var url = '{{ route("calendar.edit", ":id") }}';
                        url = url.replace(':id', event.id);
                        location.href = url;
                    });
                },
            });
            $(".fc-prev-button").append('<i class="bi bi-caret-left-fill"></i>')
            $(".fc-next-button").append('<i class="bi bi-caret-right-fill"></i>')
        });

        // 定義中文日期輸出
        moment.locale('zh-Tw', {
            months: '一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月'.split('_'),
            monthsShort: '1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月'.split('_'),
            weekdays: '(日)_(一)_(二)_(三)_(四)_(五)_(六)'.split('_'),
            weekdaysShort: '周日_周一_周二_周三_周四_周五_周六'.split('_'),
            weekdaysMin: '日_一_二_三_四_五_六'.split('_'),
            longDateFormat: {
                LT: 'Ah點mm分',
                LTS: 'Ah點m分s秒',
                L: 'YYYY-MM-DD',
                LL: 'YYYY年MMMD日',
                LLL: 'YYYY年MMMD日Ah點mm分',
                LLLL: 'YYYY.MM.DD ddddAhh點mm分',
                l: 'YYYY-MM-DD',
                ll: 'YYYY年MMMD日',
                lll: 'YYYY年MMMD日Ah點mm分',
                llll: 'YYYY年MMMD日ddddAh點mm分'
            },
            meridiemParse: /凌晨|早上|上午|中午|下午|晚上/,
            meridiemHour: function (h, meridiem) {
                let hour = h;
                if (hour === 12) {
                    hour = 0;
                }
                if (meridiem === '凌晨' || meridiem === '早上' ||
                    meridiem === '上午') {
                    return hour;
                } else if (meridiem === '下午' || meridiem === '晚上') {
                    return hour + 12;
                } else {
                    // '中午'
                    return hour >= 11 ? hour : hour + 12;
                }
            },
            meridiem: function (hour, minute, isLower) {
                const hm = hour * 100 + minute;
                if (hm < 600) {
                    return '凌晨';
                } else if (hm < 900) {
                    return '早上';
                } else if (hm < 1130) {
                    return '上午';
                } else if (hm < 1230) {
                    return '中午';
                } else if (hm < 1800) {
                    return '下午';
                } else {
                    return '晚上';
                }
            },
            calendar: {
                sameDay: function () {
                    return this.minutes() === 0 ? '[今天]Ah[點整]' : '[今天]LT';
                },
                nextDay: function () {
                    return this.minutes() === 0 ? '[明天]Ah[點整]' : '[明天]LT';
                },
                lastDay: function () {
                    return this.minutes() === 0 ? '[昨天]Ah[點整]' : '[昨天]LT';
                },
                nextWeek: function () {
                    let startOfWeek, prefix;
                    startOfWeek = moment().startOf('week');
                    prefix = this.diff(startOfWeek, 'days') >= 7 ? '[下]' : '[本]';
                    return this.minutes() === 0 ? prefix + 'dddA點整' : prefix + 'dddAh點mm';
                },
                lastWeek: function () {
                    let startOfWeek, prefix;
                    startOfWeek = moment().startOf('week');
                    prefix = this.unix() < startOfWeek.unix() ? '[上]' : '[本]';
                    return this.minutes() === 0 ? prefix + 'dddAh點整' : prefix + 'dddAh點mm';
                },
                sameElse: 'LL'
            },
            ordinalParse: /\d{1,2}(日|月|周)/,
            ordinal: function (number, period) {
                switch (period) {
                    case 'd':
                    case 'D':
                    case 'DDD':
                        return number + '日';
                    case 'M':
                        return number + '月';
                    case 'w':
                    case 'W':
                        return number + '周';
                    default:
                        return number;
                }
            },
            relativeTime: {
                future: '%s内',
                past: '%s前',
                s: '幾秒',
                m: '1 分鐘',
                mm: '%d 分鐘',
                h: '1 小時',
                hh: '%d 小時',
                d: '1 天',
                dd: '%d 天',
                M: '1 個月',
                MM: '%d 个月',
                y: '1 年',
                yy: '%d 年'
            },
            week: {
                dow: 1, // Monday is the first day of the week.
                doy: 4  // The week that contains Jan 4th is the first week of the year.
            }
        });
    </script>
@endsection
