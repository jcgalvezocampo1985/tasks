<x-modal modalId="modalTaskHistoryStatus" modalTitle="Estado Tarea" modalSize="modal-sm">
    <form wire:submit="updateTaskHistoryStatus({{$id}})">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <label for="task_history_status">Prioridad</label>
                <select wire:model.live='task_history_status' class="form-control">
                    <option value="">Selecciona</option>
                    <option value="Paused">Pausada</option>
                    <option value="Started">Iniciada</option>
                    <option value="Finished">Finalizada</option>
                </select>
                @error('task_history_status') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
        </div>
        <hr>
        <button class="btn btn-outline-success float-right">
            {!! icons('save') !!}
            Guardar
        </button>
    </form>
</x-modal>
