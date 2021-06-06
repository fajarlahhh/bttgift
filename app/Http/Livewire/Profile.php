<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class Profile extends Component
{
    public $data, $username, $referral_left, $referral_right, $email, $contract, $parent, $wallet, $upline, $name, $turnover;

    public function mount()
    {
        $this->data = auth()->user();
        $this->name = $this->data->name;
        $this->email = $this->data->email;
        $this->username = $this->data->username;
        $this->contract = $this->data->contract_price;
        $this->wallet = $this->data->wallet;
        $this->upline = $this->data->upline;
        $this->referral_left = URL::to('/registration?ref='.$this->data->referral_left);
        $this->referral_right = URL::to('/registration?ref='.$this->data->referral_right);
        $this->turnover = User::select(
            DB::raw('ifnull((select contract_price from user a where contract_price is not null and left(a.network, length(concat(user.network, user.id, "ki")))=concat(user.network, user.id, "ki") ), 0) left_turnover'),
            DB::raw('ifnull((select contract_price from user a where contract_price is not null and left(a.network, length(concat(user.network, user.id, "ka")))=concat(user.network, user.id, "ka") ), 0) right_turnover'))->where('id', auth()->id())->first();
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'contract' => 'required',
            'wallet' => 'required',
            'referral_left' => 'required',
            'referral_right' => 'required',
        ]);

        $user = User::findOrFail(auth()->id());
        $user->name = $this->name;
        $user->email = $this->email;
        $user->wallet = $this->wallet;
        $user->save();
    }

    public function render()
    {
        return view('livewire.profile', [
            'menu' => 'profile'
        ])->extends('layouts.default');
    }
}
