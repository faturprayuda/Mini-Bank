<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Transaksi;
use App\AkunVirtual;
use App\Transformers\UserTransformer;
use App\Transformers\VaTransformer;
use Auth;

class APIController extends Controller
{
    public function customerAPI(User $user)
    {
        $users = $user->all();
        // return response()->json($users);

        return fractal()
            ->collection($users)
            ->transformWith(new UserTransformer)
            ->toArray();
    }

    public function register(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => ['required', 'string', 'max:255'],
            'address'   => ['required', 'string', 'max:255'],
            'phone'     => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'address'        => $request->address,
            'no_phone'       => $request->phone,
            'remember_token' => bcrypt($request->email)
        ]);

        $response = fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->remember_token
            ])
            ->toArray();

        return response()->json($response, 201);
    }

    public function login(Request $request, User $user)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'Your Credential is not Valid'], 401);
        }

        $user = $user->find(Auth::user()->id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->remember_token
            ])
            ->toArray();
    }


    // controller transaksi

    public function cekTransaksi(Transaksi $transaksi)
    {
        $transaksis = $transaksi->all();
        return response()->json($transaksis);
    }

    public function tagihanTransaksi(Request $request, AkunVirtual $va)
    {

        $this->validate($request, [
            'nama_user'          => ['required'],
            'no_va'             => ['required'],
            'total_pembayaran'  => ['required']
        ]);

        $va = $va->create([
            'nama_user'         => $request->nama_user,
            'no_va'             => $request->no_va,
            'total_pembayaran'  => $request->total_pembayaran,
            'status'            => 'Belum Lunas',
        ]);

        $response = fractal()
            ->item($va)
            ->transformWith(new VaTransformer)
            ->toArray();

        return response()->json($response, 201);
    }
}
