<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelDetailController extends Controller
{
    
    public function index($id)
    {
        $artikels = Artikel::query()
        ->findOrFail($id);
        return view('Pengguna.Layouts.artikel-detail',compact('artikels'));
    }
}
