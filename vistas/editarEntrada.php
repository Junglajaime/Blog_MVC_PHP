<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'cabecera.php'; ?>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace a la hoja de estilos CSS -->
</head>
<body class="cuerpo">
    <div class="container centrar">
        <div>
            <a href="index.php"  class="btn btn-info">Inicio</a>
            <a href="index.php?accion=cerrarSesion" class="btn btn-danger" style="float: right; ">Cerrar sesión</a>
        </div>
        <div class="text-center">
            <h2>Actualizar Entrada</h2>
        </div>

        <?php foreach ($parametros["mensajes"] as $mensaje): ?>
            <!-- Mostramos los mensajes de alerta -->
            <div class="alert alert-<?= $mensaje['tipo'] ?>" role="alert">
                <?= $mensaje['mensaje'] ?>
            </div>
        <?php endforeach; ?>

        <form action="index.php?accion=editarEntrada" method="post" enctype="multipart/form-data">
            <!-- Campo oculto para almacenar el ID de la entrada -->
            <input type="hidden" name="idEntrada" value="<?= $parametros['entrada']['IDENT']; ?>">
            <div class="form-group">
                <label for="nuevaCategoria">Nueva Categoría:</label>
                <!-- Select para elegir la nueva categoría -->
                <select class="form-control" id="nuevaCategoria" name="nuevaCategoria" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <?php $idCategoria = $categoria['IDCAT']; ?>
                        <?php $nombreCategoria = $categoria['NOMBRECAT']; ?>
                        <?php $selected = ($parametros['entrada']['IDCATEGORIA'] == $idCategoria) ? 'selected' : ''; ?>
                        <option value="<?= $idCategoria ?>" <?= $selected ?>><?= $nombreCategoria ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nuevoTitulo">Nuevo Título:</label>
                <input type="text" class="form-control" id="nuevoTitulo" name="nuevoTitulo" value="<?= $parametros['entrada']['TITULO']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nuevaImagen">Nueva Imagen:</label>
                <input type="file" class="form-control" id="nuevaImagen" name="nuevaImagen" accept="image/*">
                <?php 
                    // Variable para almacenar la ruta de la nueva imagen
                    $nuevaImagen = isset($_FILES["nuevaImagen"]) && ($_FILES["nuevaImagen"]["error"] == UPLOAD_ERR_OK) ? "imagenes/" . time() . "-" . $_FILES["nuevaImagen"]["name"] : $parametros["entrada"]["IMAGEN"]; 
                ?>
            </div>
            <div class="form-group">
                <label for="nuevaDescripcion">Nueva Descripción:</label>
                <textarea id="editor" class="form-control" name="nuevaDescripcion"><?= $parametros['entrada']['DESCRIPCION']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        // CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
</html>
