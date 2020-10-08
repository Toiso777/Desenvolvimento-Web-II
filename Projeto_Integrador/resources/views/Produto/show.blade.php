<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Create de Produtos</title>
</head>
<body>
    <div class="container">
        <div class="form-group">
            <label for="id-produto">ID</label>
            <input type="text" class="form-control" id="id-produto" value={{$produto->id}} disabled>
        </div>
        <div class="form-group">
            <label for="id-nome">Nome</label>
            <input type="text" class="form-control" id="id-nome" value={{$produto->nome}} disabled>
        </div>
        <div class="form-group">
            <label for="id-preco">Preço</label>
            <input type="text" class="form-control" id="id-preco" value={{$produto->preco}} disabled>
        </div>
        <div class="form-group">
            <label for="id-tipoproduto">Tipo de Produto</label>
            <select id="id-tipoproduto" class="form-control" disabled>
                @foreach ($tiposDeProduto as $tipoDeProduto)
                    @if ($tipoDeProduto->id == $produto->Tipo_Produtos_id)
                        <option selected>{{$tipoDeProduto->descricao}}</option>
                    @else    
                        <option>{{$tipoDeProduto->descricao}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id-updated">Data de última atualização</label>
            <input type="text" class="form-control" id="id-updated" value={{$produto->updated_at}} disabled>
        </div>
        <div class="form-group">
            <label for="id-created">Data de creiação</label>
            <input type="text" class="form-control" id="id-created" value={{$produto->created_at}} disabled>
        </div>
        <a class="btn btn-primary" href="{{route('produto.index')}}">Voltar</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>