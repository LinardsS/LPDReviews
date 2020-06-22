@extends('layouts.app')

@section('content')
<br>
<br>
    <a href="/reviews" class="btn btn-outline-primary">Back</a>
    <br>
    <br>
        <h1>{{$review->title}}</h1>
        <img style="width:100%" src="/storage/cover_images/{{$review->cover_img}}">
        <br><br>
        <div>
            {!!$review->body!!}
        </div>
        <hr>
        <small>Written on {{$review->created_at}} by {{$review->user->name}}</small>
        <hr>
        @if(Auth::user()==$review->user)
        <a href="/reviews/{{$review->id}}/edit" class="btn btn-secondary"> Edit </a>

        {{Form::open(['action' => ['ReviewsController@destroy',$review->id], 'method' => 'DELETE', 'class' => 'float-right'])}}

        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
        @endif
@endsection