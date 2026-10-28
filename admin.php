<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once 'conexion.php';

$proyectos = consultarSupabase(
    "Proyecto?select=*,programador(nombre,apellido)"
);

$programadores = consultarSupabase(
    "programador?select=*"
);

$comercios = consultarSupabase(
    "comercio?select=*"
);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Panel administrador</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">
            Panel administrador
        </span>
        <a
            href="cerrar_sesion.php"
            class="btn btn-danger">
            Cerrar sesión

        </a>
    </div>
</nav>

<div class="container mt-5">

    <!-- PROYECTOS -->

    <div class="card shadow mb-5">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Proyectos
            </h3>

            <button type="button" class="btn btn-success" data-form-url="nuevo_proyecto.php" data-modal-title="Crear proyecto">
                + Nuevo proyecto
            </button>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Proyecto</th>

                        <th>Programador</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php if (
                        is_array($proyectos) &&
                        count($proyectos) > 0
                    ): ?>

                        <?php foreach ($proyectos as $proyecto): ?>

                            <tr>

                                <td>

                                    <?= htmlspecialchars(
                                        $proyecto['id_proyecto'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $proyecto['nombre_proyecto'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        ($proyecto['programador']['nombre'] ?? '') .
                                        ' ' .
                                        ($proyecto['programador']['apellido'] ?? '')

                                    ) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars(
                                        $proyecto['estado'] ?? ''
                                    ) ?>

                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-record-type="proyecto" data-view-record="<?= htmlspecialchars(json_encode([
                                        'ID' => $proyecto['id_proyecto'] ?? '',
                                        'Nombre' => $proyecto['nombre_proyecto'] ?? '',
                                        'Descripción' => $proyecto['descripcion'] ?? '',
                                        'Programador' => trim(($proyecto['programador']['nombre'] ?? '') . ' ' . ($proyecto['programador']['apellido'] ?? '')),
                                        'Estado' => $proyecto['estado'] ?? '',
                                        'Fecha de inicio' => $proyecto['fecha_inicio'] ?? '',
                                        'Fecha final' => $proyecto['fecha_final'] ?? ''
                                    ], JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>">Ver</button>
                                    <button type="button" class="btn btn-warning btn-sm" data-form-url="editar_proyecto_admin.php?id=<?= 
                                    urlencode((string)($proyecto['id_proyecto'] ?? '')) ?>" data-modal-title="Editar proyecto">Editar</button>

                                    <a href="eliminar_proyecto.php?id=<?= urlencode((string)($proyecto['id_proyecto'] ?? '')) ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('¿Seguro que querés eliminar este proyecto?');">
                                        Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td
                                colspan="5"
                                class="text-center">
                                No hay proyectos.
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- PROGRAMADORES -->

    <div class="card shadow mb-5">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Programadores
            </h3>
            <button type="button" class="btn btn-success" data-form-url="nuevo_programador.php" data-modal-title="Crear programador">
                + Nuevo programador
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>

                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if (
                        is_array($programadores) &&
                        count($programadores) > 0
                    ): ?>

                        <?php foreach ($programadores as $programador): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars(
                                        $programador['id_Programador'] ?? ''
                                    ) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars(
                                        $programador['nombre'] ?? ''
                                    ) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars(
                                        $programador['apellido'] ?? ''
                                    ) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars(
                                        $programador['email'] ?? ''
                                    ) ?>

                                </td>
                                <td>                   
                                    
                                    <button type="button" class="btn btn-info btn-sm" data-record-type="programador" data-view-record="<?= htmlspecialchars(json_encode([
                                        'ID' => $programador['id_Programador'] ?? '',
                                        'Nombre' => $programador['nombre'] ?? '',
                                        'Apellido' => $programador['apellido'] ?? '',
                                        'Email' => $programador['email'] ?? ''
                                    ], JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>">Ver</button>
                                    <button type="button" class="btn btn-warning btn-sm" data-form-url="editar_programador.php?id=<?= urlencode((string)($programador['id_Programador'] ?? '')) ?>" data-modal-title="Editar programador">Editar</button>
                                    <a
                                    href="eliminar_programador.php?id=<?= urlencode((string)($programador['id_Programador'] ?? '')) ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('¿Seguro que querés eliminar este programador?');">
                                    Eliminar
                                </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td
                                colspan="5"
                                class="text-center">
                                No hay programadores.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- COMERCIO -->

    <div class="card shadow mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">
                Comercio
            </h3>
            <button type="button" class="btn btn-success" data-form-url="nuevo_comercio.php" data-modal-title="Crear comercio">
                + Nuevo comercio
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if (
                        is_array($comercios) &&
                        count($comercios) > 0
                    ): ?>

                        <?php foreach ($comercios as $comercio): ?>

                            <tr>
                                <td>
                                    <?= htmlspecialchars(
                                        $comercio['id_comercio'] ?? ''
                                    ) ?>

                                </td>
                                <td>

                                    <?= htmlspecialchars(
                                        $comercio['nombre'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $comercio['direccion'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $comercio['telefono'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <button type="button" class="btn btn-info btn-sm" data-record-type="comercio" data-view-record="<?= htmlspecialchars(json_encode([
                                        'ID' => $comercio['id_comercio'] ?? '',
                                        'Nombre' => $comercio['nombre'] ?? '',
                                        'Dirección' => $comercio['direccion'] ?? '',
                                        'Teléfono' => $comercio['telefono'] ?? ''
                                    ], JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>">Ver</button>
                                    <button type="button" class="btn btn-warning btn-sm" data-form-url="editar_comercio.php?id=<?= urlencode((string)($comercio['id_comercio'] ?? '')) ?>" data-modal-title="Editar comercio">Editar</button>

                                    <a
                                        href="eliminar_comercio.php?id=<?= urlencode($comercio['id_comercio'] ?? '') ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que querés eliminar este comercio?');">

                                        Eliminar

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="5"
                                class="text-center">

                                No hay comercios.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

            <!-- Modal reutilizable para VER, CREAR y EDITAR -->
            <div class="modal fade" id="adminModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="adminModalTitle">Formulario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body" id="adminModalBody">
                            <div class="text-center py-4">Cargando...</div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
            const adminModalElement = document.getElementById('adminModal');
            const adminModal = new bootstrap.Modal(adminModalElement);
            const adminModalTitle = document.getElementById('adminModalTitle');
            const adminModalBody = document.getElementById('adminModalBody');

            document.querySelectorAll('[data-form-url]').forEach(button => {
                button.addEventListener('click', async () => {
                    adminModalTitle.textContent = button.dataset.modalTitle || 'Formulario';
                    adminModalBody.innerHTML = '<div class="text-center py-4">Cargando formulario...</div>';
                    adminModal.show();

                    try {
                        const response = await fetch(button.dataset.formUrl, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        });
                        const html = await response.text();
                        const parsed = new DOMParser().parseFromString(html, 'text/html');
                        const form = parsed.querySelector('form');

                        if (!response.ok || !form) {
                            adminModalBody.textContent = 'No se pudo cargar el formulario. Verificá que el archivo exista y que la sesión de administrador siga activa.';
                            return;
                        }

                        // Mantener el contenido del formulario y usar el Bootstrap de admin.php.
                        adminModalBody.replaceChildren(document.importNode(form, true));
                        const loadedForm = adminModalBody.querySelector('form');

                        loadedForm.addEventListener('submit', async event => {
                            event.preventDefault();
                            if (!loadedForm.reportValidity()) return;

                            const submitButton = loadedForm.querySelector('[type="submit"]');
                            const originalText = submitButton ? submitButton.textContent : '';
                            if (submitButton) {
                                submitButton.disabled = true;
                                submitButton.textContent = 'Guardando...';
                            }

                            try {
                                const formData = new FormData(loadedForm);
                                const target = loadedForm.getAttribute('action') || button.dataset.formUrl;
                                const result = await fetch(target, {
                                    method: (loadedForm.method || 'POST').toUpperCase(),
                                    body: formData,
                                    redirect: 'follow'
                                });

                                // Los controladores existentes suelen redirigir a admin.php al guardar.
                                if (result.redirected && new URL(result.url, window.location.href).pathname.endsWith('/admin.php')) {
                                    window.location.reload();
                                    return;
                                }

                                const resultText = await result.text();
                                const resultDoc = new DOMParser().parseFromString(resultText, 'text/html');
                                const message = resultDoc.body ? resultDoc.body.innerText.trim() : resultText;

                                if (result.ok && /guardado|actualizado|registrado|éxito|exito/i.test(message)) {
                                    window.location.reload();
                                    return;
                                }

                                adminModalBody.innerHTML = '';
                                const alert = document.createElement('div');
                                alert.className = 'alert alert-danger mb-0';
                                alert.textContent = message || 'No se pudo guardar. Revisá los datos e intentá nuevamente.';
                                adminModalBody.appendChild(alert);
                            } catch (error) {
                                adminModalBody.innerHTML = '<div class="alert alert-danger">Ocurrió un error de conexión al guardar.</div>';
                            } finally {
                                if (submitButton && document.body.contains(submitButton)) {
                                    submitButton.disabled = false;
                                    submitButton.textContent = originalText;
                                }
                            }
                        });
                    } catch (error) {
                        adminModalBody.textContent = 'No se pudo conectar para cargar el formulario.';
                    }
                });
            });

            // Modal de consulta de datos.
            document.querySelectorAll('[data-view-record]').forEach(button => {
                button.addEventListener('click', () => {
                    adminModalTitle.textContent = 'Ver ' + (button.dataset.recordType || 'registro');
                    let data;
                    try { data = JSON.parse(button.dataset.viewRecord); }
                    catch (error) { data = {}; }

                    const list = document.createElement('dl');
                    list.className = 'row mb-0';
                    Object.entries(data).forEach(([label, value]) => {
                        const dt = document.createElement('dt');
                        dt.className = 'col-sm-4';
                        dt.textContent = label;
                        const dd = document.createElement('dd');
                        dd.className = 'col-sm-8';
                        dd.textContent = value === null || value === '' ? '—' : String(value);
                        list.append(dt, dd);
                    });
                    adminModalBody.replaceChildren(list);
                    adminModal.show();
                });
            });
</script>

</body>

</html>