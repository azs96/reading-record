<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class ReadingRecordsController extends Controller
{
    public function showRegistrationForm()
    {   
        $genres = Genre::all();
        return view('reading-records.register', [
            'genres' => $genres
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
