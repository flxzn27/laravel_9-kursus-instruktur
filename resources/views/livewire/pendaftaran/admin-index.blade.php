<div class="p-6 max-w-5xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Manajemen Pendaftaran Kursus</h2>

    <table class="w-full table-auto border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">#</th>
                <th class="border p-2">Peserta</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Kursus</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftarans as $i => $p)
                <tr class="border-t">
                    <td class="p-2">{{ $i + 1 }}</td>
                    <td class="p-2">{{ $p->user->name }}</td>
                    <td class="p-2">{{ $p->user->email }}</td>
                    <td class="p-2">{{ $p->kursus->nama_kursus }}</td>
                    <td class="p-2">
                        <span class="@if($p->status == 'pending') text-yellow-500 
                                     @elseif($p->status == 'disetujui') text-green-600 
                                     @else text-red-500 @endif">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td class="p-2 space-x-1">
                        @if($p->status == 'pending')
                            <button wire:click="setujui({{ $p->id }})" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Setujui</button>
                            <button wire:click="tolak({{ $p->id }})" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Tolak</button>
                        @endif
                        <button wire:click="hapus({{ $p->id }})" onclick="return confirm('Yakin hapus?')" class="bg-gray-600 text-white px-2 py-1 rounded text-sm">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
