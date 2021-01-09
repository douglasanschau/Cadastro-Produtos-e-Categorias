<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    function categoria() {
        return $this->belongsTo('App\Models\Categoria');
    }
    use HasFactory;
}
