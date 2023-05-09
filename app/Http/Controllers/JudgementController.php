<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Judgement;
use Illuminate\Support\Facades\Schema;
class JudgementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judgements = Judgement::orderBy('id','desc')->get();
        $judgements_column_name = Schema::getColumnListing('judgements');
        $judgements_column_number = count($judgements_column_name);
        $level_array = ["一", "二", "三a", "三b", "四a", "四b"];
        return view('judgement.judgement')->with(compact('judgements', 'level_array', 'judgements_column_number'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $normal_day = $request->input('normal_day');
        $abnormal_day = $request->input('abnormal_day');
        $level = $request->input('level');
        $road = $request->input('road');
        $terrain = $request->input('terrain');
        $plant = $request->input('plant');
        $energy = $request->input('energy');
        $water = $request->input('water');

        $day_score = self::caculateDay($normal_day, $abnormal_day);
        $level_score = self::caculateLevel($level, $road, $terrain, $plant);
        $energy_score = self::caculateEnergy($energy, $water);
        $total_score = $day_score + $level_score + $energy_score;
        $result_level = self::caculateRank($total_score);
    
        $judgement = new Judgement();
        $judgement->name = $request->input('name');
        $judgement->normal_day = $normal_day;
        $judgement->abnormal_day = $abnormal_day;
        $judgement->level = $level;
        $judgement->road = $road;
        $judgement->terrain = $terrain;
        $judgement->plant = $plant;
        $judgement->energy = $energy;
        $judgement->water = $water;
        $judgement->score = $total_score;
        $judgement->result_level = $result_level;
        $judgement->save();
        return redirect()->route('judgement.index');

    }

    public function caculateDay($normal_day, $abnormal_day){
        $score = 0;
        $maxAbnormalIndex = 9;
        $abnormalScore = [0, 10, 15, 20, 25, 30, 35, 40, 45, 50];
    
        if($normal_day == 1)
            $score = 5;
        else if($normal_day >= 2 && $normal_day <= 3)
            $score = 10;
        else if($normal_day >= 4 && $normal_day <= 5)
            $score = 15;
        else if($normal_day >= 6 && $normal_day <= 8)
            $score = 20;
        else if($normal_day >= 9)
            $score = 25;
        if($abnormal_day <= 9)    
            $score += $abnormalScore[$abnormal_day];
        else
            $score += $abnormalScore[$maxAbnormalIndex];
        return $score;
    }

    public function caculateLevel($level, $road, $terrain, $plant) {
        $score = 0;
        $level_score_array = [1, 11, 21, 26, 31, 36];
        $score = ($level_score_array[$level] + ($road * 0.3 + $terrain * 0.4 + $plant * 0.3) * 2 ) * 1.5;
        return $score;
    }

    public function caculateEnergy($energy, $water){
        $score = $energy * 7 + $water * 2;
        return $score;
    }

    public function caculateRank($score){
        $rank = "";
        if($score < 40)
            $rank = "D";
        else if($score >= 40 && $score < 60)
            $rank = "C";
        else if($score >= 60 && $score < 80)
            $rank = "B";
        else if($score >= 80 && $score < 100)
            $rank = "A";
        else if($score >= 100 && $score < 120)
            $rank = "S";
        else if($score >= 120)
            $rank = "S+";
        return $rank;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
