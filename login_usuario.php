<?php

session_start();

require_once 'conexion.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Completá todos los campos.';
    } else {

        $usuarios = consultarSupabase(
            'usuarios?email=eq.' . urlencode($email) . '&select=*'
        );

        if (is_array($usuarios) && count($usuarios) > 0) {

            $usuario = $usuarios[0];

            if (password_verify($password, $usuario['password'])) {

                $_SESSION['usuario'] = [
                    'id' => $usuario['id_usuario'],
                    'nombre' => $usuario['nombre'],
                    'apellido' => $usuario['apellido'],
                    'email' => $usuario['email']
                ];

                header("Location: usuario.php");
                exit;

            } else {
                $error = 'Email o contraseña incorrectos.';
            }

        } else {
            $error = 'Email o contraseña incorrectos.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar sesión</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="text-center mb-4">
                        Iniciar sesión
                    </h2>

                    <?php if ($error !== ''): ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

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

                            Ingresar

                        </button>

                    </form>

                    <a
                        href="registro.php"
                        class="btn btn-secondary w-100 mt-2">

                        Crear una cuenta

                    </a>

                    <a
                        href="index.php"
                        class="d-block text-center mt-3">

                        Volver al inicio

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>