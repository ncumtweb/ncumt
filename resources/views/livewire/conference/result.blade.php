<div class="col-md-10 mt-4 text-center table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>姓名</th>
            <th>性別</th>
            <th>是否素食</th>
            <th>電話</th>
            <th>Email</th>
            <th>身份</th>
            <th>校名</th>
            <th>系級</th>
        </tr>
        </thead>
        <tbody>
        @foreach($conferenceUsers as $conferenceUser)
            <tr wire:key="ConferenceUser-{{ $conferenceUser->id }}">
                <td>{{ $conferenceUser->name }}</td>
                <td>{{ $conferenceUser->gender == 1 ? '男' : '女' }}</td>
                <td>{{ $conferenceUser->is_vegetarian ? '是' : '否' }}</td>
                <td>{{ $conferenceUser->phone }}</td>
                <td>{{ $conferenceUser->email }}</td>
                @if(App\Enums\Identity::STUDENT->value == $conferenceUser->identity)
                    <td>學生</td>
                    <td>{{ $conferenceUser->school_name }}</td>
                    <td>{{ $conferenceUser->department }}</td>
                @else
                    <td>社會人士</td>
                    <td></td>
                    <td></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $conferenceUsers->links() }}
    </div>
</div>

