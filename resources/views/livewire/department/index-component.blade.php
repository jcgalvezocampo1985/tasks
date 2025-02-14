<div>
    <x-card cardTitle="Listado de Departamentos ({{$this->totalRegistros}})" cardTools="Card Tools">
        <x:slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click='create'>
                {!! icons('plus') !!}
                Crear Departamento
            </a>
        </x:slot>

        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Nombre Corto</th>
                <th>Descripción</th>
                <th>Institución</th>
                <th>Estado Registro</th>
                <th colspan="2" width="3%">Acciones</th>
            </x-slot:thead>
            @forelse($querySelectDepartment as $department)
            <tr>
                <td>{{$department->id}}</td>
                <td>{{$department->full_name}}</td>
                <td>{{$department->short_name}}</td>
                <td>{{$department->description}}</td>
                <td>{{$department->institution->full_name}}</td>
                <td>
                    @if($department->register_status == 'Enabled')
                        <a wire:click="$dispatch('disabled', {id: {{$department->id}}, eventName: 'disabledDepartment'})" class="btn" title="Clic para deshabilitar">
                            {!! badge($department->register_status) !!}
                        </a>
                    @else
                        <a wire:click="$dispatch('enabled', {id: {{$department->id}}, eventName: 'enabledDepartment'})" class="btn" title="Clic para habilitar">
                            {!! badge($department->register_status) !!}
                        </a>
                    @endif
                </td>
                <td>
                    <a href="#" wire:click='edit({{$department->id}})' class="btn btn-info btn-xs" title="Editar">
                        {!! icons('edit') !!}
                    </a>
                </td>
                <td>
                    <a wire:click="$dispatch('delete', {id: {{$department->id}}, eventName: 'destroyDepartment'})" class="btn btn-danger btn-xs" title="Eliminar">
                        {!! icons('delete') !!}
                    </a>
                </td>
            </tr>
            @empty
                <tr class="text-center">
                    <td colspan="7">Sin registros para mostrar</td>
                </tr>
            @endforelse
        </x-table>
        <x-slot:cardFooter>
            {{$querySelectDepartment->links()}}
        </x-slot>
    </x-card>

    @include('livewire.department.form-component')
    @include('components.layouts.partials.sidebar', ['menu' => $this->menu])
</div>
