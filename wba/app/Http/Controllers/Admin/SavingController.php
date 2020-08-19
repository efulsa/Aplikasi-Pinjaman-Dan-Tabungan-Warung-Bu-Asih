<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Saving;
use Auth;
use Illuminate\Support\Facades\Gate;

class SavingController extends Controller
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
        $savings = Saving::orderBy('created_at','desc')->paginate(10);
        $saving = saving::orderBy('created_at','desc')->paginate(1);
        return view('admins.savings.index',compact('custs','saving','savings'));
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

        $getTotal = Saving::orderBy('created_at','desc')->first();
        
        $saving = new Saving();
        if($type == '1'){
            
            $saving->desc = "Setor";
            $saving->user_id = $request->input('user_id');
            $saldo = Saving::where('user_id',"=","$saving->user_id")->orderBy('created_at','desc')->first();
            $saving->debit = str_replace(".","",$bill);
            if(!empty($saldo->saldo)){
                $saving->saldo = $saldo->saldo + $saving->debit;
            }else{
                $saving->saldo = 0 + $saving->debit;
            }
            if(!empty($getTotal->total)){
                $saving->total = $getTotal->total + $saving->debit;
            }else{
                $saving->total = 0 + $saving->debit;
            }

        }else{
            $saving->desc = "Tarik";
            $saving->user_id = $request->input('user_id');
            $saldo = Saving::where('user_id',"=","$saving->user_id")->orderBy('created_at','desc')->first();
            $saving->credit = str_replace(".","",$bill);
            if(empty($saldo->saldo)){
                return back()->with('error','Saldo Tabungan Sudah Habis !');
            }elseif($saldo->saldo < $saving->credit){
                $bill_back = $saldo->saldo;

                $custs = User::orderBy('name','asc')->get();
                $savings = saving::orderBy('created_at','desc')->paginate(10);
                $saving = saving::orderBy('created_at','desc')->paginate(1);
                return view('admins.savings.index',compact('custs','saving','savings','bill_back'));
            }else{

            $saving->saldo = $saldo->saldo - $saving->credit;
            $saving->total = $getTotal->total - $saving->credit;
            
            }
        }
        $saving->save();
                if($type == '1'){
                    return back()->with('setor','Transaksi Setor Berhasil !');
                }else{
            return back()->with('tarik','Transaksi Tarik Berhasil !');
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
        $saving = Saving::where('user_id',"=",$cust->id)->orderBy('created_at','desc')->paginate(30);
        $no=1;
        return view('admins.savings.show',compact('no','cust','saving'));
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
