@extends('layouts.app')

@section('content')
<br>
<br>
        <h1>{{__('text.createReview')}}</h1>
        {{-- {!!Form::open(['action' => ['ReviewsController@destroy',$review->id], 'method' => 'DELETE', 'class' = 'float-right'])!!} --}}
        {{ Form::open(['action' => 'ReviewsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            <div class="form-group">
                {{Form::label('title', __('text.title'))}}
                {{Form::text('title', '',['class' => 'form-control', 'placeholder' => __('text.title')])}}
            </div>
            <div class="form-group">
            {{Form::label('category_id',__('text.category'))}}
            <select class="form-control" name="category_id">
                @foreach($categories as $category)   
                <option value='{{$category->id}}'>{{$category->name}}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">
                {{Form::label('body', __('text.body'))}}
                {{Form::textarea('body', '',['id'=>'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text'])}}
            </div>
            <div class = "form-group">
                    {{Form::file('cover_img')}}
            </div>
            {{Form::submit(__('text.submit'),['class' => 'btn btn-primary'])}}
        {{ Form::close() }}
@endsection