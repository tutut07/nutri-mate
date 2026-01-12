<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBahan extends Model
{
    protected $table = 'data_bahan';

    protected $fillable = [
        'bahan',
        'energi',
        'protein',
        'lemak',
        'karbo',
        'serat',
        'kategori'
    ];
}
