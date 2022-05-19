<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\ReadingRecord;

class ReadingRecordsController extends Controller
{
    public function showRegistrationForm()
    {   
        $genres = Genre::all();
        return view('reading-records.register', [
            'genres' => $genres
        ]);
    }
    
    
    public function index(Request $request)
    {   
        if(\Auth::check()){
            $reading_records = \Auth::user()->reading_records();
            $genre_id = $request->get('genre_id');
            $sort = $request->get('sort');
            $search_words = $request->get('search_words');
            $query = ReadingRecord::query();

            // 検索語がある場合
            if(!empty($search_words)){
                $spaceConversion = mb_convert_kana($search_words, 's');
                $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
                
                $query->where(function($q) use($wordArraySearched){
                    foreach($wordArraySearched as $value){
                        $q->orWhere('title', 'like', '%'.$value.'%')
                        ->orWhere('content', 'like', '%'.$value.'%')
                        ->orWhere('author', 'like', '%'.$value.'%');
                    }
                });
                $reading_records = $query;
            }
            
            // ジャンル指定がある場合
            if(!empty($genre_id)){
                $reading_records = $reading_records->where('genre_id', $genre_id);
                // ジャンル指定も並び替えもある場合
                if(!empty($sort)){
                    $records = new ReadingRecord();
                    $reading_records = $records->sortModel($reading_records, $sort);
                // 並び替え指定はない場合
                }else{
                    $reading_records = $reading_records;
                }
            // ジャンル指定なし
            }else{
                // ジャンル指定なし＆並び替えあり
                if(!empty($sort)){
                    $records = new ReadingRecord();
                    $reading_records = $records->sortModel($reading_records, $sort);
                // ジャンル指定なし＆並び替えなし
                }else{
                    $reading_records = $reading_records;
                }
            }
            
            
        } else {
            return view('welcome');
        }
        
            $genres = Genre::all();
            $reading_records = $reading_records->paginate(10);
            
            return view('welcome', [
                'reading_records' => $reading_records,
                'genres' => $genres,
                'sort' => $sort,
                'genre_id' => $genre_id,
                'search_words' => $search_words,
            ]);
        
         
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'genre_id' => 'required|integer',
            'author' => 'required|max:255',
            'title' => 'required|max:255',
            'content' => 'required|max:16384',
            'rating' => 'required|integer',
        ]);
        
        // 認証済みユーザ（現在の閲覧者）の投稿として作成
        $request->user()->reading_records()->create([
            'genre_id' => $request->genre_id,
            'author' => $request->author,
            'title' => $request->title,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);
        
        return back();
    }
    
        
    
    public function destroy($id)
    {
        $reading_record = ReadingRecord::findOrFail($id);
        $reading_record->delete();
        
        return redirect('/');
    }
    
    public function show($id)
    {
        $reading_record = ReadingRecord::findOrFail($id);
        
        return view('reading-records.show', [
            'reading_record' => $reading_record,
        ]);
    }
    
    public function edit($id)
    {
        $reading_record = ReadingRecord::findOrFail($id);
        $genres = Genre::get(['id', 'name']);
        $scores = [];
        for($score = 1; $score <= 100; $score++){
            $scores = $score;
        }

        return view('reading-records.edit', [
            'reading_record' => $reading_record,
            'genres' => $genres,
            'scores' => $scores,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'genre_id' => 'required|integer',
            'author' => 'required|max:255',
            'title' => 'required|max:255',
            'content' => 'required|max:16384',
            'rating' => 'required|integer',
        ]);
        
        $reading_record = ReadingRecord::findOrFail($id);
        
        $reading_record->content = $request->content;
        $reading_record->title = $request->title;
        $reading_record->rating = $request->rating;
        $reading_record->genre_id = $request->genre_id;
        $reading_record->author = $request->author;
        $reading_record->save();
        
        return $this->show($reading_record->id);
    }
}
