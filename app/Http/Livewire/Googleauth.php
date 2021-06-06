<?php

namespace App\Http\Livewire;

use Livewire\Component;
use RegistersUsers;

class Googleauth extends Component
{
    public $google2fa_secret, $email, $data;

    public function mount()
    {
        # code...
    }

    public function render()
    {
        $google2fa = app('pragmarx.google2fa');

        $data = $google2fa->generateSecretKey();

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $this->email,
            $this->google2fa_secret
        );

        return view('livewire.googleauth', [
            'menu' => 'dashboard',
            'qr' => $QR_Image,
            'secret' => $this->google2fa_secret
            ])->extends('layouts.default');
    }
}
