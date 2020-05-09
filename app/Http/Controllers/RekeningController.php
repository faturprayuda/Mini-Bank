<?php

namespace App\Http\Controllers;

use App\Rekening;
use App\User;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekening = Rekening::all();
        $user = User::all();
        return view('admin.rekening.rekening', [
            'rekening' => $rekening,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $this->validate($request, [
            'rekening' => 'required',
            'pin' => 'min:6|required',
            'saldo' => 'required',
        ]);

        $name = $request->name;
        if (User::findId($name)) {
            $user = User::findId($name);
            $id = $user->id;
        } else {
            return redirect()->back();
        }

        Rekening::create([
            'user_id' => $id,
            'no_rekening' => $request->rekening,
            'pin' => $request->pin,
            'saldo' => $request->saldo,
        ]);

        return redirect('/admin/rekening');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rekening = Rekening::find($id);
        return view('admin.rekening.ubahRekening', ['rekening' => $rekening]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'pin' => 'min:6|required',
            'saldo' => 'required',
        ]);


        $rekening = Rekening::find($id);
        $rekening->pin = $request->pin;
        $rekening->saldo = $request->saldo;
        $rekening->save();
        return redirect('/admin/rekening');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Rekening::find($id);
        $user->delete();

        return redirect('/admin/rekening');
    }
}
