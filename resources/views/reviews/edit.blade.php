@extends('layouts.app')

@section('content')
<br>
<br>
        <h1>Edit Review</h1>
        {{ Form::open(['action' => ['ReviewsController@update',$review->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title',$review->title ,['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
            <div class="form-group">
                {{Form::label('category_id','Category:')}}
                {{-- <select class="form-control" name="category_id">
                    @foreach($categories as $category)   
                    <option value='{{$category->id}}'>{{$category->name}}</option>
                    @endforeach
                </select> --}}
                {{Form::select('category_id',$categories, $review->category_id,['class' =>'form-control'] )}}
            </div>
            <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', $review->body,['id'=>'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text'])}}
            </div>
            <div class = "form-group">
                {{Form::file('cover_img')}}
        </div>
            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
        {{ Form::close() }}
@endsection