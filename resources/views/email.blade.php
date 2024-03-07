<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Mi Sitio</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">¡Bienvenido a WikiHeroes!</h2>
            </div>
            <div class="card-body">
                <p class="lead">Hola {{ $data['nombreUsuario'] }},</p>
                <p>Gracias por registrarte en WikiHeroe. Estamos emocionados de tenerte con nosotros.</p>
                <p>Para empezar, puedes explorar nuestro contenido y aprovechar al máximo tu experiencia en el sitio.
                </p>
                <p>¡Esperamos que disfrutes tu tiempo aquí!</p>
                <hr>
                <p class="text-muted">Si tienes alguna pregunta o necesitas asistencia, no dudes en ponerte en contacto
                    con nosotros.</p>
            </div>
        </div>
    </div>
</body>

</html>
