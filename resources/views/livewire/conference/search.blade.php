<div class="form mt-3">
    <form wire:submit.prevent="submit" class="createRecordForm">
        @if (session('status'))
            <div class="col-lg-12 text-center mb-2">
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            </div>
        @endif
        <div class="form-group">
            <label for="email">電子郵件</label>
            <input type="email" id="email" wire:model="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="請輸入電子郵件">
            @error('email')
            <div class="invalid-feedback" style="position: absolute">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12 d-flex justify-content-center">
            <button type="button" class="btn btn-primary w-25" wire:click="submit">查詢</button>
        </div>
    </form>
</div>

