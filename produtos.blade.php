@extends('layouts.app', ['current'=>'produtos', 'title' => 'Produtos'])

@section('body')

<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Produtos</h5>
        <table id="tabelaProdutos" class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome do Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onclick="newProduct()">Novo Produto</button>
    </div>
</div>

<div id="dlgProdutos" class="modal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form class="form-horizontal" id="formProduto">
              <div class="modal-header">
                  <h5 class="modal-title">Novo Produto</h5>
              </div>
              <div class="modal-body">
                  <input type="hidden" id="id" class="form-control">
                  <div class="form-group">
                      <label for="nomeProduto" class="control-label">
                          Nome do Produto
                      </label>  
                      <div class="input-group">
                          <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do Produto">
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="quantidade" class="control-label">
                        Quantidade
                    </label>  
                    <div class="input-group">
                        <input type="text" class="form-control" id="quantidade" placeholder="Quantidade">
                    </div>
                    <div class="form-group">
                        <label for="preco" class="control-label">
                            Preço
                        </label>  
                        <div class="input-group">
                            <input type="text" class="form-control" id="preco" placeholder="Preço do Produto">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoria" class="control-label">
                            Categoria
                        </label>  
                        <div class="input-group">
                            <select  class="form-control" id="categoria">
                            </select>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                 <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
                 <button type="cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
          </form>
      </div>
   </div>
</div>


@endsection

@section('javascript')
    <script type='text/JavaScript'>

        
       $.ajax({

            headers: {
                'X-CSRF-TOKEN':  '{{"csrf_token()"}}'
            },
            

        });

        function loadCategories() {
            $.getJSON('/api/categorias', function(data){;
            for(i = 0; i < data.length; i++) {
                opcao = '<option value="'+ data[i].id + '">' + data[i].name + "</option>";
                $('#categoria').append(opcao);
            }
        });
        }

        function lines(p) {
            line = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.name + "</td>" +
            "<td>" + p.stock + "</td>" +
            "<td>" + p.price + "</td>" +
            "<td>" + p.categoria_id + "</td>" +
            "<td>" +
               "<button style='margin-right:5px;' class='btn btn-sm btn-primary' onclick='editProduct("+ p.id + ")'> Editar </button> " +
               "<button class='btn btn-sm btn-danger'onclick='deleteProduct("+ p.id +")'> Apagar </button>" +
             "</td>"+
             "</tr>";
             return line;
        }

        function loadProducts() {
            $.getJSON('/api/produtos', function(data){
              for(i=0; i < data.length; i++) {
                  line = lines(data[i]);
                  $('#tabelaProdutos>tbody').append(line);
              }
            });
        }

        
        $(function(){
            loadProducts();
            loadCategories();
        });

        
        function newProduct() {
            $('#id').val('');
            $('#nomeProduto').val('');
            $('#quantidade').val('');
            $('#preco').val('');
            $('#dlgProdutos').modal('show');
        }

        function saveProduct() {
             produto = {
                 nome: $('#nomeProduto').val(),
                 estoque: $('#quantidade').val(),
                 preco: $('#preco').val(),
                 categoria: $('#categoria').val()
            };
            $.post('api/produtos', produto, function(data) {
                 produto = JSON.parse(data);
                 line = lines(produto);
                 $('#tabelaProdutos>tbody').append(line);
            });
        }

        $('#formProduto').submit(function(event) {
              event.preventDefault();
              if($('#id').val() == '')
                  saveProduct();
              else {
                  saveEdit();
              }
              $('#dlgProdutos').modal('hide');
        });

        function editProduct(id) {
            $.getJSON('/api/produtos/' + id, function(data){
               $('#id').val(data.id);
               $('#nomeProduto').val(data.name);
               $('#quantidade').val(data.stock);
               $('#preco').val(data.price);
               $('#categoria').val(data.categoria_id);
               $('#dlgProdutos').modal('show');
            });
        }

        function saveEdit() {
            produto = {
                id: $('#id').val(),
                nome: $('#nomeProduto').val(),
                estoque: $('#quantidade').val(),
                preco: $('#preco').val(),
                categoria: $('#categoria').val()
            }; 
            $.ajax({
               type: 'PUT',
               url: '/api/produtos/' + produto.id,
               context: this,
               data: produto,
               success: function(data){
                   produto = JSON.parse(data);
                   lines = $('#tabelaProdutos>tbody>tr');
                   e = lines.filter( function(i, element) {
                       return element.cells[0].textContent == produto.id;
                   });
                   if(e){
                       e[0].cells[1].textContent = produto.name;
                       e[0].cells[2].textContent = produto.stock;
                       e[0].cells[3].textContent = produto.price;
                       e[0].cells[4].textContent = produto.categoria_id;
                   }
               },
               error: function(error) {
                   console.log(error);
               }
           });
        }

        function deleteProduct(id) {
           $.ajax({
               type: 'DELETE',
               url: '/api/produtos/' + id,
               context: this,
               success: function(){
                   lines = $('#tabelaProdutos>tbody>tr');
                    e = lines.filter( function(i, element) {
                       return element.cells[0].textContent == id; 
                   });
                   if(e){
                       e.remove();
                   }
               },
               error: function(error) {
                   console.log(error);
               }

           })
        }



    </script>
@endsection