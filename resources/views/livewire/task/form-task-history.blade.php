<x-modal modalId="modalTaskHistoryFile" modalTitle="Crear Avance de Tarea" modalSize="modal-md">
    <form wire:submit="saveImage" enctype="multipart/form-data">
        <div class="row">
            {{-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <label for="description">Descripción</label>
                <textarea wire:model.live='description' class="form-control" placeholder="Descripción" rows="5"></textarea>
                @error('description') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div> --}}
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <input type="file" wire:model="image" class="form-control">
                @error('image') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>

        </div>
        <hr>
        <button class="btn btn-outline-success float-right">
            {!! icons('save') !!}
            Guardar
        </button>
    </form>
</x-modal>
