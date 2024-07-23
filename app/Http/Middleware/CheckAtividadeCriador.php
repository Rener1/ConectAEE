<?php

namespace App\Http\Middleware;

use App\Models\Arquivo;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Atividade;

class CheckAtividadeCriador
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/')->with('denied', 'É necessário estar logado para acessar o sistema');
        } else if (Auth::user()->cadastrado == false) {
            return redirect()->route('usuario.completarCadastro');
        }
        if ($request->route('id_atividade') != null) {
            $atividade = Atividade::find($request->route('id_atividade'));

            if ($atividade == NULL || $atividade->objetivo->user->id != Auth::user()->id) {
                return redirect("/")->with('denied', 'Você não tem permissão para acessar esta página ou ela não existe.');
            }
        }

        if ($request->route('id_arquivo') != null) {
            $arquivo = Arquivo::find($request->route('id_arquivo'));
            $atividade = Atividade::find($arquivo->atividade_id);
            if ($atividade->objetivo->user->id != Auth::user()->id) {
                return redirect("/")->with('denied', 'Você não tem permissão para acessar esta página ou ela não existe.');
            }
        }

        return $next($request);
    }
}
