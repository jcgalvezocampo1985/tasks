<div>
    <x-card cardTitle="Listado de Usuarios ({{$this->totalRegistros}})" cardTools="Card Tools">
        <x:slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click='create'>
                {!! icons('plus') !!}
                Crear Tarea
            </a>
        </x:slot>

        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Curso</th>
                <th>Fecha Inicio</th>
                <th>Fecha Término</th>
                <th>Minutos</th>
                <th>Nivel Dificultad</th>
                <th>Prioridad</th>
                <th>Estado Tarea</th>
                <th>Cliente</th>
                <th>Técnico</th>
                <th>Estado Registro</th>
                <th colspan="3" width="3%">Acciones</th>
            </x-slot:thead>
            @forelse($querySelectTask as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td style="min-width: 150px;width:150px;">{{$task->name}}</td>
                <td>
                    <textarea cols="10" rows="10" readonly class="form-control" style="width: 300px;min-width: 300px;max-width: 300px;height: 80px;resize: none;">{{$task->description}}</textarea>
                </td>
                <td><a href="{{$task->url_course}}" target="_blank">Ir al curso</a></td>
                <td style="min-width: 100px;width:100px;">{{$task->start_date}}</td>
                <td style="min-width: 100px;width:100px;">{{$task->end_date}}</td>
                <td style="min-width: 100px;width:100px;">{{$task->minutes}}</td>
                <td>
                    <a href="#" wire:click='editDifficultyLevel({{$task->id}})' class="btn" title="Editar Nivel Dificultad">
                        {!! badge($task->difficulty_level) !!}
                    </a>
                </td>
                <td>
                    <a href="#" wire:click='editPriority({{$task->id}})' class="btn" title="Editar Prioridad">
                        {!! badge($task->priority) !!}
                    </a>
                </td>
                <td>
                    <a href="#" wire:click='editTaskStatus({{$task->id}})' class="btn" title="Editar Estado Tarea">
                        {!! badge($task->task_status) !!}
                    </a>
                </td>
                <td style="min-width: 150px;width:150px;">{{$task->client->full_name}}</td>
                <td style="min-width: 150px;width:150px;">{{$task->user->name}}</td>
                <td style="min-width: 100px;width:100px;">
                    @if($task->register_status == 'Enabled')
                        <a wire:click="$dispatch('disabled', {id: {{$task->id}}, eventName: 'disabledTask'})" class="btn" title="Clic para deshabilitar">
                            {!! badge($task->register_status) !!}
                        </a>
                    @else
                        <a wire:click="$dispatch('enabled', {id: {{$task->id}}, eventName: 'enabledTask'})" class="btn" title="Clic para habilitar">
                            {!! badge($task->register_status) !!}
                        </a>
                    @endif
                </td>
                <td>
                    <a href="{{route()}}" class="btn btn-success btn-xs" title="Mostrar">
                        {!! icons('show') !!}
                    </a>
                </td>
                <td>
                    <a href="#" wire:click='edit({{$task->id}})' class="btn btn-info btn-xs" title="Editar">
                        {!! icons('edit') !!}
                    </a>
                </td>
                <td>
                    <a wire:click="$dispatch('delete', {id: {{$task->id}}, eventName: 'destroyTask'})" class="btn btn-danger btn-xs" title="Eliminar">
                        {!! icons('delete') !!}
                    </a>
                </td>
            </tr>
            @empty
                <tr class="text-center">
                    <td colspan="15">Sin registros para mostrar</td>
                </tr>
            @endforelse
        </x-table>
        <x-slot:cardFooter>
            {{$querySelectTask->links()}}
        </x-slot>
    </x-card>

    @include('livewire.task.form-component')
    @include('livewire.task.form-task-status-component')
    @include('livewire.task.form-difficulty-level-component')
    @include('livewire.task.form-priority-component')
    @include('components.layouts.partials.sidebar', ['menu' => $this->menu])
</div>
