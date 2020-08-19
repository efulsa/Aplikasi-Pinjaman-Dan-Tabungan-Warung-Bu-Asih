<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Borrow;
use App\Saving;
use Illuminate\View\Middleware\ShareErrorsFromSession;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $no = 1;
        $users = User::where('isAdmin','=','0')->count();
        $borrows = Auth::user()->borrow()->orderBy('created_at','desc')->first();
        $savings = Auth::user()->loan()->orderBy('created_at','desc')->first();
        
        $cust = Auth::user()->borrow()->orderBy('created_at','desc')->paginate(30);
        $total = Auth::user()->borrow()->orderBy('created_at','desc')->first();
        return view('users.index',compact('no','cust','total','borrows','savings'));
    }

    public function borrow(){
        $borrow = Auth::user()->borrow()->orderBy('created_at','desc')->paginate(30);
        $no=1;
        return view('users.borrow',compact('no','borrow'));
    }
    public function saving(){
        $saving = Auth::user()->loan()->orderBy('created_at','desc')->paginate(30);
        $no=1;
        return view('users.saving',compact('no','saving'));
    }
    public function edit($id){
        $cust = User::findOrFail($id);
        return view('users.edit',compact('cust'));
    }

    public function update(Request $request, $id){
       
        $check = User::where('id',"=",$id)->orderBy('email','desc')->first();
        $email = $request->input('email');
        
        // $validatedData = $request->validate([
        // 'email' => 'required|max:100|email','unique:users']);
      
        $cust = User::findOrFail($id);
        $cust->name = $request->get('name');
        
        if(!empty($email)){
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255','min:4'],
                'email' => ['sometimes','required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);
            $cust->email = $email;
            }else{
                $cust->email = $check->email;
            }
        $cust->password = \Hash::make($request->get('password'));
        $cust->work_place = $request->get('work_place');
        $cust->no_telp = $request->get('no_telp');
        $cust->address = $request->get('address');
        $cust->save();
        return redirect('user/dashboard')->with('success','Data Diri Berhasil di Ubah');
    }
}
