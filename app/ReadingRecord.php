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
    
    // public function orderModelBy($col, $sort)
    // {
    //     return $this->orderBy($col, $sort)->paginate(10);
    // }
    
    public static function sortModel($reading_records, $sort)
    {
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
        return $reading_records;
    }
    
}
