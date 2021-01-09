@extends('layouts.app', ['current'=>'categorias', 'title' => 'Nova Categoria'])

@section('body')

  <div class="card border">
      <div class="card-body">
          <h5 class="card-title">Nova Categoria</h5>
          <form action="/categorias" method="POST">
            @csrf
            <div class="form-group">
                <label for='nomeCategoria' style="padding:5px;">Nome </label>
                 <input class="form-control" type="text" name="nomeCategoria" id="nomeCategoria" placeholder="Categoria">
            </div>
            <button type="submit" class="btn btn-sm btn-primary"> Salvar </button>
            <a class="btn btn-sm btn-danger" href="/categorias"> Cancel </a>
          </form>
      </div>
  </div>

@endsection