<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

<link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.min.css')}}">

@yield('styles')

<style>
  .contenedor-texto {
    white-space: nowrap; /* Evita que el texto se divida en varias líneas */
    overflow: hidden; /* Oculta el texto que exceda el ancho del contenedor */
    text-overflow: ellipsis; /* Agrega puntos suspensivos al final */
    width: 200px; /* Define un ancho fijo para el contenedor */
    display: block; /* Asegura que el elemento ocupe una línea completa */
  }
</style>