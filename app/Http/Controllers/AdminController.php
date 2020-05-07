<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    // menampilkan data user
    public function indexCustomer()
    {
        $user = User::all();
        return view('admin.customer', ['user' => $user]);
    }

    // edit data customer
    public function EditCustomer($id)
    {
        $user = User::find($id);
        return view('admin.ubahCustomer', ['user' => $user]);
    }

    public function updateCustomer($id, Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->no_phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/admin/customer');
    }

    public function hapusCustomer($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/admin/customer');
    }
}
