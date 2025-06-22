<?php

// app/Livewire/Instruktur/Index.php

namespace App\Livewire\Instruktur;

use App\Models\Instruktur;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $nama, $email, $instrukturId, $isEdit = false;

    public function mount()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
    }
    
    public function render()
    {
        return view('livewire.instruktur.index', [
            'instrukturs' => Instruktur::latest()->get()
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:instrukturs,email,' . $this->instrukturId,
        ]);

        Instruktur::updateOrCreate(['id' => $this->instrukturId], [
            'nama' => $this->nama,
            'email' => $this->email
        ]);

        $this->resetForm();
    }

    public function edit($id)
    {
        $instruktur = Instruktur::findOrFail($id);
        $this->instrukturId = $instruktur->id;
        $this->nama = $instruktur->nama;
        $this->email = $instruktur->email;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        Instruktur::destroy($id);
    }

    public function resetForm()
    {
        $this->nama = '';
        $this->email = '';
        $this->instrukturId = null;
        $this->isEdit = false;
    }
}