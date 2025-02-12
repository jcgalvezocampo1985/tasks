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
                <select wire:model.live='perfil' id="perfil" class="form-control">
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
        <div class="row">

        </div>
        <hr>
        <button class="btn btn-primary float-right">Guardar</button>
    </form>
</x-modal>
@section('js')
@include('livewire.user.script')
@endsection