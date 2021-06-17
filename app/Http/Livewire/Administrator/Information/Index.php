<?php

namespace App\Http\Livewire\Administrator\Information;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $key;

    public function cancel()
    {
        $this->key = null;
    }

    public function setKey($key)
    {
        $this->key = $key;
        $this->information = null;
    }

    public function delete()
    {
        \App\Models\Information::findOrFail($this->key)->delete();
    }

    public function render()
    {
        $data = \App\Models\Information::with('user')->orderBy('created_at')->paginate(10);
        return view('livewire.administrator.information.index', [
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])->extends('layouts.default', [
            'menu' => 'information'
        ]);
    }
}
