<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-10 row order-md-1">
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
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset($equipment->image) }}" class="card-img-top mb-2"
                                 alt="{{ $equipment->category }}">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">{{ $equipment->category }} {{ $equipment->number }}</h5>
                                <div class="text-left mb-2">
                                    裝備簡介：{{ $equipment->description }}<br>
                                    社員價格: {{ $equipment->member_price }}<br>
                                    非社員價格: {{ $equipment->normal_price }}
                                </div>
                                <button class="btn btn-primary btn-block">租借裝備</button>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center">
                        {{ $equipments->links() }}
                    </div>
                @endif
            </div>
            <div class="list-group col-md-2 order-md-2 text-center">
                <h5 class="list-group-item ">選擇裝備種類</h5>
                @foreach(App\Enums\PersonalEquipmentCategory::cases() as $category)
                    <a href="#" class="list-group-item list-group-item-action"
                       wire:click.prevent="selectCategory('{{ $category->value }}')">{{ $category->value }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
