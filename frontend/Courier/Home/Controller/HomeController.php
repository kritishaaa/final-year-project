<?php

namespace Frontend\Courier\Home\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Parcel\Models\Parcel;
use Src\Parcel\Models\ParcelAssignment;
use Src\Parcel\Models\ParcelTrack;


class HomeController extends Controller
{

    public function index(Request $request)
    {
        
        return view('Courier.Home::home');
        // }
    }

    public function home(Request $request)
    {
        
        return view('Courier.Home::home');
    }   

  public function search($code)
    {
        $parcel = Parcel::where('tracking_code', $code)->first();

        if (!$parcel) {
            return view('Courier.Home::nofound', ['code' => $code]);
        }

        $assignedCouriers = ParcelAssignment::with('courier.user')
            ->where('parcel_id', $parcel->id)
            ->get();

        $parcelTracks = ParcelTrack::where('parcel_id', $parcel->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Courier.Home::track', compact('parcel', 'assignedCouriers', 'parcelTracks'));
    }

    

      
}
