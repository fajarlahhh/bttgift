<?php

namespace App\Http\Livewire\Member;

use Livewire\Component;

class Security extends Component
{
    public $error;
    public $google2fa_secret, $email, $data;

    public function registration()
    {
        User::findOrFail(auth()->id())->update([
            'google2fa_secret' => $this->google2fa_secret
        ]);
    }

    public function render()
    {
        $google2fa = app('pragmarx.google2fa');

        if (!auth()->user()->google2fa_secret) {
            $this->google2fa_secret = $google2fa->generateSecretKey(32);
        }else{
            $this->google2fa_secret = auth()->user()->google2fa_secret;
        }

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            auth()->user()->username,
            $this->google2fa_secret
        );
        return view('livewire.member.security',[
            'menu' => 'security',
            'qr' => $QR_Image,
            'secret' => $this->google2fa_secret
        ])->extends('layouts.default');
    }
}
