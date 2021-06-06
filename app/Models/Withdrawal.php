<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdrawal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'withdrawal';

    public function user()
    {
        $this->belongsTo('App\Models\User', 'id', 'id_user');
    }

    public function member()
    {
        $this->belongsTo('App\Models\Member', 'id', 'id_member');
    }
}
