<?php

namespace App\Http\Livewire\Equipment;

use App\Models\Equipment;
use Livewire\Component;
use Livewire\WithPagination;

class EquipmentRental extends Component
{
    use WithPagination;

    public $selectedCategory = '大背包';
    public $selectedEquipment = null;
    protected string $paginationTheme = 'bootstrap';

    public function selectCategory($category): void
    {
        $this->selectedCategory = $category;
    }

    public function selectEquipment($equipmentId): void
    {
        $this->selectedEquipment = Equipment::find($equipmentId);
    }

    public function render()
    {
        $equipments = Equipment::where('category', $this->selectedCategory)->where('status', 0)->paginate(4);

        return view('livewire.equipment.equipment-rental', ['equipments' => $equipments]);
    }
}
