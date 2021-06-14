<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Padepokan;
use App\Models\Ulasan;

class DepapokanController extends Controller
{
    public function index(){
        $padepokans = Padepokan::all();

        return view('index', compact("padepokans"));
    }

    public function hapus($id, Request $request){
        Padepokan::destroy($id);

        return back();
    }

    public function viewTambah(){
        return view('tambah');
    }

    public function tambah(Request $request){
        $request->validate([
            "gambar"    => ["required", "image"],
            "nama"      => ["required", "string"],
            "deskripsi" => ["required", "string"]
        ]);

        $gambar = $request->file("gambar")->store("padepokan");

        Padepokan::create([
            "gambar"    => $gambar,
            "nama"      => $request->nama,
            "deskripsi" => $request->deskripsi
        ]);

        return redirect("/");
    }

    public function viewUbah($id){
        $padepokan = Padepokan::findOrFail($id);
        return view('ubah', compact("id", "padepokan"));
    }

    public function ubah($id, Request $request){
        $request->validate([
            "gambar"    => ["nullable", "image"],
            "nama"      => ["required", "string"],
            "deskripsi" => ["required", "string"]
        ]);

        $padepokan = Padepokan::findOrFail($id);

        if($request->hasFile("gambar"))
            $padepokan->gambar = $request->file('gambar')->store('padepokan');
        $padepokan->nama = $request->nama;
        $padepokan->deskripsi = $request->deskripsi;
        $padepokan->save();

        return redirect("/");
    }

    public function viewUlasan($id, Request $request){
        $padepokan = Padepokan::findOrFail($id);

        return view('ulasan', compact('padepokan', 'id'));
    }

    public function ulas($id, Request $request){
        $request->validate([
            'nama' => ['required', 'string'],
            'ulasan' => ['required', 'string']
        ]);

        $padepokan = Padepokan::findOrFail($id);

        $padepokan->ulasan()->create([
            'name' => $request->nama,
            'comment' => $request->ulasan
        ]);

        return back();
    }

    public function ubahUlasan($id, $uid, Request $request){
        $request->validate([
            'nama' => ['required', 'string'],
            'ulasan' => ['required', 'string']
        ]);

        Ulasan::findOrFail($uid)->update([
            'name' => $request->nama,
            'comment' => $request->ulasan
        ]);

        return back();
    }

    public function hapusUlasan($id, $uid, Request $request){
        Ulasan::destroy($uid);

        return back();
    }
}
