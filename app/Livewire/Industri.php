<?php

namespace App\Livewire;

use Livewire\Component;

class Industri extends Component
{
    public $showModal = false;

    public $nama,$bidang_usaha,$alamat,$kontak,$email,$website;

    public function render()
    {
        $industris = \App\Models\Industri::all();
        return view('livewire.industri.industri',compact('industris'));
    }

    public function save(){
        $this->validate([
            'nama' => 'required',
            'bidang_usaha' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
            'email' => 'required|email',
            'website' => 'nullable',
        ]);

        \App\Models\Industri::create([
            'nama' => $this->nama,
            'bidang_usaha' => $this->bidang_usaha,
            'alamat' => $this->alamat,
            'kontak' => $this->kontak,
            'email' => $this->email,
            'website' => $this->website,
        ]);
        $this->reset(['nama', 'alamat','bidang_usaha','email','kontak','website', 'showModal']);
        session()->flash('message', 'Industri berhasil ditambahkan.');

    }

    
}
