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
                <th>Usuario</th>
                <th>Estado Registro</th>
                <th colspan="2" width="3%">Acciones</th>
            </x-slot:thead>
            @forelse($querySelectTask as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td>{{$task->name}}</td>
                <td>
                    <textarea cols="10" rows="5" readonly class="form-control" style="width: 350px;min-width: 350px;max-width: 350px;height: 60px;resize: none;">{{$task->description}}</textarea>
                </td>
                <td><a href="{{$task->url_course}}" target="_blank">Ir al curso</a></td>
                <td style="min-width: 100px;width:100px;">{{$task->start_date}}</td>
                <td>{{$task->end_date}}</td>
                <td>{{$task->minutes}}</td>
                <td>{{$task->difficulty_level}}</td>
                <td>{{$task->priority}}</td>
                <td>{{$task->task_status}}</td>
                <td>{{$task->client->full_name}}</td>
                <td>{{$task->user->name}}</td>
                <td>
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
    @include('components.layouts.partials.sidebar', ['menu' => $this->menu])
</div>
