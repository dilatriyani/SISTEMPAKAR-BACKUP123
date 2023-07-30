<?php

namespace App\Http\Controllers\Admin;
use App\Models\data_penyakit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class data_penyakitController extends Controller
{
    public function index()
    {
        $data = [
            "data_penyakit" => data_penyakit::paginate(5)
        ];

        return view('Admin.Data_Penyakit.index', $data);
    }


    // public function store(request $request)
    // {

    //     $this->validate($request, [

    //           'kd_penyakit'   => 'required',
    //           'nama_penyakit' => 'required',
    //           'solusi'        => 'required',
 	// 	  ]);
    //     //upload image

    //     $data                = new data_penyakit;
    //     $data->kd_penyakit   = $request->kd_penyakit;
    //     $data->nama_penyakit = $request->nama_penyakit;
    //     $data->solusi        = $request->solusi;
    //     $data->save();

    //     return redirect()->back()->with('success', 'Data penyakit berhasil ditambahkan!');

    // }
    public function store(Request $request)
    {

        data_penyakit::create([
            'kd_penyakit' => $request->kd_penyakit,
            'nama_penyakit' => $request->nama_penyakit,
            'solusi' => $request->solusi,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->back()->with('success', 'Data penyakit berhasil ditambahkan!');
    }

    public function edit(Request $request)
    {
        $dp = [
            "edit" => data_penyakit::where("id", $request->id)->first()
        ];

        return view('Admin.Data_Penyakit.edit', $dp);
    }

    public function update(Request $request, $id)
    {
        $data_penyakit = data_penyakit::findOrFail($id);
        $data_penyakit->kd_penyakit = $request->kd_penyakit;
        $data_penyakit->nama_penyakit = $request->nama_penyakit;
        $data_penyakit->solusi = $request->solusi;
        $data_penyakit->deskripsi = $request->deskripsi;
        $data_penyakit->save();

        return redirect()->back()->with('success', 'Data penyakit berhasil diubah!');
    }

    // public function update(Request $request)
    // {
    //     // dd($request->all());
    //     data_penyakit::where("id", $request->id)->update([
    //         'kd_penyakit' => $request->kd_penyakit,
    //         'nama_penyakit' => $request->nama_penyakit,
    //         'solusi' => $request->solusi,
    //     ]);

    //     return back()->with('success', 'Data penyakit berhasil diubah!');

    // }

    // public function show(Request $request)
    // {
    //     $ket = [
    //         "detail" => KetentuanLayanan::where("id", $request->id)->first()
    //     ];

    //     return view('superadmin.master.ketentuan.detail', $ket);
    // }

    //
    public function destroy($id)
    {
        $data_penyakit = data_penyakit::findOrFail($id);
        $data_penyakit->relatedModel()->delete();
        $data_penyakit->delete();

        //redirect to index
        return redirect('/Admin/Data_Penyakit')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
