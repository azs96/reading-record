@extends('layouts.app')

@section('content')
 <div class="center jumbotron bg-light">
    <div class="text-center">
        <h1>Reading Record</h1>
    </div>
    <div class="text-center">
        <a class="btn btn-dark btn-lg mr-5" href="#" role="button">Log in</a>
        {!! link_to_route('signup.get', 'Sign up', [], ['class' => 'btn btn-dark btn-lg ml-5']) !!}
    </div>
 </div>
@endsection