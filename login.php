<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Acceso administrador</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header bg-dark text-white text-center">

                    <h3 class="mb-0">
                        Acceso administrador
                    </h3>

                </div>

                <div class="card-body">

                    <form
                        action="verificar_login.php"
                        method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Usuario
                            </label>

                            <input
                                type="text"
                                name="usuario"
                                class="form-control"
                                required>

                        </div>


                        <div class="mb-4">

                            <label class="form-label">
                                Contraseña
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Iniciar sesión

                        </button>

                    </form>


                    <div class="text-center mt-3">

                        <a href="index.php">
                            Volver al inicio
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>