<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

        <div class="card shadow">
            <div class="card-body">

            <h2 class="text-center mb-4">Administrador</h2>

            <form action="verificar_login.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control" required>
                </div>

                <div class="mb-3">
                     <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Iniciar Sesion
                </button>

            </form>         

            <a href="index.php" class="btn btn-secondary w-100 mt-2">
                Volver
            </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>