<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Borrow;
use DB;
use Illuminate\Support\Facades\Gate;

class BorrowController extends Controller
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
    public function index()
    {
        $custs = User::orderBy('name','asc')->get();
        $borrows = Borrow::orderBy('created_at','desc')->paginate(10);
        $borrow = Borrow::orderBy('created_at','desc')->paginate(1);
        return view('admins.borrowers.index',compact('custs','borrows','borrow'));
    }
    public function printBorrow()
    {
        $custs = User::orderBy('name','asc');
        return view('admins.borrowers.printBorrow',compact('custs'));
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
        $type = $request->input('type');
        $user_id = $request->input('user_id');
        $bill = $request->input('bill_amount');
        
        $getTotal = Borrow::orderBy('created_at','desc')->first();
        
        $borrow = new Borrow();
        if($type == '1'){
            
            $borrow->desc = "Pinjam";
            $borrow->user_id = $request->input('user_id');
            $saldo = Borrow::where('user_id',"=","$borrow->user_id")->orderBy('created_at','desc')->first();
            $borrow->debit = str_replace(".","",$bill);
            if(!empty($saldo->saldo)){
                $borrow->saldo = $saldo->saldo + $borrow->debit;
            }else{
                $borrow->saldo = 0 + $borrow->debit;
            }
            if(!empty($getTotal->total)){
                $borrow->total = $getTotal->total + $borrow->debit;
            }else{
                $borrow->total = 0 + $borrow->debit;
            }

        }else{
            $borrow->desc = "Bayar";
            $borrow->user_id = $request->input('user_id');
            $saldo = Borrow::where('user_id',"=","$borrow->user_id")->orderBy('created_at','desc')->first();
            $borrow->credit = str_replace(".","",$bill);
            if(empty($saldo->saldo)){
                
                return back()->with('error','Pelanggan Tidak Punya Pinjaman !');
            }elseif($saldo->saldo < $borrow->credit){
                $bill_back = $borrow->credit - $saldo->saldo;
                $borrow->bill_back = $bill_back;
                $borrow->total = $getTotal->total - $saldo->saldo;
                $borrow->saldo = 0;
                $borrow->save();
                
                $custs = User::orderBy('name','asc')->get();
                $borrows = Borrow::orderBy('created_at','desc')->paginate(10);
                $borrow = Borrow::orderBy('created_at','desc')->paginate(1);
                return view('admins.borrowers.index',compact('custs','borrows','borrow','bill_back'));
            }else{

            $borrow->saldo = $saldo->saldo - $borrow->credit;
            $borrow->total = $getTotal->total - $borrow->credit;
            
            }
        }
        $borrow->save();
                if($type == '1'){
                    return back()->with('pinjam','Transaksi Pinjam Berhasil !');
                }else{
            return back()->with('bayar','Transaksi Bayar Berhasil !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cust = User::findOrFail($id);
        $borrow = Borrow::where('user_id',"=",$cust->id)->orderBy('created_at','desc')->paginate(30);
        $no=1;
        return view('admins.borrowers.show',compact('no','cust','borrow'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
