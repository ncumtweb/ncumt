@php
    use App\Enums\Gender;
    use App\Enums\Identity;
@endphp
<div class="form mt-5">
    <form wire:submit.prevent="submit" class="createRecordForm">
        @if(App\Enums\Mode::EDIT == $mode)
            <div class="col-lg-12 text-center">
                <h1>報名資訊</h1>
            </div>
        @endif
        @if (session('status'))
            <div class="col-lg-12 text-center mb-2">
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            </div>
        @endif
            @if(!$isDone)
                <div class="row mb-3">
                    <!-- 姓名 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">姓名</label>
                            <input type="text" id="name" wire:model="name"
                                   class="form-control @error('name') is-invalid @enderror" placeholder="請輸入姓名">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- 手機 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">手機</label>
                            <input type="text" id="phone" wire:model="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="請輸入手機號碼">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- 性別 -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="gender">性別</label>
                            <select id="gender" wire:model="gender"
                                    class="form-control @error('gender') is-invalid @enderror">
                                <option value="">請選擇性別</option>
                                <option
                                    value="{{ Gender::MALE->value }}"> {{ Gender::from(Gender::MALE->value)->toChinese() }} </option>
                                <option
                                    value="{{ Gender::FEMALE->value }}"> {{ Gender::from(Gender::FEMALE->value)->toChinese() }}</option>
                            </select>
                            @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- 是否吃素 -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="isVegetarian">葷素</label>
                            <select id="isVegetarian" wire:model="isVegetarian"
                                    class="form-control @error('isVegetarian') is-invalid @enderror">
                                <option value="">請選擇葷素</option>
                                <option value="0">葷</option>
                                <option value="1">素</option>
                            </select>
                            @error('isVegetarian')
                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" wire:model="email"
                           class="form-control @error('email') is-invalid @enderror" placeholder="請輸入電子信箱">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="identity">參加身份</label>
                    <select id="identity" wire:model="identity"
                            class="form-control @error('identity') is-invalid @enderror">
                        <option value="">請選擇參加身份</option>
                        <option
                            value="{{ Identity::STUDENT->value }}">{{ Identity::from(Identity::STUDENT->value)->toChinese() }}</option>
                        <option
                            value="{{ Identity::SOCIAL->value }}">{{ Identity::from(Identity::SOCIAL->value)->toChinese() }}</option>
                    </select>
                    @error('identity')
                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                @if( $identity == App\Enums\Identity::STUDENT->value)
                    <div class="form-group">
                        <label for="schoolName">校名</label>
                        <input type="text" id="schoolName" wire:model="schoolName"
                               class="form-control @error('schoolName') is-invalid @enderror" placeholder="請輸入校名">
                        @error('schoolName')
                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="department">系級</label>
                        <input type="text" id="department" wire:model="department"
                               class="form-control @error('department') is-invalid @enderror" placeholder="請輸入系級">
                        @error('department')
                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                @endif

                <div class="text-center">
                    @if(App\Enums\Mode::CREATE == $mode)
                        <button type="submit"
                                class="btn btn-primary">提交
                        </button>
                    @else
                    <button type="submit"
                            class="btn btn-primary">修改
                    </button>
                        <button type="button" wire:click="cancelRegistration"
                                class="btn btn-danger">取消報名
                        </button>
                    @endif
                </div>
            @endif
    </form>
</div>

