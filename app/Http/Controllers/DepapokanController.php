<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Padepokan;
use App\Models\Ulasan;

class DepapokanController extends Controller
{
    public function index(Request $request){
        $padepokans = Padepokan::all();

        if($request->wantsJson()){
            foreach ($padepokans as $padepokan) {
                $padepokan->gambar = asset($padepokan->gambar);
                $padepokan->ulasan = $padepokan->ulasan;
            }
            return response()->json($padepokans, 200);
            // return $padepokans->toJson(JSON_PRETTY_PRINT);
        }

        return view('index', compact("padepokans"));
    }

    public function dapatSatu($id, Request $request){
        $padepokan = Padepokan::findOrFail($id);

        if($request->wantsJson()){
            $padepokan->gambar = asset($padepokan->gambar);
            $padepokan->ulasan = $padepokan->ulasan;
            return response()->json($padepokan, 200);
            // return $padepokans->toJson(JSON_PRETTY_PRINT);
        }

        $padepokans = [$padepokan];
        return view('index', compact("padepokans"));
    }

    public function hapus($id, Request $request){
        Padepokan::destroy($id);

        if($request->wantsJson())
            return response()->json(["id"=>$id, "saka"=>"hapus", "palang"=>"berhasil"], 200);

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

        $padepokan = Padepokan::create([
            "gambar"    => $gambar,
            "nama"      => $request->nama,
            "deskripsi" => $request->deskripsi
        ]);

        $padepokan->gambar = asset($padepokan->gambar);
        $padepokan->ulasan = [];
        if($request->wantsJson())
            return response()->json($padepokan, 200);
            // return response()->json(["saka"=>"tambah", "palang"=>"berhasil"], 200);

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

        if($request->wantsJson())
            return response()->json($padepokan, 200);

        return redirect("/");
    }

    // ##### ULASAN #########################################

    public function viewUlasan($id, Request $request){
        $padepokan = Padepokan::findOrFail($id);

        return view('ulasan', compact('padepokan', 'id'));
    }

    public function langkahSatu($id, $uid, Request $request){
        $ulasan = Ulasan::findOrFail($uid);
        $ulasan->padepokan = $ulasan->padepokan;

        return response()->json($ulasan, 200);
    }

    public function ulas($id, Request $request){
        $request->validate([
            'nama' => ['required', 'string'],
            'ulasan' => ['required', 'string']
        ]);

        $padepokan = Padepokan::findOrFail($id);

        $ulasan = $padepokan->ulasan()->create([
            'name' => $request->nama,
            'comment' => $request->ulasan
        ]);

        if($request->wantsJson())
            return response()->json($ulasan, 200);

        return back();
    }

    public function ubahUlasan($id, $uid, Request $request){
        $request->validate([
            'nama' => ['required', 'string'],
            'ulasan' => ['required', 'string']
        ]);

        $ulasan = Ulasan::findOrFail($uid)->update([
            'name' => $request->nama,
            'comment' => $request->ulasan
        ]);

        if($request->wantsJson()){
            $ulasan->padepokan = $ulasan->padepokan;
            return response()->json($ulasan, 200);
        }

        return back();
    }

    public function hapusUlasan($id, $uid, Request $request){
        Ulasan::destroy($uid);

        if($request->wantsJson())
            return response()->json(["id"=>$id, "saka"=>"hapus", "palang"=>"berhasil"], 200);

        return back();
    }
}
