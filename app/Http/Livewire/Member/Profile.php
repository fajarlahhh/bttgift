<?php

namespace App\Http\Livewire\Member;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class Profile extends Component
{
    public $data, $username, $left_referral, $right_referral, $email, $contract, $parent, $wallet, $upline, $name, $left_turnover, $right_turnover;

    public function mount()
    {
        $this->data = auth()->user();
        $this->name = $this->data->name;
        $this->email = $this->data->email;
        $this->username = $this->data->username;
        $this->contract = $this->data->contract_price;
        $this->wallet = $this->data->wallet;
        $this->upline = $this->data->upline;
        $this->left_referral = URL::to('/registration?ref='.$this->data->left_referral);
        $this->right_referral = URL::to('/registration?ref='.$this->data->right_referral);
        $turnover = User::select(
            DB::raw('ifnull((select sum(contract_price) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ki")))=concat(user.network, user.id, "ki") ), 0) left_turnover'),
            DB::raw('ifnull((select sum(contract_price) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ka")))=concat(user.network, user.id, "ka") ), 0) right_turnover'))->where('id', auth()->id())->first();
        $this->right_turnover = $turnover['right_turnover'];
        $this->left_turnover = $turnover['left_turnover'];

    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'contract' => 'required',
            'wallet' => 'required',
            'left_referral' => 'required',
            'right_referral' => 'required',
        ]);

        $user = User::findOrFail(auth()->id());
        $user->name = $this->name;
        $user->email = $this->email;
        $user->wallet = $this->wallet;
        $user->save();
    }

    public function render()
    {
        return view('livewire.member.profile', [
            'menu' => 'profile'
        ])->extends('layouts.default');
    }
}
