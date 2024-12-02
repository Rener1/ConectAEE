<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\CondicaoSaudeController;
use App\Http\Controllers\DesenvolvimentoController;
use App\Http\Controllers\EspecificidadeEducacionalController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\NotificacaoController;
use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\PdiController;
use App\Http\Controllers\RecursosMultifuncionaisController;
use App\Http\Controllers\SugestaoController;
use App\Http\Controllers\UserController;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::middleware(['auth', 'ativo'])->group(function() {
    
    Route::controller(HomeController::class)->group(function(){
        Route::get('/video', 'video')->name('video');
        Route::get('/home', 'index')->name('home');
        Route::get('/', 'index');
    
    });
   
    Route::prefix('users')->controller(UserController::class)->group(function(){

        Route::get('/', 'create')->name('users.index');
        Route::get('/create', 'create')->name('user.create')->withoutMiddleware('auth');
        Route::post('/store', 'store')->name('user.store')->withoutMiddleware('auth');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::put('/', 'update')->name('user.update');
        
    });
    Route::prefix('escolas')->controller(EscolaController::class)->name('escolas.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{escola_id}', 'edit')->name('edit');
        Route::get('/show/{escola_id}', 'show')->name('show');
        Route::delete('/{escola_id}', 'destroy')->name('destroy');

        Route::put('/{escola_id}', 'update')->name('update');

    });
    Route::prefix('usuarios/notificacoes')->controller(NotificacaoController::class)->group(function(){
        Route::get('listar', 'listar')->name('notificacao.listar');
        Route::get('{id_notificacao}/ler', 'ler')->name('notificacao.ler');
        Route::get('lerTodas', 'lerTodas')->name('notificacao.lerTodas');

    });


    Route::prefix('aluno')->controller(AlunoController::class)->name('alunos.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/{aluno_id}/show', 'show')->name('show');
        Route::post('/criar', 'store')->name('store');
        Route::get('/cadastrar', 'create')->name('create');
        Route::get('/{aluno_id}/editar', 'edit')->name('edit');
        Route::post('/atualizar', 'update')->name('update');
        Route::get('/buscar', 'buscar')->name('buscar');
        Route::get('/buscarCPF', 'buscarCPF')->name('buscarCPF');
        Route::get('/buscarAluno', 'buscarAluno')->name('buscarAluno');
        Route::get('/{aluno_id}/excluir', 'delete')->name('delete');
        

        Route::prefix('aluno/objetivos')->controller(ObjetivoController::class)->group(function(){
            Route::get('/{aluno_id}/cadastrar','cadastrar')->name('objetivo.cadastrar');
            Route::get('/{aluno_id}/listar','listar')->name('objetivo.listar');
            Route::get('/{id_objetivo}/gerenciar','gerenciar')->name('objetivo.gerenciar');
            Route::get('/{id_objetivo}/gerenciar/finalizar','concluir')->name('objetivo.concluir');
            Route::get('/{id_objetivo}/gerenciar/reabrir','desconcluir')->name('objetivo.desconcluir');
            Route::get('/{id_objetivo}/gerenciar/editar','editar')->name('objetivo.editar');
            Route::get('/{id_objetivo}/gerenciar/excluir','excluir')->name('objetivo.excluir');
            Route::get('/{aluno_id}/buscar', 'buscar')->name('objetivo.buscar');
            Route::post('/atualizar', 'atualizar')->name('objetivo.atualizar');
            Route::post('/criar', 'criar')->name('objetivo.criar');

        });

        Route::prefix('aluno/objetivo/gerenciar/atividade')->controller(AtividadeController::class)->group(function(){
            Route::get('{id_objetivo}/cadastrar','cadastrar')->name('atividades.cadastrar');
            Route::get('gerenciar/atividade/{id_atividade}/finalizar','concluir')->name('atividade.concluir');
            Route::get('gerenciar/atividade/{id_atividade}/reabrir','desconcluir')->name('atividade.desconcluir');
            Route::get('gerenciar/atividade/{id_atividade}/editar','editar')->name('atividade.editar');
            Route::get('gerenciar/atividade/{id_atividade}/excluir','excluir')->name('atividade.excluir');
            Route::post('objetivos/criar', 'criar')->name('atividades.criar');
            Route::post('atividade/atualizar', 'atualizar')->name('atividade.atualizar');

        });

        Route::prefix('aluno/gerenciar/sugestoes')->controller(SugestaoController::class)->group(function(){
            Route::get('objetivo/{id_objetivo}/cadastrar','cadastrar')->name('sugestoes.cadastrar');
            Route::get('/objetivo/{id_sugestao}/ver','ver')->name('sugestao.ver');
            Route::get('/objetivo/{id_sugestao}/editar','editar')->name('sugestao.editar');
            Route::get('/objetivo/{id_sugestao}/excluir','excluir')->name('sugestao.excluir');
            Route::post('/objetivo/criar', 'criar')->name('sugestoes.criar');
            Route::post('/sugestao/atualizar', 'atualizar')->name('objetivo.sugestao.atualizar');

        });

        Route::prefix('alunos/objetivos/gerenciar/sugestoes/feedbacks')->controller(FeedbackController::class)->group(function(){
            Route::get('/{id_feedback}/excluir','excluir')->name('feedback.excluir');
            Route::post('/criar','criar')->name('feedbacks.criar');
            Route::post('/atualizar', 'atualizar')->name('feedback.atualizar');
        });


        Route::prefix('alunos/albuns')->controller(AlbumController::class)->group(function(){
            Route::get('/{aluno_id}/listar', 'listar')->name('album.listar');
            Route::get('/{aluno_id}/cadastrar', 'cadastrar')->name('album.cadastrar');
            Route::get('/{id_album}/ver', 'ver')->name('album.ver');
            Route::get('/{id_album}/editar', 'editar')->name('album.editar');
            Route::get('/{id_album}/excluir', 'excluirAlbum')->name('album.excluir');
            Route::post('/fotos/excluir', 'excluirFotos')->name('album.fotos.excluir');
            Route::post('/criar', 'criar')->name('album.criar');
            Route::post('/atualizar', 'atualizar')->name('album.atualizar');
        });

        Route::prefix('aluno/pdi')->controller(PdiController::class)->group(function(){
            Route::get('/{aluno_id}/listar', 'index')->name('pdi.index');
            Route::get('/{pdi_id}/ver', 'show')->name('pdi.show');
            Route::get('/{aluno_id}/cadastrar', 'create')->name('pdi.create');
            Route::post('/criar', 'store')->name('pdi.store');
            Route::get('/{pdi_id}/editar', 'edit')->name('pdi.edit');
            Route::post('/atualizar', 'update')->name('pdi.update');
            Route::get('/{pdi_id}/excluir', 'delete')->name('pdi.delete');

            Route::get('/{aluno_id}/cadastrarArquivo', 'cadastrarArquivo')->name('pdi.cadastrarArquivo');
            Route::post('/criarArquivo', 'criarArquivo')->name('pdi.criarArquivo');
            Route::get('/arquivo/{id_pdiArquivo}/download','download')->name('pdi.download');
            Route::get('/arquivo/{id_pdiArquivo}/excluirArquivo','excluirArquivo')->name('pdi.excluirArquivo');
            Route::get('/{id_pdi}/pdf', 'gerarPdf')->name('pdi.pdf');

            Route::get('/{pdi_id}', 'create_finalizacao')->name('pdi.create_finalizacao');
            Route::post('/{pdi_id}/recursos', 'finalizacao')->name('pdi.finalizacao');
            
            
        });
        Route::get('/saude/{pdi_id}', [CondicaoSaudeController::class, 'create_condicoes_saude'])->name('pdi.create_condicoes_saude');
        Route::get('/desenvolvimento/{pdi_id}', [DesenvolvimentoController::class, 'create_desenvolvimento_estudante'])->name('pdi.create_desenvolvimento_estudante');
        Route::get('/especificidade/{pdi_id}', [EspecificidadeEducacionalController::class, 'create_especificidade_educacional'])->name('pdi.create_especificidade_educacional');
        Route::get('/recursos/{pdi_id}', [RecursosMultifuncionaisController::class, 'create_recursos_mult_funcionais'])->name('pdi.create_recursos_mult_funcionais');
        Route::post('/{pdi_id}/cond', [CondicaoSaudeController::class, 'store'])->name('pdi.condicoes_saude');
        Route::post('/{pdi_id}/desen', [DesenvolvimentoController::class, 'store'])->name('pdi.desenvolvimento_estudante');
        Route::post('/{pdi_id}/especificidade', [EspecificidadeEducacionalController::class, 'store'])->name('pdi.especificidade_educacional');
        Route::post('/{pdi_id}/recursos', [RecursosMultifuncionaisController::class, 'store'])->name('pdi.recursos_mult_funcionais');

        Route::prefix('arquivos')->controller(ArquivoController::class)->group(function(){
            Route::get('/{id_arquivo}/download','download')->name('arquivo.download');
            Route::get('/{id_arquivo}/excluir','excluir')->name('arquivo.excluir');
            Route::get('/aluno/objetivo/gerenciar/atividade/{id_atividade}/listar','listar')->name('arquivo.listar');
            Route::get('/aluno/objetivo/gerenciar/atividade/{id_atividade}/{is_arquivo}/cadastrar','cadastrar')->name('arquivo.cadastrar');
            Route::post('/criar','criar')->name('arquivo.criar');
        });

        //Rotas para relatorio
        Route::get('/aluno/{aluno_id}/relatorio', 'RelatorioController@gerarRelatorio')->name('relatorio.gerar');

        Route::post('/aluno/objetivo/status/atualizar', 'StatusController@atualizar')->name('objetivo.status.atualizar');
    });
});

Route::prefix('inativo')->group(function() {
    Route::get('/', function(){
        return view('users.check_ativo');
    })->name('inativo');
});