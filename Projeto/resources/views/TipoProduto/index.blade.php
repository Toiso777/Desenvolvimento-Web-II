<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>{{__('translate.indexFromTypeProduct')}}</title>
</head>
<body>

    <div class="container">
        <a href="{{route('tipoproduto.create')}}">{{__('translate.createTypeProduct')}}</a>
    
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">{{__('translate.name')}}</th>
                    <th scope="col">{{__('translate.productType')}}</th>
                    <th scope="col">{{__('translate.actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resources as $resource)
                    <tr>
                        <th scope="row">{{$resource['id']}}</th>
                        <td>{{$resource['nome']}}</td>
                        <td>{{$resource['descricao']}}</td>
                        <td>
                            <a class="btn btn-outline-secondary" href="{{route('tipoproduto.edit', $resource['id'])}}">{{__('translate.edit')}}</a>
                            <a class="btn btn-outline-danger delButton" data-toggle="modal" data-target="#modalDelete" value="{{route('tipoproduto.destroy', $resource['id'])}}">{{__('translate.remove')}}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
