<x-modal modalId="modalDifficultyLevel" modalTitle="Nivel Dificultad" modalSize="modal-sm">
    <form wire:submit="updateDifficultyLevel({{$id}})">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <label for="difficulty_level">Nivel Dificultad</label>
                <select wire:model.live='difficulty_level' class="form-control">
                    <option value="">Selecciona</option>
                    <option value="High">Alta</option>
                    <option value="Medium">Media</option>
                    <option value="Low">Baja</option>
                </select>
                @error('difficulty_level') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
            </div>
        </div>
        <hr>
        <button class="btn btn-primary float-right">Guardar</button>
    </form>
</x-modal>
