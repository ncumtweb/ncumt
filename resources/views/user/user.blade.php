@php use App\Enums\Role; @endphp
@extends('basic.main')

@section('title',  '使用者列表')

@section('content')
    <section id="contact" class="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">使用者列表</h1>
                    <div>
                    </div>
                    <section id="posts" class="posts">
                        <div class="row">
                            <!-- Start Video -->
                            <div class="col-md-12 text-center mb-5 table-responsive">
                                <table class="table table-light table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">學號</th>
                                        <th scope="col">名稱</th>
                                        <th scope="col">電子信箱</th>
                                        <th scope="col">暱稱</th>
                                        <th scope="col">角色</th>
                                        <!-- 幹部才能編輯 -->
                                        @auth
                                            @if(Auth::user()->role == Role::WEB_ADMIN->value)
                                                <th scope="col">編輯</th>
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
                                                <td>{{ Role::from($user->role)->toChinese() }}</td>
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
                            </div>
                        </div><!-- 難度分級表 End  -->
                </div>
    </section>
    </div>
    </div>
@endsection
