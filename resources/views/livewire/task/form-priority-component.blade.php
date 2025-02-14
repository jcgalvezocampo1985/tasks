<x-modal modalId="modalPriority" modalTitle="Prioridad" modalSize="modal-sm">
    <form wire:submit="updatePriority({{$id}})">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <label for="priority">Prioridad</label>
                <select wire:model.live='priority' class="form-control">
                    <option value="">Selecciona</option>
                    <option value="High">Alta</option>
                    <option value="Medium">Media</option>
                    <option value="Low">Baja</option>
                </select>
                @error('priority') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
        </div>
        <hr>
        <button class="btn btn-outline-success float-right">
            {!! icons('save') !!}
            Guardar
        </button>
    </form>
</x-modal>
