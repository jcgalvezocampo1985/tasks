<?php

namespace App\Livewire\Institution;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

use App\Models\Institution;

#[Title('Instituciones')]
class InstitutionComponent extends Component
{
    use WithPagination;

    public $totalRegistros = 0;
    public $search = '';
    public $cant = 5;
    public $id;
    public $full_name;
    public $short_name;
    public $description;

    /* #region public function render() */
    public function render()
    {
        if($this->search != '')
            $this->resetPage();

        $this->totalRegistros = Institution::count();

        $querySelectInstitution = Institution::where('full_name','like','%'.$this->search.'%')
                                            ->orWhere('short_name','like','%'.$this->search.'%')
                                            ->orWhere('description','like','%'.$this->search.'%')
                                            ->orderBy('id', 'desc')
                                            ->paginate($this->cant);

        return view('livewire.institution.institution-component',[
            'querySelectInstitution' => $querySelectInstitution
        ]);
    }
    /* #endregion */

    /* #region public function mount() */
    public function mount()
    {

    }
    /* #endregion */

    /* #region public function store() */
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
        $this->dispatch('msg', 'Institución creada correctamente');

        $this->reset(['full_name', 'short_name', 'description']);
    }
    /* #endregion */

    public function edit(Institution $institution)
    {
        $this->id = $institution->id;
        dump($institution);
    }
}
