<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Pelanggan;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    function index()
    {
        $title = 'Data Pelanggan';
        $pelanggan = Pelanggan::all();
        return view('backend.pelanggan_index', compact('pelanggan', 'title'));
    }
    function edit($id)
    {
        $pelanggan = Pelanggan::find($id);

        $title = 'Edit Pelanggan';
        return view('backend.pelanggan_edit', compact('pelanggan', 'title'));
    }
    function update(Request $request): RedirectResponse
    {

        //Validasi
        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'no_telp' => 'required',
            'alamat_jalan' => 'required',
        ]);
        $pelanggan_id = $request->pelanggan_id;
        if (Session::get('type') == 'admin') {
            $pelanggan = Pelanggan::find($pelanggan_id);
            // dd('here');
            $userdata = $request->validate([
                'email' => ['required', Rule::unique('user', 'email')->ignore($pelanggan->user->user_id, 'user_id')]
            ]);


            $user = User::find($pelanggan->user->user_id);
            $user->update($userdata);
        }
        if (Session::get('type') == 'pelanggan') {

            $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
            $userdata = $request->validate([
                'email' => ['required', Rule::unique('user', 'email')->ignore(Session::get('user_id'), 'user_id')],
                // 'user_password' => 'required|confirmed:password_confirmation',
                // 'password_confirmation' => 'required'
            ]);
            // unset($userdata['password_confirmation']);
            // $userdata['user_password'] = Hash::make($userdata['user_password']);

            $user = User::find($pelanggan->user->user_id);
            $user->update($userdata);
        }
        // $pelanggan = Pelanggan::find($pelanggan_id);
        $pelanggan->update($validated);


        return redirect(route('front.profil'));
    }
}
