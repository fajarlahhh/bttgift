<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hexters\CoinPayment\Entities\CoinpaymentTransaction;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'member';

    protected $fillable = [
        'username',
        'password',
        'name',
        'email',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function coinpayment_waiting()
    {
        return $this->hasMany('Hexters\CoinPayment\Entities\CoinpaymentTransaction', 'buyer_email', 'email')->where('status', 0);
    }

    public function contract()
    {
        return $this->belongsTo('App\Models\Contract', 'contract_price', 'price');
    }

    public function registration_waiting()
    {
        return $this->hasMany('App\Models\Deposit', 'id_member', 'id')->where('requisite', 'Registration')->whereNull('id_user')->whereNull('prcessed_at');
    }

    public function left_child()
    {
        return $this->hasMany('App\Models\Member', 'parent', 'id')->with('invalid_left_turnover')->with('invalid_right_turnover')->where('member_position', 0)->whereNotNull('password')->select("id", "username", "email", "rating", "parent", "position", "contract_price", "name", "network", "due_date", "deleted_at",
        DB::raw('(select ifnull(contract_price, 0) from member a where a.password is not null and left(a.network, length(concat(member.network, member.id, "ki")))=concat(member.network, member.id, "ki") ) left_turnover'),
        DB::raw('(select ifnull(contract_price, 0) from member a where a.password is not null and left(a.network, length(concat(member.network, member.id, "ka")))=concat(member.network, member.id, "ka") ) right_turnover'))->orderBy('username');
    }

    public function right_child()
    {
        return $this->hasMany('App\Models\Member', 'parent', 'id')->with('invalid_left_turnover')->with('invalid_right_turnover')->where('member_position', 1)->whereNotNull('password')->select("id", "username", "email", "rating", "parent", "position", "contract_price", "name", "network", "due_date", "deleted_at",
        DB::raw('(select ifnull(contract_price, 0) from member a where a.password is not null and left(a.network, length(concat(member.network, member.id, "ki")))=concat(member.network, member.id, "ki") ) left_turnover'),
        DB::raw('(select ifnull(contract_price, 0) from member a where a.password is not null and left(a.network, length(concat(member.network, member.id, "ka")))=concat(member.network, member.id, "ka") ) right_turnover'))->orderBy('username');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Member', 'id', 'parent')->with('parent')->with('invalid_left_turnover')->with('invalid_right_turnover')->select("id", "email", "name", "username", "parent", "position", "contract_price", "network", "due_date", "deleted_at",
        DB::raw('(select ifnull(contract_price, 0) from member a where a.active_at is not null and left(a.network, length(concat(member.network, member.id, "ki")))=concat(member.network, member.id, "ki") ) left_turnover'),
        DB::raw('(select ifnull(contract_price, 0) from member a where a.active_at is not null and left(a.network, length(concat(member.network, member.id, "ka")))=concat(member.network, member.id, "ka") ) right_turnover'))->withTrashed();
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
