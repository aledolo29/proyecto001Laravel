<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Registro en WikiHeroes</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="font-family: Arial, sans-serif;">

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h2 class="mb-0">Alerta de Registro en WikiHeroes</h2>
            </div>
            <div class="card-body">
                <p class="lead">Hola {{ $data['nombreUsuario'] }} </p>
                <p>Recibes este correo porque alguien intentó registrarse en WikiHeroes utilizando tu dirección de
                    correo
                    electrónico.</p>
                <p>Si reconoces esta actividad, puedes ignorar este correo electrónico. Sin embargo, si no has intentado
                    registrarte en WikiHeroes, te recomendamos que tomes medidas para proteger tu cuenta.</p>
                <p>Gracias por tu atención y cuidado.</p>
                <hr>
                <p class="text-muted">Si tienes alguna pregunta o necesitas asistencia, no dudes en ponerte en contacto
                    con nosotros.</p>
            </div>
        </div>
    </div>

</body>

</html>
