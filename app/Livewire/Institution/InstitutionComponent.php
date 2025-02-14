<?php

namespace App\Livewire\Institution;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

use App\Models\Institution;


#[Title('Instituciones')]
class InstitutionComponent extends Component
{
    use WithPagination;

    /* #region Properties */
    public $menu = 'Instituciones';
    public $totalRegistros = 0;
    public $search = '';
    public $cant = 5;
    public $id;
    public $full_name;
    public $short_name;
    public $description;
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
            'full_name' => 'required|max:255|unique:institutions,id,'.$this->id,
            'short_name' => 'required|max:255',
            'description' => 'required|max:500'
        ];
    }
    /* #endregion */

    /* #region protected function validationAttributes() */
    protected function validationAttributes()
    {
        return [
            'full_name' => 'Nombre Completo',
            'short_name' => 'Nombre Corto',
            'description' => 'Descripción'
        ];
    }
    /* #endregion */

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

        return view('livewire.institution.index-component',[
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
        $this->dispatch('open-modal', 'modalInstitution');
    }
    /* #endregion */

    /* #region public function store() */
    public function store()
    {
        Institution::create($this->validate());

        //Cerrar modal
        $this->dispatch('close-modal', 'modalInstitution');
        //Mostrar mensaje
        $this->dispatch('msg', ['msg' => 'Institución creada correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function edit(Institution $institution) */
    public function edit(Institution $institution)
    {
        $this->clean();

        $this->id = $institution->id;
        $this->full_name = $institution->full_name;
        $this->short_name = $institution->short_name;
        $this->description = $institution->description;

        //Abrir modal
        $this->dispatch('open-modal', 'modalInstitution');
    }
    /* #endregion */

    /* #region public function update(Institution $institution) */
    public function update(Institution $institution)
    {
        $institution->update($this->validate());

        //Cerrar modal
        $this->dispatch('close-modal', 'modalInstitution');
        //Mostrar mensaje
        $this->dispatch('msg', ['msg' => 'Institución modificada correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function detroy($id) */
    #[On('destroyInstitution')]
    public function detroy($id)
    {
        $institution = Institution::findOrFail($id);
        $institution->delete();

        $this->dispatch('msg', ['msg' => 'Institución eliminada correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function disabled($id) */
    #[On('disabledInstitution')]
    public function disabled($id)
    {
        $institution = Institution::findOrFail($id);
        $institution->register_status = 'Disabled';
        $institution->save();

        $this->dispatch('msg', ['msg' => 'Institución deshabilitada correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function enabled($id) */
    #[On('enabledInstitution')]
    public function enabled($id)
    {
        $institution = Institution::findOrFail($id);
        $institution->register_status = 'Enabled';
        $institution->save();

        $this->dispatch('msg', ['msg' => 'Institución habilitada correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function clean() */
    public function clean()
    {
        //Reset de campos
        $this->reset(['id','full_name', 'short_name', 'description']);
        //Reset mensajes validación
        $this->resetErrorBag();
    }
    /* #endregion */
}
