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
        $gejala = Gejala::query()->findOrFail($id);
        return view('Pengguna.Diagnosa.form')->with([
            'gejala' => $gejala,
            'user_name' => last($user_name),
            'user_age' => last($user_age),
            'user_address' => last($user_address),
        ]);
    }

    public function result(Request $request,)
    {
        $last = Gejala::latest()->first();
        $penyakit_total = data_penyakit::get()->count();
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
                    for ($i = 1; $i <= $penyakit_total; $i++) {
                        $rule = Rule::query()->findOrFail($i);
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
            return redirect('/Pengguna/Diagnosa/' . $next);
        } else {
            $penyakit = Session::get('penyakit');
            $arrayLength = count($penyakit);
            if ($arrayLength == 0) {
                return redirect('/Pengguna/Diagnosa/1')->with(['message' => 'Pilih setidaknya 1 Gejala!']);
            }

            $countArray = array_count_values($penyakit);
            $arrayLength = count($penyakit);
            arsort($countArray);
            $mostFrequentValue = key($countArray);
            $frequency = current($countArray);
            $score = $frequency / $arrayLength * 100;

            $penyakit_result = data_penyakit::query()->findOrFail($mostFrequentValue);

            $user_name = Session::get('user_name');
            $user_age = Session::get('user_age');
            $user_address = Session::get('user_address');
            $gejala_list = Session::get('gejala');

            HistoryDiagnosa::create([
                'nama' => last($user_name),
                'umur' => last($user_age),
                'alamat' => last($user_address),
                'penyakit' => $penyakit_result->nama_penyakit,
                'persentase' => strval($score),
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
