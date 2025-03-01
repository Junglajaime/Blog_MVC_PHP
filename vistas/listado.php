<!DOCTYPE html>
<html>
<head>
    <?php require_once 'cabecera.php'; ?>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace a la hoja de estilos CSS -->
    <!-- Asegúrate de incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="cuerpo">
    <div class="container centrar">
        <div>
            <a href="index.php"  class="btn btn-info">Inicio</a>
            <a href="index.php?accion=cerrarSesion" class="btn btn-danger" style="float: right; ">Cerrar sesión</a>
        </div>
        <div class="text-center">
            <h2>Listar Entradas</h2>
        </div>
        <!-- Modal de confirmación para eliminar -->
        <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        Confirma que quieres eliminar esta entrada
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="confirmarEliminarBtn">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Botón para generar PDF -->
        <div class="text-right mb-4">
            <button class="btn btn-warning" onclick="generarPDF()">Imprimir</button>
        </div>
        <?php foreach ($parametros["mensajes"] as $mensaje) : ?>
            <!-- Mensajes de alerta -->
            <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach; ?>
        <?php if (empty($parametros["datos"])) : ?>
            <div class="alert alert-info">No hay entradas disponibles.</div>
        <?php else : ?>
            <table class="table table-striped" id="pdfTable">
                <thead>
                    <tr>
                        <th>Nick Usuario</th>
                        <th>Nombre Categoría</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>
                            <!-- Ordenar por fecha -->
                            <a href="index.php?accion=listado&orden=<?= ($orden == 'asc') ? 'desc' : 'asc' ?>">
                                Fecha
                                <?= ($orden == 'asc') ? '<span>&#9650;</span>' : '<span>&#9660;</span>' ?>
                            </a>
                        </th>
                        <th>Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($parametros["datos"] as $d) : ?>
                        <tr>
                            <td><?= $d["Nick Usuario"] ?></td>
                            <td><?= $d["Nombre Categoría"] ?></td>
                            <td><?= $d["TITULO"] ?></td>
                            <td><?= $d["DESCRIPCION"] ?></td>
                            <td>
                                <?php if ($d["IMAGEN"] !== NULL) : ?>
                                    <img src="imagenes/<?= $d['IMAGEN'] ?>" alt="Imagen" class="avatar-img">
                                <?php else : ?>
                                    ----
                                <?php endif; ?>
                            </td>
                            <td><?= date("d/m/Y H:i:s", strtotime($d["FECHA"])) ?></td>
                            <td>
                                <a href="index.php?accion=editarEntrada&id=<?= $d['IDENT'] ?>">Editar</a> |
                                <a href="index.php?accion=mostrarEntrada&id=<?= $d['IDENT'] ?>">Detalle</a> |
                                <a href="#" onclick="mostrarModalEliminar(<?= $d['IDENT'] ?>)">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <div class="pagination-container">
        <div class="arrow" onclick="window.location.href='index.php?accion=listado&pagina=<?php echo max($parametros['pagina'] - 1, 1); ?>&orden=<?php echo $parametros['orden']; ?>&regsxpag=<?php echo $parametros['regsxpag']; ?>'">
            ◂
        </div>
        <div class="text-center">
            <!-- Paginación -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $parametros['totalPaginas']; $i++) : ?>
                        <li class="page-item <?php echo ($i == $parametros['pagina']) ? 'active' : ''; ?>">
                            <a class="page-link" href="index.php?accion=listado&pagina=<?php echo $i; ?>&orden=<?php echo isset($_GET['orden']) ? $_GET['orden'] : 'asc'; ?>&regsxpag=<?php echo $parametros['regsxpag']; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
        <div class="arrow" onclick="window.location.href='index.php?accion=listado&pagina=<?php echo min($parametros['pagina'] + 1, $parametros['totalPaginas']); ?>&orden=<?php echo $parametros['orden']; ?>&regsxpag=<?php echo $parametros['regsxpag']; ?>'">
            ▸
        </div>
    </div>
    <script>
        // Función para generar el PDF
        function generarPDF() {
            try {
                var contenido = document.getElementById('pdfTable').cloneNode(true);
                var filas = contenido.querySelectorAll('tr');
                filas.forEach(function(fila) {
                    fila.removeChild(fila.lastElementChild);
                });

                var opciones = {
                    margin: 10,
                    filename: 'ListadoEntradas.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };

                html2pdf().from(contenido).set(opciones).save();
            } catch (error) {
                alert("Error al generar el PDF.");
            }
        }

        var idEliminar = null;

        // Modal de confirmación para eliminar
        function mostrarModalEliminar(id) {
            idEliminar = id;
            $('#confirmarEliminarModal').modal('show');
        }

        // Clic en el botón de confirmación de eliminación
        $('#confirmarEliminarBtn').click(function() {
            if (idEliminar !== null) {
                eliminarEntrada(idEliminar);
                idEliminar = null;
            }
        });

        // Función para redirigir a la eliminación de la entrada
        function eliminarEntrada(id) {
            window.location.href = 'index.php?accion=eliminarEntrada&id=' + id;
        }
    </script>
</body>
</html>
