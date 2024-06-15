<?php

namespace App\Http\Livewire\JudgementComponent;

use App\Models\Judgement;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class JudgementPage extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $amountOfPage = 10;
        $levelArray = ["一", "二", "三a", "三b", "四a", "四b"];
        $judgementData = Judgement::orderBy('id', 'desc')->paginate($amountOfPage);
        $judgementsColumnName = Schema::getColumnListing('judgements');
        $amountOfJudgementColumns = count($judgementsColumnName);

        return view('livewire.table', [
            'judgements' => $judgementData,
            'levelArray' => $levelArray,
            'amountOfPage' => $amountOfPage,
            'amountOfJudgementColumns' => $amountOfJudgementColumns,
        ]);
    }
}
