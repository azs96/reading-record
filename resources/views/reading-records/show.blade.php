@extends('layouts.app')

@section('content')
        <div class="media container">
            <div class="media-body col-md-2">
                <i class="block-center fas fa-book-open fa-5x"></i>
            </div>
            <div class="col-md-12">
                <table class="table">
                        <tr>
                            <th class="w-25">title:</th>
                            <td>{!! nl2br(e($reading_record->title)) !!}</td>
                        </tr>
                        <tr>
                            <th>rating:</th>
                            <td>{!! $reading_record->rating !!}</td>
                        </tr>
                        <tr>
                            <th>genre:</th>
                            <td>{!! nl2br(e(\App\Genre::find($reading_record->genre_id)->name)) !!}</td>
                        </tr>
                        <tr>
                            <th>author:</th>
                            <td>{!! nl2br(e($reading_record->author)) !!}</td>
                        </tr>
                        <tr>
                            <th>content:</th>
                            <td>{!! nl2br(e($reading_record->content)) !!}</td>
                        </tr>
                        <tr>
                            <th>last updated at:</th>
                            <td>{!! nl2br(e($reading_record->updated_at->format('y-m-d'))) !!}</td>
                        </tr>
                </table>
            </div>
        </div>
        
        <div class="text-right d-flex justify-content-end">
            <div class="mr-5"><a class="btn btn-light" href="{{ route('reading_records.edit', $reading_record->id, ['reading_record' => $reading_record->id]) }}">Edit</a></div>
            {!! Form::model($reading_record, ['route' => ['reading_records.destroy', $reading_record->id], 'method' => 'delete']) !!}
                {!! Form::submit('delete', ['class' => 'btn btn-danger mr-5']) !!}
            {!! Form::close() !!}
            <div><a class="btn btn-secondary" href="{{ url()->previous() }}">Back to list</a></div>
        </div>
        

@endsection