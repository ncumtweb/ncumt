<div class="form mt-3">
    <form wire:submit.prevent="submit" class="createRecordForm">
        @if (session('status'))
            <div class="col-lg-12 text-center mb-2">
                <h6 class="alert alert-success">{{ session('status') }}</h6>
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
            <livewire:conference.form :mode="App\Enums\Mode::EDIT"/>
        @endif
    </form>
</div>

