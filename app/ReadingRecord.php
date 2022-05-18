<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadingRecord extends Model
{
    protected $fillable = ['genre_id', 'author', 'title', 'content', 'rating'];
    
    // この記録を保有するユーザ
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // この記録が保持するジャンル
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    
    // public function orderByModel($col, $sort)
    // {
    //     return $this->orderBy($col, $sort)->paginate(10);
    // }
}
