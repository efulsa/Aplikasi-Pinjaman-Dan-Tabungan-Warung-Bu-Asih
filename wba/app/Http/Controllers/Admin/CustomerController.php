<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Borrow;
use App\Saving;
use DB;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('admin'))
            return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $email = User::count('email');
        if($search){
            $custs = User::where('name',"LIKE","%$search%")->paginate(10);
        }else{
        $custs = User::orderBy('name','asc')->paginate(10);
        }
        $no = 1;
        return view('admins.customers.index',compact('no','custs','email'));
    }

    public function printBorrow()
    {
        $custs = User::orderBy('name','asc')->get();
        return view('admins.customers.printBorrow',compact('custs'));
    }
    public function printSaving()
    {
        $custs = User::orderBy('name','asc')->get();
        return view('admins.customers.printSaving',compact('custs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $no_telp = $request->input('no_telp');
        $address = $request->input('address');
        $work_place = $request->input('work_place');
        $cust = new User;
        $cust->name = $request->input('name');
        $cust->email = $request->input('email');
        $cust->password = \Hash::make($request->input('password'));
        if(!empty($no_telp)){
        $cust->no_telp = $no_telp;
        }else{
            $cust->no_telp = "+628000000";
        }
        if(!empty($address)){
            $cust->address = $address;
        }else{
            $cust->address = "...";
        }
        if(!empty($work_place)){
            $cust->work_place = $work_place;
        }else{
            $cust->work_place = "...";
        }
        $cust->save();
        return back()->with('success','Pelanggan Berhasil di Tambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $cust = User::findOrFail($id);
        // $borrow = Borrow::where('user_id',"=",$cust->id)->orderBy('created_at','desc')->paginate(30);
        // $no=1;
        // return view('admins.customers.show',compact('no','cust','borrow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $no_telp = $request->input('no_telp');
        $address = $request->input('address');
        $work_place = $request->input('work_place');
        $cust = User::findOrFail($id);
        $cust->name = $request->get('name');
        $cust->email = $request->get('email');
        $cust->password = \Hash::make($request->get('password'));
        if(!empty($no_telp)){
            $cust->no_telp = $no_telp;
            }else{
                $cust->no_telp = "+62XX XXX XXX XXX";
            }
            if(!empty($address)){
                $cust->address = $address;
            }else{
                $cust->address = "Cimahi";
            }
            if(!empty($work_place)){
                $cust->work_place = $work_place;
            }else{
                $cust->work_place = "PT.Belum Di Isi";
            }
        $cust->save();
        return back()->with('success','Pelanggan Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Borrow::where('user_id',"=",$id);
        $t = Saving::where('user_id',"=",$id);

        $check = User::findOrFail($id);

        $p->delete();
        $t->delete();
        $check->delete();
        return back()->with('success','Berhasil mengahapus Pelanggan !');
        // }else{
        //     return back()->with('borrow','Pelanggan masih punya Pinjaman !');
        // }

        // if(empty($check->loanSaldo)){
        //     $check->delete();
        //     return back()->with('success','Berhasil mengahapus Pelanggan !');
        // }else{
        //     return back()->with('saving','Pelanggan masih punya Tabungan !');
        // }
        
    }
    
}
