<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Gejala;
use App\Models\Rule;
use App\Models\HistoryDiagnosa;
use App\Models\data_penyakit;
use Illuminate\Support\Facades\Session;
// use PDF;
// use Spatie\Browsershot\Browsershot;
// use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
// use Illuminate\Support\Facades\URL;

class dashboardController extends Controller
{
    public function index()
    {
        return view('Admin.Dashboard.body');
    }

    // public function diagnosa()
    // {
    //     return view('Pengguna.Diagnosa.form');
    // }

    public function getUserSess(Request $request)
    {
        if ($request) {
            $request->session()->flush();
            Session::push('user_name', $request->name);
            Session::push('user_age', $request->age);
            Session::push('user_address', $request->address);
            return redirect('/Pengguna/Diagnosa/1');
        }
    }

    public function question($id)
    {
        $user_name = Session::get('user_name');
        $user_age = Session::get('user_age');
        $user_address = Session::get('user_address');
        if ($id == null) {
            $id = 1;
        }
        $gejala = Gejala::query()->find($id);
        if ($gejala == null) {
            return redirect('')->with('error', 'Inform admin, data is not updated');
        }
        return view('Pengguna.Diagnosa.form')->with([
            'gejala' => $gejala,
            'user_name' => last($user_name),
            'user_age' => last($user_age),
            'user_address' => last($user_address),
        ]);
    }

    public function result(Request $request)
    {
        $last = Gejala::latest()->first();
        $data_penyakit = data_penyakit::get();
        $id_gejala = $request->id_gejala;
        $next = $id_gejala + 1;
        if ($next <= $last->id) {
            $gejala = Gejala::find($id_gejala);
            if (Gejala::find($next) === null) {
                $next++;
            } else {
                if ($request->answer == 1) {
                    # save gejala selected
                    Session::push('gejala', $gejala->nama_gejala);
                    Session::push('IdGejala', $gejala->id);
                    foreach($data_penyakit as $penyakit){
                        $rule = Rule::where('id_penyakit', $penyakit->id)->first();
                        if($rule != null){
                            $daftar_gejala = explode(',', $rule->daftar_gejala);
                            foreach ($daftar_gejala as $gejala) {
                                $daftar_gejala = explode(',', $rule->daftar_gejala);
                                if ($gejala == $id_gejala) {
                                    Session::push('penyakit', $rule->id_penyakit);
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            return redirect('/Pengguna/Diagnosa/' . $next);
        } else {
            $penyakit = Session::get('penyakit');
            if ($penyakit == null || count($penyakit) == 0) {
                return redirect('/Pengguna/Diagnosa/1')->with(['message' => 'Pilih setidaknya 1 Gejala!']);
            }

            $id_gejala_all = Session::get('IdGejala');
            $id_penyakit_possible = array_unique(Session::get('penyakit'));
            $score_results = [];

            // perhitungan score
            foreach ($id_penyakit_possible as $penyakit_id) {
                $rules_for_penyakit = Rule::where('id_penyakit', $penyakit_id)->get();
                $counter = 0;
                foreach ($rules_for_penyakit as $rule) {
                    $gejala_list_for_rule = explode(',', $rule->daftar_gejala);
            
                    foreach ($gejala_list_for_rule as $gejala_id) {
                        foreach ($id_gejala_all as $applied_gejala) {
                            if ($gejala_id == $applied_gejala) {
                                $counter++;
                            }
                        }
                    }
            
                    $score = $counter / count($gejala_list_for_rule) * 100;
                    $score_results[] = $score;
                }
            }
            
            Session::put('score', $score_results);
            
            // dd($id_gejala_all,$id_penyakit_possible, Session::get('score'));

            // kemungkianan dan score ada diarrray berbeda dengan urutan sama
            // ambil index untuk kemungkinan tertinggi
            $score_all = Session::get('score');
            $max_score = max($score_all);
            $maxIndex = array_search($max_score, $score_all); 
            $max_possible_penyakit = $id_penyakit_possible[$maxIndex];
            
            // $countArray = array_count_values($penyakit);
            // $arrayLength = count($penyakit);
            // arsort($countArray);
            // $mostFrequentValue = key($countArray);
            // $frequency = current($countArray);
            // $score = $frequency / $arrayLength * 100;

            $penyakit_result = data_penyakit::query()->findOrFail($max_possible_penyakit);

            $user_name = Session::get('user_name');
            $user_age = Session::get('user_age');
            $user_address = Session::get('user_address');
            $gejala_list = Session::get('gejala');

            HistoryDiagnosa::create([
                'nama' => last($user_name),
                'umur' => last($user_age),
                'alamat' => last($user_address),
                'penyakit' => $penyakit_result->nama_penyakit,
                'persentase' => strval($max_score),
                'solusi' => $penyakit_result->solusi,
            ]);

            return view('Pengguna.Diagnosa.Hasil')->with([
                'penyakit' => $penyakit_result,
                'score' => $score,
                'name' => last($user_name),
                'age' => last($user_age),
                'address' => last($user_address),
                'gejala_list' => $gejala_list,
            ]);
        }
    }

    // public function GeneratePdf()
    // {
    //     $baseUrl = URL::to('/'); // Get the base URL
    //     $additionalPath = '/Pengguna/Diagnosa/Hasil'; // Additional path to append
    //     $url = $baseUrl . $additionalPath; // Combine the base URL and additional path
    //     Browsershot::url($url)
    //         ->fullPage()
    //         ->save('screenshot.png');
    //     $screenshotPath = public_path('screenshot.png'); // Path to the captured screenshot
    //     $pdf = PDF::loadView('report', compact('screenshotPath'));

    //     return $pdf->download('report.pdf');
    // }

    public function info_penyakit()
    {
        $artikels = Artikel::query()
            ->get();
        return view('Pengguna.Layouts.info_penyakit', compact('artikels'));
    }



    public function tentang()
    {
        return view('Pengguna.Layouts.tentang');
    }
    public function hasil()
    {
        return view('Pengguna.Diagnosa.Hasil');
    }
}
