<div class="p-4 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Manajemen Kursus</h2>

    <form wire:submit.prevent="store" class="space-y-4 mb-6">
        <input wire:model="nama_kursus" type="text" placeholder="Nama Kursus" class="w-full border p-2 rounded">
        <input wire:model="durasi" type="text" placeholder="Durasi (misal: 3 bulan)" class="w-full border p-2 rounded">

        <select wire:model="instruktur_id" class="w-full border p-2 rounded">
            <option value="">-- Pilih Instruktur --</option>
            @foreach($instrukturs as $ins)
                <option value="{{ $ins->id }}">{{ $ins->nama }}</option>
            @endforeach
        </select>

        <input wire:model="biaya" type="number" step="0.01" placeholder="Biaya" class="w-full border p-2 rounded">

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $isEdit ? 'Update' : 'Tambah' }}
            </button>
            @if($isEdit)
                <button type="button" wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
            @endif
        </div>
    </form>

    <table class="w-full table-auto border border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">#</th>
                <th class="border p-2">Kursus</th>
                <th class="border p-2">Durasi</th>
                <th class="border p-2">Instruktur</th>
                <th class="border p-2">Biaya</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kursuses as $i => $k)
                <tr>
                    <td class="border p-2">{{ $i + 1 }}</td>
                    <td class="border p-2">{{ $k->nama_kursus }}</td>
                    <td class="border p-2">{{ $k->durasi }}</td>
                    <td class="border p-2">{{ $k->instruktur->nama }}</td>
                    <td class="border p-2">Rp{{ number_format($k->biaya, 0, ',', '.') }}</td>
                    <td class="border p-2 space-x-2">
                        <button wire:click="edit({{ $k->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="delete({{ $k->id }})" onclick="return confirm('Yakin hapus?')" class="text-red-600">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>