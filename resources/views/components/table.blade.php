<div class="mb-3 d-flex justify-content-between">
    <div>
        <span>Mostrar</span>
        <select wire:model.live='cant'>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        <span>Entradas</span>
    </div>
    <div wire:ignore>
        <input wire:model.live='search' wire:focus="search" type="text" placeholder="Buscar..." class="form-control">
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped display nowrap">
        <thead>
            <tr>
                {{$thead}}
            </tr>
        </thead>
        <tbody>
            {{$slot}}
        </tbody>
    </table>

</div>
