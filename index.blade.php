@extends('layouts.app', ['current' => 'categorias', 'title'=>'Categorias'])

@section('body')
  <div class="card border">
      <div class="card-body">
          <h5 class="card-title">Categorias Cadastradas</h5>
@if(isset($categorias) > 0)
          <table class="table table-ordered table-hover">
              <thead>
                  <tr>
                    <th>Código</th>
                    <th>Nome da Categoria</th>
                    <th>Ações</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($categorias as $categoria)
                  <tr>
                     <td>{{$categoria->id}}</td>
                     <td>{{$categoria->name}}</td>
                     <td>
                        <a href="/categorias/editar/{{$categoria->id}}" class="btn btn-sm btn-primary"> Editar </a>
                        <a href="/categorias/excluir/{{$categoria->id}}" class="btn btn-sm btn-danger"> Excluir </a>
                     </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
@endif
      </div>
      <div class="card-footer">
          <a href="/categorias/novo" class="btn btn-sm btn-success"> Nova Categoria </a>
      </div>
  </div>
@endsection