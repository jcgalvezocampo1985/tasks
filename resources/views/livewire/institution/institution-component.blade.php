<div>
    <x-card cardTitle="Listado de Categorías ({{$this->totalRegistros}})" cardTools="Card Tools" cardFooter="Card Footer">
        <x:slot:cardTools>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalInstitution">Crear Institución</a>
        </x:slot>
        
        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Nombre Corto</th>
                <th>Descripción</th>
                <th>Estado Registro</th>
                <th colspan="4" width="3%">Acciones</th>
            </x-slot:thead>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="#" class="btn btn-info btn-xs" title="Ver">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 576 512">
                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                        </svg>
                    </a>
                </td>
                <td>
                    <a href="#" class="btn btn-danger btn-xs" title="Eliiminar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 448 512">
                            <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        </x-table>
    </x-card>

    <x-modal modalId="modalInstitution" modalTitle="Instituciones">
        <form wire:submit="store">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <input wire:model.live='full_name' type="text" class="form-control" placeholder="Nombre Completo">
                    @error('full_name') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                    <input wire:model.live='short_name' type="text" class="form-control" placeholder="Nombre Corto">
                    @error('short_name') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                    <textarea wire:model.live='description' class="form-control" placeholder="Descripción"></textarea>
                    @error('description') <span class="text-danger w-100 mt-2">{{ $message }}</span> @enderror
                </div>
            </div>
            <hr>
            <button class="btn btn-primary float-right">Save changes</button>
        </form>
    </x-modal>
</div>