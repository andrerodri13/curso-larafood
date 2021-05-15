@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Listagem dos Planos <a href="{{route('plans.create')}}" class="btn btn-dark"><i class="fa fa-plus"></i></a></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('plans.index')}}">Planos </a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('plans.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preços</th>
                    <th width="250">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($plans as $plan)
                    <tr>
                        <td>{{$plan->name}}</td>
                        <td>R$ {{number_format($plan->price, 2, ',', '.')}}</td>
                        <td>
                            <a href="{{route('details.plan.index', $plan->url)}}" class="btn btn-primary"><i class="fas fa-list"></i></a>
                            <a href="{{route('plans.edit', $plan->url)}}" class="btn btn-info"><i class="fas fa-pen-alt"></i></a>
                            <a href="{{route('plans.show', $plan->url)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('plans.profiles', $plan->id) }}" class="btn btn-dark"><i class="fas fa-address-book"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif
        </div>
    </div>
@stop
