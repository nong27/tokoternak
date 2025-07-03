<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Pelanggan;
use App\Models\Pembeli;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    function loginPage()
    {
        return view('login');
    }
    public function loginPost(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $data = User::where('email', $email)->first();
        if ($data) { //apakah email tersebut ada atau tidak
            if (Hash::check($password, $data->user_password)) {
                Session::put('user_id', $data->user_id);
                Session::put('email', $data->email);
                Session::put('type', $data->user_type);
                Session::put('login_' . $data->user_type, TRUE);
                return redirect(route('dashboard'));
            } else {
                return redirect('login')->with('alert', 'Password anda salah!');
            }
        } else {
            return redirect('login')->with('alert', 'Email anda salah / Belum terdaftar!');
        }
    }
    function registrasiPembeli()
    {
        $title = 'SignUp Pelanggan Toko Ternak';
        return view('signup', compact('title'));
    }
    public function registrasiPost(Request $request)
    {
        //Validasi
        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'no_telp' => 'required',
            'alamat_jalan' => 'required',
        ]);
        $userdata = $request->validate([
            'email' => 'required|unique:user,email',
            'user_password' => 'required|confirmed:password_confirmation',
            'password_confirmation' => 'required',
        ]);
        unset($userdata['password_confirmation']);
        $userdata['user_type'] = 'pelanggan';
        // dd($userdata['user_password']);
        $userdata['user_password'] = Hash::make($userdata['user_password']);

        $user = new User();
        $user->fill($userdata);

        $user->save();

        $validated['user_id'] = $user->user_id;
        Pelanggan::insert($validated);

        return redirect(route('login'))->with('success', 'Registrasi Berhasil, silahkan login menggunakan akun anda.');
    }

    function logout()
    {
        Session::flush();
        return redirect('/');
    }

    //here
    function profil()
    {
        $user = User::find(Session::get('user_id'));
        $title = 'Profil Saya';
        return view('backend.profil', compact('user', 'title'));
    }

    function gantiPassword(Request $request): RedirectResponse
    {
        $user = User::find(Session::get('user_id'));
        if (Hash::check($request->current_password, $user->user_password)) {
            $userdata = $request->validate([
                // 'email' => ['required', Rule::unique('user', 'email')->ignore(Session::get('user_id'), 'user_id')],
                'user_password' => 'required|confirmed:password_confirmation',
                'password_confirmation' => 'required'
            ]);
            unset($userdata['password_confirmation']);
            $userdata['user_password'] = Hash::make($userdata['user_password']);

            $user->update($userdata);
            return back()->with('message', 'successAlert("Password diganti")');
        }
        return back()->with('message', 'dangerAlert("Password gagal diganti")');
    }
}
