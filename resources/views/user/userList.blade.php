@php use App\Enums\Role; @endphp
@extends('basic.main')

@section('title',  '使用者列表')

@section('content')
    <section id="contact" class="contact">
        <div class="container">
            <div class="col-lg-12 text-center">
                <h1 class="page-title">使用者列表</h1>
            </div>
            <div class="row justify-content-center">
                {{--                <livewire:user.user-list :users="$users"/>--}}
                <div class="col-md-10 mt-4 text-center table-responsive">
                    @if (session()->has('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered">
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
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->identifier }}</td>
                                    <td>{{ $user->name_zh}}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->nickname }}</td>
                                    <td>
                                        @if(Auth::user()->role == Role::WEB_ADMIN->value)
                                            <form action="{{ route('user.updateRole', $user->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="page" value="{{ request()->get('page', 1) }}">
                                                <label for="role">
                                                    <select name="role" onchange="this.form.submit()">
                                                        @foreach(Role::cases() as $role)
                                                            <option
                                                                value="{{ $role->value }}" {{ $user->role == $role->value ? 'selected' : '' }}>
                                                                {{ $role->toChinese() }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </form>
                                        @else
                                            {{ Role::from($user->role)->toChinese() }}
                                        @endif
                                    </td>
                                    <!-- 幹部才能編輯 -->
                                    @auth
                                        @if(Auth::user()->role == Role::WEB_ADMIN->value)
                                            <td>
                                                <button type="button" class="bi bi-pencil-square"
                                                        onclick="window.location='{{ route('user.edit', $user->id) }}'"></button>
                                            </td>
                                        @endif
                                    @endauth
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $users->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

