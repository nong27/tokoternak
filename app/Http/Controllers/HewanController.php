<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Jenishewan;
use App\Models\Peternak;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HewanController extends Controller
{
    protected $user;
    function __construct()
    {
        $this->user = User::where('email', Session::get('email'))->first();
    }
    function jenisHewan()
    {
        $title = 'Jenis Hewan';
        $jenishewan = Jenishewan::all();
        return view('backend.jenishewan', compact('jenishewan', 'title'));
    }

    function insertjenisHewan(Request $request): RedirectResponse
    {

        //Validasi
        $validated = $request->validate([
            'jenishewan_nama' => 'required',
        ]);

        Jenishewan::insert($validated);

        return back()->with('message', 'successAlert("Jenis hewan berhasil ditambahkan!")');
    }
    function updatejenisHewan(Request $request): RedirectResponse
    {

        //Validasi
        $jenishewan_id = $request->jenishewan_id;
        $validated = $request->validate([
            'jenishewan_nama' => 'required',
        ]);

        $jenishewan = Jenishewan::find($jenishewan_id);
        $jenishewan->fill($validated);
        $jenishewan->save();

        return back()->with('message', 'successAlert("Jenis hewan berhasil diupdate!")');
    }
    function deletejenisHewan(Request $request)
    {
        $jenishewan_id = $request->jenishewan_id;
        Jenishewan::destroy($jenishewan_id);
        return back()->with('message', 'successAlert("Data jenis hewan berhasil dihapus!")');
    }
    function index()
    {
        $data['title'] = 'Hewan';
        $title = 'Hewan';
        $hewan = Hewan::where('hewan_jumlah', '>', 0)->get();
        $jenishewan = Jenishewan::all();
        if (Session::get('type') == 'admin')
            $peternak = Peternak::all();
        else
            $peternak = Peternak::where('kecamatan_id', $this->user->operator->kecamatan_id)->get();
        return view('backend.hewan', compact('hewan', 'jenishewan', 'title', 'peternak'));
    }
    function insert(Request $request): RedirectResponse
    {
        $user = User::where('email', Session::get('email'))->first();
        //Validasi
        $validated = $request->validate([
            'jenishewan_id' => 'required',
            'hewan_nama' => 'required',
            'hewan_deskripsi' => 'required',
            'hewan_berat' => 'required',
            'hewan_umur' => 'required',
            'hewan_fisik' => 'required',
            'hewan_warna' => 'required',
            // 'hewan_tanduk' => 'required',
            'hewan_harga' => 'required',
            'hewan_jumlah' => 'required',
            'peternak_id' => 'required',
            'file' => 'required',
        ]);
        $path = $request->file('file')->storePublicly('hewan', 'public');

        unset($validated['file']);
        $validated['hewan_gambar'] = $path;
        Hewan::insert($validated);

        return redirect(route('hewan.index'))->with('message', 'successAlert("Hewan berhasil ditambahkan!")');
    }
    function view($id)
    {
        $hewan = Hewan::find($id);
        $title = 'Detail Hewan';
        return view('backend.hewan_detail', compact('hewan', 'title'));
    }
    function edit($id)
    {
        $hewan = Hewan::find($id);
        $title = 'Edit Hewan';
        $jenishewan = Jenishewan::all();
        $peternak = Peternak::all();
        return view('backend.hewan_edit', compact('hewan', 'jenishewan', 'title', 'peternak'));
    }
    function update(Request $request): RedirectResponse
    {
        $hewan_id = $request->hewan_id;
        //Validasi
        $validated = $request->validate([
            'jenishewan_id' => 'required',
            'hewan_nama' => 'required',
            'hewan_deskripsi' => 'required',
            'hewan_berat' => 'required',
            'hewan_umur' => 'required',
            'hewan_fisik' => 'required',
            'hewan_warna' => 'required',
            // 'hewan_tanduk' => 'required',
            'hewan_harga' => 'required',
            'hewan_jumlah' => 'required',
        ]);
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $path = $request->file('file')->storePublicly('hewan', 'public');
            $validated['hewan_gambar'] = $path;
        }

        unset($validated['file']);
        $hewan = Hewan::find($hewan_id);
        $hewan->fill($validated);
        $hewan->save();

        return redirect(route('hewan.index'))->with('message', 'successAlert("Data hewan berhasil diupdate!")');
    }
    function delete(Request $request)
    {
        $hewan_id = $request->hewan_id;
        Hewan::destroy($hewan_id);
        return redirect(route('hewan.index'))->with('message', 'successAlert("Data hewan berhasil dihapus!")');
    }
}
