<?php

namespace App\Livewire;

use Livewire\Component;

class Industri extends Component
{
    public $showModal = false;
    public $isFormVisible = false;

    public function render()
    {
        $industris = \App\Models\Industri::all();
        return view('livewire.industri.industri',compact('industris'));
    }

    public function store(){
        
    }

    
}
