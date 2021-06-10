<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hexters\CoinPayment\Entities\CoinpaymentTransaction;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'user';

    protected $fillable = [
        'username',
        'password',
        'name',
        'email',
        'phone',
        'actived_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rating()
    {
        return $this->belongsTo('App\Models\Rating', 'id_rating', 'id');
    }

    public function contract()
    {
        return $this->belongsTo('App\Models\Contract', 'contract_price', 'price');
    }

    public function registration_waiting_fund()
    {
        return $this->hasMany('App\Models\Deposit', 'id_member', 'id')->where('requisite', 'Registration')->whereNull('file')->whereNull('information')->whereNull('id_user')->whereNull('processed_at');
    }

    public function registration_waiting_process()
    {
        return $this->hasMany('App\Models\Deposit', 'id_member', 'id')->where('requisite', 'Registration')->whereNotNull('file')->whereNotNull('information')->whereNull('id_user')->whereNull('processed_at');
    }

    public function left_child()
    {
        return $this->hasMany('App\Models\User', 'upline', 'id')->where('role', 1)->with('invalid_left_turnover')->with('invalid_right_turnover')->where('position', 0)->whereNotNull('actived_at')->select("id", "username", "email", "id_rating", "upline", "position", "contract_price", "name", "network", "due_date", "deleted_at",
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ki")))=concat(user.network, user.id, "ki") ) left_turnover'),
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ka")))=concat(user.network, user.id, "ka") ) right_turnover'))->orderBy('username')->withTrashed();
    }

    public function right_child()
    {
        return $this->hasMany('App\Models\User', 'upline', 'id')->where('role', 1)->with('invalid_left_turnover')->with('invalid_right_turnover')->where('position', 1)->whereNotNull('actived_at')->select("id", "username", "email", "id_rating", "upline", "position", "contract_price", "name", "network", "due_date", "deleted_at",
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ki")))=concat(user.network, user.id, "ki") ) left_turnover'),
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ka")))=concat(user.network, user.id, "ka") ) right_turnover'))->orderBy('username')->withTrashed();
    }

    public function parent()
    {
        return $this->hasOne('App\Models\User', 'id', 'upline')->where('role', 1)->with('parent')->with('invalid_left_turnover')->with('invalid_right_turnover')->select("id", "username", "email", "id_rating", "upline", "position", "contract_price", "name", "network", "due_date", "deleted_at",
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ki")))=concat(user.network, user.id, "ki") ) left_turnover'),
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ka")))=concat(user.network, user.id, "ka") ) right_turnover'))->withTrashed();
    }

    public function invalid_right_turnover()
    {
        return $this->hasMany('App\Models\InvalidTurnover', 'id_member')->where("position", 1);
    }

    public function invalid_left_turnover()
    {
        return $this->hasMany('App\Models\InvalidTurnover', 'id_member')->where("position", 0);
    }
}
