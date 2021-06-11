<?php

namespace App\Http\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;

class Achievement extends Component
{
    use WithPagination;

    public function render()
    {
        $data = \App\Models\Achievement::where('id_member', auth()->id())->orderBy('created_at','desc')->paginate(10);
        return view('livewire.member.achievement', [
            'data' => $data,
            'no' => ($this->page - 1) * 10,
            'menu' => 'achievement'
        ])->extends('layouts.default');
    }
}
