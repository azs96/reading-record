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
            $user = \Auth::user();
            $genre_id = $request->get('genre_id');
            $sort = $request->get('sort');
            
            // ジャンル指定がある場合
            if($genre_id){
                $reading_records = $user->reading_records()->where('genre_id', $genre_id);
                
                // ジャンル指定も並び替えもある場合
                if($sort){
                    switch($sort){
                        case 'updated_at_desc':
                            $reading_records = $reading_records->orderBy('updated_at', 'desc')->paginate(10);
                            break;
                        case 'updated_at_asc':
                            $reading_records = $reading_records->orderBy('updated_at', 'asc')->paginate(10);
                            break;
                        case 'rating_desc':
                            $reading_records = $reading_records->orderBy('rating', 'desc')->paginate(10);
                            break;
                        case 'rating_asc':
                            $reading_records = $reading_records->orderBy('rating', 'asc')->paginate(10);
                            break;
                    }
                // 並び替え指定はない場合
                }else{
                    $reading_records = $reading_records->paginate(10);
                }
            // ジャンル指定なし
            }else{
                $reading_records = $user->reading_records();
                
                // ジャンル指定なし＆並び替えあり
                if($sort){
                    switch($sort){
                        case 'updated_at_desc':
                            $reading_records = $reading_records->orderBy('updated_at', 'desc')->paginate(10);
                            break;
                        case 'updated_at_asc':
                            $reading_records = $reading_records->orderBy('updated_at', 'asc')->paginate(10);
                            break;
                        case 'rating_desc':
                            $reading_records = $reading_records->orderBy('rating', 'desc')->paginate(10);
                            break;
                        case 'rating_asc':
                            $reading_records = $reading_records->orderBy('rating', 'asc')->paginate(10);
                            break;
                    }
                // ジャンル指定なし＆並び替えなし
                }else{
                    $reading_records = $reading_records->paginate(10);
                }
            }
        } else {
            return view('welcome');
        }
        
            $genres = Genre::all();
            
            return view('welcome', [
                'reading_records' => $reading_records,
                'genres' => $genres,
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
    
        
    
    public function destroy()
    {
        
    }
}
