<?php

namespace Src\Courier\Controllers;

use App\Enums\Action;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CourierAdminController extends Controller
{
    

    function index(Request $request)
    {
        return view('Courier::index');
    }

    function create(Request $request)
    {
        $action = Action::CREATE;
        
        return view('Courier::form')->with(compact('action'));
    }

    function edit(Request $request)
    {
        $user = User::find($request->route('id'));
        $action = Action::UPDATE;
       
        return view('Courier::form')->with(compact('action'));
    }
}
