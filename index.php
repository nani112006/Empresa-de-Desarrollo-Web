<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DevWeb</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        body {
            margin: 0;
            background: #f8fafc;
            font-family: Arial, Helvetica, sans-serif;
            color: #0f172a;
        }

        .navbar-custom {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #0f172a;
        }

        .logo {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #111827;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
        }

        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-btn {
            border: none;
            padding: 12px 22px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .btn-login {
            color: #334155;
            background: transparent;
        }

        .btn-login:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .btn-register {
            background: #2563eb;
            color: white;
        }

        .btn-register:hover {
            background: #1d4ed8;
            color: white;
        }

        .btn-admin {
            color: #334155;
            background: transparent;
        }

        .btn-admin:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .hero {
            min-height: calc(100vh - 82px);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 50px 20px;
        }

        .hero-content {
            max-width: 800px;
        }

        .badge-platform {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border-radius: 25px;
            background: #eff6ff;
            border: 1px solid #dbeafe;
            color: #2563eb;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            background: #60a5fa;
            border-radius: 50%;
        }

        .hero h1 {
            font-size: 48px;
            line-height: 1.1;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .hero h1 span {
            color: #2563eb;
        }

        .hero p {
            font-size: 19px;
            line-height: 1.6;
            color: #64748b;
            max-width: 680px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {

            .navbar-custom {
                height: auto;
                padding: 15px;
                flex-direction: column;
                gap: 15px;
            }

            .nav-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero {
                min-height: calc(100vh - 140px);
            }

            .hero h1 {
                font-size: 38px;
            }

            .hero p {
                font-size: 17px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar-custom">

        <a href="index.php" class="logo-container">

            <div class="logo">
                &lt;/&gt;
            </div>

            <span class="brand">
                DevWeb
            </span>

        </a>


        <div class="nav-buttons">

            <!-- CREAR CUENTA -->
            <a href="registro.php" class="nav-btn btn-register">
                <i class="bi bi-person-plus"></i>
                Crear cuenta
            </a>


            <!-- INICIAR SESIÓN USUARIO -->
            <a href="login_usuario.php" class="nav-btn btn-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Iniciar sesión
            </a>


            <!-- ACCESO ADMINISTRADOR -->
            <a href="login.php" class="nav-btn btn-admin">
                <i class="bi bi-shield-lock-fill"></i>
                Acceso administrador
            </a>

        </div>

    </nav>


    <main class="hero">

        <div class="hero-content">

            <div class="badge-platform">

                <span class="badge-dot"></span>

                Plataforma de Desarrollo Web

            </div>


            <h1>

                Bienvenido a nuestra

                <br>

                <span>plataforma digital</span>

            </h1>


            <p>

                Plataforma dedicada al desarrollo de proyectos y
                soluciones web modernas, eficientes y funcionales

            </p>

        </div>

    </main>

</body>
</html>