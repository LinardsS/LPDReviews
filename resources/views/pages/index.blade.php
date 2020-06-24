  @extends('layouts.app')

@section('content')
{{-- <h1>{{$title}}</h1>
<p>This is a website for reviews! </p> --}}
<div class="jumbotron">
    <div class="container">
    <h1 class="display-3">{{__('text.introduction')}}</h1>
    <p>{{__('text.description')}}</p>
      <p><a class="btn btn-primary btn-lg" href="/login" role="button">{{__('text.login')}}</a>  <a class="btn btn-success btn-lg" href="/register" role="button">{{__('text.register')}}</a></p>
      <p>{{__('text.languageSelect')}}</p> <a href="/setlocale/en">English</a> <a href="setlocale/lv">Latviešu</a>
    </div>
  </div>
@endsection