@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <h1>{{__('text.Reviews')}}</h1>
        @if(count($reviews)>0)
            @foreach($reviews as $review)
            <div class="card p-3 mt-3 mb-3">
                <div class = "row">
                    <div class = "col-md-4 col-sm-4">
                        <img style="width:100%;height:100%;max-width:500px;max-height:750px;" src="/storage/cover_images/{{$review->cover_img}}">
                    </div>
                    <div class = "col-md-8 col-sm-8">
                        <h3><a href="/reviews/{{$review->id}}">{{$review->title}}</a></h3>
                        <small>{{__('text.writtenOn')}} {{$review->created_at}} by {{$review->user->name}}</small>
                    </div>
                </div>
           
            </div>
            @endforeach
            {{$reviews->links()}}
        @else 
            <p>No reviews found</p>
        @endif
        </div>
@endsection