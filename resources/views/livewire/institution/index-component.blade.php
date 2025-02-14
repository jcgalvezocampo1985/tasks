<div>
    <x-card cardTitle="Listado de Instituciones ({{$this->totalRegistros}})" cardTools="Card Tools">
        <x:slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click='create'>
                {!! icons('plus') !!}
                Crear Institución
            </a>
        </x:slot>

        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Nombre Corto</th>
                <th>Descripción</th>
                <th>Estado Registro</th>
                <th colspan="2" width="3%">Acciones</th>
            </x-slot:thead>
            @forelse($querySelectInstitution as $institution)
            <tr>
                <td>{{$institution->id}}</td>
                <td>{{$institution->full_name}}</td>
                <td>{{$institution->short_name}}</td>
                <td>{{$institution->description}}</td>
                <td>
                    @if($institution->register_status == 'Enabled')
                        <a wire:click="$dispatch('disabled', {id: {{$institution->id}}, eventName: 'disabledInstitution'})" class="btn" title="Clic para deshabilitar">
                            {!! badge($institution->register_status) !!}
                        </a>
                    @else
                        <a wire:click="$dispatch('enabled', {id: {{$institution->id}}, eventName: 'enabledInstitution'})" class="btn" title="Clic para habilitar">
                            {!! badge($institution->register_status) !!}
                        </a>
                    @endif
                </td>
                <td>
                    <a href="#" wire:click='edit({{$institution->id}})' class="btn btn-info btn-xs" title="Editar">
                        {!! icons('edit') !!}
                    </a>
                </td>
                <td>
                    <a wire:click="$dispatch('delete', {id: {{$institution->id}}, eventName: 'destroyInstitution'})" class="btn btn-danger btn-xs" title="Eliminar">
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
            {{$querySelectInstitution->links()}}
        </x-slot>
    </x-card>

    @include('livewire.institution.form-component')
    @include('components.layouts.partials.sidebar', ['menu' => $this->menu])
</div>
