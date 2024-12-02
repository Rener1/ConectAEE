<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Gre;
use App\Models\Municipio;
use Exception;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EscolaController extends Controller
{
    public function index(Request $request){
        $escolas = QueryBuilder::for(Escola::class)
        ->allowedFilters([
            AllowedFilter::exact('gre_id', 'municipio.gre_id'),
            AllowedFilter::exact('municipio_id'), 
        ]) 
        ->defaultSort('nome')      
        ->paginate(10);
        $gres = Gre::all();
        $municipios = Municipio::all();
        return view('escolas.index', compact('escolas', 'gres', 'municipios'));
    }

    public function show($escola_id){
        $escola = Escola::find($escola_id);

        return view('escolas.show', compact('escola'));
    }

    public function create(){
        $escolas = Escola::all();

        return view('escolas.create', compact('escolas'));
    }

    public function store(Request $request){
        $escolas = Escola::all();

        return view('escolas.index', compact('escolas'));
    }

    public function edit($escola_id){
        $escola = Escola::find($escola_id);
        $municipios = Municipio::orderBy('nome')->get();

        return view('escolas.edit', compact('escola', 'municipios'));
    }

    public function update(Request $request, $escola_id){
        $dados = $request->validate([
            'nome' => 'required|string|min:3',
            'municipio_id' => 'required|integer|exists:municipios,id'
        ]);

        try {
            $escola = Escola::find($escola_id);
            $escola->update($dados);
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Ocorreu um erro ao atualizar os dados da escola. [$e->getMessage()]");
        }
        
        return redirect()->route('escolas.index')->with('Escola atualizada com sucesso!');
    }

    public function destroy($escola_id){
        Escola::find($escola_id)->delete();

        return view('escolas.index', compact('escolas'));
    }
}
