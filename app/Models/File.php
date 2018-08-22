<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * Relationships
     *
     * @return user_id
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
