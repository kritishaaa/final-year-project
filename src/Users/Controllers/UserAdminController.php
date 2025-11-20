<?php

namespace Src\Users\Controllers;

use App\Enums\Action;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserAdminController extends Controller
{
    

    function index(Request $request)
    {
        return view('Users::index');
    }

    function create(Request $request)
    {
        $action = Action::CREATE;
        
        return view('Users::form')->with(compact('action'));
    }

    function edit(Request $request)
    {
        $user = User::find($request->route('id'));
        $action = Action::UPDATE;
       
        return view('Users::form')->with(compact('action', 'user'));
    }
}
