<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{

   
    public function __invoke()
    {
        
        // dd('etaa samma ta ayo hai ');

        return view('admin.dashboard');
    }

    

      
}
