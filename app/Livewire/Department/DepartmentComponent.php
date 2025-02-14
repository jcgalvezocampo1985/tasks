<?php

namespace App\Livewire\Department;

use App\Models\Institution;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

use App\Models\Department;

#[Title('Departamentos')]
class DepartmentComponent extends Component
{
    use WithPagination;

    /* #region Properties */
    public $menu = 'Departamentos';
    public $totalRegistros = 0;
    public $search = '';
    public $cant = 5;
    public $id;
    public $full_name;
    public $short_name;
    public $description;
    public $institution_id;
    /* #endregion */

    /* #region public function mount() */
    public function mount()
    {

    }
    /* #endregion */

    /* #region protected function rules() */
    protected function rules()
    {
        return [
            'full_name' => 'required|max:255|unique:departments,id,'.$this->id,
            'short_name' => 'required|max:255',
            'description' => 'required|max:500',
            'institution_id' => 'required'
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
            'institution_id' => 'Institución'
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

        return view('livewire.department.index-component',[
            'querySelectDepartment' => $querySelectDepartment,
            'querySelectInstitution' => $querySelectInstitution
        ]);
    }
    /* #endregion */

    /* #region public function create() */
    public function create()
    {
        $this->clean();
        $this->id = 0;
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
        $this->dispatch('msg', ['msg' => 'Departamento creado correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function edit(Department $department) */
    public function edit(Department $department)
    {
        $this->clean();

        $this->id = $department->id;
        $this->full_name = $department->full_name;
        $this->short_name = $department->short_name;
        $this->description = $department->description;
        $this->institution_id = $department->institution_id;

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
        $this->dispatch('msg', ['msg' => 'Departamento modificado correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function detroy($id) */
    #[On('destroyDepartment')]
    public function detroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        $this->dispatch('msg', ['msg' => 'Departamento eliminado correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function disabled($id) */
    #[On('disabledDepartment')]
    public function disabled($id)
    {
        $department = Department::findOrFail($id);
        $department->register_status = 'Disabled';
        $department->save();

        $this->dispatch('msg', ['msg' => 'Departamento deshabilitado correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function enabled($id) */
    #[On('enabledDepartment')]
    public function enabled($id)
    {
        $department = Department::findOrFail($id);
        $department->register_status = 'Enabled';
        $department->save();

        $this->dispatch('msg', ['msg' => 'Departamento habilitado correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function clean() */
    public function clean()
    {
        //Reset de campos
        $this->reset(['id','full_name', 'short_name', 'description', 'institution_id']);
        //Reset mensajes validación
        $this->resetErrorBag();
    }
    /* #endregion */
}
