Probando correo!
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar registro</title>
</head>
<body>
<h1>Gracias por tu interés en nuestro Festival PLURANZA 2016!</h1>

<p>
    Necesitamos <a href='{{ route("pluranza.users.confirm", $user->token) }}'>confimar tu correo</a>, será rápido!
</p>
</body>
</html>