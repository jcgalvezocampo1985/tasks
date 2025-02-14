<?php

namespace App\Livewire\Task;

use App\Models\Client;
use App\Models\Task;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

#[Title('Tareas')]
class TaskComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    /* #region Properties */
    public $menu = 'Tareas';
    public $totalRegistros = 0;
    public $search = '';
    public $cant = 5;
    public $id;
    public $name;
    public $description;
    public $url_course;
    public $start_date;
    public $end_date;
    public $minutes;
    public $difficulty_level;
    public $priority;
    public $task_status;
    public $client_id;
    public $user_id;
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
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'url_course' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'difficulty_level' => [
                'required',
                Rule::in(["High","Medium","Low"]),
            ],
            'priority' => [
                'required',
                Rule::in(["High","Medium","Low"]),
            ],
            'client_id' => 'required',
            'user_id' => 'required',
        ];
    }
    /* #endregion */

    /* #region protected function validationAttributes() */
    protected function validationAttributes()
    {
        return [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'url_course' => 'Curso',
            'start_date' => 'Fecha Inicio',
            'end_date' => 'Fecha Termino',
            'difficulty_level' => 'Nivel Dificultad',
            'priority' => 'Prioridad',
            'client_id' => 'Cliente',
            'user_id' => 'Usuario',
        ];
    }
    /* #endregion */

    /* #region public function render() */
    public function render()
    {
        if($this->search != '')
            $this->resetPage();

        $this->totalRegistros = Task::count();

        $querySelectTask = Task::with('client','user')
                                ->where('name','like','%'.$this->search.'%')
                                ->orWhere('description','like','%'.$this->search.'%')
                                ->orWhere('url_course','like','%'.$this->search.'%')
                                ->orWhere('start_date','like','%'.$this->search.'%')
                                ->orWhere('end_date','like','%'.$this->search.'%')
                                ->orWhere('minutes','like','%'.$this->search.'%')
                                ->orWhere('difficulty_level','like','%'.$this->search.'%')
                                ->orWhere('task_status','like','%'.$this->search.'%')
                                ->orWhere('register_status','like','%'.$this->search.'%')
                                ->orWhereHas('client', function($query){
                                    return $query->where('full_name', 'like', '%'.$this->search.'%');
                                })
                                ->orWhereHas('user', function($query){
                                    return $query->where('name', 'like', '%'.$this->search.'%');
                                })
                                ->orderBy('id', 'desc')
                                ->paginate($this->cant);

        $querySelectClient = Client::all();
        $querySelectUserTecnicos = User::where('perfil', 'Técnico')->get();

        return view('livewire.task.index-component',[
            'querySelectTask' => $querySelectTask,
            'querySelectClient' => $querySelectClient,
            'querySelectUserTecnicos' => $querySelectUserTecnicos,
        ]);
    }
    /* #endregion */

    /* #region public function create() */
    public function create()
    {
        $this->clean();
        $this->id = 0;
        //Abrir modal
        $this->dispatch('open-modal', 'modalTask');
    }
    /* #endregion */

    /* #region public function store() */
    public function store()
    {
        Task::create($this->validate());

        //Cerrar modal
        $this->dispatch('close-modal', 'modalTask');
        //Mostrar mensaje
        $this->dispatch('msg', ['msg' => 'Tarea creada correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function edit(Task $task) */
    public function edit(Task $task)
    {
        $this->clean();

        $this->id = $task->id;
        $this->name = $task->name;
        $this->description = $task->description;
        $this->url_course = $task->url_course;
        $this->start_date = $task->start_date;
        $this->end_date = $task->end_date;
        $this->difficulty_level = $task->difficulty_level;
        $this->priority = $task->priority;
        $this->task_status = $task->task_status;
        $this->client_id = $task->client_id;
        $this->user_id = $task->user_id;

        //Abrir modal
        $this->dispatch('open-modal', 'modalTask');
    }
    /* #endregion */

    /* #region public function update(Task $task) */
    public function update(Task $task)
    {
        $task->update($this->validate());

        //Cerrar modal
        $this->dispatch('close-modal', 'modalTask');
        //Mostrar mensaje
        $this->dispatch('msg', ['msg' => 'Tarea modificada correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function detroy($id) */
    #[On('destroyTask')]
    public function detroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        $this->dispatch('msg', ['msg' => 'Tarea eliminada correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function disabled($id) */
    #[On('disabledTask')]
    public function disabled($id)
    {
        $task = User::findOrFail($id);
        $task->register_status = 'Disabled';
        $task->save();

        $this->dispatch('msg', ['msg' => 'Tarea deshabilitada correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function editTaskStatus(Task $task) */
    public function editTaskStatus(Task $task)
    {
        $this->clean();

        $this->id = $task->id;
        $this->task_status = $task->task_status;

        //Abrir modal
        $this->dispatch('open-modal', 'modalTaskStatus');
    }
    /* #endregion */

    /* #region public function updateTaskStatus(Task $task) */
    public function updateTaskStatus(Task $task)
    {
        $validated = $this->validate([
            'task_status' => [
                'required',
                Rule::in(["Paused","Started","Stoped","Finished"]),
            ],
        ]);

        $task->update($validated);

        //Cerrar modal
        $this->dispatch('close-modal', 'modalTaskStatus');
        //Mostrar mensaje
        $this->dispatch('msg', ['msg' => 'Estado Tarea modificado correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function editDifficultyLevel(Task $task) */
    public function editDifficultyLevel(Task $task)
    {
        $this->clean();

        $this->id = $task->id;
        $this->difficulty_level = $task->difficulty_level;

        //Abrir modal
        $this->dispatch('open-modal', 'modalDifficultyLevel');
    }
    /* #endregion */

    /* #region public function updateDifficultyLevel(Task $task) */
    public function updateDifficultyLevel(Task $task)
    {
        $validated = $this->validate([
            'difficulty_level' => [
                'required',
                Rule::in(["High","Medium","Low"])
            ],
        ]);

        $task->update($validated);

        //Cerrar modal
        $this->dispatch('close-modal', 'modalDifficultyLevel');
        //Mostrar mensaje
        $this->dispatch('msg', ['msg' => 'Nivel Dificultad modificado correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function editPriority(Task $task) */
    public function editPriority(Task $task)
    {
        $this->clean();

        $this->id = $task->id;
        $this->priority = $task->priority;

        //Abrir modal
        $this->dispatch('open-modal', 'modalPriority');
    }
    /* #endregion */

    /* #region public function updatePriority(Task $task) */
    public function updatePriority(Task $task)
    {
        $validated = $this->validate([
            'priority' => [
                'required',
                Rule::in(["High","Medium","Low"])
            ]
        ]);

        $task->update($validated);

        //Cerrar modal
        $this->dispatch('close-modal', 'modalPriority');
        //Mostrar mensaje
        $this->dispatch('msg', ['msg' => 'Prioridad modificada correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function enabled($id) */
    #[On('enabledUser')]
    public function enabled($id)
    {
        $user = User::findOrFail($id);
        $user->register_status = 'Enabled';
        $user->save();

        $this->dispatch('msg', ['msg' => 'Tarea habilitada correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function clean() */
    public function clean()
    {
        //Reset de campos
        $this->reset(['id','name', 'description', 'url_course', 'start_date', 'end_date', 'minutes', 'difficulty_level', 'priority', 'task_status', 'client_id', 'user_id']);
        //Reset mensajes validación
        $this->resetErrorBag();
    }
    /* #endregion */
}
