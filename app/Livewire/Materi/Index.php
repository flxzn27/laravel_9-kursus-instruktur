<?php

// app/Livewire/Materi/Index.php

namespace App\Livewire\Materi;

use App\Models\Materi;
use App\Models\Kursus;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $kursus_id, $judul, $deskripsi, $file, $materiId, $isEdit = false;

    public function render()
    {
        return view('livewire.materi.index', [
            'kursuses' => Kursus::all(),
            'materis' => Materi::with('kursus')->latest()->get(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'kursus_id' => 'required|exists:kursuses,id',
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'file' => $this->isEdit ? 'nullable|file|mimes:pdf,doc,docx' : 'required|file|mimes:pdf,doc,docx',
        ]);

        $filePath = $this->file ? $this->file->store('materi-files', 'public') : null;

        Materi::updateOrCreate(
            ['id' => $this->materiId],
            [
                'kursus_id' => $this->kursus_id,
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'file' => $filePath ?? Materi::find($this->materiId)?->file,
            ]
        );

        $this->resetForm();
    }

    public function edit($id)
    {
        $m = Materi::findOrFail($id);
        $this->materiId = $m->id;
        $this->kursus_id = $m->kursus_id;
        $this->judul = $m->judul;
        $this->deskripsi = $m->deskripsi;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        $materi = Materi::findOrFail($id);
        if ($materi->file && \Storage::disk('public')->exists($materi->file)) {
            \Storage::disk('public')->delete($materi->file);
        }
        $materi->delete();
    }

    public function resetForm()
    {
        $this->materiId = null;
        $this->kursus_id = '';
        $this->judul = '';
        $this->deskripsi = '';
        $this->file = null;
        $this->isEdit = false;
    }
}