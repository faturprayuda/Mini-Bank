<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Rekening;
use App\User;
use Auth;

class UserController extends Controller
{
    public function info()
    {
        // cari nama
        $name = Auth::user()->name;

        // cari id
        $id = User::findId($name);

        $rekening = Rekening::find($id);
        return view('customers.info', ['rekening' => $rekening]);
    }

    public function transfer()
    {
        return view('customers.transfer');
    }

    public function cekTransfer(Request $request)
    {
        $request->session()->put('norek', $request->norek);
        $request->session()->put('nominal', $request->nominal);
        $norek = $request->norek;
        $nominal = $request->nominal;

        $id = Rekening::findId($norek);

        $rekening = Rekening::find($id);

        // return redirect('')->withInput();

        return view(
            'customers.cekTransfer',
            [
                'norek' => $norek,
                'nominal' => $nominal,
                'rekening' => $rekening,
            ]
        );
    }

    public function prosesTransfer(Request $request)
    {
        $norek = $request->session()->get('norek');
        $nominal = $request->session()->get('nominal');

        $id = Rekening::findId($norek);

        $saldo = Rekening::where('user_id', $id->id)->get('saldo');

        $value = $saldo->first()->saldo;

        $total_saldo = $value + $nominal;

        $customer = Rekening::find($id->id);
        $customer->saldo = $total_saldo;
        $customer->save();
        return redirect('/home');
    }

    public function tarik()
    {
        return view('customers.tarik');
    }

    public function prosesTarik(Request $request)
    {
        // cari nama
        $name = Auth::user()->name;

        // cari id
        $id = User::findId($name);

        $nominal = $request->nominal;

        $saldo = Rekening::where('user_id', $id->id)->get('saldo');

        $value = $saldo->first()->saldo;

        $total_saldo = $value - $nominal;

        $customer = Rekening::find($id->id);
        $customer->saldo = $total_saldo;
        $customer->save();
        return redirect('/home');
    }
}
