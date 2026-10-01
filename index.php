<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DevWeb</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
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

        /* NAVBAR */
        .navbar-custom {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            height: 82px;
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
        }

        /* HERO */
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

        .hero-line {
            width: 100%;
            height: 1px;
            background: #e5e7eb;
            margin: 65px 0 30px;
        }

        .admin-text {
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .admin-access {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: 25px;
            border: 1px solid #fbbf24;
            color: #b45309;
            background: #fffbeb;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .admin-access:hover {
            background: #fef3c7;
            color: #92400e;
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

    <!-- NAVBAR -->
    <nav class="navbar-custom">

        <!-- LOGO -->
        <a href="index.php" class="logo-container">
            <div class="logo">
                &lt;/&gt;
            </div>

            <span class="brand">DevWeb</span>
        </a>

        <!-- SOLO LOS 3 ACCESOS SOLICITADOS -->
        <div class="nav-buttons">

            <a href="login.php" class="nav-btn btn-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Iniciar sesión
            </a>

            <a href="registro.php" class="nav-btn btn-register">
                Registrarse
            </a>

            <a href="login.php?admin=1" class="nav-btn btn-admin">
                <i class="bi bi-shield-lock-fill"></i>
                Acceso administrador
            </a>

        </div>

    </nav>


    <!-- HERO -->
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
                Empresa dedicada al desarrollo de proyectos y soluciones web
                modernas, eficientes y con un diseño impecable.
            </p>


        </div>

    </main>

</body>
</html>