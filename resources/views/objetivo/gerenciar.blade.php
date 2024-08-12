@extends('layouts.app')
@section('title', 'Gerenciar objetivo')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>
                <strong style="color: #12583C">
                    Gerenciar objetivo
                </strong>
            </h1>
            <div>
                <a href="{{ route('aluno.index') }}">Início</a>
                > <a href="{{ route('aluno.gerenciar', $aluno->id) }}">Perfil de
                    <strong>{{ explode(' ', $aluno->nome)[0] }}</strong></a>
                > <a href="{{ route('objetivo.listar', $aluno->id) }}">Objetivos</a>
                > <strong>{{ $objetivo->titulo }}</strong>
            </div>
        </div>

        <div class="col-md-6 text-right">
            @if ($objetivo->user->id == \Auth::user()->id && $objetivo->concluido == false)
                <a class="btn btn-primary" href={{ route('objetivo.editar', ['id_objetivo' => $objetivo->id]) }}>
                    Editar
                </a>
                <a class="btn btn-primary" href={{ route('objetivo.concluir', ['id_objetivo' => $objetivo->id]) }}>
                    Finalizar
                </a>
                <a class="btn btn-danger"
                    onclick="return confirm('\Confirmar exclusão do objetivo {{ $objetivo->titulo }}?')"
                    href={{ route('objetivo.excluir', ['id_objetivo' => $objetivo->id]) }}>
                    Excluir
                </a>
            @elseif($objetivo->user->id == \Auth::user()->id && $objetivo->concluido == true)
                <a class="btn btn-primary" href={{ route('objetivo.desconcluir', ['id_objetivo' => $objetivo->id]) }}>
                    Reabrir
                </a>
            @endif

            @if (App\Models\Gerenciar::where('user_id', '=', \Auth::user()->id)->where('aluno_id', '=', $aluno->id)->first() != null && $objetivo->user->id != \Auth::user()->id and
                    App\Models\Gerenciar::where('user_id', '=', \Auth::user()->id)->where('aluno_id', '=', $aluno->id)->first()->tipoUsuario !=
                        2)
                <a class="btn btn-primary"
                    style="float:right; margin-left: -50px; background-color: #0398fc; color: white; font-weight: bold; font-size: 15px; padding: 7px; border-radius: 5px; border-color: #0398fc; box-shadow: 4px 4px 4px #CCC"
                    href="{{ route('sugestoes.cadastrar', ['id_objetivo' => $objetivo->id]) }}" id="signup">
                    Nova Sugestão
                </a>
            @endif
        </div>
    </div>

    <hr style="border-top: 1px solid #AAA;">

    <div class="row">
        <div class="col-md-8">
            <p>
                <strong>Objetivo: </strong>{{ $objetivo->titulo }}
            </p>
            <strong>Autor: </strong>{{ $objetivo->user->name }}
            <br>
            <strong>Prioridade: </strong>{{ $objetivo->prioridade }}
            <br>
            <strong>Tipo: </strong>{{ $objetivo->tipoObjetivo->tipo }}
            <br>
            <strong>Concluído: </strong>
            <?php
            echo $objetivo->statusObjetivo[sizeof($objetivo->statusObjetivo) - 1]->status->status == 'Concluído' ? 'Sim' : 'Não';
            ?>
            <br>
            <br>
            <strong>Descrição: </strong>{{ $objetivo->descricao }}
            <br>
        </div>

        <div class="col-md-4">
            <strong>Histórico de Status: </strong> <br>
            <ul>
                @foreach ($objetivo->statusObjetivo as $statusObjetivo)
                    <li>
                        {{ $statusObjetivo->status->status }} - {{ $statusObjetivo->data }} <br>
                    </li>
                @endforeach
            </ul>

            <strong>Status atual:</strong>

            <form method="POST" action="{{ route('objetivo.status.atualizar') }}">
                {{ csrf_field() }}

                <input id="id_aluno" type="hidden" class="form-control" name="id_aluno" value="{{ $aluno->id }}">
                <input id="id_objetivo" type="hidden" class="form-control" name="id_objetivo" value="{{ $objetivo->id }}">

                <div>
                    <div class="col-md-12">
                        @if ($objetivo->user_id == Auth::user()->id)
                            <select id="status" class="form-control" name="status" style="margin-bottom:15px">
                                @foreach ($statusesObjetivo as $status)
                                    @if ($statusObjetivo->status == $status)
                                        <option value={{ $status->id }} selected>{{ $status->status }}</option>
                                    @else
                                        <option value={{ $status->id }}>{{ $status->status }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            {{ $objetivo->statusObjetivo[sizeof($objetivo->statusObjetivo) - 1]->status->status }}
                        @endif
                    </div>

                    <div class="col-md-12 text-center">
                        @if ($objetivo->user_id == Auth::user()->id)
                            <button type="submit" class="btn btn-primary"
                                style="width: 100%; margin: 10px 0px; background-color: #17b01f; color: white; font-weight: bold; font-size: 15px; padding: 7px; border-radius: 5px; border-color: #17b01f; box-shadow: 4px 4px 4px #CCC">
                                Atualizar
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <hr style="border-top: 1px solid #AAA;">
            <div class="row">
                <div class="col-md-6">
                    <h3>
                        <strong>Atividades</strong>
                    </h3>
                </div>

                <div class="col-md-6 text-right">
                    @if (App\Models\Gerenciar::where('user_id', '=', \Auth::user()->id)->where('aluno_id', '=', $aluno->id)->first()->perfil_id != 1 && $objetivo->user->id == \Auth::user()->id and
                            App\Models\Gerenciar::where('user_id', '=', \Auth::user()->id)->where('aluno_id', '=', $aluno->id)->first()->tipoUsuario !=
                                2)
                        <a class="btn btn-primary"
                            style="float:right; margin-left: -50px; background-color: #0398fc; color: white; font-weight: bold; font-size: 15px; padding: 7px; border-radius: 5px; border-color: #0398fc; box-shadow: 4px 4px 4px #CCC"
                            href="{{ route('atividades.cadastrar', ['id_objetivo' => $objetivo->id]) }}"
                            id="signup">
                            Nova Atividade
                        </a>
                    @endif
                </div>
            </div>


                <div>

                    @if (count($atividades) != 0)
                        <div id="tabela" class="table-responsive" id="login-card">
                            <table class="table table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th style="width:20%;cursor:pointer;" onclick="sortTable(0, 'table1')">
                                            STATUS <img class="on-contrast-force-white"
                                                src="{{ asset('images/sort.png') }}" style="height:15px">
                                        </th>
                                        <th style="width:30%;cursor:pointer;" onclick="sortTable(1, 'table1')">
                                            TÍTULO <img class="on-contrast-force-white"
                                                src="{{ asset('images/sort.png') }}" style="height:15px">
                                        </th>
                                        <th style="width:25%;cursor:pointer;" onclick="sortTable(2, 'table1')">
                                            DATA <img class="on-contrast-force-white" src="{{ asset('images/sort.png') }}"
                                                style="height:15px">
                                        </th>
                                        <th style="width:25%">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($atividades as $atividade)
                                        <tr>
                                            <td data-title="Status" class="output">
                                                @php($cor = \App\Http\Controllers\AtividadeController::corStatus($atividade->status))
                                                <span style="background:{{ $cor }}"></span>
                                                {{ $atividade->status }}
                                            </td>
                                            <td data-title="Atividades">
                                                {{ $atividade->titulo }}
                                            </td>
                                            <td data-title="Data">{{ $atividade->data }}</td>
                                            <td data-title="Ações">
                                                @if ($atividade->objetivo->user->id == \Auth::user()->id)
                                                    <a class="btn btn-primary" data-toggle="modal"
                                                        data-target="#modalAtividade{{ $atividade->id }}"
                                                        style="background: #ccac1d; height: 40px; font-size: 17px">Gerenciar</a>
                                                @else
                                                    <a class="btn btn-primary" data-toggle="modal"
                                                        data-target="#modalAtividade{{ $atividade->id }}"
                                                        style="background: #ccac1d; height: 40px; font-size: 17px">Ver</a>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalAtividade{{ $atividade->id }}" role="dialog">
                                            <div class="modal-dialog modal-lg panel-default"
                                                style="background-color:white; padding: 10px 20px;" id="login-card">

                                                <!-- Modal content-->
                                                <div class="modal-header" id="login-card">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>

                                                    <h2>
                                                        <strong>
                                                            {{ $atividade->titulo }}
                                                        </strong>
                                                    </h2>

                                                    <hr style="border-top: 1px solid black;">
                                                </div>

                                                <div class="modal-body" id="login-card">
                                                    <div class="row" id="login-card">
                                                        <div class="col-md-6" id="login-card">
                                                            <strong>Título: </strong>{{ $atividade->titulo }}
                                                            <br>
                                                            <strong>Prioridade: </strong>{{ $atividade->prioridade }}
                                                            <br>
                                                            <strong>Status: </strong>{{ $atividade->status }}
                                                            <br>
                                                            <strong>Concluído:
                                                            </strong>{{ $atividade->concluido ? 'Sim' : 'Não' }}
                                                            <br>
                                                            <strong>Data: </strong> {{ $atividade->data }}
                                                        </div>

                                                        <div class="col-md-6" align="justify" id="login-card">
                                                            <strong>Descrição: </strong>{{ $atividade->descricao }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer" id="login-card">
                                                    @if ($objetivo->user->id == \Auth::user()->id)
                                                        @if ($atividade->concluido == false)
                                                            <a class="btn btn-secondary" style="margin-right: 36%"
                                                                href={{ route('arquivo.listar', ['id_atividade' => $atividade->id]) }}>
                                                                Listar Arquivos
                                                            </a>

                                                            <a class="btn btn-primary"
                                                                href={{ route('atividade.editar', ['id_atividade' => $atividade->id]) }}>
                                                                Editar
                                                            </a>

                                                            <a class="btn btn-primary"
                                                                href={{ route('atividade.concluir', ['id_atividade' => $atividade->id]) }}>
                                                                Finalizar
                                                            </a>

                                                            <a class="btn btn-danger"
                                                                onclick="return confirm('\Confirmar exclusão da atividade {{ $atividade->titulo }}?')"
                                                                href={{ route('atividade.excluir', ['id_atividade' => $atividade->id]) }}>
                                                                Excluir
                                                            </a>

                                                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button> -->
                                                        @elseif($atividade->concluido == true)
                                                            <a class="btn btn-primary"
                                                                href={{ route('atividade.desconcluir', ['id_atividade' => $atividade->id]) }}>
                                                                Reabrir
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                        </div>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info" id="login-card">
                    <strong>Não há nenhuma atividade cadastrada.</strong>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <hr style="border-top: 1px solid #AAA;">
        <div>
            <div>
                <div class="col-md-6">
                    <h3>
                        <strong>Sugestões</strong>
                    </h3>
                </div>

                <div class="col-md-6 text-right">
                    @if (App\Models\Gerenciar::where('user_id', '=', \Auth::user()->id)->where('aluno_id', '=', $aluno->id)->first() != null && $objetivo->user->id != \Auth::user()->id and
                            App\Models\Gerenciar::where('user_id', '=', \Auth::user()->id)->where('aluno_id', '=', $aluno->id)->first()->tipoUsuario !=
                                2)
                        <a class="btn btn-primary"
                            style="float:right; margin-left: -50px; background-color: #0398fc; color: white; font-weight: bold; font-size: 15px; padding: 7px; border-radius: 5px; border-color: #0398fc; box-shadow: 4px 4px 4px #CCC"
                            href="{{ route('sugestoes.cadastrar', ['id_objetivo' => $objetivo->id]) }}" id="signup">
                            Nova Sugestão
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div>

            @if (\Session::has('sugestao'))
                <div class="alert alert-success">
                    <strong>Sucesso!</strong>
                    {!! \Session::get('sugestao') !!}
                </div>
            @endif

            @if (count($sugestoes) != 0)
                <div id="tabela" class="table-responsive">
                    <table class="table table-bordered" id="table2">
                        <thead>
                            <tr>
                                <th style="width:20%;cursor:pointer;" onclick="sortTable(0, 'table2')">
                                    AUTOR <img class="on-contrast-force-white" src="{{ asset('images/sort.png') }}"
                                        style="height:15px">
                                </th>
                                <th style="width:30%;cursor:pointer;" onclick="sortTable(1, 'table2')">
                                    TÍTULO <img class="on-contrast-force-white" src="{{ asset('images/sort.png') }}"
                                        style="height:15px">
                                </th>
                                <th style="width:25%;cursor:pointer;" onclick="sortTable(2, 'table2')">
                                    DATA <img class="on-contrast-force-white" src="{{ asset('images/sort.png') }}"
                                        style="height:15px">
                                </th>
                                <th style="width:25%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sugestoes as $sugestao)
                                <tr>
                                    <td data-title="Autor">
                                        {{ explode(' ', $sugestao->user->name)[0] }}
                                    </td>
                                    <td data-title="Atividades">
                                        {{ $sugestao->titulo }}
                                    </td>
                                    <td data-title="Data">{{ $sugestao->data }}</td>
                                    <td data-title="Ação">
                                        @if ($sugestao->user->id == \Auth::user()->id)
                                            <a class="btn btn-primary"
                                                href="{{ route('sugestao.ver', ['id_sugestao' => $sugestao->id]) }}"
                                                style="background: #ccac1d; height: 40px; font-size: 17px">Gerenciar</a>
                                        @else
                                            <a class="btn btn-primary"
                                                href="{{ route('sugestao.ver', ['id_sugestao' => $sugestao->id]) }}"
                                                style="background: #ccac1d; height: 40px; font-size: 17px">Ver</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info" id="login-card">
                    <strong>Não há nenhuma atividade cadastrada.</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="text-center">
        <a class="btn btn-secondary btn-lg" href="{{ route('objetivo.listar', $aluno->id) }}">
            Voltar
        </a>
    </div>



    <style>
        .output span {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }
    </style>

    <script type="text/javascript">
        $('#summer').summernote({
            placeholder: 'Escreva sua mensagem aqui...',
            lang: 'pt-BR',
            tabsize: 2,
            height: 100
        });

        function sortTable(n, table) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById(table);
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc";
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /* Check if the two rows should switch place,
                    based on the direction, asc or desc: */
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                    and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Each time a switch is done, increase this count by 1:
                    switchcount++;
                } else {
                    /* If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again. */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>

@endsection
