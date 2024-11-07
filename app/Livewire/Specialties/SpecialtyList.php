<?php

namespace App\Livewire\Specialties;

use App\Models\Specialty;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;


class SpecialtyList extends Component
{
    public function render()
    {
        $specialties = Specialty::latest()->paginate();
        return view('livewire.specialties.specialty-list', compact('specialties'));
    }

    public function delete(Specialty $specialty): void
    {
        abort_if(! auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialty->delete();
    }
}
