<?php

namespace App\Livewire\Client;

use App\Models\Institution;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

use App\Models\Client;

#[Title('Clientes')]
class ClientComponent extends Component
{
    use WithPagination;

    public $totalRegistros = 0;
    public $search = '';
    public $cant = 5;
    public $id;
    public $full_name;
    public $short_name;
    public $description;
    public $department_id;
    public $user_id;

    /* #region public function mount() */
    public function mount()
    {

    }
    /* #endregion */

    /* #region protected function rules() */
    protected function rules()
    {
        return [
            'full_name' => 'required|max:255|unique:clients,id,'.$this->id,
            'short_name' => 'required|max:255',
            'description' => 'required|max:500',
            'department_id' => 'required'
        ];
    }
    /* #endregion */

    /* #region protected function validationAttributes() */
    protected function validationAttributes()
    {
        return [
            'full_name' => 'Nombre Completo',
            'short_name' => 'Nombre Corto',
            'description' => 'Descripción',
            'deparment_id' => 'Departamento'
        ];
    }
    /* #endregion */

    /* #region public function render() */
    public function render()
    {
        if($this->search != '')
            $this->resetPage();

        $this->totalRegistros = Department::count();

        $querySelectInstitution = Institution::whereIn('register_status', ['Enabled'])->get();

        $querySelectDepartment = Department::with('institution')->where('full_name','like','%'.$this->search.'%')
                                        ->orWhere('short_name','like','%'.$this->search.'%')
                                        ->orWhere('description','like','%'.$this->search.'%')
                                        ->orWhereHas('institution', function($query){
                                            return $query->where('full_name', 'like', '%'.$this->search.'%');
                                        })
                                        ->orderBy('id', 'desc')
                                        ->paginate($this->cant);

        return view('livewire.department.department-component',[
            'querySelectDepartment' => $querySelectDepartment,
            'querySelectInstitution' => $querySelectInstitution
        ]);
    }
    /* #endregion */

    /* #region public function create() */
    public function create()
    {
        $this->id = 0;
        //Reset de campos
        $this->reset(['full_name', 'short_name', 'description', 'institution_id']);
        //Reset mensajes validación
        $this->resetErrorBag();
        //Abrir modal
        $this->dispatch('open-modal', 'modalDepartment');
    }
    /* #endregion */

    /* #region public function store() */
    public function store()
    {
        Department::create($this->validate());

        //Cerrar modal
        $this->dispatch('close-modal', 'modalDepartment');
        //Mostrar mensaje
        $this->dispatch('msg', 'Departamento creado correctamente');
        //Reset de campos
        $this->reset(['full_name', 'short_name', 'description', 'institution_id']);
    }
    /* #endregion */

    /* #region public function edit(Department $department) */
    public function edit(Department $department)
    {
        $this->id = $department->id;
        $this->full_name = $department->full_name;
        $this->short_name = $department->short_name;
        $this->description = $department->description;
        $this->institution_id = $department->institution_id;

        //Reset mensajes validación
        $this->resetErrorBag();
        //Abrir modal
        $this->dispatch('open-modal', 'modalDepartment');
    }
    /* #endregion */

    /* #region public function update(Deparment $department) */
    public function update(Department $department)
    {
        $department->update($this->validate());

        //Cerrar modal
        $this->dispatch('close-modal', 'modalDepartment');
        //Mostrar mensaje
        $this->dispatch('msg', 'Departamento modificado correctamente');
        //Reset de campos
        $this->reset(['full_name', 'short_name', 'description', 'institution_id']);
    }
    /* #endregion */

    /* #region public function detroy($id) */
    #[On('destroyDepartment')]
    public function detroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        $this->dispatch('msg', 'Departamento eliminado correctamente');
    }
    /* #endregion */

    /* #region public function disabled($id) */
    #[On('disabledDepartment')]
    public function disabled($id)
    {
        $department = Department::findOrFail($id);
        $department->register_status = 'Disabled';
        $department->save();

        $this->dispatch('msg', 'Departamento deshabilitado correctamente');
    }
    /* #endregion */
    
    /* #region public function enabled($id) */
    #[On('enabledDepartment')]
    public function enabled($id)
    {
        $department = Department::findOrFail($id);
        $department->register_status = 'Enabled';
        $department->save();

        $this->dispatch('msg', 'Departamento habilitado correctamente');
    }
    /* #endregion */
}
