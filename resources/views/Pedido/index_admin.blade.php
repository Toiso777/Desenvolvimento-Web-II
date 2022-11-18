<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="{{ asset('css/pedidoAdmin.css') }}" rel="stylesheet">
    <title></title>
</head>
<body>

    <section class="container-fluid" id="menus">
        <div class="container">
            <div class="left-container mt-5">
                <button class="btn btn-primary font-weight-bold w-100" href="{{route('admin.dashboard')}}">
                    {{__('translate.return')}}
                </button>

                <div class="pedidos-menu " id="id-pedidos-list" role="tablist">
                    @foreach ($pedidos as $pedido)
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab" value={{$pedido->id}}>
                        {{__('translate.order')}} {{$pedido->id}}
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="middle-container mt-5">
                <div class="pedido-titulo shadow bg-white rounded p-2"></div>

                <div class="pedidos-itens shadow bg-white rounded">
                    <ul id="id-pedido-produtos-list" class="list-group listProdutosSizeVertical my-2">
                    </ul>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control font-weight-bold" value="{{__('translate.amount')}}" disabled>
                    <div class="input-group-append">
                        <span class="input-group-text">R$</span>
                        <span id="id-span-preco" class="input-group-text">0,00</span>
                    </div>
                </div>
            </div>

            <div class="right-container mt-5">
                <div class="inputs">
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
                    <input type="spinner" id="id-spinner-quantity" class="" value="1" style="width: 100%">
                    <form id="id-form-add-pedido-produto" method="get" action="">
                        @csrf
                        <input type="submit" id="id-botao-adicionar-produto" class="btn btn-success btn-block my-2 font-weight-bold" value="{{__('translate.addProduct')}}">    
                    </form>
                    <select class="custom-select mr-sm-2 my-2" id="id-selecao-endereco" name="Enderecos_id">
                        @foreach ($enderecos as $endereco)
                            <option value="{{$endereco->id}}">{{$endereco->logradouro}} nº {{$endereco->numero}}, {{__('translate.neighbour')}}: {{$endereco->bairro}} - {{__('translate.complement')}}: {{$endereco->complemento}}</option>    
                        @endforeach
                    </select>
                    <form id="id-form-confirmar-pedido" method="get" action="#" class="mt-5">
                        @csrf
                        <input type="submit" id="id-botao-enviar-pedido" class="btn btn-warning text-white btn-block my-2 font-weight-bold" value="{{__('translate.productRequest')}}">
                    </form>
                    <form id="id-form-imprimir-pedido" method="get" action="#" >
                        @csrf
                        <input type="submit" id="id-botao-enviar-pedido" class="btn btn-info btn-block my-2 font-weight-bold" value="{{__('translate.sendOrder')}}">
                    </form>
                    <form id="id-form-cancelar-pedido" method="get" action="#" >
                        @csrf
                        <input type="submit" id="id-botao-enviar-pedido" class="btn btn-danger btn-block my-2 font-weight-bold" value="{{__('translate.cancelOrder')}}">
                    </form>
                    <form id="id-form-finalizar-pedido" method="get" action="#" >
                        @csrf
                        <input type="submit" id="id-botao-enviar-pedido" class="btn btn-success btn-block my-2 font-weight-bold" value="{{__('translate.finishOrder')}}">
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/pedidoAdmin.js') }}"></script>
</body>
</html>