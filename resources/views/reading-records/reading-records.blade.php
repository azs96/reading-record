<div class="d-flex justify-content-around align-items-center">
    <div>
        {!! Form::open(['route' => 'reading-records.index', 'method' => 'get']) !!}
        <p>Genre
            <select class='form-select', name ='genre_id'>
                <option value="">すべて</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </p>
        <p>Sort　
            <select class='form-select', name ='sort'>
                <option value="updated_at_desc" @if ($sort == 'updated_at_desc') selected @endif>更新が新しい順</option>
                <option value="updated_at_asc" @if ($sort == 'updated_at_asc') selected @endif>更新が古い順</option>
                <option value="rating_desc" @if ($sort == 'rating_desc') selected @endif>評価が高い順</option>
                <option value="rating_asc" @if ($sort == 'rating_asc') selected @endif>評価が低い順</option>
            </select>
        </p>
    </div>
    <div>
            {!! Form::submit('show list', ['class' => 'btn btn-dark btn-block']) !!}
        {!! Form::close() !!}
    </div> 
    
    <div>
        {!! Form::open(['route' => 'reading-records.index', 'method' => 'get']) !!}
            <div class="form-group">
                {!! Form::text('search_words', $search_words) !!}
            </div>
    </div>
    <div>
            {!! Form::submit('search', ['class' => 'btn btn-dark btn-block']) !!}
        {!! Form::close() !!}
    </div>
</div>



@if (count($reading_records) > 0)
        @foreach ($reading_records as $reading_record)
            <div class="media mb-3">
                <div class="d-flex container">
                    <div class="col-md-2">
                        <i class="w-100 d-inline-block text-center fas fa-book-open fa-5x"></i>
                        <p class="text-center">{!! nl2br(e($reading_record->rating)) !!}</p>
                    </div>
                    
                    <div class=" media-body col-md-10">
                        <div>
                            <p class="mb-0 font-weight-bold">
                                <a class="text-dark" href="{{ route('reading_records.show', $reading_record->id) }}">
                                    <span class="badge bg-secondary text-light">{!! nl2br(e(\App\Genre::find($reading_record->genre_id)->name)) !!}</span>
                                    {!! nl2br(e($reading_record->title)) !!} ({!! nl2br(e($reading_record->author)) !!})
                                </a>
                            </p>
                        </div>
                        <div>
                            <p class="mb-0">{!! nl2br(e($reading_record->content)) !!}</p>
                        </div>
                        <div>
                            <p class="mb-0 text-right">last updated at {!! nl2br(e($reading_record->updated_at->format('y-m-d'))) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    {{-- ページネーションのリンク --}}
    {{ $reading_records->links() }}
@endif