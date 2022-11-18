@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{__('translate.helloUserDashborad', ['user' => Auth::user()->name])}}
                        {{trans_choice('translate.notificationsCountMessage', 5, ['number' => 5])}}
                    </div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('welcome')}}" class="btn btn-primary">{{__('translate.return')}}</a>    
                        <a href="{{route('pedido.index')}}" class="btn btn-primary">{{__('translate.keepOrder')}}</a>
                        <a href="{{route('endereco.index')}}" class="btn btn-primary">{{__('translate.keepAndress')}}</a>
                        <a href="#" class="btn btn-primary">{{__('translate.keepProfile')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
