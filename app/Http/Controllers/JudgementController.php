<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Judgement;

class JudgementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('judgement.judgement');
        //
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
        $level_score_array = [1,11,21,31,41,51];
        
        $judgement = new Judgement();
        $judgement->name = $request->input('name');
        $judgement->normal_day = $request->input('normal_day');
        $judgement->abnormal_day = $request->input('abnormal_day');
        $judgement->level = $level_score_array[ $request->input('level') ];
        $judgement->road = $request->input('road');
        $judgement->terrain = $request->input('terrain');
        $judgement->plant = $request->input('plant');
        $judgement->energy = $request->input('energy');
        $judgement->water = $request->input('water');
        $judgement->save();

        //$id = $judgement->id;
        
        return redirect()->route('judgement.index');
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
