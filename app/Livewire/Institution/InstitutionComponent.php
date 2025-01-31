<?php

namespace App\Livewire\Institution;

use Livewire\Component;
use Livewire\Attributes\Title;

use App\Models\Institution;

#[Title('Instituciones')]
class InstitutionComponent extends Component
{
    public $totalRegistros = 0;
    public $full_name;
    public $short_name;
    public $description;

    public function render()
    {
        return view('livewire.institution.institution-component');
    }

    public function mount()
    {
        $this->totalRegistros = Institution::count();
    }

    /**
     * Summary of store
     * @return void
     */
    public function store()
    {
        $rules = [
            'full_name' => 'required|max:255|unique:institutions',
            'short_name' => 'required|max:255',
            'description' => 'required|max:10'
        ];
        
        $messages = [
            'full_name.required' => 'El campo nombre completo es requerido',
            'full_name.max' => 'El campo nombre completo no debe ser mayor a 255 caracteres',
            'full_name.unique' => 'El campo nombre completo ya existe',
            'short_name.required' => 'El campo nombre corto es requerido',
            'short_name.max' => 'El campo nombre corto no debe ser mayor a 255 caracteres',
            'description.required' => 'El campo descripción es requerido',
            'description.max' => 'El campo descripción no debe ser mayor a 500 caracteres'
        ];

        $this->validate($rules, $messages);

        $institution = new Institution();
        $institution->full_name = $this->full_name;
        $institution->short_name = $this->short_name;
        $institution->description = $this->description;
        $institution->save();

        $this->dispatch('close-modal', 'modalInstitution');

    }
}
