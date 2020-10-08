<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Create de Produto</title>
</head>
<body>
    <div class="container">
        <form method="POST" action="{{route('produto.store')}}">
            @csrf
            <div class="form-group">
                <label for="input-id">ID</label>
                <input type="text" class="form-control" id="input-id" aria-describedby="idHelp" placeholder="#" disabled>
                <small id="idHelp" class="form-text text-muted">Não é necessário informar o ID para cadastrar um novo dado.</small>
            </div>
            <div class="form-group">
                <label for="input-nome">Nome</label>
                <input type="text" name="nome" class="form-control" id="input-nome" placeholder="Digite o nome">
            </div>
            <div class="form-group">
                <label for="input-preco">Preço</label>
                <input type="text" name="preco" class="form-control" id="input-preco" placeholder="Digite o preço">
            </div>
            <div class="form-group">
                <label for="select-tipo">Tipo</label>
                <select id="select-tipo" class="form-control" name="tipo">
                    @foreach ($tipoProdutos as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
            <a class="btn btn-primary" href="{{route('produto.index')}}">Voltar</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>

