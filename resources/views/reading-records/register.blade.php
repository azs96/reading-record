@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Register New Reading Record</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'reading_records.store']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('author', 'Author') !!}
                    {!! Form::text('author', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('genre_id', 'Genre') !!}
                    <select class='form-control', name ='genre_id'>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', 'Content') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('rating', 'Rating') !!}
                    <select class='form-control', name ='rating'>
                        @for($score = 1; $score <= 100; $score++)
                            <option value="{{ $score }}">{{ $score }}</option>
                        @endfor
                    </select>
                </div>

                {!! Form::submit('Register', ['class' => 'btn btn-dark btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection