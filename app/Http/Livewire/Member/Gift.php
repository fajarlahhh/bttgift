<?php

namespace App\Http\Livewire\Member;

use App\Models\Bonus;
use Livewire\Component;
use Livewire\WithPagination;

class Gift extends Component
{
    use WithPagination;

    public function render()
    {
        $data = Bonus::orderBy('created_at','asc')->where('id_member', auth()->id())->paginate(10);
        return view('livewire.member.gift', [
            'balance' => 0,
            'data' => $data,
            'no' => ($this->page - 1) * 10,
            'menu' => 'gift History'
        ])->extends('layouts.default');
    }
}
