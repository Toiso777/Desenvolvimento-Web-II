@extends('layouts.admin-app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('translate.adminArea')}}</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('welcome')}}" class="btn btn-primary">{{__('translate.return')}}</a>    
                        <a href="#" class="btn btn-primary">{{__('translate.keepOrder')}}</a>
                        <a href="{{route('produto.index')}}" class="btn btn-primary">{{__('translate.keepProduct')}}</a>
                        <a href="{{route('tipoproduto.index')}}" class="btn btn-primary">{{__('translate.keepTypeProduct')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
