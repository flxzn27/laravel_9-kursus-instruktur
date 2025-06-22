<?php

// app/Livewire/Kursus/Index.php

namespace App\Livewire\Kursus;

use App\Models\Kursus;
use App\Models\Instruktur;
use Livewire\Component;
use Illuminate\Support\Facades\Auth; 

class Index extends Component
{
    public $nama_kursus, $durasi, $instruktur_id, $biaya, $kursusId, $isEdit = false;

    public function mount()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
    }
    
    public function render()
    {
        return view('livewire.kursus.index', [
            'kursuses' => Kursus::with('instruktur')->latest()->get(),
            'instrukturs' => Instruktur::all()
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama_kursus' => 'required',
            'durasi' => 'required',
            'instruktur_id' => 'required|exists:instrukturs,id',
            'biaya' => 'required|numeric'
        ]);

        Kursus::updateOrCreate(['id' => $this->kursusId], [
            'nama_kursus' => $this->nama_kursus,
            'durasi' => $this->durasi,
            'instruktur_id' => $this->instruktur_id,
            'biaya' => $this->biaya
        ]);

        $this->resetForm();
    }

    public function edit($id)
    {
        $k = Kursus::findOrFail($id);
        $this->kursusId = $k->id;
        $this->nama_kursus = $k->nama_kursus;
        $this->durasi = $k->durasi;
        $this->instruktur_id = $k->instruktur_id;
        $this->biaya = $k->biaya;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        Kursus::destroy($id);
    }

    public function resetForm()
    {
        $this->nama_kursus = '';
        $this->durasi = '';
        $this->instruktur_id = '';
        $this->biaya = '';
        $this->kursusId = null;
        $this->isEdit = false;
    }
}
