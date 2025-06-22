<div class="p-4 max-w-3xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Upload Materi Kursus</h2>

    <form wire:submit.prevent="store" class="space-y-4 mb-6" enctype="multipart/form-data">
        <select wire:model="kursus_id" class="w-full border p-2 rounded">
            <option value="">-- Pilih Kursus --</option>
            @foreach($kursuses as $kursus)
                <option value="{{ $kursus->id }}">{{ $kursus->nama_kursus }}</option>
            @endforeach
        </select>

        <input type="text" wire:model="judul" placeholder="Judul Materi" class="w-full border p-2 rounded">
        <textarea wire:model="deskripsi" placeholder="Deskripsi" class="w-full border p-2 rounded"></textarea>

        <input type="file" wire:model="file" class="w-full border p-2 rounded">

        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                {{ $isEdit ? 'Update' : 'Tambah' }}
            </button>
            @if($isEdit)
                <button type="button" wire:click="resetForm" class="bg-gray-600 text-white px-4 py-2 rounded">Batal</button>
            @endif
        </div>
    </form>

    <table class="w-full table-auto border border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">#</th>
                <th class="border p-2">Kursus</th>
                <th class="border p-2">Judul</th>
                <th class="border p-2">Deskripsi</th>
                <th class="border p-2">File</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materis as $i => $m)
                <tr>
                    <td class="border p-2">{{ $i + 1 }}</td>
                    <td class="border p-2">{{ $m->kursus->nama_kursus }}</td>
                    <td class="border p-2">{{ $m->judul }}</td>
                    <td class="border p-2">{{ $m->deskripsi }}</td>
                    <td class="border p-2">
                        @if($m->file)
                            <a href="{{ Storage::url($m->file) }}" target="_blank" class="text-blue-500">Lihat File</a>
                        @else
                            <span class="text-gray-400 italic">Tidak ada</span>
                        @endif
                    </td>
                    <td class="border p-2 space-x-2">
                        <button wire:click="edit({{ $m->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="delete({{ $m->id }})" onclick="return confirm('Yakin hapus?')" class="text-red-600">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
