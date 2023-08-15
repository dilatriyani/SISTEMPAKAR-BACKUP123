<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'rules';
    

    // protected $fillable = [
    // 'kd_penyakit',
    // 'kd_gejala',
    // 'pertanyaan'

    // ];

    protected $fillable = ['id_penyakit', 'daftar_gejala'];
    // public function gejala()
    // {
    //     return $this->belongsTo(gejala::class, 'kd_gejala', 'id');
    // }

    public function data_penyakit()
    {
        return $this->belongsTo(data_penyakit::class, 'id_penyakit', 'id');
    }

    public function gejala()
    {
        return $this->hasMany(gejala::class, 'id', 'daftar_gejala');
    }

    public function many_penyakit()
    {
        return $this->hasMany(data_penyakit::class);
    }
}
