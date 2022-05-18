@extends('layouts.app')

@section('content')

    <h1>Edit Record</h1>

            {!! Form::model($reading_record, ['route' => ['reading_records.update', $reading_record->id], 'method' => 'put']) !!}
            <div class="media container">
                <div class="media-body col-md-4">
                    <i class="block-center fas fa-book-open fa-5x"></i>
                </div>
                <div class="col-md-12">
                    <table class="table">
                            <tr>
                                <th>{!! Form::label('title', 'title:') !!}</th>
                                <td>{!! Form::text('title', null, ['class' => 'form-control']) !!}</td>
                            </tr>
                            <tr>
                                <th>{!! Form::label('rating', 'rating:') !!}</th>
                                <td>
                                    <select class='form-control', name ='rating'>
                                        @for($score = 1; $score <= 100; $score++)
                                            <option value="{{ $score }}" @if ($score == $reading_record->rating) selected @endif>{{ $score }}</option>
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>{!! Form::label('genre_id', 'genre:') !!}</th>
                                <td>
                                    <select class='form-control', name ='genre_id'>
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}" @if ($genre->id == $reading_record->genre_id) selected @endif>{{ $genre->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>{!! Form::label('author', 'author:') !!}</th>
                                <td>{!! Form::text('author', null, ['class' => 'form-control']) !!}</td>
                            </tr>
                            <tr>
                                <th>{!! Form::label('content', 'content:') !!}</th>
                                <td>{!! Form::text('content', null, ['class' => 'form-control']) !!}</td>
                            </tr>
                    </table>
                </div>
            </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection