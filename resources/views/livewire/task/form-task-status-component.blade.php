<x-modal modalId="modalTaskStatus" modalTitle="Estado Tarea" modalSize="modal-sm">
    <form wire:submit="updateTaskStatus({{$id}})">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <label for="task_status">Prioridad</label>
                <select wire:model.live='task_status' class="form-control">
                    <option value="">Selecciona</option>
                    <option value="Paused">Pausada</option>
                    <option value="Started">Iniciada</option>
                    <option value="Stoped">Detenida</option>
                    <option value="Finished">Finalizada</option>
                </select>
                @error('task_status') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
        </div>
        <hr>
        <button class="btn btn-outline-success float-right">
            {!! icons('save') !!}
            Guardar
        </button>
    </form>
</x-modal>
