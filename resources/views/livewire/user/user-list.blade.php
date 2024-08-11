@php use App\Enums\Role; @endphp
<div class="col-md-10 mt-4 text-center table-responsive">
    <table class="table table-striped table-bordered">
        @if (session()->has('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <thead>
        <tr>
            <th>#</th>
            <th>學號</th>
            <th>名稱</th>
            <th>電子信箱</th>
            <th>暱稱</th>
            <th>角色</th>
            <!-- 幹部才能編輯 -->
            @auth
                @if(Auth::user()->role == Role::WEB_ADMIN->value)
                    <th>編輯</th>
                @endif
            @endauth
        </tr>
        </thead>
        <tbody>
        @if (!$users->count())
            <tr>
                <td colspan= {{ $users->count() }}>目前尚無使用者</td>
            </tr>
        @else
            @foreach($users as $user)
                <tr wire:key="userId-{{ $user->id }}">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $user->identifier }}</td>
                    <td>{{ $user->name_zh }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->nickname }}</td>
                    <td>
                        <label for="role">
                            <select id="role-{{ $user->id }}" wire:key="selectRole-{{ $user->id }}">
                                @foreach(Role::cases() as $role)
                                    <option wire:key="role-{{ $user->id }}"
                                        value="{{ $role->value }}" {{ $user->role == $role->value ? 'selected' : '' }}>
                                        {{ $role->toChinese() }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </td>
                    @if(Auth::user()->role == Role::WEB_ADMIN->value)
                        <td>
                            <button type="button" class="bi bi-pencil-square"
                                    onclick="window.location='{{ route('user.edit', $user->id) }}'"></button>
                        </td>
                    @endif
                </tr>
            @endforeach
        @endif
    </table>
</div>
