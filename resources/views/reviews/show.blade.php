@extends('layouts.app')

@section('content')

    <a href="/reviews" class="btn btn-outline-primary">{{__('text.back')}}</a>
    <br>
    <br>
        <h1>{{$review->title}}</h1>
        <img style="width:50%;height:50%;max-width:500px;max-height:750px;" src="/storage/cover_images/{{$review->cover_img}}">
        <br><br>
        <div>
            {!!$review->body!!}
        </div>
        <hr>
        @if($review->category['name']!= null) <p>{{__('text.category')}}  {{$review->category['name']}}</p>
        @endif
        <small>{{__('text.writtenOn')}} {{$review->created_at}} by {{$review->user->name}}</small>
        <hr>
        @if(Auth::user()==$review->user)
        <a href="/reviews/{{$review->id}}/edit" class="btn btn-secondary"> Edit </a>

        {{Form::open(['action' => ['ReviewsController@destroy',$review->id], 'method' => 'DELETE', 'class' => 'float-right'])}}

        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset">
                @foreach($review->comments as $comment) 
                <div class="comment">
                <p><strong>{{__('text.name')}}:</strong> {!!$comment->name!!} <strong>Posted: </strong> {!!$comment->created_at->diffForHumans()!!}</p>
                <p><strong>{{__('text.comment')}}:</strong> <br/>{!!$comment->comment!!}</p><br>
                </div>

                @endforeach
            </div>
        </div>

        <div class="row">
            <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
                {{Form::open(['route'=>['comments.store', $review->id, 'method' =>'POST']])}}
                <div class="row">
                    <div class="col-md-6"> 
                        {{Form::label('name', "Name:")}}
                        {{Form::text('name', null, ['class' =>'form-control'])}}
                    </div>
                    <div class="col-md-6">
                        {{Form::label('email', "Email:")}}
                        {{Form::text('email', null, ['class' =>'form-control'])}}
                    </div>
                    <div class="col-md-12">
                        {{Form::label('comment', "Comment:")}}
                        {{Form::textarea('comment',null,['class' =>'form-control', 'rows'=>'5'])}}

                        {{Form::submit('Add comment', ['class'=>'btn btn-success btn-block','style'=>'margin-top:15px;'])}}
                    </div>
                </div>    
                {{Form::close()}}
            </div>
        </div>
@endsection