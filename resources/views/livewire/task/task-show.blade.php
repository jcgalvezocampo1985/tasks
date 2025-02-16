<div>
    <x-card cardTitle="Tarea: {{$task->name}}" cardTools="Card Tools">
        <x:slot:cardTools>
            <a href="{{route('tareas')}}" class="btn btn-outline-warning">
                {!! icons('back') !!}
                Regresar
            </a>
            @if($this->task_history_status == 'Finished')
                <a href="#" class="btn btn-outline-primary" wire:click='startTaskHistory'>
                    {!! icons('plus') !!}
                    Iniciar nueva avance
                </a>
            @endif
        </x:slot>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <h2 class="profile-username text-center mb-2">{{$task->name}}</h2>
                        <ul class="list-group mb-3">
                            <li class="list-group-item">
                                <b>Fecha Inicio</b> <a class="float-right">{{$task->start_date}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Fecha Término</b> <a class="float-right">{{$task->end_date}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Minutos</b> <a class="float-right">{{$task->minutes}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Nivel Dificultad</b> <a class="float-right">{!! badge($task->difficulty_level) !!}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Prioridad</b> <a class="float-right">{!! badge($task->priority) !!}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Estado Tarea</b> <a class="float-right">{!! badge($task->task_status) !!}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Cliente</b> <a class="float-right">{{$task->client->full_name}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Técnico</b> <a class="float-right">{{$task->user->name}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Descripción</b> <a class="float-right">{{$task->description}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Término</th>
                            <th>Minutos</th>
                            <th>Descripción</th>
                            <th>Estado Tarea</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($querySelectTaskHistory as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->start_date}}</td>
                            <td>{{$row->end_date}}</td>
                            <td>{{$row->minutes}}</td>
                            <td>{{$row->description}}</td>
                            <td>
                                @if($row->task_history_status != 'Finished')
                                    <a href="#" wire:click='editTaskStatusHistory({{$row->id}})' class="btn" title="Editar Estado Tarea">
                                        {!! badge($row->task_history_status) !!}
                                    </a>
                                @else
                                    {!! badge($row->task_history_status) !!}
                                @endif
                            </td>
                            <td>
                                @if($row->task_history_status != 'Finished')
                                    <a href="#" wire:click='edit({{$task->id}})' class="btn btn-info btn-xs" title="Editar">
                                        {!! icons('edit') !!}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$querySelectTaskHistory->links()}}
            </div>
        </div>
    </x-card>

    @include('livewire.task.form-task-history')
    @include('livewire.task.form-task-history-status-component')
    @include('components.layouts.partials.sidebar', ['menu' => $this->menu])
</div>

