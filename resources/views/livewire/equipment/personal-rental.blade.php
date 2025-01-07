<div id="top" class="row">
    <h1 class="page-title text-center">個人裝備租借</h1>

    <!-- 左側：選擇裝備種類 -->
    <div class="d-md-block d-none col-md-2 text-center">
        <h5 class="list-group-item">選擇裝備種類</h5>
        <div class="list-group">
            @foreach(App\Enums\PersonalEquipmentCategory::cases() as $category)
                <a href="#" class="list-group-item list-group-item-action"
                   wire:click.prevent="selectCategory('{{ $category->value }}')"
                   onclick="scrollToTop()">{{ $category->value }}
                </a>
            @endforeach
        </div>
    </div>
    <!-- 裝備選單按鈕 -->
    <a class="btn btn-outline-primary d-md-none mb-2 me-2" type="button" data-bs-toggle="offcanvas"
       data-bs-target="#categoriesOffcanvas" aria-controls="categoriesOffcanvas">
        <i class="bi bi-list"></i> 裝備選單
    </a>
    <!-- 裝備選單 Offcanvas -->
    <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="categoriesOffcanvas"
         aria-labelledby="categoriesOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="categoriesOffcanvasLabel">裝備選單</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group">
                @foreach(App\Enums\PersonalEquipmentCategory::cases() as $category)
                    <a href="#" class="list-group-item list-group-item-action" data-bs-dismiss="offcanvas" aria-label="Close"
                       wire:click.prevent="selectCategory('{{ $category->value }}')"
                       onclick="scrollToTop()">{{ $category->value }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- 租借清單按鈕 -->
    <a class="btn btn-outline-success d-md-none mb-2" type="button" data-bs-toggle="offcanvas"
       data-bs-target="#rentalListOffcanvas" aria-controls="rentalListOffcanvas">
        <i class="bi bi-cart"></i> 租借清單
    </a>
    <!-- 租借清單 Offcanvas -->
    <div class="offcanvas offcanvas-end d-md-none" tabindex="-1" id="rentalListOffcanvas"
         aria-labelledby="rentalListOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="rentalListOffcanvasLabel">租借清單</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @if(count($rentalEquipmentMap) > 0)
                <ul class="list-unstyled">
                    @foreach($rentalEquipmentMap as $equipmentId => $rentalEquipment)
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span>
                                <strong>{{ $rentalEquipment['equipment']['category'] }}</strong>
                                {{ $rentalEquipment['equipment']['equipment_oid'] }}（{{ $rentalEquipment['price'] }}）
                            </span>
                            <button wire:click="removeFromRentalList({{ $equipmentId }})"
                                    class="btn btn-danger btn-sm ms-2" data-bs-dismiss="offcanvas" aria-label="Close">
                                移除
                            </button>
                        </li>
                    @endforeach
                    <li class="d-flex justify-content-between align-items-center">
                        <strong>目前總金額：</strong>
                        <span>{{ $rentalAmount }}</span>
                    </li>
                </ul>
                <!-- 確認租借按鈕 -->
                <button wire:click="confirmRental"
                        class="btn btn-success w-100 mt-3">
                    確認租借
                </button>
            @else
                <div class="text-center mt-3">
                    <p>目前沒有要租借的裝備</p>
                </div>
            @endif
        </div>
    </div>

    <!-- 中間：裝備清單 -->
    <div class="col-md-8 text-center mb-5">
        <div class="row mt-3">
            @if($equipments->isEmpty())
                <div class="col-md-12">
                    <h2>{{ $selectedCategory }}已經被租借完畢</h2>
                </div>
            @else
                @if (session('status'))
                    <div class="col-md-12">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
                @foreach($equipments as $equipment)
                    <div class="col-6 col-md-3 mb-3 thumbnail" wire:key="equipment-{{ $equipment->id }}">
                        <img src="{{ asset($equipment->image) }}"
                             class="card-img-top mb-2 img-fluid responsive-img"
                             alt="{{ $equipment->category }}">
                        <div class="card-body">
                            <h5 class="card-title mb-2">{{ $equipment->category }} {{ $equipment->equipment_oid }}</h5>
                            <div class="text-start mb-2">
                                裝備簡介：{{ $equipment->description }}<br>
                                裝備重量：{{ $equipment->weight }} 克<br>
                                社員價格：{{ $equipment->member_price }} 元<br>
                                非社員價格：{{ $equipment->normal_price }} 元<br>
                                裝備購買日期：{{ $equipment->bought_date }}
                            </div>
                            @if (isset($rentalEquipmentMap[$equipment->id]))
                                <button class="btn btn-secondary btn-block" disabled>已加入租借清單</button>
                            @else
                                <button wire:click="addToRentalList({{ $equipment->id }})"
                                        class="btn btn-primary btn-block">加入租借清單
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $equipments->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- 右側：租借清單 -->
    <div class="d-md-block d-none col-md-2 text-center">
        <h3>租借清單</h3>
        @if(count($rentalEquipmentMap) > 0)
            <ul>
                @foreach($rentalEquipmentMap as $equipmentId => $rentalEquipment)
                    <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <span>
                            {{ $rentalEquipment['equipment']['category'] }} {{ $rentalEquipment['equipment']['equipment_oid'] }}（{{ $rentalEquipment['price'] }}）
                        </span>
                        <button wire:click="removeFromRentalList({{ $equipmentId }})"
                                class="btn btn-danger btn-sm"
                                style="margin-left: 10px;">
                            移除
                        </button>
                    </li>
                @endforeach
                <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>目前總金額：{{ $rentalAmount }}</span>
                </li>
            </ul>
            <button wire:click="confirmRental" class="btn btn-success mt-1">
                確認租借
            </button>
        @else
            <div class="col-md-12 text-center">
                <p>目前沒有要租借的裝備</p>
            </div>
        @endif
    </div>
</div>

<script>
    function scrollToTop() {
        window.scrollTo({top: 0, behavior: 'smooth'});
    }
</script>
