<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Faker\Factory as Faker;
use App\Transaksi;
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
        // proses penambahan dana orang yang di transfer
        $norek = $request->session()->get('norek');
        $nominal = $request->session()->get('nominal');

        $id = Rekening::findId($norek);

        $saldo = Rekening::where('user_id', $id->id)->get('saldo');

        $value = $saldo->first()->saldo;

        $total_saldo = $value + $nominal;

        $customer = Rekening::find($id->id);
        $customer->saldo = $total_saldo;

        // proses pengurangan dana orang yang mentransfer
        // cari nama
        $name = Auth::user()->name;

        // cari id
        $id_tf = User::findId($name);

        $saldo_tf = Rekening::where('user_id', $id_tf->id)->get('saldo');

        $value_tf = $saldo_tf->first()->saldo;

        $total_saldo_tf = $value_tf - $nominal;

        //log transaksi
        $norek_tf = Rekening::where('user_id', $id_tf->id)->get('no_rekening')->first()->no_rekening;
        $id_norek = Rekening::findId($norek_tf);
        $faker = Faker::create('id_ID');
        $no_rekening = $faker->numberBetween(1000, 5000);
        $date = $faker->dateTimeBetween('now', 'now', 'Asia/Jakarta');

        $transaksi = Transaksi::create([
            'id_rekening'       => $id_norek->id,
            'no_transaksi'      => $no_rekening,
            'date_transaksi'    => $date,
            'total_transaksi'   => $nominal,
            'action'            => 'Transfer',
            'tujuan_tf'         => $norek,
        ]);

        $customer_tf = Rekening::find($id_tf->id);
        $customer_tf->saldo = $total_saldo_tf;
        $customer_tf->save();
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

        //log transaksi
        $norek = Rekening::where('user_id', $id->id)->get('no_rekening')->first()->no_rekening;
        $id_norek = Rekening::findId($norek);
        $faker = Faker::create('id_ID');
        $no_rekening = $faker->numberBetween(1000, 5000);
        $date = $faker->dateTimeBetween('now', 'now', 'Asia/Jakarta');

        $transaksi = Transaksi::create([
            'id_rekening'       => $id_norek->id,
            'no_transaksi'      => $no_rekening,
            'date_transaksi'    => $date,
            'total_transaksi'   => $nominal,
            'action'            => 'Tarik Tunai',
        ]);

        // input saldo
        $customer = Rekening::find($id->id);
        $customer->saldo = $total_saldo;
        $customer->save();


        return redirect('/home');
    }

    public function setor()
    {
        return view('customers.setor');
    }

    public function prosesSetor(Request $request)
    {
        // cari nama
        $name = Auth::user()->name;

        // cari id
        $id = User::findId($name);

        $nominal = $request->nominal;

        $saldo = Rekening::where('user_id', $id->id)->get('saldo');

        $value = $saldo->first()->saldo;

        $total_saldo = $value + $nominal;

        //log transaksi
        $norek = Rekening::where('user_id', $id->id)->get('no_rekening')->first()->no_rekening;
        $id_norek = Rekening::findId($norek);
        $faker = Faker::create('id_ID');
        $no_rekening = $faker->numberBetween(1000, 5000);
        $date = $faker->dateTimeBetween('now', 'now', 'Asia/Jakarta');

        $transaksi = Transaksi::create([
            'id_rekening'       => $id_norek->id,
            'no_transaksi'      => $no_rekening,
            'date_transaksi'    => $date,
            'total_transaksi'   => $nominal,
            'action'            => 'Setor Tunai',
        ]);

        // input saldo
        $customer = Rekening::find($id->id);
        $customer->saldo = $total_saldo;
        $customer->save();
        return redirect('/home');
    }
}
