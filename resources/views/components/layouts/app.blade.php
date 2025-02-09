<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }}</title>
    @include('components.layouts.partials.styles')
    {{-- @livewireStyles --}}
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('components.layouts.partials.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('components.layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('components.layouts.partials.breadcrumb')
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @livewire('messages')
                    {{ $slot }}
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('components.layouts.partials.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('components.layouts.partials.scripts')

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('close-modal', (idModal) => {
                $('#' + idModal).modal('hide');
            });

            Livewire.on('open-modal', (idModal) => {
                $('#' + idModal).modal('show');
            });

            Livewire.on('delete', (e) => {
                Swal.fire({
                    title: "¿Eliminar el registro?",
                    text: "No se podrá revertir esta acción",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "¡Eliminado!",
                            text: "Registro Eliminado",
                            icon: "success"
                        });

                        Livewire.dispatch(e.eventName, {id: e.id});
                    }
                });
            });

            Livewire.on('disabled', (e) => {
                Swal.fire({
                    title: "¿Deshabilitar el registro?",
                    text: "Esta acción se puede revertir",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Deshabilitar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "¡Deshabilitado!",
                            text: "Registro Deshabilitado",
                            icon: "success"
                        });

                        Livewire.dispatch(e.eventName, {id: e.id});
                    }
                });
            });

            Livewire.on('enabled', (e) => {
                Swal.fire({
                    title: "¿Habilitar el registro?",
                    text: "Esta acción se puede revertir",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Habilitar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "¡Habilitado!",
                            text: "Registro Habilitado",
                            icon: "success"
                        });

                        Livewire.dispatch(e.eventName, {id: e.id});
                    }
                });
            });
        });
    </script>
    {{-- @livewireScripts --}}
</body>

</html>
