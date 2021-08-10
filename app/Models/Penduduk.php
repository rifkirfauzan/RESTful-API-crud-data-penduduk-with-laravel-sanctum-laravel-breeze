<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $guarded =[];

    public function datak()
    {
        return $this->hasMany('App\Models\Datakk','penduduk_id');
    }
}
