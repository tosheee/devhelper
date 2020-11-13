<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotesChildren extends Model
{
    protected $guarded = [];

    public function note()
    {
        return $this->belongsTo('App\Note', 'id', 'id');
    }
}