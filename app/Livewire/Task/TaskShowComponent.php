<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

#[Title('Mostrar Tarea')]
class TaskShowComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public Task $task;
    public $menu = 'Tareas';
    public $id;
    public $start_date;
    public $end_date;
    public $description;
    public $url_file;
    public $task_history_status;
    public $task_status;
    public $image;

    /* #region protected function rules() */
    protected function rules()
    {
        return [
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required'
        ];
    }
    /* #endregion */

    /* #region protected function validationAttributes() */
    protected function validationAttributes()
    {
        return [
            'start_date' => 'Fecha Inicio',
            'end_date' => 'Fecha Termino',
            'description' => 'Descripción',
            'image' => 'Imagen'
        ];
    }
    /* #endregion */

    /* #region public function mount() */
    public function mount()
    {
        $this->task_history_status = 'Finished';

        $querySelectMaxTaskHistory = TaskHistory::where([
                                    ['user_id', '=', Auth::user()->id],
                                    ['task_id', '=', $this->task->id]
                                ])
                                ->whereIn('task_history_status', ['Started','Paused'])
                                ->max('id');

        if($querySelectMaxTaskHistory != null)
        {
            $querySelectTaskHistory = TaskHistory::findOrFail($querySelectMaxTaskHistory);
            $this->task_history_status = $querySelectTaskHistory->task_history_status;
        }
    }
    /* #endregion */

    /* #region public function render() */
    public function render()
    {
        $querySelectTaskHistory = $this->task->task_history()->paginate(5);

        $this->task_status = $this->task->task_status;

        return view('livewire.task.task-show', compact('querySelectTaskHistory'));
    }
    /* #endregion */

    /* #region public function clean() */
    public function clean()
    {
        //Reset de campos
        $this->reset(['id','start_date', 'end_date','description']);
        //Reset mensajes validación
        $this->resetErrorBag();
    }
    /* #endregion */

    /* #region public function startTaskHistory() */
    public function startTaskHistory()
    {
        TaskHistory::create([
            'start_date' => date('Y-m-d h:i:s'),
            'task_id' => $this->task->id,
            'user_id' => Auth::user()->id
        ]);

        $this->task_history_status = 'Started';

        $this->dispatch('msg', ['msg' => 'Avance de tarea iniciadp correctamente', 'type' => 'success']);
    }
    /* #endregion */

    /* #region public function editTaskStatus(Task $task) */
    public function editTaskStatusHistory(TaskHistory $taskHistory)
    {
        $this->clean();

        $this->id = $taskHistory->id;
        $this->task_history_status = $taskHistory->task_history_status;

        //Abrir modal
        $this->dispatch('open-modal', 'modalTaskHistoryStatus');
    }
    /* #endregion */

    /* #region public function updateTaskHistoryStatus(TaskHistory $taskHistory) */
    public function updateTaskHistoryStatus(TaskHistory $taskHistory)
    {
        $validated = $this->validate([
            'task_history_status' => [
                'required',
                Rule::in(["Paused","Started","Finished","Canceled"]),
            ],
        ]);

        $taskHistory->update($validated);

        //Cerrar modal
        $this->dispatch('close-modal', 'modalTaskHistoryStatus');
        //Mostrar mensaje
        $this->dispatch('msg', ['msg' => 'Estado Tarea modificado correctamente', 'type' => 'success']);
        //Reset de campos
        $this->clean();
    }
    /* #endregion */

    /* #region public function create() */
    public function formUpload(TaskHistory $taskHistory)
    {
        $this->dispatch('open-modal', 'modalTaskHistoryFile');
    }
    /* #endregion */


    public function saveImage()
    {
        /* $validated = $this->validate([
            'image' => 'image|max:1024'
        ]); */

        dd($this->image);
        // if($this->image)
        // {
        //     $custonName = 'task-history/'.uniqid().'.'.$this->image->extension();
        // }
    }
}
