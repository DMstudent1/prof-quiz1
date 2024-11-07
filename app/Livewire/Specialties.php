<?php

namespace App\Livewire;

use App\Models\Specialty;
use Livewire\Component;

class Specialties extends Component
{
    public function render()
    {
        $specialties = Specialty::latest()->paginate();
        return view('livewire.specialties', compact('specialties'));
    }
}
/*

    public function delete(Question $question): void
    {
        abort_if(! auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question->delete();
    }*/