@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header">
                    {{__('welcome_dashboards.helloUserDashboard', ['user'=> Auth::user()->name])}}
                    {{trans_choice('welcome_dashboards.notificationsCountMessage', 2, ['number' => 2])}}
                </div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('welcome')}}" class="btn btn-primary">Voltar</a>    
                        <a href="{{route('pedido.index')}}" class="btn btn-primary">Manter Pedidos</a>
                        <a href="#" class="btn btn-primary">Manter Endereços</a>
                        <a href="#" class="btn btn-primary">Manter Perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
