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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('judgement.edit', compact('id'));
    }

    /**
     * 顯示隊伍評分紀錄表
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function record()
    {
        return view('judgement.record');
    }

    /**
     * 顯示評分紀錄規則
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function rule()
    {
        return view('judgement.rule');
    }

    /**
     * 顯示評分紀錄規則
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function pointRule()
    {
        return view('judgement.pointRule');
    }

}
