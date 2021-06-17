<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Recovery;
use Illuminate\Support\Str;
use App\Jobs\SendRecoveryMail;
use Illuminate\Support\Facades\Auth;

class Forgot extends Component
{
    public $error, $email, $success;

    protected $rules = [
        'email' => 'required|email'
    ];

    public function recover()
    {
        $this->reset('error');
        $this->validate();

        $member = null;
        $user = User::where('email', $this->email)->get();
        if ($user->count() > 0) {
            $member = $user->first();
            if (Recovery::where('email', $member->email)->count() > 0){
                $this->error = "<p class='text-theme-6'>You've done this action before. Please check your email!!!</p>";
            }
        }else{
            $this->error = "<p class='text-theme-6'>Email is not registered!!!</p>";
        }

        if($this->error){
            return;
        }

        $recovery = new Recovery();
        $recovery->email = $member->email;
        $recovery->token = Str::random(40).date("Ymdhms");
        $recovery->save();
        $details =[
            'token' => $recovery->token,
            'name' => $member->username,
            'email' => $member->email
        ];
        dispatch(new SendRecoveryMail($details));

        $this->success = "<p class='text-theme-9'>The recovery link has been sent to ".$member->email."</p>";
    }

    public function render()
    {
        Auth::logout();
        return view('livewire.forgot')->extends('layouts.auth');
    }
}
