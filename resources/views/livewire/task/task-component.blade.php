<div>
    <x-card cardTitle="Listado de Usuarios ({{$this->totalRegistros}})" cardTools="Card Tools">
        <x:slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click='create'>
                {!! icons('plus') !!}
                Crear Usuario
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
                <td>{{$task->description}}</td>
                <td>{{$task->url_course}}</td>
                <td>{{$task->start_date}}</td>
                <td>{{$task->end_date}}</td>
                <td>{{$task->minutes}}</td>
                <td>{{$task->difficulty_level}}</td>
                <td>{{$task->priority}}</td>
                <td>{{$task->task_status}}</td>
                <td>{{$task->client_id->full_name}}</td>
                <td>{{$task->user_id->name}}</td>
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

    <x-modal modalId="modalTask" modalTitle="Tareas">
        <form wire:submit="{{ $id == 0 ? "store" : "update($id)" }}">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label for="name">Nombre</label>
                    <input wire:model.live='name' type="text" class="form-control" placeholder="Nombre">
                    @error('name') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label for="description">Descripción</label>
                    <textarea wire:model.live='description' class="form-control" placeholder="Descripción"></textarea>
                    @error('description') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label for="url_course">Curso URL</label>
                    <input wire:model.live='url_course' type="text" class="form-control" placeholder="Curso URL">
                    @error('url_course') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label for="start_date">Fecha Inicio</label>
                    <input wire:model.live='start_date' type="date" class="form-control" placeholder="Fecha Inicio">
                    @error('start_date') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label for="end_date">Fecha Término</label>
                    <input wire:model.live='end_date' type="date" class="form-control" placeholder="Fecha Término">
                    @error('end_date') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                    <label for="difficulty_level">Nivel Dificultad</label>
                    <select wire:model.live='difficulty_level' class="form-control">
                        <option value="">Selecciona</option>
                        <option value="Admin">Administrador</option>
                        <option value="Cliente">Cliente</option>
                        <option value="Técnico">Técnico</option>
                    </select>
                    @error('difficulty_level') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
            </div>
            <hr>
            <button class="btn btn-primary float-right">Guardar</button>
        </form>
    </x-modal>
</div>
