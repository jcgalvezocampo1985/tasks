<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{$title ?? config('app.name')}}</title>
  @include('components.layouts.partials.styles')
  {{-- @livewireStyles --}}
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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
       {{$slot}}
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
      $('#'+idModal).modal('hide');
  });
  });
</script>
{{-- @livewireScripts --}}
</body>
</html>
