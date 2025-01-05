<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    /**
     * 列出所有的登入者個人裝備租借紀錄
     * @return Factory|View|Application
     */
    public function personalRentalRecord(): Factory|View|Application
    {
        $rentals = Rental::where('user_id', Auth::user()->id)->whereNotNull('rental_date')->orderby('created_at', 'desc')->get();
        $rentalEquipments = [];
        foreach($rentals as $rental)
            $rentalEquipments = $rental->rentalEquipment;
        return view('equipment.rentalList', compact('rentals', 'rentalEquipments'));
    }

    public function returnRental($rental_id): RedirectResponse
    {
        $rental = Rental::findOrFail($rental_id);
        $rental->actual_return_date = Carbon::now()->toDateString();
        $rental->update();
        foreach($rental->rentalEquipment as $rentalEquipment) {
            $rentalEquipment->equipment->status = 0;
            $rentalEquipment->equipment->update();
        }

        return redirect()->back()->with('status','裝備歸還成功');
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
        //
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
