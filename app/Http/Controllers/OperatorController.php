<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class OperatorController extends Controller
{
    function index()
    {
        $title = 'Operator';
        $operator = Operator::all();
        $kecamatan = Kecamatan::all();

        return view('backend.operator', compact('operator', 'title', 'kecamatan'));
    }
    function view($id)
    {
        $operator = Operator::find($id);
        $title = 'Detail Operator';
        return view('backend.operator_detail', compact('operator', 'title'));
    }
    function edit($id)
    {
        $operator = Operator::find($id);
        $kecamatan = Kecamatan::all();
        $title = 'Detail Operator';
        return view('backend.operator_edit', compact('operator', 'title', 'kecamatan'));
    }
    function tambah()
    {
        // $operator = Operator::find($id);
        $title = 'Tambah Operator';
        $kecamatan = Kecamatan::all();
        return view('backend.operator_tambah', compact('title', 'kecamatan'));
    }
    function update(Request $request): RedirectResponse
    {

        //Validasi
        $validated = $request->validate([
            'operator_nama' => 'required',
            'operator_hp' => 'required',
            'operator_alamat' => 'required',
            'kecamatan_id' => 'required',
        ]);
        $operator_id = $request->operator_id;
        if (Session::get('type') == 'admin') {
            $operator = Operator::find($operator_id);
            // dd('here');
            $userdata = $request->validate([
                'email' => ['required', Rule::unique('user', 'email')->ignore($operator->user->user_id, 'user_id')]
            ]);

            $user = new User();
            $user->find($operator->user->user_id);
            $user->update($userdata);
        }
        if (Session::get('type') == 'operator') {
            $userdata = $request->validate([
                'email' => ['required', Rule::unique('user', 'email')->ignore(Session::get('user_id'), 'user_id')],
                'user_password' => 'required|confirmed:password_confirmation',
                'password_confirmation' => 'required'
            ]);
            unset($userdata['password_confirmation']);
            $userdata['user_password'] = Hash::make($userdata['user_password']);

            $user = new User();
            $user->find($operator->user->user_id);
            $user->update($userdata);
        }
        $operator = Operator::find($operator_id);
        $operator->update($validated);
        return back()->with('message', 'successAlert("Operator berhasil diubah!")');
    }


    function insert(Request $request): RedirectResponse
    {

        //Validasi
        $validated = $request->validate([
            'operator_nama' => 'required',
            'operator_hp' => 'required',
            'operator_alamat' => 'required',
            'kecamatan_id' => 'required',
        ]);
        $userdata = $request->validate([
            'email' => 'required|unique:user,email',
            'user_password' => 'required|confirmed:password_confirmation',
            'password_confirmation' => 'required'
        ]);

        unset($userdata['password_confirmation']);
        $userdata['user_type'] = 'operator';
        // dd($userdata['user_password']);
        $userdata['user_password'] = Hash::make($userdata['user_password']);

        $user = new User();
        $user->fill($userdata);

        $user->save();

        $validated['user_id'] = $user->user_id;
        Operator::insert($validated);

        return redirect(route('operator.index'))->with('message', 'successAlert("Operator berhasil ditambahkan!")');
    }

    function delete(Request $request)
    {
        $operator_id = $request->operator_id;
        $operator = Operator::find($operator_id);
        User::destroy($operator->user_id);
        Operator::destroy($operator_id);
        return back()->with('message', 'successAlert("Data operator berhasil dihapus!")');
    }
}
