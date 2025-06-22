<div class="p-4 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Pendaftaran Kursus</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 p-2 rounded mb-4">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="daftar" class="mb-6">
        <select wire:model="kursus_id" class="w-full border p-2 rounded">
            <option value="">-- Pilih Kursus --</option>
            @foreach($kursuses as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kursus }}</option>
            @endforeach
        </select>
        <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">Daftar</button>
    </form>

    <h3 class="font-semibold mb-2">Status Pendaftaran Anda</h3>
    <ul class="space-y-2">
        @foreach($pendaftarans as $p)
            <li class="border p-2 rounded">
                <strong>{{ $p->kursus->nama_kursus }}</strong> -
                <span class="text-gray-600">{{ ucfirst($p->status) }}</span>
            </li>
        @endforeach
    </ul>
</div>
