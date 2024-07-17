<?php

namespace App\Http\Livewire\JudgementComponent;

use App\Models\Judgement;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class Page extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['reloadJudgements'];

    public $amountOfPage = 10;

    public function render()
    {
        $levelArray = ["一", "二", "三a", "三b", "四a", "四b"];
        $judgements = Judgement::orderBy('updated_at', 'desc')->paginate($this->amountOfPage);
        $judgementsColumnName = Schema::getColumnListing('judgements');
        $amountOfJudgementColumns = count($judgementsColumnName);

        return view('livewire.judgement-component.page', [
            'judgements' => $judgements,
            'levelArray' => $levelArray,
            'amountOfPage' => $this->amountOfPage,
            'amountOfJudgementColumns' => $amountOfJudgementColumns,
        ]);
    }

    public function reloadJudgements() {
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
