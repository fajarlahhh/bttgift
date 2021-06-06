<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bonus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bonus';

    public function withdrawal()
    {
        $this->belongsTo('App\Models\Withdrawal', 'id_withdrawal', 'id');
    }

    public function member()
    {
        $this->belongsTo('App\Models\Member', 'id', 'id_member');
    }
}
