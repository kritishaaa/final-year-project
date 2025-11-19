<?php

namespace Frontend\Courier\Parcel\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Courier\Models\Courier;
use Src\Parcel\Models\Parcel;
use Src\Parcel\Models\ParcelAssignment;


class ParcelController extends Controller
{

public function index(Request $request)
{
    

    return view('Courier.Parcel::parcels');
}


     function view(Request $request)
    {
        $parcel = Parcel::find($request->route('id'));
        $assignedCouriers = ParcelAssignment::with('courier.user')
        ->where('parcel_id', $parcel->id)
        ->get();
       
        return view('Courier.Parcel::show')->with(compact( 'parcel', 'assignedCouriers') );
    }


    public function assigned(Request $request)
    {
        $userId = auth()->id();
        $courier = Courier::where('user_id', $userId)->firstOrFail();

        $assignments = ParcelAssignment::with('parcel')
            ->where('courier_id', $courier->id)
            ->where('status', '!=', 'delivered') // Exclude delivered parcels
            ->get();

        return view('Courier.Parcel::assignments', compact('assignments'));
    }

    

      
}
