<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rental;
use App\Models\RentalEquipment;
use App\Models\Equipment;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $rentals = Rental::where('user_id', Auth::user()->id)->whereNotNull('rental_date')->orderby('created_at', 'desc')->get();
        $rentalEquipments = [];
        foreach($rentals as $rental)
            $rentalEquipments = $rental->rentalEquipment;  
        return view('equipment.rentalList', compact('rentals', 'rentalEquipments'));
    }
    
    public function showRental($rental_id)
    {        
        $rental = Rental::findOrFail($rental_id);
        $rentalEquipments = RentalEquipment::where('rental_id', '=' , $rental_id)->orderby('equipment_id', 'asc')->get();    

        return view('equipment.personalRental', compact('rental', 'rentalEquipments'));
       
    }

    public function addEquipment($equipment_id) 
    {
        $equipment = Equipment::findOrFail($equipment_id);
        $equipment->status = 1;
        $equipment->update();

        $name = $equipment->name;
        $rental = Rental::where('user_id', Auth::user()->id)->where('rental_date', null)->first();

        if(!$rental) {
            $rental = new Rental();
            $rental->user_id = Auth::user()->id;
            $rental->rental_amount = self::getPrice($equipment->member_price, $equipment->normal_price);
            $rental->save();
        }
        else {
            $rental->rental_amount += self::getPrice($equipment->member_price, $equipment->normal_price);
            $rental->update();
        }

        $rentalEquipment = new RentalEquipment();
        $rentalEquipment->equipment_id = $equipment_id;
        $rentalEquipment->rental_id = $rental->id;
        $rentalEquipment->save();

        session()->put('rental_id', $rental->id);
        // ->with('rental_id', $rental->id)

        return redirect()->route('equipment.index', $name)->with('status','裝備已新增至租借清單，請點擊下方按鈕查看');
    }

    //check the price is member or normal
    public function getPrice($member_price, $normal_price) {
        $amount = 0;
        if(Auth::user()->role >= 0) {
            $amount = $member_price;
        }
        else {
            $amount = $normal_price;
        }

        return $amount;
    }

    public function removeEquipment($rentalEquipment_id) {
        $rentalEquipment = RentalEquipment::findOrFail($rentalEquipment_id);
        $rental = $rentalEquipment->rental;
        $equipment =  $rentalEquipment->equipment;

        $rental->rental_amount -= self::getPrice($equipment->member_price, $equipment->normal_price);
        $rental->update();

        $equipment->status = 0;
        $equipment->update();

        $rentalEquipment->delete();
        
        if($rental->rental_amount == 0) {
            session()->forget('rental_id');
            return redirect()->route('equipment.select')->with('status','裝備取消租借成功，目前尚無租借，將您導回裝備租借頁面');
        }
        return redirect()->back()->with('status','裝備取消租借成功');
    }

    public function returnRental($rental_id) {
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
        $rental = Rental::findOrFail($id);
        $rental->rental_date = $request->input('rental_date');
        $rental->return_date = $request->input('return_date');
        $rental->update();
        session()->forget('rental_id');
        
        return redirect()->route('rental.index')->with('status','租借成功，請確認租借資訊');
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
