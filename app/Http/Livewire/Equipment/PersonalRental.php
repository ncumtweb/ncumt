<?php

namespace App\Http\Livewire\Equipment;

use App\Enums\EquipmentStatus;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\RentalEquipment;
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
            $this->rentalEquipmentMap[$equipmentId] = [
                'equipment' => $equipment,
                'price' => $equipment->getPrice()
            ];
            $this->rentalAmount += $equipment->getPrice();
            session()->flash('status', "$equipment->category $equipment->equipment_oid 已加入租借清單！");
        }
    }

    public function removeFromRentalList(int $equipmentId): void
    {
        $equipment = Equipment::find($equipmentId);

        // 從租借清單中移除該裝備
        if (isset($this->rentalEquipmentMap[$equipmentId])) {
            unset($this->rentalEquipmentMap[$equipmentId]);
            $this->rentalAmount -= $equipment->getPrice();
            session()->flash('status', "裝備已移出租借清單！");
        }
    }

    /** @noinspection PhpMissingReturnTypeInspection */
    public function confirmRental()
    {
        $rentalEquipmentIdList = array_keys($this->rentalEquipmentMap);
        Equipment::whereIn('id', $rentalEquipmentIdList)
            ->update(['status' => EquipmentStatus::BORROWED->value]);
        $rentalId = $this->newRental();
        $this->newRentalEquipmentList($rentalId, $rentalEquipmentIdList);
        $this->reset();

        return redirect()->route('rental.personalRentalRecord')->with('status','租借成功，請確認租借資訊');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $equipments = Equipment::where('category', $this->selectedCategory)->where('status', EquipmentStatus::NOT_BORROWED->value)->paginate(4);

        return view('livewire.equipment.personal-rental', ['equipments' => $equipments]);
    }

    private function newRental(): int
    {
        $rental = new Rental();
        $rental->user_id = Auth::user()->id;
        $rental->rental_amount = $this->rentalAmount;
        $rental->rental_date = date('Y-m-d');
        $rental->save();
        return $rental->id;
    }

    private function newRentalEquipmentList(int $rentalId, array $equipmentIdList): void
    {
        foreach ($equipmentIdList as $equipmentId) {
            $rentalEquipment = new RentalEquipment();
            $rentalEquipment->equipment_id = $equipmentId;
            $rentalEquipment->rental_id = $rentalId;
            $rentalEquipment->save();
        }
    }

    /**
     * 重置金額
     */
    private function resetData(): void
    {
        $this->rentalEquipmentMap = [];
        $this->rentalAmount = 0;
    }

    /**
     * 觸發滾動到頂端
     * @return void
     */
    public function updatedPage(): void
    {
        $this->dispatchBrowserEvent('scroll-to-top');
    }
}
