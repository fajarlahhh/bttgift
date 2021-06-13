<?php

namespace App\Http\Livewire\Member;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Downline extends Component
{
    public $key;

    protected $queryString = ['key'];

    public function mount()
    {
        $this->key = $this->key?:auth()->user()->username;
    }

    public function setKey($key)
    {
        $this->key = $key;
        $this->emit('reinitialize');
    }

    public function render()
    {
        $this->emit('reinitialize');
        $data = User::with('left_child')->with('right_child')->with('invalid_left_turnover')->with('invalid_right_turnover')->select("id", "username", "email", "id_rating", "upline", "position", "contract_price", "name", "network", "due_date", "deleted_at",
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ki")))=concat(user.network, user.id, "ki") ) left_turnover'),
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ka")))=concat(user.network, user.id, "ka") ) right_turnover'))->where('username', $this->key);

        return view('livewire.member.downline', [
            'data' => $data->first()
        ])->extends('layouts.default', [
            'menu' => 'downline'
        ]);
    }
}
