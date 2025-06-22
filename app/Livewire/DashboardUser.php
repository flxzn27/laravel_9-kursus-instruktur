<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kursus;

class DashboardUser extends Component
{
    public function render()
    {
        $kursusList = Kursus::with(['instruktur', 'pendaftaran'])
            ->latest()
            ->get();

        return view('livewire.dashboard-user', [
            'kursusList' => $kursusList,
        ]);
    }
}
