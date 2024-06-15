<?php

namespace App\Http\Livewire\JudgementComponent;

use App\Models\Judgement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    const DEFAULT_STRING = '';
    const DEFAULT_SELECT = '';
    const DEFAULT_INTEGER = 0;
    public $judgementId;
    public $mode; // create or edit

    public $name = self::DEFAULT_STRING;
    public $normal_day = self::DEFAULT_SELECT;
    public $abnormal_day = self::DEFAULT_SELECT;
    public $trip_tag = self::DEFAULT_INTEGER;
    public $level = self::DEFAULT_SELECT;
    public $road = self::DEFAULT_SELECT;
    public $terrain = self::DEFAULT_SELECT;
    public $plant = self::DEFAULT_SELECT;
    public $energy = self::DEFAULT_SELECT;
    public $water = self::DEFAULT_INTEGER;
    public $totalScore = self::DEFAULT_INTEGER;
    public $resultLevel = self::DEFAULT_STRING;
    public $resultMessage = self::DEFAULT_STRING;

    public $status;

    protected $rules = [
        'name' => 'required|string',
        'normal_day' => 'required|integer|min:0',
        'abnormal_day' => 'required|integer|min:0',
        'trip_tag' => 'required|in:0,1,2',
        'level' => 'required|in:0,1,2,3,4,5',
        'road' => 'required|integer|min:0|max:10',
        'terrain' => 'required|integer|min:0|max:10',
        'plant' => 'required|integer|min:0|max:10',
        'energy' => 'required|integer|min:0|max:4',
        'water' => 'required|integer|min:0',
    ];

    protected $messages = [
        'name.required' => '請填寫路線名稱',
        'normal_day.required' => '請輸入傳統路天數',
        'normal_day.integer' => '傳統路天數必須是數字',
        'normal_day.min' => '傳統路天數不得小於0',
        'abnormal_day.required' => '請輸入非傳統路天數',
        'abnormal_day.integer' => '非傳統路天數必須是數字',
        'abnormal_day.min' => '非傳統路天數不得小於0',
        'trip_tag.required' => '請選擇行程',
        'trip_tag.in' => '行程選擇不正確',
        'level.required' => '請選擇路況分級',
        'level.in' => '路況分級選擇不正確',
        'road.required' => '請選擇路跡級別',
        'road.integer' => '路跡級別必須是數字',
        'road.min' => '路跡級別不得小於1',
        'road.max' => '路跡級別不得大於10',
        'terrain.required' => '請選擇地形級別',
        'terrain.integer' => '地形級別必須是數字',
        'terrain.min' => '地形級別不得小於1',
        'terrain.max' => '地形級別不得大於10',
        'plant.required' => '請選擇植被級別',
        'plant.integer' => '植被級別必須是數字',
        'plant.min' => '植被級別不得小於1',
        'plant.max' => '植被級別不得大於10',
        'energy.required' => '請選擇體力級別',
        'energy.integer' => '體力級別必須是數字',
        'energy.min' => '體力級別不得小於1',
        'energy.max' => '體力級別不得大於4',
        'water.required' => '請輸入多背水天數',
        'water.integer' => '多背水天數必須是數字',
        'water.min' => '多背水天數不得小於0',
    ];

    public function mount($mode)
    {
        $this->mode = $mode;
        if ($this->mode == 'edit') {

            $judgement = Judgement::findOrFail($this->judgementId);
            $this->name = $judgement->name;
            $this->normal_day = $judgement->normal_day;
            $this->abnormal_day = $judgement->abnormal_day;
            $this->trip_tag = $judgement->trip_tag;
            $this->level = $judgement->level;
            $this->road = $judgement->road;
            $this->terrain = $judgement->terrain;
            $this->plant = $judgement->plant;
            $this->energy = $judgement->energy;
            $this->water = $judgement->water;
        }
    }

    public function submit()
    {
        $this->validate();
        if (!$this->validateDay()) {
            return;
        }

        $judgement = new Judgement();
        $judgement->name = $this->name;
        $judgement->normal_day = $this->normal_day;
        $judgement->abnormal_day = $this->abnormal_day;
        $judgement->trip_tag = $this->trip_tag;
        $judgement->level = $this->level;
        $judgement->road = $this->road;
        $judgement->terrain = $this->terrain;
        $judgement->plant = $this->plant;
        $judgement->energy = $this->energy;
        $judgement->water = $this->water;
        $judgement->score = $this->totalScore;
        $judgement->result_level = $this->resultLevel;
        $judgement->modify_user = Auth::id();
        if ($this->mode == 'edit') {
            $judgement->update();
            return redirect()->route('judgement.index')->with('status','評分紀錄更新成功');
        }
        $judgement->create_user = Auth::id();
        $judgement->save();
        $this->emitTo('judgement-component.page', 'reloadJudgements');
        session()->flash('status', '評分結果儲存成功');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.judgement-component.form');
    }

    public function calculate()
    {
        $this->validate();
        if (!$this->validateDay()) {
            return;
        }

        $levelScore = $this->calculateLevel($this->level, $this->road, $this->terrain, $this->plant);
        $dayScore = $this->calculateDay($this->normal_day, $this->abnormal_day);
        $energyScore = $this->calculateEnergy($this->energy, $this->water);
        $score = $levelScore + $dayScore + $energyScore;
        $this->totalScore = $this->calculateTripTag($score, $this->trip_tag);
        $this->resultLevel = $this->calculateRank($this->totalScore);
        $this->resultMessage = "路線名稱：{$this->name}<br>路況分數：{$levelScore}<br>天數分數：{$dayScore}<br>體力分數：{$energyScore}<br>總分：{$this->totalScore}<br>難度等級：{$this->resultLevel}";
    }

    /**
     * 驗證總天數是否大於 0 是則回傳 true，反之則回傳 false
     * @return bool
     */
    private function validateDay(): bool
    {
        if (($this->normal_day + $this->abnormal_day) <= 0) {
            $this->addError('normal_day', '傳統路天數和非傳統路天數之和必須大於 0。');
            $this->addError('abnormal_day', '傳統路天數和非傳統路天數之和必須大於 0。');
            return false;
        }
        return true;
    }

    private function calculateDay($normal_day, $abnormal_day): int
    {
        $score = 0;
        $maxAbnormalIndex = 9;
        $abnormalScore = [0, 10, 15, 20, 25, 30, 35, 40, 45, 50];

        if ($normal_day == 1)
            $score = 5;
        else if ($normal_day >= 2 && $normal_day <= 3)
            $score = 10;
        else if ($normal_day >= 4 && $normal_day <= 5)
            $score = 15;
        else if ($normal_day >= 6 && $normal_day <= 8)
            $score = 20;
        else if ($normal_day >= 9)
            $score = 25;
        if ($abnormal_day <= $maxAbnormalIndex)
            $score += $abnormalScore[$abnormal_day];
        else
            $score += $abnormalScore[$maxAbnormalIndex];
        return $score;
    }

    private function calculateLevel($level, $road, $terrain, $plant): float
    {
        $levelScoreArray = [1, 11, 21, 26, 31, 36];
        $score = ($levelScoreArray[$level] + ($road * 0.3 + $terrain * 0.4 + $plant * 0.3) * 2) * 1.5;
        return round($score);
    }

    private function calculateEnergy($energy, $water)
    {
        return $energy * 7 + $water * 2;
    }

    /**
     * <pre>
     * - 0-39: "D"
     * - 40-44: "C-"
     * - 45-54: "C"
     * - 55-59: "C+"
     * - 60-64: "B-"
     * - 65-74: "B"
     * - 75-79: "B+"
     * - 80-84: "A-"
     * - 85-94: "A"
     * - 95-99: "A+"
     * - 100-104: "S-"
     * - 105-114: "S"
     * - 115-119: "S+"
     * - 120 and above: "SSS"
     * </pre>
     *
     * @param $score
     * @return string
     */
    private function calculateRank(int $score): string
    {
        if ($score < 40) {
            return "D";
        } elseif ($score < 45) {
            return "C-";
        } elseif ($score < 55) {
            return "C";
        } elseif ($score < 60) {
            return "C+";
        } elseif ($score < 65) {
            return "B-";
        } elseif ($score < 75) {
            return "B";
        } elseif ($score < 80) {
            return "B+";
        } elseif ($score < 85) {
            return "A-";
        } elseif ($score < 95) {
            return "A";
        } elseif ($score < 100) {
            return "A+";
        } elseif ($score < 105) {
            return "S-";
        } elseif ($score < 115) {
            return "S";
        } elseif ($score < 120) {
            return "S+";
        } else {
            return "SSS";
        }
    }

    private function calculateTripTag($score, $trip_tag): float
    {
        if ($trip_tag == 1) $score *= 1.1;
        if ($trip_tag == 2) $score *= 0.9;
        return round($score);
    }
}
