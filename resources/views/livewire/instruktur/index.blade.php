<div class="p-4 max-w-xl mx-auto">
    <h1 class="text-xl font-bold mb-4">Manajemen Instruktur</h1>

    <form wire:submit.prevent="store" class="space-y-4 mb-6">
        <input wire:model="nama" type="text" placeholder="Nama" class="w-full border p-2 rounded">
        <input wire:model="email" type="email" placeholder="Email" class="w-full border p-2 rounded">

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $isEdit ? 'Update' : 'Tambah' }}
            </button>
            @if($isEdit)
                <button type="button" wire:click="resetForm" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
            @endif
        </div>
    </form>

    <table class="w-full table-auto border border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">#</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($instrukturs as $i => $ins)
                <tr>
                    <td class="border p-2">{{ $i + 1 }}</td>
                    <td class="border p-2">{{ $ins->nama }}</td>
                    <td class="border p-2">{{ $ins->email }}</td>
                    <td class="border p-2 space-x-2">
                        <button wire:click="edit({{ $ins->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="delete({{ $ins->id }})" class="text-red-600" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>