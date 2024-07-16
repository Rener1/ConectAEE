@extends('layouts.app')
@section('title','Cadastrar aluno')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div>
                        <h1>
                            <strong style="color: #12583C">
                                Novo Aluno
                            </strong>
                            <div>
                                <a href="{{route('aluno.listar')}}">Início</a> > Novo Aluno
                            </div>
                        </h1>

                        <hr style="border-top: 1px solid #AAA;">
                    </div>

                    <div>
                        <div class="col-md-8 col-md-offset-2">
                            <form method="POST" action="{{ route("aluno.criar") }}" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                @if(\Session::has('cpf'))

                                    <h3>
                                        <strong>
                                            Instituição
                                        </strong>
                                    </h3>

                                    <hr style="border-top: 1px solid #AAA;">

                                    <div class="form-group{{ $errors->has('instituicoes') ? ' has-error' : '' }}"
                                         id="login-card">
                                        <label for="instituicoes" class="col-md-12 control-label">Instituição(ões)
                                            vinculada(s) ao aluno<font
                                                    color="red">*</font> </label>

                                        <div class="col-md-12" id="login-card">
                                            <select class="form-control js-example-basic-multiple" name="instituicoes[]"
                                                    multiple="multiple" autofocus>
                                                @foreach ($instituicoes as $instituicao)
                                                    @php($selected = false)
                                                    @if(old("instituicoes.0") != null )

                                                        @for ($i=0; $i < count($instituicoes) ; $i++) {
                                                        @if(old("instituicoes.".$i) == $instituicao->id)
                                                            @php($selected = true)
                                                            @break
                                                        @endif
                                                        @endfor

                                                        @if($selected)
                                                            <option value="{{$instituicao->id}}"
                                                                    selected> {{$instituicao->nome}}
                                                                , {{ $instituicao->endereco->cep }}
                                                                , {{ $instituicao->endereco->rua }}
                                                                , {{ $instituicao->endereco->cidade }}
                                                                - {{ $instituicao->endereco->estado }} </option>
                                                        @else
                                                            <option value="{{$instituicao->id}}">{{$instituicao->nome}}
                                                                , {{ $instituicao->endereco->cep }}
                                                                , {{ $instituicao->endereco->rua }}
                                                                , {{ $instituicao->endereco->cidade }}
                                                                - {{ $instituicao->endereco->estado }} </option>
                                                        @endif

                                                    @else
                                                        <option value="{{$instituicao->id}}">{{$instituicao->nome}}
                                                            , {{ $instituicao->endereco->cep }}
                                                            , {{ $instituicao->endereco->rua }}
                                                            , {{ $instituicao->endereco->cidade }}
                                                            - {{ $instituicao->endereco->estado }} </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->has("instituicoes"))
                                                <span class="help-block">
                        <strong>{{ $errors->first("instituicoes") }}</strong>
                      </span>
                                            @endif
                                            <br>
                                        </div>
                                    </div>

                                    <div class="form-group" id="login-card">
                                        <div class="col-md-12 col-md-offset-5" id="login-card">
                                            Instituição não encontrada? &nbsp;
                                            <a class="btn btn-primary" href="{{ route("instituicao.cadastrar") }}">Cadastre</a>
                                        </div>
                                    </div>

                                    <h3>
                                        <strong>
                                            Identificação do Aluno
                                        </strong>
                                    </h3>

                                    <hr style="border-top: 1px solid #AAA;">
                                    <input type="hidden" name="cpf" value="{!! \Session::get('cpf') !!}">

                                    <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}"
                                        >
                                        <label for="cpf" class="col-md-12 control-label"> CPF<font color="red">*</font></label>

                                        <div class="col-md-12">
                                            <input id="cpf" type="text" class="form-control" name="cpf" readonly
                                                   value="{!! \Session::get('cpf') !!}">

                                            @if ($errors->has('cpf'))
                                                <span class="help-block">
                        <strong>{{ $errors->first('cpf') }}</strong>
                      </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}"
                                        >
                                        <label for="nome" class="col-md-12 control-label"> Nome<font
                                                    color="red">*</font></label>

                                        <div class="col-md-12">
                                            <input id="nome" type="text" class="form-control" name="nome"
                                                   value="{{ old('nome') }}">

                                            @if ($errors->has('nome'))
                                                <span class="help-block">
                        <strong>{{ $errors->first('nome') }}</strong>
                      </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('imagem') ? ' has-error' : '' }}">
                                        <label for="imagem" class="col-md-12 control-label">Foto de perfil</label>

                                        <div class="col-md-12">
                                            <input id="imagem" type="file" class="filestyle" name="imagem"
                                                   data-placeholder="Nenhum arquivo" data-text="Selecionar"
                                                   data-btnClass="btn btn-primary">

                                            @if ($errors->has('imagem'))
                                                <span class="help-block">
                        <strong>{{ $errors->first('imagem') }}</strong>
                      </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('data_nascimento') ? ' has-error' : '' }}"
                                                    >
                                                    <label for="data_nascimento" class="col-md-12 control-label">Data de
                                                        nascimento<font color="red">*</font> </label>

                                                    <div class="col-md-12">
                                                        <input id="data_nascimento" type="date" class="form-control"
                                                               name="data_nascimento" max=""
                                                               value="{{ old('data_nascimento') }}">

                                                        @if ($errors->has('data_nascimento'))
                                                            <span class="help-block">
                              <strong>{{ $errors->first('data_nascimento') }}</strong>
                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="login-card">
                                                <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }}"
                                                     id="login-card">

                                                    <label for="sexo" class="col-md-12 control-label">Sexo<font
                                                                color="red">*</font> </label>

                                                    <div class="col-md-12" id="login-card">
                                                        @if(old('sexo') == "M")
                                                            <input type="radio" id="sexo1" name="sexo" value="M"
                                                                   checked="checked">
                                                        @else
                                                            <input type="radio" id="sexo1" name="sexo" value="M">
                                                        @endif

                                                        <label class="custom-control-label"
                                                               for="sexo1">Masculino</label>

                                                        @if(old('sexo') == "F")
                                                            <input type="radio" id="sexo2" name="sexo" value="F"
                                                                   checked="checked">
                                                        @else
                                                            <input type="radio" id="sexo2" name="sexo" value="F">
                                                        @endif

                                                        <label class="custom-control-label" for="sexo2">Feminino</label>

                                                        @if ($errors->has('sexo'))
                                                            <span class="help-block">
                              <strong>{{ $errors->first('sexo') }}</strong>
                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <h3>
                                        <strong>
                                            Endereço da Moradia do Aluno
                                        </strong>
                                    </h3>

                                    <hr style="border-top: 1px solid #AAA;">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4" id="login-card">
                                                <div class="form-group{{ $errors->has('cep') ? ' has-error' : '' }}"
                                                     id="login-card">
                                                    <label for="cep" class="col-md-12 control-label">CEP<font
                                                                color="red">*</font></label>

                                                    <div class="col-md-12" id="login-card">

                                                        <input id="cep" onblur="pesquisacep(this.value);" type="text"
                                                               class="form-control" name="cep" value="{{ old('cep') }}">

                                                        @if ($errors->has('cep'))
                                                            <span class="help-block">
                            <strong>{{ $errors->first('cep') }}</strong>
                          </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group{{ $errors->has('rua') ? ' has-error' : '' }}"
                                                    >
                                                    <label for="rua" class="col-md-12 control-label">Rua<font
                                                                color="red">*</font></label>

                                                    <div class="col-md-12">

                                                        <input id="rua" type="text" class="form-control" name="rua"
                                                               value="{{ old('rua') }}">

                                                        @if ($errors->has('rua'))
                                                            <span class="help-block">
                          <strong>{{ $errors->first('rua') }}</strong>
                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}"
                                                    >
                                                    <label for="numero" class="col-md-12 control-label">Número<font
                                                                color="red">*</font> </label>

                                                    <div class="col-md-12">
                                                        <input id="numero" type="text" class="form-control"
                                                               name="numero" value="{{ old('numero') }}">

                                                        @if ($errors->has('numero'))
                                                            <span class="help-block">
                            <strong>{{ $errors->first('numero') }}</strong>
                          </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}"
                                                    >
                                                    <label for="bairro" class="col-md-12 control-label">Bairro<font
                                                                color="red">*</font></label>

                                                    <div class="col-md-12">
                                                        <input id="bairro" type="text" class="form-control"
                                                               name="bairro" value="{{ old('bairro') }}">

                                                        @if ($errors->has('bairro'))
                                                            <span class="help-block">
                            <strong>{{ $errors->first('bairro') }}</strong>
                          </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}"
                                                    >
                                                    <label for="estado" class="col-md-12 control-label">Estado<font
                                                                color="red">*</font> </label>

                                                    <div class="col-md-12">
                                                        <select id="estado" class="form-control" name="estado"
                                                                data-target="#cidade">
                                                            <option value="" selected hidden>-- UF --</option>
                                                            <option @if(old('estado') == 'AC')  selected
                                                                    @endif value="AC">
                                                                Acre
                                                            </option>
                                                            <option @if(old('estado') == 'AL') selected
                                                                    @endif value="AL">
                                                                Alagoas
                                                            </option>
                                                            <option @if(old('estado') == 'AP') selected
                                                                    @endif value="AP">
                                                                Amapá
                                                            </option>
                                                            <option @if(old('estado') == 'AM') selected
                                                                    @endif value="AM">
                                                                Amazonas
                                                            </option>
                                                            <option @if(old('estado') == 'BA') selected
                                                                    @endif value="BA">
                                                                Bahia
                                                            </option>
                                                            <option @if(old('estado') == 'CE') selected
                                                                    @endif value="CE">
                                                                Ceará
                                                            </option>
                                                            <option @if(old('estado') == 'DF') selected
                                                                    @endif value="DF">
                                                                Distrito Federal
                                                            </option>
                                                            <option @if(old('estado') == 'ES') selected
                                                                    @endif value="ES">
                                                                Espírito Santo
                                                            </option>
                                                            <option @if(old('estado') == 'GO') selected
                                                                    @endif value="GO">
                                                                Goiás
                                                            </option>
                                                            <option @if(old('estado') == 'MA') selected
                                                                    @endif value="MA">
                                                                Maranhão
                                                            </option>
                                                            <option @if(old('estado') == 'MT') selected
                                                                    @endif value="MT">
                                                                Mato Grosso
                                                            </option>
                                                            <option @if(old('estado') == 'MS') selected
                                                                    @endif value="MS">
                                                                Mato Grosso do Sul
                                                            </option>
                                                            <option @if(old('estado') == 'MG') selected
                                                                    @endif value="MG">
                                                                Minas Gerais
                                                            </option>
                                                            <option @if(old('estado') == 'PA') selected
                                                                    @endif value="PA">
                                                                Pará
                                                            </option>
                                                            <option @if(old('estado') == 'PB') selected
                                                                    @endif value="PB">
                                                                Paraíba
                                                            </option>
                                                            <option @if(old('estado') == 'PR') selected
                                                                    @endif value="PR">
                                                                Paraná
                                                            </option>
                                                            <option @if(old('estado') == 'PE') selected
                                                                    @endif value="PE">
                                                                Pernambuco
                                                            </option>
                                                            <option @if(old('estado') == 'PI') selected
                                                                    @endif value="PI">
                                                                Piauí
                                                            </option>
                                                            <option @if(old('estado') == 'RJ') selected
                                                                    @endif value="RJ">
                                                                Rio de Janeiro
                                                            </option>
                                                            <option @if(old('estado') == 'RN') selected
                                                                    @endif value="RN">
                                                                Rio Grande do Norte
                                                            </option>
                                                            <option @if(old('estado') == 'RS') selected
                                                                    @endif value="RS">
                                                                Rio Grande do Sul
                                                            </option>
                                                            <option @if(old('estado') == 'RO') selected
                                                                    @endif value="RO">
                                                                Rondônia
                                                            </option>
                                                            <option @if(old('estado') == 'RR') selected
                                                                    @endif value="RR">
                                                                Roraima
                                                            </option>
                                                            <option @if(old('estado') == 'SC') selected
                                                                    @endif value="SC">
                                                                Santa Catarina
                                                            </option>
                                                            <option @if(old('estado') == 'SP') selected
                                                                    @endif value="SP">
                                                                São Paulo
                                                            </option>
                                                            <option @if(old('estado') == 'SE') selected
                                                                    @endif value="SE">
                                                                Sergipe
                                                            </option>
                                                            <option @if(old('estado') == 'TO') selected
                                                                    @endif value="TO">
                                                                Tocantins
                                                            </option>
                                                        </select>

                                                        @if ($errors->has('estado'))
                                                            <span class="help-block">
                            <strong>{{ $errors->first('estado') }}</strong>
                          </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}"
                                                    >
                                                    <label for="cidade" class="col-md-12 control-label">Cidade<font
                                                                color="red">*</font> </label>

                                                    <div class="col-md-12">
                                                        <input id="cidade" class="form-control" name="cidade"
                                                               value="{{ old('cidade') }}">

                                                        @if ($errors->has('cidade'))
                                                            <span class="help-block">
                            <strong>{{ $errors->first('cidade') }}</strong>
                          </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3>
                                        <strong>
                                            Dados Médicos do Aluno
                                        </strong>
                                    </h3>

                                    <hr style="border-top: 1px solid #AAA;">

                                    <div class="form-group{{ $errors->has('cid') ? ' has-error' : '' }}"
                                        >
                                        <label for="cid" class="col-md-12 control-label">CID</label>

                                        <div class="col-md-12">
                                            <input id="cid" type="text" class="form-control" placeholder="X000"
                                                   name="cid" value="{{ old('cid') }}">

                                            @if ($errors->has('cid'))
                                                <span class="help-block">
                        <strong>{{ $errors->first('cid') }}</strong>
                      </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('descricaoCid') ? ' has-error' : '' }}"
                                        >
                                        <label for="descricaoCid" class="col-md-12 control-label">Descrição do
                                            CID</label>

                                        <div class="col-md-12">
                                            <input id="descricaoCid" type="text"
                                                   class="form-control" name="descricaoCid"
                                                   value="{{ old('descricaoCid') }}">

                                            @if ($errors->has('descricaoCid'))
                                                <span class="help-block">
                        <strong>{{ $errors->first('descricaoCid') }}</strong>
                      </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('observacao') ? ' has-error' : '' }}"
                                        >
                                        <label for="observacao" class="col-md-12 control-label">Outras
                                            observações</label>

                                        <div class="col-md-12">
                    <textarea name="observacao" style="width:100%; min-width: 100%; max-width: 100%;min-height: 50px;"
                              id="observacao" type="text" class="form-control">{{old('observacao')}}</textarea>

                                            <br>
                                            @if ($errors->has('observacao'))
                                                <span class="help-block">
                        <strong>{{ $errors->first('observacao') }}</strong>
                      </span>
                                            @endif
                                        </div>
                                    </div>

                                    <h3>
                                        <strong>
                                            Perfil do Cadastrante
                                        </strong>
                                    </h3>

                                    <hr style="border-top: 1px solid #AAA;">

                                    <div class="form-group{{ $errors->has('perfil') ? ' has-error' : '' }}"
                                       >
                                        <label for="perfil" class="col-md-12 control-label">Perfil<font
                                                    color="red">*</font></label>

                                        <div class="col-md-12" id="login-card">
                                            <select style="margin-bottom:15px;" id="perfil" class="form-control"
                                                    name="perfil" onchange="showResponsavel(this)">
                                                @if (old('perfil') == null)
                                                    <option id="perfil" selected disabled hidden>Escolha seu perfil
                                                    </option>
                                                @endif
                                                <option @if(old('perfil') == 1) selected
                                                        @endif value='1'>Responsável
                                                </option>
                                                <option @if(old('perfil') == 2) selected
                                                        @endif value='2'>Professor AEE
                                                </option>

                                            </select>

                                            @if ($errors->has('perfil'))
                                                <span class="help-block">
                        <strong>{{ $errors->first('perfil') }}</strong>
                      </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if(old('perfil') == "2")
                                        <div id="div-responsavel" style="display: block;">
                                            @else
                                                <div id="div-responsavel" style="display: none;">
                                                    @endif

                                                    <h3>
                                                        <strong>
                                                            Responsável
                                                        </strong>
                                                    </h3>

                                                    <hr style="border-top: 1px solid #AAA;">

                                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}"
                                                       >
                                                        <label for="username" class="col-md-12 control-label">Nome de
                                                            Usuário <font color="red">*</font> </label>

                                                        <div class="col-md-12">
                                                            <input id="username" autocomplete="off" name="username"
                                                                   type="text" class="form-control"
                                                                   value="{{old('username')}}">

                                                            @if ($errors->has('username'))
                                                                <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                      </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('cadastrado') ? ' has-error' : '' }}"
                                                        >
                                                        <label for="cadastrado" class="col-md-12 control-label">Usuário
                                                            já cadastrado?</label>

                                                        <div class="col-md-12">
                                                            @if(old('cadastrado') == "true")
                                                                <input type="radio" name="cadastrado" id="sim"
                                                                       value="true" checked>
                                                            @else
                                                                <input type="radio" name="cadastrado" id="sim"
                                                                       value="true">
                                                            @endif

                                                            <label for="sim">Sim</label>

                                                            @if(old('cadastrado') == "false" || old('cadastrado') == null)
                                                                <input type="radio" name="cadastrado" id="nao"
                                                                       value="false" checked>
                                                            @else
                                                                <input type="radio" name="cadastrado" id="nao"
                                                                       value="false">
                                                            @endif

                                                            <label for="nao">Não</label>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <div class="row col-md-12 text-center">
                                                        <br>
                                                        <a class="btn btn-secondary" href="{{route('aluno.listar')}}"
                                                           id="menu-a">
                                                            Voltar
                                                        </a>
                                                        <button type="submit" class="btn btn-primary">
                                                            Cadastrar
                                                        </button>
                                                    </div>
                                                </div>
                                                @else
                                                    <div class="alert alert-info">
                                                        <center>
                                                            <h3>
                                                                Informe o CPF do aluno nesta página primeiro:
                                                                <a class="btn btn-primary" style="width:160px"
                                                                   href="{{ route("aluno.buscar") }}">Novo Aluno</a>
                                                            </h3>
                                                        </center>
                                                    </div>
                                    @endif
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
   

    <script type="text/javascript">
        $('#summer').summernote({
            lang: 'pt-BR',
            tabsize: 2,
            height: 100
        });
    </script>

    <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script>
        $(function () {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();

            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#data_nascimento').attr('max', maxDate);
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });

        // <script>
        //   var estados = [];

        //   function loadEstados(element) {
        //     if (estados.length > 0) {
        //       putEstados(element);
        //       $(element).removeAttr('disabled');
        //     } else {
        //       $.ajax({
        //         url: 'https://api.myjson.com/bins/enzld',
        //         method: 'get',
        //         dataType: 'json',
        //         beforeSend: function() {
        //           $(element).html('<option>Carregando...</option>');
        //         }
        //       }).done(function(response) {
        //         estados = response.estados;
        //         putEstados(element);
        //         $(element).removeAttr('disabled');
        //       });
        //     }
        //   }

        //   function putEstados(element) {
        //     var oldEstado = "{{old('estado')}}";

        //     var label = $(element).data('label');
        //     label = label ? label : 'Estado';

        //     var options = '<option value="">' + label + '</option>';
        //     for (var i in estados) {
        //       var estado = estados[i];

        //       if(estado.sigla == oldEstado){
        //         options += '<option selected value="' + estado.sigla + '">' + estado.nome + '</option>';
        //       }else{
        //         options += '<option value="' + estado.sigla + '">' + estado.nome + '</option>';
        //       }
        //     }

        //     if(oldEstado != ""){
        //       var target = $(element).data('target');

        //       if (target) {
        //         loadCidades(target, oldEstado);
        //       }
        //     }

        //     $(element).html(options);
        //   }

        //   function loadCidades(element, estado_sigla) {

        //     if (estados.length > 0) {
        //       putCidades(element, estado_sigla);
        //       $(element).removeAttr('disabled');
        //     } else {
        //       $.ajax({
        //         url: theme_url + '/assets/json/estados.json',
        //         method: 'get',
        //         dataType: 'json',
        //       }).done(function(response) {
        //         estados = response.estados;
        //         putCidades(element, estado_sigla);
        //         $(element).removeAttr('disabled');
        //       });
        //       document.write(estados.length);
        //     }
        //   }

        //   function putCidades(element, estado_sigla) {
        //     var label = $(element).data('label');
        //     label = label ? label : 'Cidade';

        //     var oldCidade = "{{old('cidade')}}";

        //     var options = '<option value="">' + label + '</option>';
        //     for (var i in estados) {
        //       var estado = estados[i];
        //       if (estado.sigla != estado_sigla)
        //       continue;
        //       for (var j in estado.cidades) {
        //         var cidade = estado.cidades[j];

        //         if (cidade == oldCidade) {
        //           options += '<option selected value="' + cidade + '">' + cidade + '</option>';
        //         }else {
        //           options += '<option value="' + cidade + '">' + cidade + '</option>';
        //         }
        //       }
        //     }
        //     $(element).html(options);
        //   }

        //   document.addEventListener('DOMContentLoaded', function() {
        //     loadEstados('#estado');

        //     $(document).on('change', '#estado', function(e) {
        //       var target = $(this).data('target');
        //       if (target) {
        //         loadCidades(target, $(this).val());
        //       }
        //     });

        //   }, false);


        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('estado').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('estado').value = (conteudo.uf);

            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('rua').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('estado').value = "...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };


    </script>

    <script src="{{ asset('js/bootstrap-filestyle.min.js')}}"></script>

@endsection
