<x-modal modalId="modalInstitution" modalTitle="Instituciones">
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
        </div>
        <hr>
        <button class="btn btn-primary float-right">Guardar</button>
    </form>
</x-modal>