<?php

namespace App\Http\Livewire;

use App\Models\Member;
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
        $this->turnover = Member::select(
            DB::raw('ifnull((select contract_price from member a where contract_price is not null and left(a.network, length(concat(member.network, member.id, "ki")))=concat(member.network, member.id, "ki") ), 0) left_turnover'),
            DB::raw('ifnull((select contract_price from member a where contract_price is not null and left(a.network, length(concat(member.network, member.id, "ka")))=concat(member.network, member.id, "ka") ), 0) right_turnover'))->where('id', auth()->id())->first();
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

        $member = Member::findOrFail(auth()->id());
        $member->name = $this->name;
        $member->email = $this->email;
        $member->wallet = $this->wallet;
        $member->save();
    }

    public function render()
    {
        return view('livewire.profile', [
            'menu' => 'profile'
        ])->extends('layouts.default');
    }
}
