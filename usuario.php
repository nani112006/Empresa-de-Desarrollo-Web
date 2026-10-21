
<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login_usuario.php");
    exit;
}

require_once 'conexion.php';

$idUsuario = $_SESSION['usuario']['id'] ?? null;

$proyectos = [];

if ($idUsuario) {
    $resultado = consultarSupabase(
        "Proyecto?id_usuario=eq." . urlencode((string)$idUsuario) .
        "&select=*,programador(nombre,apellido)"
    );

    if (is_array($resultado)) {
        $proyectos = $resultado;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de Usuario</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Empresa de Desarrollo Web</span>

        <div>
            <span class="text-white me-3">
                Hola, <?= htmlspecialchars($_SESSION['usuario']['nombre'] ?? '') ?>
            </span>

            <a href="cerrar_sesion_usuario.php" class="btn btn-danger">
                Cerrar sesión
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <div class="text-center mb-4">
        <h1>
            Bienvenido <?= htmlspecialchars($_SESSION['usuario']['nombre'] ?? '') ?>
        </h1>
        <p class="lead">Estos son tus proyectos.</p>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <button
            type="button"
            class="btn btn-success"
            onclick="abrirFormulario('nuevo_proyecto_usuario.php', 'Crear proyecto')">
            + Crear proyecto
        </button>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h3 class="mb-0">Mis proyectos</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Proyecto</th>
                            <th>Descripción</th>
                            <th>Programador</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (count($proyectos) > 0): ?>

                        <?php foreach ($proyectos as $p): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars((string)($p['id_proyecto'] ?? '')) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($p['nombre_proyecto'] ?? '') ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($p['descripcion'] ?? '') ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        ($p['programador']['nombre'] ?? '') . ' ' .
                                        ($p['programador']['apellido'] ?? '')
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($p['estado'] ?? '') ?>
                                </td>

                                <td class="text-nowrap">
                                    <button
                                        type="button"
                                        class="btn btn-info btn-sm"
                                        onclick='verProyecto(<?= json_encode(
                                            $p,
                                            JSON_HEX_TAG |
                                            JSON_HEX_APOS |
                                            JSON_HEX_QUOT |
                                            JSON_HEX_AMP
                                        ) ?>)'>
                                        Ver
                                    </button>

                                    <button
                                        type="button"
                                        class="btn btn-warning btn-sm"
                                        onclick="abrirFormulario(
                                            'editar_proyecto_usuario.php?id=<?= urlencode((string)($p['id_proyecto'] ?? '')) ?>',
                                            'Editar proyecto'
                                        )">
                                        Editar
                                    </button>

                                    <a
                                        href="eliminar_proyecto_usuario.php?id=<?= urlencode((string)($p['id_proyecto'] ?? '')) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que querés eliminar este proyecto?');">
                                        Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                Todavía no tenés proyectos.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver los datos -->
<div class="modal fade" id="modalVer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Detalles del proyecto</h5>
                <button type="button" class="btn-close btn-close-white"
                    data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8" id="verId"></dd>

                    <dt class="col-sm-4">Nombre</dt>
                    <dd class="col-sm-8" id="verNombre"></dd>

                    <dt class="col-sm-4">Descripción</dt>
                    <dd class="col-sm-8" id="verDescripcion"></dd>

                    <dt class="col-sm-4">Programador</dt>
                    <dd class="col-sm-8" id="verProgramador"></dd>

                    <dt class="col-sm-4">Fecha de inicio</dt>
                    <dd class="col-sm-8" id="verInicio"></dd>

                    <dt class="col-sm-4">Fecha final</dt>
                    <dd class="col-sm-8" id="verFinal"></dd>

                    <dt class="col-sm-4">Estado</dt>
                    <dd class="col-sm-8" id="verEstado"></dd>
                </dl>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal para crear y editar -->
<div class="modal fade" id="modalFormulario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="tituloFormulario">Formulario</h5>
                <button type="button" class="btn-close btn-close-white"
                    data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body p-0" style="min-height: 500px;">
                <iframe
                    id="iframeFormulario"
                    title="Formulario de proyecto"
                    style="width:100%; height:70vh; border:0;"
                    src="about:blank">
                </iframe>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
const modalVer = new bootstrap.Modal(document.getElementById('modalVer'));
const modalFormularioElement = document.getElementById('modalFormulario');
const modalFormulario = new bootstrap.Modal(modalFormularioElement);
const iframeFormulario = document.getElementById('iframeFormulario');

function ponerTexto(id, valor) {
    document.getElementById(id).textContent =
        valor === null || valor === undefined || valor === ''
            ? 'No especificado'
            : String(valor);
}

function verProyecto(p) {
    ponerTexto('verId', p.id_proyecto);
    ponerTexto('verNombre', p.nombre_proyecto);
    ponerTexto('verDescripcion', p.descripcion);

    const programador = p.programador
        ? `${p.programador.nombre || ''} ${p.programador.apellido || ''}`.trim()
        : '';

    ponerTexto('verProgramador', programador);
    ponerTexto('verInicio', p.fecha_inicio);
    ponerTexto('verFinal', p.fecha_final);
    ponerTexto('verEstado', p.estado);

    modalVer.show();
}

function abrirFormulario(url, titulo) {
    document.getElementById('tituloFormulario').textContent = titulo;
    iframeFormulario.src = url;
    modalFormulario.show();
}

// Si el formulario termina redirigiendo a usuario.php,
// cerrar el modal y recargar la lista de proyectos.
iframeFormulario.addEventListener('load', function () {
    try {
        const ruta = iframeFormulario.contentWindow.location.pathname;
        if (ruta.endsWith('/usuario.php') || ruta.endsWith('/usuario')) {
            modalFormulario.hide();
            window.location.reload();
        }
    } catch (error) {
        // No se interviene si el navegador impide leer la URL del iframe.
    }
});

modalFormularioElement.addEventListener('hidden.bs.modal', function () {
    iframeFormulario.src = 'about:blank';
});
</script>

</body>
</html>
