<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Padepokan;

class DepapokanController extends Controller
{
    public function index(){
        $padepokans = Padepokan::all();

        return view('index', compact("padepokans"));
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

    public function hapus($id, Request $request){
        Padepokan::destroy($id);

        return back();
    }
}
