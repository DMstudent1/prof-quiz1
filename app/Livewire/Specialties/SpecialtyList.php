<?php

namespace App\Livewire\Specialties;

use App\Models\Specialty;
use Livewire\Component;

class SpecialtyList extends Component
{
    public function render()
    {
        $specialties = Specialty::latest()->paginate();
        return view('livewire.specialties.specialty-list', compact('specialties'));
    }
}
/*
SpecialtyForm
    public function delete(Question $question): void
    {
        abort_if(! auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question->delete();
    }*/