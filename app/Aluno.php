<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;

class Aluno extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable=['cpf'];
    public static $rules=['cpf' =>'required'];
    public static $messages=['cpf'=>'erro cpf'];

    public function getDataDeNascimentoAttribute( $value ) {
      return (new Carbon($value))->format('d/m/Y');
    }

    public function getData(){
      $ano= substr($this->data_de_nascimento, 6);
      $mes= substr($this->data_de_nascimento, 3,-5);
      $dia= substr($this->data_de_nascimento, 0,-8);
      return $ano."-".$mes."-".$dia;
    }

    public function gerenciars(){
        return $this->hasMany(Gerenciar::class);
    }

    public function instituicoes(){
        return $this->belongsToMany(Instituicao::class, 'aluno_instituicaos');
    }

    public function objetivos(){
        return $this->hasMany(Objetivo::class)->orderBy('updated_at','desc');
    }

    public function forum(){
        return $this->hasOne(ForumAluno::class);
    }

    public function familia(){
        return $this->hasOne(Familia::class, 'id','familia_id');
    }

    public function pdi(){
        return $this->belongsTo(Pdi::class);
    }

    public function endereco(){
        return $this->hasOne(Endereco::class,'id','endereco_id');
    }

    public function albuns(){
        return $this->hasMany(Album::class);
    }
}
