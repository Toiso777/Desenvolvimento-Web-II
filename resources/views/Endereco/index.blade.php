<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>{{__('translate.indexFromAddress')}}</title>
</head>
<body>
    <div class="container col-lg-8 rounded shadow mt-4">
    <a class="btn btn-primary mt-3 mb-3" href="{{route('endereco.create')}}">{{__('translate.storeNewAddress')}}</a>

    <table class=" table">
        <tr>
            <td>#ID</td>
            <td>{{__('translate.neighbour')}}</td>
            <td>{{__('translate.street')}}</td>
            <td>{{__('translate.number')}}</td>
            <td>{{__('translate.complement')}}</td>
            <td>{{__('translate.name')}}</td>
            <td>{{__('translate.actions')}}</td>
        </tr>
        @foreach ($enderecos as $endereco)
            <tr>
                <td>{{$endereco['id']}}</td>
                <td>{{$endereco['bairro']}}</td>
                <td>{{$endereco['logradouro']}}</td>
                <td>{{$endereco['numero']}}</td>
                <td>{{$endereco['complemento']}}</td>
                <td>{{$endereco['name']}}</td>
                <td>
                    <a class="btn btn-secondary" href="{{route('endereco.show', $endereco['id'])}}">{{__('translate.show')}}</a>  
                    <a class="btn btn-primary" href="{{route('endereco.edit', $endereco['id'])}}">{{__('translate.edit')}}</a>  
                    <a class="btn btn-danger delButton" data-toggle="modal" data-target="#modalDelete" value="{{route('endereco.destroy', $endereco['id'])}}">{{__('translate.remove')}}</a>
                </td>
            </tr>
        @endforeach
    </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__('translate.removeR')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                {{__('translate.wantR')}}
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('translate.cancel')}}</button>
            <form id="modal-delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{__('translate.remove')}}</button>
            </form>
            </div>
        </div>
        </div>
    </div>


    <script>
        var buttons = document.querySelectorAll('.delButton');
        var formDelete = document.querySelector('#modal-delete-form');
        
        buttons.forEach(button=>{
            button.addEventListener('click', delButtonClick);
        });

        function delButtonClick(){
            formDelete.setAttribute("action", this.getAttribute("value"));
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>