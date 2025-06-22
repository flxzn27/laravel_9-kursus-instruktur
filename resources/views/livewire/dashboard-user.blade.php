<div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Selamat Datang di KCourse 🎓</h1>

    <div class="mb-8 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded">
        <p>KCourse adalah platform pembelajaran online yang menyediakan berbagai macam kursus dari instruktur berpengalaman. Pilih kursus favoritmu dan daftar sekarang juga!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($kursusList as $kursus)
            <div class="bg-white shadow rounded-xl p-4 border">
                <h2 class="text-xl font-semibold">{{ $kursus->nama_kursus }}</h2>
                <p class="text-sm text-gray-600">Durasi: {{ $kursus->durasi }}</p>
                <p class="text-sm text-gray-600">Instruktur: {{ $kursus->instruktur->nama }}</p>
                <p class="text-sm text-gray-600">Biaya: Rp{{ number_format($kursus->biaya, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600">Peserta Terdaftar: {{ $kursus->pendaftaran->count() }}</p>

                <a href="{{ route('pendaftaran.form', $kursus->id) }}"
                    class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Daftar Sekarang
                </a>
            </div>
        @endforeach
    </div>
</div>
