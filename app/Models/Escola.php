<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'municipio_id',
    ];

    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'escola_user', 'escola_id', 'user_id');
    }
}
