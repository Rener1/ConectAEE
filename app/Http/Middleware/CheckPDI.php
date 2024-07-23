<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\Aluno;
use App\Models\Gerenciar;
use Closure;

class CheckPDI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            return redirect('/')->with('denied', 'É necessário estar logado para acessar o sistema');
        }else if(Auth::user()->cadastrado == false){
            return redirect()->route('usuario.completarCadastro');
        }

        $aluno = Aluno::find($request->route('id_aluno'));
        if($aluno == NULL){
            return redirect("/")->with('denied','Você não tem permissão para acessar esta página ou ela não existe.');
        }

        $gerenciar = Gerenciar::where('user_id','=',Auth::user()->id)->where('aluno_id','=',$aluno->id)->first();
        if($gerenciar == NULL || ($gerenciar->perfil_id != 2 and $gerenciar->tipo_usuario != 3)){
            return redirect("/")->with('denied','Você não tem permissão para acessar esta página ou ela não existe.');
        }
        return $next($request);
    }
}
