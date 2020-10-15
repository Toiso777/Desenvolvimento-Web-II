<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>{{__('translate.editFromTypeProduct')}}</title>
</head>
<body>

    <div class="container col-lg-8 rounded shadow pt-3 pb-3 mt-4">
        <form method="POST" action="{{route('tipoproduto.update', $tipoProduto['id'])}}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="input-id">ID</label>
                <input type="text" class="form-control" id="input-id" aria-describedby="idhelp" placeholder="{{$tipoProduto['id']}}" disabled>
            </div>
            <div class="form-group">
                <label for="input-desc">{{__('translate.description')}}</label>
                <input type="text" class="form-control" name="descricao" id="input-desc" placeholder="{{$tipoProduto['descricao']}}">
            </div>
            <button type="submit" class="btn btn-primary">{{__('translate.send')}}</button>
            <a class="btn btn-success" href="{{route('tipoproduto.index')}}">{{__('translate.return')}}</a>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>