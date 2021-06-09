<?php

namespace App\Http\Livewire\Member;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.member.dashboard', [
            'menu' => 'dashboard'
        ])->extends('layouts.default');
    }
}
