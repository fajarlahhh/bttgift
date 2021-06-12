<?php

namespace App\Http\Livewire\Member;

use App\Models\User;
use Livewire\Component;

class Security extends Component
{
    public $error, $google2fa_secret, $pin, $qr_image;

    public function mount()
    {
        $google2fa = app('pragmarx.google2fa');

        if (!auth()->user()->google2fa_secret) {
            $this->google2fa_secret = $google2fa->generateSecretKey(32);
        }else{
            $this->google2fa_secret = auth()->user()->google2fa_secret;
        }

        $this->qr_image = $google2fa->getQRCodeInline(
            config('app.name'),
            auth()->user()->username,
            $this->google2fa_secret
        );
    }

    public function registration()
    {
        $this->error = null;
        $this->validate([
            'pin' => 'required'
        ]);

        $google2fa = app('pragmarx.google2fa');
        if ($google2fa->verifyKey($this->google2fa_secret, $this->pin) === false) {
            $this->error .= "Invalid Google Authenticator PIN";
            return;
        }
        User::findOrFail(auth()->id())->update([
            'google2fa_secret' => $this->google2fa_secret
        ]);
    }

    public function render()
    {
        return view('livewire.member.security',[
            'menu' => 'security',
            'qr' => $this->qr_image,
            'secret' => $this->google2fa_secret
        ])->extends('layouts.default');
    }
}
