@extends('layouts.principal')
@section('title','Requisitar permissão')
@section('navbar')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" style="margin-top: -20px; padding: 10px 20px;" id="login-card">
                    <div class="panel-heading">
                        <h2>
                            <strong>
                                Requisitar acesso à {{$aluno->nome}}
                            </strong>
                        </h2>
                        <div style="font-size: 14px" id="login-card">
                            <a href="{{route('alunos.index')}}">Início</a>
                            > <a href="{{route('alunos.buscar')}}">Novo Aluno</a>
                            > Requisitar acesso
                        </div>

                        <hr style="border-top: 1px solid black;">
                    </div>

                    <div class="panel-body panel-body-cadastro">
                        <div class="col-md-8 col-md-offset-2">
                            <form method="POST" action="{{ route("alunos.permissoes.notificar") }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="aluno_id" value="{{ $aluno->id }}">

                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="username" class="col-md-12 control-label">Seu nome de usuário</label>

                                    <div class="col-md-12">
                                        <input id="username" readonly type="text" class="form-control" name="username"
                                               value="{{ \Auth::user()->username }}" autofocus>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('perfil') ? ' has-error' : '' }}">
                                    <label for="perfil" class="col-md-12 control-label">Requisitar acesso com o perfil de<font
                                                color="red">*</font> </label>

                                    <div class="col-md-12">
                                        <select name="perfil" class="form-control" onchange="showEspecializacao(this)">
                                            <option value="" selected disabled hidden>Escolha o Perfil</option>
                                            @foreach($perfis as $perfil)
                                                @if($perfil->nome == old('perfil'))
                                                    <option value="{{$perfil->nome}}"
                                                            selected>{{$perfil->nome}}</option>
                                                @else
                                                    <option value="{{$perfil->nome}}">{{$perfil->nome}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @if ($errors->has('perfil'))
                                            <span class="help-block">
                      <strong>{{ $errors->first('perfil') }}</strong>
                    </span>
                                        @endif
                                    </div>
                                </div>

                                @if(old('perfil') == "Profissional Externo")
                                    <div id="div-especializacao"
                                         class="form-group{{ $errors->has('especializacao') ? ' has-error' : '' }}">
                                        @else
                                            <div id="div-especializacao"
                                                 class="form-group{{ $errors->has('especializacao') ? ' has-error' : '' }}"
                                                 style="display: none">
                                                @endif
                                                <label for="especializacao" class="col-md-12 control-label">Sua especialização<font color="red">*</font></label>

                                                <div class="col-md-12">
                                                    <input id="especializacao" type="text" class="form-control"
                                                           name="especializacao" value="{{ old('especializacao') }}"
                                                           autofocus>

                                                    @if ($errors->has('especializacao'))
                                                        <span class="help-block">
                      <strong>{{ $errors->first('especializacao') }}</strong>
                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row col-md-12 text-center">
                                                    <br>
                                                    <a class="btn btn-secondary" href="{{route('alunos.buscar')}}">
                                                        Voltar
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">
                                                        Requisitar
                                                    </button>
                                                </div>
                                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function (e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function (e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function (e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }

            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function (e) {
                closeAllLists(e.target);
            });
        }

        var myarray = [<?php echo '"' . implode('","', $especializacoes) . '"' ?>];

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("especializacao"), myarray);
    </script>

@endsection
