<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Borrow;
use App\Saving;
use DB;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('admin'))
            return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    public function index(){
        $users = User::where('isAdmin','=','0')->count();
        $borrows = Borrow::orderBy('created_at','desc')->first();
        $savings = Saving::orderBy('created_at','desc')->first();
        return view('admins.index',compact('users','borrows','savings'));
    }
}
