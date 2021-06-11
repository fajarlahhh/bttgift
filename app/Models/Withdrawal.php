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

    protected $fillable = [
        'id_user',
        'processed_at',
        'information'
    ];

    public function user()
    {
        $this->belongsTo('App\Models\User', 'id_user', 'id');
    }

    public function member()
    {
        $this->belongsTo('App\Models\User', 'id_member', 'id');
    }
}
