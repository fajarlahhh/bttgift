<?php

namespace App\Http\Livewire\Member;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Security extends Component
{
    public $success, $error, $google2fa_secret, $pin_google, $pin, $qr_image, $type = 'password', $show = 'Show', $new_password, $old_password;

    public function mount()
    {
        $google2fa = app('pragmarx.google2fa');

        if (!auth()->user()->google2fa_secret) {
            $this->google2fa_secret = $google2fa->generateSecretKey();
        }else{
            $this->google2fa_secret = auth()->user()->google2fa_secret;
        }

        $this->qr_image = $google2fa->getQRCodeInline(
            config('app.name'),
            auth()->user()->username,
            $this->google2fa_secret
        );
    }

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

    public function password()
    {
        $this->success = null;
        $this->error = null;
        if (auth()->user()->google2fa_secret) {
            $this->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'pin' => 'required'
            ]);

            $google2fa = app('pragmarx.google2fa');
            if ($google2fa->verifyKey($this->google2fa_secret, $this->pin) === false) {
                $this->error .= "Invalid Google Authenticator PIN";
                return;
            }
        }else{
            $this->validate([
                'old_password' => 'required',
                'new_password' => 'required'
            ]);
        }

        $user = User::findOrFail(auth()->id());

        if (Hash::check($this->old_password, $user->password)) {
            User::findOrFail(auth()->id())->update([
                'password' => Hash::make($this->new_password)
            ]);
            $this->reset(['old_password', 'new_password', 'pin']);
            $this->success = "Your password has been updated";
        } else {
            $this->error .= "Invalid old password";
        }
    }

    public function registration()
    {
        $this->success = null;
        $this->error = null;
        $this->validate([
            'pin_google' => 'required'
        ]);

        $google2fa = app('pragmarx.google2fa');
        if ($google2fa->verifyKey($this->google2fa_secret, $this->pin_google) === false) {
            $this->error .= "Invalid Google Authenticator PIN";
            return;
        }
        User::findOrFail(auth()->id())->update([
            'google2fa_secret' => $this->google2fa_secret
        ]);
        redirect('security');
    }

    public function render()
    {
        return view('livewire.member.security',[
            'qr' => $this->qr_image,
            'secret' => $this->google2fa_secret
        ])->extends('layouts.default', [
            'menu' => 'security'
        ]);
    }
}
