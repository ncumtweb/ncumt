<?php

namespace App\Http\Livewire\RecordComponent;

use App\Models\Record;
use Livewire\Component;
use Livewire\WithPagination;

class Page extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $amountOfPages = 5; // 每頁顯示 5 筆記錄

    public function render()
    {
// 獲取分頁資料
        $records = Record::orderBy('start_date', 'desc')->paginate($this->amountOfPages);

// 定義 $category_array
        $category_array = ["中級山", "高山", "溯溪"];

        return view('livewire.record-component.page', [
            'records' => $records,
            'category_array' => $category_array,
        ]);
    }

    /**
     * 觸發滾動到頂端
     * @return void
     */
    public function updatedPage()
    {
        $this->dispatchBrowserEvent('scroll-to-top');
    }

}
