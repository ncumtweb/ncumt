<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Judgement;
use Illuminate\Support\Facades\Schema;
class JudgementController extends Controller
{
    /**
     * 顯示隊伍評分紀錄首頁
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judgements_column_name = Schema::getColumnListing('judgements');
        $judgements_column_number = count($judgements_column_name);
        $level_array = ["一", "二", "三a", "三b", "四a", "四b"];
        return view('judgement.index')->with(compact('level_array', 'judgements_column_number'));
    }

    /**
     * 顯示隊伍評分編輯頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('judgement.edit', compact('id'));
    }
}
