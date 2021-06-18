<?php

namespace App\Http\Livewire\Administrator;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Member extends Component
{
    use WithPagination;

    public $key, $active = 1;

    protected $queryString = ['active'];

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function delete()
    {
        $data = User::findOrFail($this->key)->delete();
    }

    public function render()
    {
        $data = User::select('*',
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ki")))=concat(user.network, user.id, "ki") ) left_turnover'),
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ka")))=concat(user.network, user.id, "ka") ) right_turnover'))->orderBy('username')->where('role', 1);
        if ($this->active == 1) {
            $data = $data->whereNotNull('actived_at');
        } else {
            $data = $data->whereNull('actived_at');
        }

        $data = $data->paginate(5);
        return view('livewire.administrator.member', [
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])->extends('layouts.default', [
            'menu' => 'member'
        ]);
    }
}
