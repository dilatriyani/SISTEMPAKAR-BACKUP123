<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;


class ArtikelController extends Controller
{
    public function index()
    {
        $data = [
            "artikel" => Artikel::paginate(5)
        ];

        return view('Admin.Artikel.index', $data);
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'judul' => '',
        //     'deskripsi' => '',
        //     'image' => 'mimes:jpg,jpeg,png'
        // ]);

        if($request->file("image")) {
            $data = $request->file("image")->store("Artikel");
        }

        Artikel::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'image' => $data
        ]);
        return back()->with('berhasil', 'Artikel baru telah ditambahkan!');
    }
    
    public function edit(Request $request)
    {
        $data = [
            "edit" => Artikel::where("id", $request->id)->first()
        ];

        return view("Admin.Artikel.edit", $data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'image_new' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);
    
        $artikel = Artikel::findOrFail($id);
    
        if ($request->hasFile("image_new")) {
            if ($artikel->image) {
                Storage::delete($artikel->image);
            }
    
            $data['image'] = $request->file("image_new")->store("Artikel");
        } else {
            // If no new image is uploaded, retain the existing image
            $data['image'] = $artikel->image;
        }
    
        $artikel->update($data);
    
        return back()->with('success', 'Artikel berhasil diperbarui!');
    }
    
    

        // $this->validate($request, [
        //     'judul' => '',
        //     'deskripsi' => '',
        //     'image' => 'mimes:jpg,jpeg,png'
        // ]);

        // if($request->file("image_new")) {
        //     if ($request->gambarLama) {
        //         Storage::delete($request->gambarLama);
        //     }

        //     $data = $request->file("image_new")->store("Artikel");
        // }else {
        //     $data = $request->gambarLama;
        // }

        // Artikel::where("id", $request->id)->update([
        //     'judul' => $request->judul,
        //     'isi' => $request->isi,
        //     'image' => $data
        // ]);

        // return back();
    // }

    
    public function destroy($id)
    { 
       $data = Artikel::findorfail($id);

       $file = public_path('./Artikel').$data->image;

       if (file_exists($file)){
        @unlink($file);

       }
       $data->delete();
       return back();
        // //delete post
        // $artikel = artikel::findOrFail($id);
        // $artikel->delete();

        // //redirect to index
        // return redirect('/Admin/Artikel')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
