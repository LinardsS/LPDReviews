  @extends('layouts.app')

@section('content')
{{-- <h1>{{$title}}</h1>
<p>This is a website for reviews! </p> --}}
<div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Welcome to LPDReviews!</h1>
      <p>This is a website where you can post reviews about movies, videogames, music and much more!</p>
      <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>  <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div>
  </div>
@endsection