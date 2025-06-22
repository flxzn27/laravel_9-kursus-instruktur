<?php

// app/Livewire/Pendaftaran/AdminIndex.php

namespace App\Livewire\Pendaftaran;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; 
use App\Models\Pendaftaran;

class AdminIndex extends Component
{
    public function mount()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
    
    public function render()
    {
        return view('livewire.pendaftaran.admin-index', [
            'pendaftarans' => Pendaftaran::with(['user', 'kursus'])->latest()->get()
        ]);
    }

    public function setujui($id)
    {
        Pendaftaran::findOrFail($id)->update(['status' => 'disetujui']);
    }

    public function tolak($id)
    {
        Pendaftaran::findOrFail($id)->update(['status' => 'ditolak']);
    }

    public function hapus($id)
    {
        Pendaftaran::findOrFail($id)->delete();
    }
}
