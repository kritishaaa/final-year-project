<?php

namespace Src\Branch\Controllers;

use App\Enums\Action;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BranchAdminController extends Controller
{
    

    function index(Request $request)
    {
        return view('Branch::index');
    }

    function create(Request $request)
    {
        $action = Action::CREATE;
        
        return view('Branch::form')->with(compact('action'));
    }

    function edit(Request $request)
    {
        $user = User::find($request->route('id'));
        $action = Action::UPDATE;
       
        return view('Branch::form')->with(compact('action'));
    }
}
