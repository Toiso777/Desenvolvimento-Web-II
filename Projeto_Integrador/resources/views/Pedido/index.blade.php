<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="{{ asset('css/pedido.css') }}" rel="stylesheet">
    <title>Index de pedidos</title>
</head>
<body>
    <div class="container">
        {{-- Div para mostrar as mensagens de erro --}}
        <div class="messageBox my-5">
        </div>
          
        <div class="row">
            <div class="col-lg-4">
                <form id="id-form-novo-pedido" class="form-group my-2" name="formPedido">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <a class="btn btn-primary font-weight-bold w-100" href="{{route('home')}}">Voltar</a>
                        </div>
                        <div class="col-8">
                            <input type="submit" class="btn btn-info font-weight-bold w-100" value="Novo pedido">
                        </div>
                    </div>
                </form>
                <div class="list-group listPedidosSizeVertical my-2" id="id-pedidos-list" role="tablist">
                    @foreach ($pedidos as $pedido)
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab" value={{$pedido->id}}>Pedido {{$pedido->id}}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <h3 class="my-2 text-center"><strong>Adicione Produtos</strong></h3>
                <select class="custom-select mr-sm-2 my-2" id="id-selecao-tipo-produto">
                    @foreach ($tipoProdutos as $tipoProduto)
                        <option value="{{$tipoProduto->id}}">{{$tipoProduto->descricao}}</option>    
                    @endforeach
                </select>
                <select class="custom-select mr-sm-2 my-2" id="id-selecao-produto">
                    @foreach ($produtosDoPrimeiroTipo as $produto)
                        <option value="{{$produto->id}}">{{$produto->nome}}</option>    
                    @endforeach
                </select>
                <input type="spinner" id="id-spinner-quantity" class="" value="1" style="width: 90%">
                <form id="id-form-add-pedido-produto" method="post" action="">
                    @csrf
                    <input type="submit" id="id-botao-adicionar-produto" class="btn btn-success btn-block my-2 font-weight-bold" value="Adicionar produto">    
                </form>
                <select class="custom-select mr-sm-2 my-2" id="id-selecao-endereco" name="Enderecos_id">
                    @foreach ($enderecos as $endereco)
                        <option value="{{$endereco->id}}">{{$endereco->logradouro}} nº {{$endereco->numero}}, Bairro: {{$endereco->bairro}} - Complemento: {{$endereco->complemento}}</option>    
                    @endforeach
                </select>
                <form id="id-form-enviar-pedido" method="post" action="">
                    @csrf
                    <input type="submit" id="id-botao-enviar-pedido" class="btn btn-info btn-block my-2 font-weight-bold" value="Enviar pedido">
                </form>
            </div>
            <div class="col-lg-4">
                <input type="text" id="id-text-estado" class="form-control my-2 text-center font-weight-bold" id="text-estado" value="">
                <ul id="id-pedido-produtos-list" class="list-group listProdutosSizeVertical my-2">
                </ul>
                <div class="input-group">
                    <input type="text" class="form-control font-weight-bold" value="Valor total:" disabled>
                    <div class="input-group-append">
                        <span class="input-group-text">R$</span>
                        <span id="id-span-preco" class="input-group-text">0,00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="id-destroy-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Remoção de produto de pedido</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Deseja remover o produto do pedido?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <form id="id-form-delete" method="post" action="">
                @csrf
                <input id="id-botao-form-delete" type="submit" class="btn btn-danger" value="Remover">
            </form>
            </div>
        </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/pedido.js') }}"></script>
</body>
</html>

