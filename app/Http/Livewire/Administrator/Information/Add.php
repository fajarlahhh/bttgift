<?php

namespace App\Http\Livewire\Administrator\Information;

use Livewire\Component;

class Add extends Component
{
    public $title, $content;

    protected $listeners = ['set:setcontent' => 'setContent'];

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $information = new \App\Models\Information();
        $information->id_user = auth()->id();
        $information->title = $this->title;
        $information->content = $this->content;
        $information->save();
        redirect('/admin-area/information');
    }

    public function render()
    {
        return view('livewire.administrator.information.add')->extends('layouts.default', [
            'menu' => 'information'
        ]);
    }
}
