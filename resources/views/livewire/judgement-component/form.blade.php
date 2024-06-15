<div class="row mb-5 justify-content-center">
    <div class="col-md-12">
        <div class="form mt-5">
            <form wire:submit.prevent="submit" class="php-email-form">
                @if (session('status'))
                    <div class="col-lg-12 text-center mb-2">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
                <div class="form-group">
                    <label for="name" class="form-label">路線名稱</label>
                    <input type="text" id="name" wire:model="name" class="form-control" placeholder="請輸入路線名稱"
                           required>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="normal_day" class="form-label">傳統路天數</label>
                        <input type="number" id="normal_day" wire:model="normal_day" class="form-control" min="0"
                               placeholder="請輸入傳統路天數" required>
                        @error('normal_day') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="abnormal_day" class="form-label">非傳統路天數</label>
                        <input type="number" id="abnormal_day" wire:model="abnormal_day" class="form-control" min="0"
                               placeholder="請輸入非傳統路天數" required>
                        @error('abnormal_day') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="trip_tag" class="form-label">行程</label>
                        <select id="trip_tag" wire:model="trip_tag" class="form-select" required>
                            <option value="0" selected>一般行程</option>
                            <option value="1">壓縮行程</option>
                            <option value="2">寬鬆行程</option>
                        </select>
                        @error('trip_tag') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="level" class="form-label">路況分級</label>
                        <select id="level" wire:model="level" class="form-select" required>
                            <option selected disabled value="">請選擇路況分級</option>
                            <option value="0">一</option>
                            <option value="1">二</option>
                            <option value="2">三a</option>
                            <option value="3">三b</option>
                            <option value="4">四a</option>
                            <option value="5">四b</option>
                        </select>
                        @error('level') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="road" class="form-label">路跡級別</label>
                        <select id="road" wire:model="road" class="form-select" required>
                            <option selected disabled value="">請選擇路跡級別</option>
                            @for($i = 0; $i < 10; $i++)
                                <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                            @endfor
                        </select>
                        @error('road') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="terrain" class="form-label">地形級別</label>
                        <select id="terrain" wire:model="terrain" class="form-select" required>
                            <option selected disabled value="">請選擇地形級別</option>
                            @for($i = 0; $i < 10; $i++)
                                <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                            @endfor
                        </select>
                        @error('terrain') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="plant" class="form-label">植被級別</label>
                        <select id="plant" wire:model="plant" class="form-select" required>
                            <option selected disabled value="">請選擇植被級別</option>
                            @for($i = 0; $i < 10; $i++)
                                <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                            @endfor
                        </select>
                        @error('plant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="energy" class="form-label">體力級別</label>
                        <select id="energy" wire:model="energy" class="form-select" required>
                            <option selected disabled value="">請選擇體力級別</option>
                            @for($i = 0; $i < 4; $i++)
                                <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                            @endfor
                        </select>
                        @error('energy') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="water" class="form-label">多背水天數</label>
                        <input type="number" id="water" wire:model="water" class="form-control" min="0"
                               placeholder="請輸入多背水天數" required>
                        @error('water') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="my-3">
                    <div class="result-message">
                        {!! $resultMessage !!}
                    </div>
                </div>
                <div class="row">
                    <div class="text-center">
                        <button type="button" wire:click="calculate" value="store" name="submit_button">
                            開始評分
                        </button>
                        @auth
                            @if(Auth::user()->role > 0 && $resultMessage)
                                <button type="submit" id="store_result" name="store_result">
                                    儲存評分結果
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
