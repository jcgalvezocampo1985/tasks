<div>
    Inicio
    <x-card cardTitle="Card Title" cardTools="Card Tools" cardFooter="Card Footer">
        <x:slot:cardTools>
            <a href="#" class="btn btn-primary">Crear</a>
        </x:slot>

        <x-table>
            <x-slot:thead>
                <th>No.</th>
                <th>Nombre</th>
            </x-slot:thead>
            <tr>
                <td>1</td>
                <td>Juan</td>
            </tr>
        </x-table>
    </x-card>

    @include('components.layouts.partials.sidebar', ['menu' => $this->menu])
</div>
