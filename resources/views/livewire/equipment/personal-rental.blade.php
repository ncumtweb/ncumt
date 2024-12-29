@php use App\Models\Equipment; @endphp
<div id="top" class="row">
    <h1 class="page-title text-center">個人裝備租借</h1>
    <div class="list-group col-md-2 text-center">
        <h5 class="list-group-item ">選擇裝備種類</h5>
        @foreach(App\Enums\PersonalEquipmentCategory::cases() as $category)
            <a href="#" class="list-group-item list-group-item-action"
               wire:click.prevent="selectCategory('{{ $category->value }}')"
               onclick="scrollToTop()">{{ $category->value }}
            </a>
        @endforeach
    </div>
    <div class="col-md-8 text-center mb-5">
        <div class="row mt-3">
            @if($equipments->isEmpty())
                <div class="col-md-12 text-center">
                    <h2>{{ $selectedCategory }}已經被租借完畢</h2>
                </div>
            @else
                @if (session('status'))
                    <div class="col-md-12 text-center">
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                    </div>
                @endif
                @foreach($equipments as $equipment)
                    <div class="col-md-3 mb-3" wire:key="equipment-{{ $equipment->id }}">
                        <img src="{{ asset($equipment->image) }}" class="card-img-top mb-2 img-fluid"
                             alt="{{ $equipment->category }}">
                        <div class="card-body">
                            <h5 class="card-title mb-2">{{ $equipment->category }} {{ $equipment->equipment_oid }}</h5>
                            <div class="text-left mb-2">
                                裝備簡介：{{ $equipment->description }}<br>
                                裝備重量：{{ $equipment->weight }} 克<br>
                                社員價格：{{ $equipment->member_price }}<br>
                                非社員價格：{{ $equipment->normal_price }}<br>
                                購買日期：{{ $equipment->bought_date }}
                            </div>
                            @if (isset($rentalEquipmentMap[$equipment->id]))
                                <button class="btn btn-secondary btn-block" disabled>已加入租借清單</button>
                            @else
                                <button wire:click="addToRentalList({{ $equipment->id }})" class="btn btn-primary btn-block">加入租借清單</button>
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
    <div class="col-md-2 text-center">
        <h3>租借清單</h3>
        @if(count($rentalEquipmentMap) > 0)
            <ul>
                @foreach($rentalEquipmentMap as $equipmentId => $rentalEquipment)
                    <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <span>
                            {{ $rentalEquipment['category'] }} {{ $rentalEquipment['equipment_oid'] }}
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
