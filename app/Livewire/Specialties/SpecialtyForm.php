<?php

namespace App\Livewire\Specialties;

use App\Models\Specialty;
use Livewire\Component;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Illuminate\Contracts\View\View;


class SpecialtyForm extends Component
{
    public ?Specialty $specialty = null;

    public string $name = '';

    public string $description = '';

    public bool $editing = false;

    public function mount(Specialty $specialty): void
    {

        if ($specialty->exists) {
            $this->specialty = $specialty;
            $this->editing = true;
            $this->name = $specialty->name;
            $this->description = $specialty->description;
        }
    }

    public function save(): Redirector|RedirectResponse
    {
        $this->validate();

        if (empty($this->specialty)) {
            $this->specialty = Specialty::create($this->only(['name', 'description']));
        } else {
            $this->specialty->update($this->only(['name', 'description']));
        }

        return to_route('specialties');
    }

    public function render(): View
    {
        return view('livewire.specialties.specialty-form');
    }
    protected function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
