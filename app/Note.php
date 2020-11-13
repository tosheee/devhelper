<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Note extends Model
{

    public function notesChildren()
    {
        return $this->hasOne('App\NotesChildren', 'id', 'id');
    }
}
