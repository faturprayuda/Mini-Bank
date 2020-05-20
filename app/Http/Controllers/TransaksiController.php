<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Rekening;
use App\Transaksi;
use App\AkunVirtual;
use Faker\Factory as Faker;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::all();

        return view('admin.transaksi.transaksi', ['transaksi' => $transaksi]);
    }

    public function infoVa()
    {
        $data_va = AkunVirtual::all();

        return view('admin.transaksi.transaksiVA', ['data_va' => $data_va]);
    }

    public function transfer()
    {
        return view('customers.va');
    }

    public function cekTransfer(Request $request)
    {
        $no_va = $request->va;

        $bill = AkunVirtual::select('total_pembayaran')->where('no_va', $no_va)->where('status', 'Belum Lunas')->sum('total_pembayaran');
        $bill = number_format((float) $bill, 0, '.', '');

        $nama = AkunVirtual::select('nama_user')->where('no_va', $no_va)->where('status', 'Belum Lunas')->get();
        $nama = $nama->first()->nama_user;

        $request->session()->put('no_va', $request->va);
        $request->session()->put('bill', $bill);

        return view(
            'customers.cekVA',
            [
                'nama' => $nama,
                'no_va' => $no_va,
                'bill'  => $bill,
            ]
        );
    }

    public function prosesTransfer(Request $request)
    {
        $bill = $request->session()->get('bill');
        $no_va = $request->session()->get('no_va');

        // dd([$bill, $no_va]);

        $full_name = $no_va;
        $name = explode('08', $full_name);
        if ($name[0] == '80588') {

            // proses penambahan dana orang yang di transfer

            $id = Rekening::findId($name[0]);

            $id = $id->id;

            $saldo = Rekening::where('id', $id)->get('saldo');

            $value = $saldo->first()->saldo;

            $total_saldo = $value + $bill;

            $customer = Rekening::find($id);
            $customer->saldo = $total_saldo;

            // proses pengurangan dana orang yang mentransfer
            // cari nama
            $name = Auth::user()->name;

            // cari id
            $id_tf = User::findId($name);

            $saldo_tf = Rekening::where('user_id', $id_tf->id)->get('saldo');

            $value_tf = $saldo_tf->first()->saldo;

            $total_saldo_tf = $value_tf - $bill;

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
                'status'            => 'Lunas',
                'total_transaksi'   => $bill,
                'action'            => 'Transfer VA',
                'tujuan_tf'         => '80588',
            ]);

            $customer_tf = Rekening::find($id_tf->id);
            $customer_tf->saldo = $total_saldo_tf;

            //log tf va

            $id_payment = AkunVirtual::select('id')->where('no_va', $no_va)->where('status', 'Belum Lunas')->get();

            $payments = AkunVirtual::find($id_payment);
            foreach ($payments as $key => $payment) {
                $payment->status = 'Lunas';
                $payment->save();
            }

            $customer_tf->save();
            $customer->save();


            return redirect('/home');
        } else {
            return redirect('/home');
        }
    }
}
