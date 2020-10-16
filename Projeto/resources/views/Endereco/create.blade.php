<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>{{__('translate.createFromAddress')}}</title>
</head>
<body>
    <div class="container col-lg-8 rounded shadow pt-3 pb-3 mt-4">
        <form method="POST" action="{{route('endereco.store')}}">
            @csrf
            <div class="form-group">
                <label for="input-bairro">{{__('translate.street')}}</label>
                <input type="text" name="bairro" class="form-control" id="input-bairro" placeholder="Digite o bairro">
            </div>
            <div class="form-group">
                <label for="input-logradouro">{{__('translate.publicPlace')}}</label>
                <input type="text" name="logradouro" class="form-control" id="input-logradouro" placeholder="Digite o logradouro">
            </div>
            <div class="form-group">
                <label for="input-numero">{{__('translate.number')}}</label>
                <input type="number" name="numero" class="form-control" id="input-numero" placeholder="Digite o número">
            </div>
            <div class="form-group">
                <label for="input-complemento">{{__('translate.complement')}}</label>
                <input type="text" name="complemento" class="form-control" id="input-complemento" placeholder="Digite o complemento">
            </div>
            <div class="form-group">
                <label for="select-user">{{__('translate.user')}}</label>
                <select id="select-user" class="form-control" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{__('translate.send')}}</button>

            <a class="btn btn-success" href="{{route('endereco.index')}}">{{__('translate.return')}}</a>
 
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>

