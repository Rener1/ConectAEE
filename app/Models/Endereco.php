<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{

  protected $fillable = [
    'logradouro',
    'numero',
    'bairro',
    'cidade',
    'estado',
    'cep',
  ];

  public function aluno()
  {
     return $this->belongsTo(Aluno::class);
  }
}
