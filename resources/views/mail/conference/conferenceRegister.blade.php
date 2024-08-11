<div style="color: black !important;">
    <p>親愛的山友：</p>

    <p>以下是您的報名資訊，請確認資料是否正確。</p>

    <h3 style="margin-top: 20px;">表單名稱：2024 第二十五屆全國大專校院登山運動研討會報名表</h3>
    <ul>
        <li>姓名 : {{ $conferenceUser->name }}</li>
        <li>性別 : {{ $conferenceUser->getGenderString($conferenceUser->gender) }}</li>
        <li>手機 : {{ $conferenceUser->phone }}</li>
        <li>是否吃素：{{ $conferenceUser->is_vegetarian ? '是' : '否' }}</li>
        <li>E-mail : {{ $conferenceUser->email }}</li>
        @if(App\Enums\Identity::STUDENT->value == $conferenceUser->identity)
            <li>參加講習之身份 : 學生</li>
            <li>校名 : {{ $conferenceUser->school_name }}</li>
            <li>系別/年級 : {{ $conferenceUser->department }}</li>
        @else
            <li>參加講習之身份 : 社會人士</li>
        @endif
    </ul>
    @include('mail.conference.fixInformation')
</div>
