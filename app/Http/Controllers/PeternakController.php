<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Peternak;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class PeternakController extends Controller
{
    function index()
    {
        $title = 'Peternak';
        if (Session::get('type') == 'admin') {
            $peternak = Peternak::all();
            $kecamatan = Kecamatan::all();
            $user = User::where('email', Session::get('email'))->first();
        }
        if (Session::get('type') == 'operator') {
            $user = User::where('email', Session::get('email'))->first();
            $peternak = Peternak::where('kecamatan_id', $user->operator->kecamatan_id)->get();
            $kecamatan = [];
        }
        return view('backend.peternak', compact('peternak', 'title', 'kecamatan'));
    }
    function view($id)
    {
        $peternak = Peternak::find($id);
        $title = 'Detail Peternak';
        return view('backend.peternak_detail', compact('peternak', 'title'));
    }
    function edit($id)
    {
        $peternak = Peternak::find($id);
        if (Session::get('type') == 'admin') {
            $kecamatan = Kecamatan::all();
        } else {
            $kecamatan = null;
        }
        $title = 'Detail Peternak';
        return view('backend.peternak_edit', compact('peternak', 'title', 'kecamatan'));
    }
    function tambah()
    {
        // $peternak = Peternak::find($id);
        $title = 'Tambah Peternak';
        $kecamatan = Kecamatan::all();
        return view('backend.peternak_tambah', compact('title', 'kecamatan'));
    }
    function update(Request $request): RedirectResponse
    {

        //Validasi
        if (Session::get('type') == 'admin') {
            $validated = $request->validate([
                'peternak_nama' => 'required',
                'peternak_hp' => 'required',
                'peternak_jk' => 'required',
                'peternak_tempatlahir' => 'required',
                'peternak_tgllahir' => 'required',
                'kecamatan_id' => 'required',
                'peternak_alamat' => 'required',
            ]);
        } else {
            $validated = $request->validate([
                'peternak_nama' => 'required',
                'peternak_hp' => 'required',
                'peternak_jk' => 'required',
                'peternak_tempatlahir' => 'required',
                'peternak_tgllahir' => 'required',
                'kecamatan_id' => 'required',
                'peternak_alamat' => 'required',
            ]);
            $user = User::where('email', Session::get('email'))->first();
            $validated['kecamatan_id'] = $user->operator->kecamatan_id;
        }
        $peternak_id = $request->peternak_id;
        if (Session::get('type') == 'admin') {
            $peternak = Peternak::find($peternak_id);
            // dd('here');
            $userdata = $request->validate([
                'email' => ['required', Rule::unique('user', 'email')->ignore($peternak->user->user_id, 'user_id')]
            ]);

            $user = new User();
            $user->find($peternak->user->user_id);
            $user->update($userdata);
        }
        if (Session::get('type') == 'peternak') {
            $userdata = $request->validate([
                'email' => ['required', Rule::unique('user', 'email')->ignore(Session::get('user_id'), 'user_id')],
                'user_password' => 'required|confirmed:password_confirmation',
                'password_confirmation' => 'required'
            ]);
            unset($userdata['password_confirmation']);
            $userdata['user_password'] = Hash::make($userdata['user_password']);

            $user = new User();
            $user->find($peternak->user->user_id);
            $user->update($userdata);
        }
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $path = $request->file('file')->storePublicly('profil', 'public');
            $validated['peternak_foto'] = $path;
        }
        $peternak = Peternak::find($peternak_id);
        $peternak->update($validated);
        return back()->with('message', 'successAlert("Peternak berhasil diubah!")');
    }


    function insert(Request $request): RedirectResponse
    {

        //Validasi
        if (Session::get('type') == 'admin') {
            $validated = $request->validate([
                'peternak_nama' => 'required',
                'peternak_hp' => 'required',
                'peternak_jk' => 'required',
                'peternak_tempatlahir' => 'required',
                'peternak_tgllahir' => 'required',
                'kecamatan_id' => 'required',
                'peternak_alamat' => 'required',
            ]);
        } else {
            $validated = $request->validate([
                'peternak_nama' => 'required',
                'peternak_hp' => 'required',
                'peternak_jk' => 'required',
                'peternak_tempatlahir' => 'required',
                'peternak_tgllahir' => 'required',
                'peternak_alamat' => 'required',
            ]);
            $user = User::where('email', Session::get('email'))->first();
            $validated['kecamatan_id'] = $user->operator->kecamatan_id;
        }
        $userdata = $request->validate([
            'email' => 'required|unique:user,email',
            'user_password' => 'required|confirmed:password_confirmation',
            'password_confirmation' => 'required'
        ]);
        $path = $request->file('file')->storePublicly('profil', 'public');

        unset($userdata['password_confirmation']);
        unset($validated['file']);
        $userdata['user_type'] = 'peternak';
        // dd($userdata['user_password']);
        $userdata['user_password'] = Hash::make($userdata['user_password']);

        $user = new User();
        $user->fill($userdata);

        $user->save();

        $validated['user_id'] = $user->user_id;
        $validated['peternak_foto'] = $path;
        Peternak::insert($validated);

        return redirect(route('peternak.index'))->with('message', 'successAlert("Peternak berhasil ditambahkan!")');
    }

    function delete(Request $request)
    {
        $peternak_id = $request->peternak_id;
        $peternak = Peternak::find($peternak_id);
        User::destroy($peternak->user_id);
        Peternak::destroy($peternak_id);
        return back()->with('message', 'successAlert("Data peternak berhasil dihapus!")');
    }
}
