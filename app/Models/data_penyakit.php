<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_penyakit extends Model
{
    use HasFactory;

    protected $guarded = [' '];

    protected $table = "data_penyakits";

    public function data_gejala()
    {
        return $this->hasMany(gejala::class);
    }

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
}
