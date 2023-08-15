<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\data_penyakit;
use App\Models\gejala;
use App\Models\Rule;

class RuleController extends Controller
{

    public function index()
    {

        $data = [
            "rules" => Rule::with(['data_penyakit', 'gejala'])
                        ->orderBy('id', 'asc')
                        ->paginate(5),
            "data_penyakits" => data_penyakit::get(),
            "gejalas" => gejala::get()
    
        ];

        return view('Admin.Rule.index', $data);
    }

    public function store(Request $request)
{
    $request->validate([
        'id_penyakit' => 'required',
        'daftar_gejala' => 'required|array',
    ]);

    // $data_rule = new Rule;
    // $data_rule->id_penyakit = $request->input('id_penyakit');
    // $data_rule->daftar_gejala = implode(',', $request->input('daftar_gejala'));

    Rule::create([
        'id_penyakit' => $request->input('id_penyakit'),
        'daftar_gejala' => implode(',', $request->input('daftar_gejala')),
    ]);

    // $data_rule->save();

    return redirect()->back()->with('success', 'Data rule berhasil ditambahkan!');
}
public function edit($id)
{ 
    
    $data_rule = Rule::findOrFail($id);
    $data_penyakit = data_penyakit::get();
    $gejala = gejala::get();

    $selectedGejala = explode(',', $data_rule->daftar_gejala);

    $data = [
        "item" => $data_rule,
        "data_penyakits" => $data_penyakit,
        "gejalas" => $gejala,
        "selectedGejala" => $selectedGejala
    ];

    return view('Admin.Rule.edit', $data);
}



// public function update(Request $request, $id)
// {
//     $request->validate([
//         'id_penyakit' => 'required',
//         'daftar_gejala'=>'required|array',

//     ]);

//     $data_rule = Rule::findOrFail($id);
//     $data_rule->id_penyakit = $request->input('id_penyakit');
//     $data_rule->daftar_gejala = implode(',', $request->input('daftar_gejala'));
//     $data_rule->save();
    

//     return back()->with('success', 'Data Rule berhasil diupdate');
// }

public function update(Request $request, $id)
{
    $request->validate([
        'id_penyakit' => 'required',
        'daftar_gejala' => 'required|array',
    ]);

    $data_rule = Rule::findOrFail($id);
    $data_rule->id_penyakit = $request->input('id_penyakit');
    $data_rule->daftar_gejala = implode(',', $request->input('daftar_gejala'));
    $data_rule->save();

    return back()->with('success', 'Data Rule berhasil diupdate');
}


public function destroy($id)
{
    //delete post
    $data_rule = Rule::findOrFail($id);
    $data_rule->delete();

    //redirect to index
    return redirect('/Admin/Rule')->with(['success' => 'Data Berhasil Dihapus!']);
}

    }

