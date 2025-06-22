<?php

// app/Livewire/Pendaftaran/Index.php

namespace App\Livewire\Pendaftaran;

use Livewire\Component;
use App\Models\Kursus;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $kursus_id;

    public function render()
    {
        return view('livewire.pendaftaran.index', [
            'kursuses' => Kursus::all(),
            'pendaftarans' => Pendaftaran::with('kursus')
                ->where('user_id', Auth::id())
                ->get(),
        ]);
    }

    public function daftar()
    {
        $this->validate([
            'kursus_id' => 'required|exists:kursuses,id',
        ]);

        if (Pendaftaran::where('kursus_id', $this->kursus_id)->where('user_id', Auth::id())->exists()) {
            session()->flash('message', 'Anda sudah mendaftar kursus ini.');
            return;
        }        

        Pendaftaran::create([
            'kursus_id' => $this->kursus_id,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        session()->flash('message', 'Pendaftaran berhasil dikirim!');
        $this->kursus_id = '';
    }
}