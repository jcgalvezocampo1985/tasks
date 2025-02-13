<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de nuevo usuario</title>
</head>
<body>
    <h2>Tu cuenta ha sido creada, estos son tus datos de acceso:</h2>
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
    <p>
        ¡Gracias!.
    </p>
</body>
</html>
