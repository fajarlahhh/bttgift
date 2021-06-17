<?php

namespace App\Http\Livewire\Administrator;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Withdrawal extends Component
{
    use WithPagination;

    public $process = 0, $month, $year, $key, $information;
    protected $queryString = ['process'];

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
        $wd = \App\Models\Withdrawal::findOrFail($this->key);
        $wd->process_information = auth()->user()->username.", ".$this->information;
        $wd->processed_at = Carbon::now();
        $wd->save();
        $this->key = null;
        $this->information = null;
    }

    public function render()
    {
        $data = \App\Models\Withdrawal::with('member')->orderBy('created_at');
        if ($this->process == 1) {
            $data = $data->whereNotNull('processed_at');
        } else {
            $data = $data->whereNull('processed_at');
        }

        $data = $data->paginate(10);
        return view('livewire.administrator.withdrawal', [
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])->extends('layouts.default', [
            'menu' => 'withdrawal'
        ]);
    }
}
