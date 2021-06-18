<?php

namespace App\Http\Livewire\Administrator;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Security extends Component
{
    public $success, $error, $google2fa_secret, $pin_google, $pin, $qr_image, $type = 'password', $show = 'Show', $new_password, $old_password;

    public function password()
    {
        $this->success = null;
        $this->error = null;
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required'
        ]);

        $user = User::findOrFail(auth()->id());

        if (Hash::check($this->old_password, $user->password)) {
            User::findOrFail(auth()->id())->update([
                'password' => Hash::make($this->new_password)
            ]);
            $this->reset(['old_password', 'new_password']);
            $this->success = "Your password has been updated";
        } else {
            $this->error .= "Invalid old password";
        }
    }

    public function render()
    {
        return view('livewire.administrator.security')->extends('layouts.default', [
            'menu' => 'security'
        ]);
    }
}
