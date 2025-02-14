<x-modal modalId="modalTaskHistory" modalTitle="Crear Avance de Tarea" modalSize="modal-md">
    <form wire:submit.prevent="store">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <label for="description">Descripción</label>
                <textarea wire:model.live='description' class="form-control" placeholder="Descripción" rows="5"></textarea>
                @error('description') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <div class="form-group">
                    <label for="url_file">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input wire:model='url_file' type="file" class="custom-file-input" id="url_file">
                            <label class="custom-file-label" for="url_file">Choose file</label>
                        </div>
                    </div>
                </div>
                @error('url_file') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                {{-- <label for="url_file">Imagenes</label>
                <input wire:model.live='url_file' type="file" class="form-control" placeholder="Archivos">
                @error('url_file') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror --}}
            </div>

        </div>
        <hr>
        <button class="btn btn-outline-success float-right">
            {!! icons('save') !!}
            Guardar
        </button>
    </form>
</x-modal>
