@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <br>
                    <a href="/reviews/create" class="btn btn-primary">Create Review</a>
                    <br>
                    <br>
                    <h3>Your Reviews</h3>
                   @if(count($reviews)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($reviews as $review)
                        <tr>
                            <th>{{$review->title}}</th>
                            <td><a href="/reviews/{{$review->id}}/edit" class="btn btn-default">Edit</td>
                            <td>{{Form::open(['action' => ['ReviewsController@destroy',$review->id], 'method' => 'DELETE', 'class' => 'float-right'])}}

                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
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
