@extends('layouts.app')

@push('css')
    <style>
        label[for]:has(+ input[required])::after {
            content: " *";
            color: red;
        }

        .content {
            color: #12583C;
        }
    </style>
@endpush

@section('content')
    <div class="content">

        <div class="mb-4">
            <h1>Editar Escola</h1>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('alunos.index') }}">Início</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('escolas.index') }}">Escolas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nova Escola</li>
                </ol>
            </nav>
        </div>

        <hr class="border-2 my-4">

        <form method="POST" action="{{ route('escolas.update', $escola->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-4">Dados institucionais</h3>

                    <div class="form-group mb-2">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" id="nome" value="{{ $escola->nome ?? old('nome') }}" required>
                        @error('nome')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <h3 class="mb-4">Endereço</h3>

                    <label for="municipio_id" class="form-label">Município</label>
                    <select class="form-select" aria-label="municipio" name="municipio_id" id="municipio_id" required>Município
                        @foreach ($municipios as $municipio)
                            <option value="{{ $municipio->id }}" @if ($escola->municipio_id === $municipio->id) selected @endif>{{ $municipio->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col-auto">
                    <a type="button" class="btn btn-lg btn-secondary" href="{{ route('escolas.index') }}">Voltar</a>
                    <button type="submit" class="btn btn-lg btn-success">Salvar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
