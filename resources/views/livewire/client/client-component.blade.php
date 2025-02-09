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

    <x-modal modalId="modalDepartment" modalTitle="Departamentos">
        <form wire:submit="{{ $id == 0 ? "store" : "update($id)" }}">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label for="full_name">Nombre Completo</label>
                    <input wire:model.live='full_name' type="text" class="form-control" placeholder="Nombre Completo">
                    @error('full_name') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                    <label for="short_name">Nombre Corto</label>
                    <input wire:model.live='short_name' type="text" class="form-control" placeholder="Nombre Corto">
                    @error('short_name') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                    <label for="description">Descripción</label>
                    <textarea wire:model.live='description' class="form-control" placeholder="Descripción"></textarea>
                    @error('description') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                    <label for="institution_id">Institución</label>
                    <select wire:model.live='institution_id' class="form-control">
                        <option value="">Selecciona</option>
                        @foreach($querySelectInstitution as $row)
                        <option value="{{$row->id}}">{{$row->full_name}}</option>                            
                        @endforeach
                    </select>
                    @error('institution_id') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
            </div>
            <hr>
            <button class="btn btn-primary float-right">Guardar</button>
        </form>
    </x-modal>
</div>
