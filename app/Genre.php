<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name'
    ];
    
    public function reading_records()
    {
        $this->hasMany(ReadingRecord::class);
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount('reading_records');
    }
}
