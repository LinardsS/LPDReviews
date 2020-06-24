@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('text.dashboard')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{__('text.loggedIn')}}
                    <br>
                    <a href="/reviews/create" class="btn btn-primary">{{__('text.createReview')}}</a>
                    <br>
                    <br>
                    <h3>{{__('text.yourReviews')}}</h3>
                   @if(count($reviews)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>{{__('text.title')}}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($reviews as $review)
                        <tr>
                            <th>{{$review->title}}</th>
                            <td><a href="/reviews/{{$review->id}}/edit" class="btn btn-primary">{{__('text.edit')}}</td>
                            <td>{{Form::open(['action' => ['ReviewsController@destroy',$review->id], 'method' => 'DELETE', 'class' => 'float-right'])}}
                                {{Form::submit(__('text.delete'), ['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @else 
                        <p> You have no reviews submitted </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
