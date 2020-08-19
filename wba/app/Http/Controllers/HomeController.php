<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('index');
    }
    
    public function check(Request $request)
    {
        $search = $request->get('search');
        if($search){
            $custs = User::where('name',"LIKE","%$search%")->paginate(100);
        }else{
        $custs = User::orderBy('name','asc')->paginate(100);
        }
        return view('welcome',compact('custs'));
    }


}
