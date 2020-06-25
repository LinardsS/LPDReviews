@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{__('text.categories')}}</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('text.title')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <th>{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(!Auth::guest() && Auth::user()->hasRole('admin'))
        <div class="col-md-3">
            <div class="card card-body bg-light">
                {!!Form::open(['route' =>'categories.store', 'method' =>'POST'])!!}
                <h2>{{__('text.newCategory')}}</h2>  
                {{Form::label('name', __('text.nameColon'))}}
                {{Form::text('name',null, ['class' => 'form-control'])}}

                {{Form::submit(__('text.createNewCategory'),['class' => 'btn btn-primary btn-block','style'=>'margin-top:10px;'])}}
                {!!Form::close()!!}
            </div>
        </div>
        @endif
    </div>

@endsection