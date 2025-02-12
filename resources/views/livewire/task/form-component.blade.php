<x-modal modalId="modalTask" modalTitle="Tareas" modalSize="modal-xl">
    <form wire:submit="{{ $id == 0 ? "store" : "update($id)" }}">
        <div class="row">
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="name">Nombre</label>
                <input wire:model.live='name' type="text" class="form-control" placeholder="Nombre">
                @error('name') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="client_id">Cliente</label>
                <select wire:model.live='client_id' class="form-control">
                    <option value="">Selecciona</option>
                    @foreach($querySelectUserClientes as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
                @error('client_id') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="user_id">Técnico</label>
                <select wire:model.live='user_id' class="form-control">
                    <option value="">Selecciona</option>
                    @foreach($querySelectUserTecnicos as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
                @error('user_id') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="url_course">Curso URL</label>
                <input wire:model.live='url_course' type="text" class="form-control" placeholder="Curso URL">
                @error('url_course') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="start_date">Fecha Inicio</label>
                <input wire:model.live='start_date' type="date" class="form-control" placeholder="Fecha Inicio">
                @error('start_date') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="end_date">Fecha Término</label>
                <input wire:model.live='end_date' type="date" class="form-control" placeholder="Fecha Término">
                @error('end_date') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="difficulty_level">Nivel Dificultad</label>
                <select wire:model.live='difficulty_level' class="form-control">
                    <option value="">Selecciona</option>
                    <option value="High">Alta</option>
                    <option value="Medium">Media</option>
                    <option value="Low">Baja</option>
                </select>
                @error('difficulty_level') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mt-3">
                <label for="priority">Prioridad</label>
                <select wire:model.live='priority' class="form-control">
                    <option value="">Selecciona</option>
                    <option value="High">Alta</option>
                    <option value="Medium">Media</option>
                    <option value="Low">Baja</option>
                </select>
                @error('priority') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3">
                <label for="description">Descripción</label>
                <textarea wire:model.live='description' class="form-control" placeholder="Descripción" rows="5"></textarea>
                @error('description') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
        </div>
        <hr>
        <button class="btn btn-primary float-right">Guardar</button>
    </form>
</x-modal>