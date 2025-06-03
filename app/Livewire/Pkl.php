<?php

namespace App\Livewire;

use Livewire\Component;

class Pkl extends Component
{
    public $industris,$gurus,$pkls;

    public $siswa_id,$guru_id,$industri_id,$tanggal_mulai,$tanggal_selesai;
    public $showModal = false;

    public function mount(){
        $this->industris = \App\Models\Industri::all();
        $this->gurus = \App\Models\Guru::all();
        $this->pkls = \App\Models\Pkl::with(['siswa', 'guru', 'industri'])->get();

    }

    public function render()
    {
        return view('livewire.pkl.pkl');
    }

    public function save(){
        $this->validate([
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ],[
            'after' => 'Tanggal selesai harus setelah tanggal mulai.',
        ]);

        $siswa_id = Auth()->user()->siswa->id;

        \App\Models\Pkl::create([
            'siswa_id' => $siswa_id,
            'guru_id' => $this->guru_id,
            'industri_id' => $this->industri_id,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
        ]);

        $this->reset(['guru_id', 'industri_id','tanggal_mulai','tanggal_selesai', 'showModal']);
        session()->flash('message', 'Industri berhasil ditambahkan.');

    }
}
