<?php

namespace Src\Parcel\Controllers;

use App\Enums\Action;
use App\Http\Controllers\Controller;
use Src\Parcel\Models\Parcel;
use Illuminate\Http\Request;
use Src\Parcel\Models\ParcelAssignment;

class ParcelAdminController extends Controller
{
    

    function index(Request $request)
    {
        return view('Parcel::index');
    }

    function create(Request $request)
    {
        $action = Action::CREATE;
        
        return view('Parcel::form')->with(compact('action'));
    }

    function edit(Request $request)
    {
        $parcel = Parcel::find($request->route('id'));
        $action = Action::UPDATE;
       
        return view('Parcel::form')->with(compact('action', 'parcel') );
    }
    function view(Request $request)
    {
        $parcel = Parcel::find($request->route('id'));
        $assignedCouriers = ParcelAssignment::with('courier.user')
        ->where('parcel_id', $parcel->id)
        ->get();
       
        return view('Parcel::show')->with(compact( 'parcel', 'assignedCouriers') );
    }
}
