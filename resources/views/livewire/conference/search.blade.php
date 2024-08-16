<div class="form mt-3">
    <form wire:submit.prevent="submit" class="createRecordForm">
        @if (session('status'))
            <div class="col-lg-12 text-center mb-2">
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            </div>
        @endif
            @if (session('warning'))
                <div class="col-lg-12 text-center mb-2">
                    <h6 class="alert alert-danger">{{ session('warning') }}</h6>
                </div>
            @endif
        <div class="form-group">
            <label for="search-email">電子郵件</label>
            <div class="d-flex">
                <input type="email" id="search-email" wire:model="email"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="請輸入電子郵件">
                <button type="button" class="btn btn-primary bi-search ms-2" style="white-space: nowrap;"
                        wire:click="submit">
                </button>
            </div>
            @error('email')
            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
            @enderror
        </div>
        @if($conferenceUser)
                <div class="form-group mt-3">
                    <label for="verification-code">驗證碼</label>
                    <div class="d-flex">
                        <input type="text" id="verification-code" wire:model="verificationCodeInput"
                               class="form-control @error('verificationCodeInput') is-invalid @enderror"
                               placeholder="請輸入收到的驗證碼">
                        <button type="button" id="resend-button" class="btn btn-secondary bi-arrow-clockwise ms-2"
                                wire:click="resendVerificationCodeToUser">
                        </button>
                        <button type="button" class="btn btn-primary bi-check-lg ms-2"
                                wire:click="submitVerificationCode"></button>
                    </div>
                    @error('verificationCodeInput')
                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                    @enderror
                </div>
            @endif
            @if($isValid)
            <livewire:conference.form :mode="App\Enums\Mode::EDIT"/>
        @endif
    </form>
</div>

