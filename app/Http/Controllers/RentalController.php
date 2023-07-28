<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rental;
use App\Models\RentalEquipment;
use App\Models\Equipment;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $rentals = Rental::orderby('created_at', 'desc');

        return view('equipment.rental', compact('rentals'));
    }

    public function addEquipment($equipment_id) 
    {
        $equipment = Equipment::findOrFail($equipment_id);
        $equipment->status = 1;
        $equipment->update();

        $rental = Rental::where('user_id', Auth::user()->id)->first();

        if(!$rental) {
            $rental = new Rental();
            $rental->user_id = Auth::user()->id;
            if(Auth::user()->role >= 0) {
                $rental->rental_amount = $equipment->member_price;
            }
            else {
                $rental->rental_amount = $equipment->normal_price;
            }
            $rental->save();
        }

        $rentalEquipment = new RentalEquipment();
        $rentalEquipment->equipment_id = $equipment_id;
        $rentalEquipment->rental_id = $rental->id;
        $rentalEquipment->save();

        return redirect()->route('equipment.index');
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
