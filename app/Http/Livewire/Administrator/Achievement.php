<?php

namespace App\Http\Livewire\Administrator;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Achievement extends Component
{
    use WithPagination;

    public $process = 0, $month, $year, $key, $information, $search;
    protected $queryString = ['process', 'search'];

    public function cancel()
    {
        $this->key = null;
    }

    public function setKey($key)
    {
        $this->key = $key;
        $this->information = null;
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function send()
    {
        $this->validate([
            'information' => 'required'
        ]);

        $achievement = \App\Models\Achievement::findOrFail($this->key);
        $achievement->member_wallet = $achievement->member->wallet;
        $achievement->process_information = auth()->user()->username.", ".$this->information;
        $achievement->processed_at = Carbon::now();
        $achievement->save();
        $this->key = null;
        $this->information = null;
    }

    public function render()
    {

        $data = \App\Models\Achievement::with('rating')->with('member')->orderBy('created_at');
        if ($this->process == 1) {
            $data = $data->where('processed_at', 'like', '%'.$this->search.'%')->whereNotNull('processed_at');
        } else {
            $data = $data->whereNull('processed_at');
        }

        $data = $data->paginate(10);
        return view('livewire.administrator.achievement', [
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])->extends('layouts.default', [
            'menu' => 'achievement'
        ]);
    }
}
