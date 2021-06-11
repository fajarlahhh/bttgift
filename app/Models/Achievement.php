<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievement';

    public function rating()
    {
        return $this->belongsTo('App\Models\Rating', 'id_rating', 'id');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\User', 'id_member', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Rating', 'id_user', 'id');
    }
}
