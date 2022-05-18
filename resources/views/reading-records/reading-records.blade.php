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
                <option value="updated_at_desc">更新が新しい順</option>
                <option value="updated_at_asc">更新が古い順</option>
                <option value="rating_desc">評価が高い順</option>
                <option value="rating_asc">評価が低い順</option>
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
    <ul class="list-unstyled container">
        @foreach ($reading_records as $reading_record)
            <li class="media mb-3">
                <div class=" media-body d-flex">
                    <div class="col-md-2">
                    <i class="block-center fas fa-book-open fa-5x"></i>
                        <p class="text-center">{!! nl2br(e($reading_record->rating)) !!}</p>
                    </div>
                    
                    <div class="col-md-10">
                        <div>
                            <p class="mb-0 font-weight-bold">
                                <span class="badge bg-secondary text-light">{!! nl2br(e(\App\Genre::find($reading_record->genre_id)->name)) !!}</span>
                                {!! nl2br(e($reading_record->title)) !!} ({!! nl2br(e($reading_record->author)) !!})
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
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $reading_records->links() }}
@endif