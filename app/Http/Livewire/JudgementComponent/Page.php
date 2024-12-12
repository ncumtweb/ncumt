<?php

namespace App\Http\Livewire\JudgementComponent;

use App\Models\Judgement;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class Page extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['reloadJudgements'];

    public $amountOfPage = 10;
    public $searchTerm = ''; // 新增搜尋字詞
    public $selectedLevel = ''; // 新增篩選等級
    public function performSearch() // 執行搜尋
    {
        $this->resetPage();
    }
    public function clearSearch() // 清除搜尋
    {
        $this->searchTerm = '';
        $this->resetPage();
    }

    public function render()
    {
        $levelArray = ["一", "二", "三a", "三b", "四a", "四b"];
        $result_levelArray = ['S', 'A', 'B', 'C', 'D'];
        $judgementsColumnName = Schema::getColumnListing('judgements');
        $amountOfJudgementColumns = count($judgementsColumnName);

        // 查詢和篩選資料
        $query = Judgement::orderBy('updated_at', 'desc');

        if (!empty($this->searchTerm) || !empty($this->selectedLevel)) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%')
                ->where('result_level', 'like', $this->selectedLevel . '%');

            // 重置頁數確保有結果
            if ($query->exists()) {
                $this->resetPage();
            }

        }



        $judgements = $query->paginate($this->amountOfPage);

        return view('livewire.judgement-component.page', [
            'judgements' => $judgements,
            'levelArray' => $levelArray,
            'result_levelArray' => $result_levelArray,
            'amountOfPage' => $this->amountOfPage,
            'amountOfJudgementColumns' => $amountOfJudgementColumns,
        ]);
    }

    public function reloadJudgements()
    {
        $this->resetPage();
    }

    public function deleteJudgement($id)
    {
        Judgement::findOrFail($id)->delete();
        session()->flash('status', '評分紀錄刪除成功！');
        $currentPage = $this->page;
        $totalPages = ceil(Judgement::count() / $this->amountOfPage);

        if ($currentPage > $totalPages) {
            $this->gotoPage($totalPages);
        } else {
            $this->gotoPage($currentPage);
        }
    }
}
