<x-modal modalId="modalUser" modalTitle="Usuarios" modalSize="modal-xl">
    <form wire:submit="{{ $id == 0 ? "store" : "update($id)" }}">
        <div class="row">
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="name">Nombre</label>
                <input wire:model.live='name' type="text" class="form-control" placeholder="Nombre">
                @error('name') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="email">Email</label>
                <input wire:model.live='email' type="text" class="form-control" placeholder="Email">
                @error('email') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="perfil">Pefil</label>
                <select wire:model.live='perfil' wire:change="$set('perfil',$event.target.value)" class="form-control">
                    <option value="">Selecciona</option>
                    <option value="Admin">Administrador</option>
                    <option value="Cliente">Cliente</option>
                    <option value="Técnico">Técnico</option>
                </select>
                @error('perfil') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
        </div>
        <hr>
        @if($perfil == 'Cliente')
            <div id="datos-cliente">
                <h3>Datos del Cliente</h3>
                <div class="row">
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                        <label for="full_name">Nombre Completo</label>
                        <input wire:model.live='full_name' type="text" class="form-control" placeholder="Nombre Completo">
                        @error('full_name') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                        <label for="short_name">Nombre Corto</label>
                        <input wire:model.live='short_name' type="text" class="form-control" placeholder="Nombre Corto">
                        @error('short_name') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                        <label for="institution_id">Institución</label>
                        <select wire:model.live='institution_id' class="form-control">
                            <option value="">Selecciona</option>
                            @foreach($querySelectInstitution as $row)
                            <option value="{{$row->id}}">{{$row->full_name}}</option>
                            @endforeach
                        </select>
                        @error('institution_id') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                        <label for="department_id">Institución</label>
                        <select wire:model.live='department_id' class="form-control">
                            <option value="">Selecciona</option>
                            @foreach($querySelectDepartment as $row)
                            <option value="{{$row->id}}">{{$row->full_name}}</option>
                            @endforeach
                        </select>
                        @error('department_id') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                        <label for="description">Descripción</label>
                        <textarea wire:model.live='description' class="form-control" placeholder="Descripción" rows="5"></textarea>
                        @error('description') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        @endif
        <hr>
        <button class="btn btn-primary float-right">Guardar</button>
    </form>
</x-modal>
{{-- @section('js')
@include('livewire.user.script')
@endsection --}}
