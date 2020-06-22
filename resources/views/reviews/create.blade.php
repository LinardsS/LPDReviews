@extends('layouts.app')

@section('content')
<br>
<br>
        <h1>Create Review</h1>
        {{-- {!!Form::open(['action' => ['ReviewsController@destroy',$review->id], 'method' => 'DELETE', 'class' = 'float-right'])!!} --}}
        {{ Form::open(['action' => 'ReviewsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '',['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
            <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', '',['id'=>'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text'])}}
            </div>
            <div class = "form-group">
                    {{Form::file('cover_img')}}
            </div>
            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
        {{ Form::close() }}
@endsection