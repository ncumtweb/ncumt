<?php

namespace App\Http\Livewire\Equipment;

use App\Enums\EquipmentStatus;
use App\Models\Equipment;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PersonalRental extends Component
{
    use WithPagination;

    public array $rentalEquipmentMap = [];

    public string $selectedCategory = '大背包';

    public int $rentalAmount = 0;

    protected string $paginationTheme = 'bootstrap';

    public function selectCategory($category): void
    {
        $this->selectedCategory = $category;
        $this->resetPage();
    }

    public function addToRentalList(int $equipmentId): void
    {
        $equipment = Equipment::find($equipmentId);

        if (!$equipment || $equipment->status !== EquipmentStatus::NOT_BORROWED->value) {
            session()->flash('status', '裝備已被借出！');
            return;
        }

        // 添加到租借清單
        if (!isset($this->rentalEquipmentMap[$equipmentId])) {
            $this->rentalEquipmentMap[$equipmentId] = $equipment;
            $this->rentalAmount += $equipment->getPrice();
            session()->flash('status', "$equipment->category $equipment->equipment_oid 已加入租借清單！");
        }
    }

    public function removeFromRentalList(int $equipmentId): void
    {
        // 從租借清單中移除該裝備
        if (isset($this->rentalEquipmentMap[$equipmentId])) {
            unset($this->rentalEquipmentMap[$equipmentId]);
            session()->flash('status', "裝備已移出租借清單！");
        }
    }

    public function confirmRental(): void
    {
        // 確認租借並更新數據庫
        Equipment::whereIn('id', array_keys($this->rentalEquipmentMap))
            ->update(['status' => EquipmentStatus::BORROWED->value]);

        $this->rentalEquipmentMap = [];
        $this->rentalAmount = 0;

        session()->flash('status', '租借已成功確認！');
    }

    public function render()
    {
        $equipments = Equipment::where('category', $this->selectedCategory)->where('status', EquipmentStatus::NOT_BORROWED->value)->paginate(4);

        return view('livewire.equipment.personal-rental', ['equipments' => $equipments]);
    }

    private function newRental(): void
    {
        $rental = new Rental();
        $rental->user_id = Auth::user()->id;
        $rental->save();
    }
}
