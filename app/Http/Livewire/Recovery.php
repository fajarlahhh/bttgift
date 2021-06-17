<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Recovery extends Component
{
    public $data, $token, $error, $type = 'password', $show = 'Show', $new_password, $username, $id_member, $email, $name;

    protected $queryString = ['token'];

    public function showHide($type)
    {
        if ($type == 'Show') {
            $this->show = "Hide";
            $this->type = "text";
        } else {
            $this->show = "Show";
            $this->type = "password";
        }
    }

    protected $rules = [
        'new_password' => 'required'
    ];

    public function mount()
    {
        $this->data = \App\Models\Recovery::where('token', $this->token)->with('member')->first();
        if($this->data && $this->data->member){
            $this->id_member = $this->data->member->id;
            $this->username = $this->data->member->username;
            $this->name = $this->data->member->name;
            $this->email = $this->data->member->email;
        }
    }

    public function submit()
    {
        $this->reset('error');
        $this->validate();

        if($this->recaptchaPasses() === false){
            $this->error = "<p class='text-theme-6'>Recaptcha Failed</p>";
            return;
        }

        if (\App\Models\Recovery::where('token', $this->token)->count() === 0) {
            $this->error = "<p class='text-theme-6'>The link has expired</p>";
            return;
        }

        DB::transaction(function () {
            $member = User::findOrFail($this->id_member);
            $member->password = Hash::make($this->new_password);
            $member->save();

            \App\Models\Recovery::where('token', $this->token)->delete();
        });
        if (Auth::attempt(['username' => $this->username, 'password' => $this->new_password])) {
            Auth::logoutOtherDevices($this->new_password, 'password');
            return redirect('/dashboard');
        }
    }

    public function render()
    {
        Auth::logout();
        return view('livewire.recovery')->extends('layouts.auth');
    }
}
