<div style="color: black !important;">
    <p>親愛的山友：</p>

    <p>以下是您的報名資訊，請確認資料是否正確。</p>

    <h3 style="margin-top: 20px;">表單名稱：2024 第二十五屆全國大專校院登山運動研討會報名表</h3>
    <ul>
        <li>姓名 : {{ $conferenceUser->name }}</li>
        <li>性別 : {{ $conferenceUser->getGenderString($conferenceUser->gender) }}</li>
        <li>手機 : {{ $conferenceUser->phone }}</li>
        <li>E-mail : {{ $conferenceUser->email }}</li>
        @if(App\Enums\Identity::STUDENT->value == $conferenceUser->identity)
            <li>參加講習之身份 : 學生</li>
            <li>校名 : {{ $conferenceUser->school_name }}</li>
            <li>系別/年級 : {{ $conferenceUser->department }}</li>
        @else
            <li>參加講習之身份 : 社會人士</li>
        @endif
    </ul>

    <h3 style="margin-top: 20px;">會議資訊</h3>
    <ul>
        <li>時間： 113年10月26日 (六) 09:30</li>
        <li>地點：國立中央大學會議廳 (桃園市中壢區中大路300號)</li>
    </ul>

    <h3 style="margin-top: 20px;">聯絡資訊</h3>
    <ul>
        <li>中華民國健行登山會信箱：info@alpineclub.org.tw</li>
        <li>中央大學登山社粉絲專頁：
            <a href="https://www.facebook.com/ncumountaineeringclub" style="text-decoration: underline;">
                https://www.facebook.com/ncumountaineeringclub
            </a>
        </li>
    </ul>

    <h3 style="margin-top: 20px;">主辦及贊助單位</h3>
    <ul>
        <li>指導單位：教育部體育署</li>
        <li>主辦單位：中華民國健行登山會</li>
        <li>承辦單位：國立中央大學登山社</li>
        <li>贊助單位：歐都納戶外體育基金會</li>
    </ul>
</div>
