@extends('layouts.app')

@section('content')
{{-- ログインしていない場合のホームページ --}}
    @if (!Auth::check())
        <div class="center jumbotron bg-light">
            <div class="text-center">
                <h1>Reading Record</h1>
            </div>
            <div class="text-center">
                {!! link_to_route('login', 'Log in', [], ['class' => 'btn btn-dark btn-lg mr-5']) !!}
                {!! link_to_route('signup.get', 'Sign up', [], ['class' => 'btn btn-dark btn-lg ml-5']) !!}
            </div>
        </div>
    {{-- ログインしている場合はいちらん表示todo --}}
    @else
        
    @endif
@endsection