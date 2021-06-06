<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class Registration extends Component
{
    public $username, $password, $name, $email, $contract, $message, $ref, $upline, $data_contract, $error;

    protected $queryString = ['ref'];

    public function login()
    {
        redirect('/login');
    }

    public function mount()
    {
        $this->data_contract = Contract::all();

        $position = substr($this->ref, -1);
        if ($position == 1) {
            $upline = Member::where('referral_right', $this->ref)->first();
        } else {
            $upline = Member::where('referral_left', $this->ref)->first();
        }

        if (!$upline) {
            return abort(404);
        }
    }

    public function submit()
    {
        $this->error = null;
        $this->validate([
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'contract' => 'required'
        ]);

        if (Member::where('username', $this->username)->count() > 0) {
            $this->error .= "Username already used";
        }

        $upline = null;
        $referral = date('Ymd');
        $position = substr($this->ref, -1);
        if ($position == 1) {
            $upline = Member::where('referral_right', $this->ref)->first();
        } else {
            $upline = Member::where('referral_left', $this->ref)->first();
        }

        $user = new Member();
        $user->username = $this->username;
        $user->password = Hash::make($this->password);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->contract_price = $this->contract;
        $user->position = $position;
        $user->upline = $upline->id;
        $user->network = trim($upline->network).$upline->id.($position == 0? 'ki': 'ka');
        $user->referral_left = md5($this->username)."0";
        $user->referral_right = md5($this->username)."1";
        $user->save();

        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            Auth::logoutOtherDevices($this->password, 'password');
            return redirect('dashboard');
        }
    }

    public function render()
    {
        if(!$this->ref){
            abort(403, 'Unauthorized action.');
        }
        return view('livewire.registration', [
            'menu' => 'registration'
        ])->extends('layouts.auth');
    }
}
