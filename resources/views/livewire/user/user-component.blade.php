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
                <th>Email</th>
                <th>Perfil</th>
                <th>Estado Registro</th>
                <th colspan="2" width="3%">Acciones</th>
            </x-slot:thead>
            @forelse($querySelectUser as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->perfil}}</td>
                <td>
                    @if($user->register_status == 'Enabled')
                        <a wire:click="$dispatch('disabled', {id: {{$user->id}}, eventName: 'disabledUser'})" class="btn" title="Clic para deshabilitar">
                            {!! badge($user->register_status) !!}
                        </a>
                    @else
                        <a wire:click="$dispatch('enabled', {id: {{$user->id}}, eventName: 'enabledUser'})" class="btn" title="Clic para habilitar">
                            {!! badge($user->register_status) !!}
                        </a>
                    @endif
                </td>
                <td>
                    <a href="#" wire:click='edit({{$user->id}})' class="btn btn-info btn-xs" title="Editar">
                        {!! icons('edit') !!}
                    </a>
                </td>
                <td>
                    <a wire:click="$dispatch('delete', {id: {{$user->id}}, eventName: 'destroyUser'})" class="btn btn-danger btn-xs" title="Eliminar">
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
            {{$querySelectUser->links()}}
        </x-slot>
    </x-card>

    <x-modal modalId="modalUser" modalTitle="Usuarios">
        <form wire:submit="{{ $id == 0 ? "store" : "update($id)" }}">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label for="name">Nombre</label>
                    <input wire:model.live='name' type="text" class="form-control" placeholder="Nombre">
                    @error('name') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                    <label for="email">Email</label>
                    <input wire:model.live='email' type="text" class="form-control" placeholder="Email">
                    @error('email') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                    <label for="perfil">Pefil</label>
                    <select wire:model.live='perfil' class="form-control">
                        <option value="">Selecciona</option>
                        <option value="Admin">Administrador</option>
                        <option value="Cliente">Cliente</option>
                        <option value="Técnico">Técnico</option>
                    </select>
                    @error('perfil') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                    <label for="password">Password</label>
                    <input wire:model.live='password' type="password" class="form-control" placeholder="Password">
                    @error('password') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
            </div>
            <hr>
            <button class="btn btn-primary float-right">Guardar</button>
        </form>
    </x-modal>
</div>
