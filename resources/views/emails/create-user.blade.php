<x-mail::message>
    <h3>Tu cuenta ha sido creada, estos son tus datos de acceso:</h3>
    <p>
        <strong>Nombre: </strong>{{$details['name']}}
    </p>
    <p>
        <strong>Email: </strong>{{$details['email']}}
    </p>
    <p>
        <strong>Contraseña: </strong>{{$details['password']}}
    </p>
    <p>
        Ya puedes ingresar a tu cuenta.
    </p>
    <x-mail::button :url="$details['url']" color="success">
        Ingresar
    </x-mail::button>
    <p>
        ¡Gracias!.
    </p>
</x-mail::message>
