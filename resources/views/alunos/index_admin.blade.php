@extends('layouts.app')
@section('title','Listar Instituições')

@section('content')

  <div class="row m-2">
    <div class="col-md-6">
      <h2>
        <strong style="color: #12583C">
          Alunos
        </strong>
      </h2>
    </div>
  </div>

  <hr style="border-top: 1px solid #AAA;">

  <x-filter-group context="alunos" :current-filters="request()->query()" />
    
  <div class="mb-4">
    <table class="table shadow table-hover table-borderless">
      <thead style="background-color: #538970; color: white;">
        <tr>
          <th>Nome</th>
          <th>Matrícula</th>
          <th>CID</th>
          <th>Escola</th>
          <th class="col-md-2 text-center">Ações</th>
        </tr>

      </thead>
      <tbody>
        @foreach ($alunos as $aluno)
          <tr>
            <td>{{ $aluno->nome }}</td>

            <td>{{$aluno->matricula}}</td>
            <td>{{$aluno->descricao_cid}}</td>
            <td>{{$aluno->escola->nome}}</td>
            <td>
              {{-- <a class="btn btn-primary" href="{{ route("users.show" , ['user_id' => $user->id]) }}">
                Visualizar
              </a> --}}
            
              <a class="btn btn-primary" href="{{ route("alunos.edit" , ['aluno_id' => $aluno->id]) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
              </a>
              @include('layouts.components.delete_modal', ['route' => 'alunos.destroy', 'param' => 'aluno_id', 'entity_id' => $aluno->id])
            
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$aluno->id}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2-fill" viewBox="0 0 16 16">
                  <path d="M2.037 3.225A.7.7 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2a.7.7 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671zm9.89-.69C10.966 2.214 9.578 2 8 2c-1.58 0-2.968.215-3.926.534-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466-.18-.14-.498-.307-.975-.466z"/>
                </svg>
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <x-pagination-info :paginator="$alunos" />

    <div class="d-flex justify-content-center">
        {{$alunos->appends(request()->query())->links()}}
    </div>

    <a class="btn btn-secondary" href="{{route('home')}}">
      Voltar
    </a>
  </div>
@endsection
