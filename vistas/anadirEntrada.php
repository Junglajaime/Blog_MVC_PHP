<!DOCTYPE html>
<html>
<head>
  <?php require_once 'cabecera.php'; // Incluye el archivo de cabecera ?>
  <link rel="stylesheet" href="styles.css"> <!-- Enlace a la hoja de estilos CSS -->
</head>
<body>
  <div class="centrar">  
    <div class="container centrar">
      <div>
            <a href="index.php"  class="btn btn-info">Inicio</a>
            <a href="index.php?accion=cerrarSesion" class="btn btn-danger" style="float: right; ">Cerrar sesión</a>
        </div>
      <div class="container cuerpo text-center centrar">   
        <h2>Añadir Entrada</h2>
        <?php 
        // Verifica si $msgResultado está definido
        if (isset($msgResultado)) {
          echo "<div class='alert alert-info'>$msgResultado</div>";
        } 
        ?>
      </div>
      <?php 
      // Verifica si $parametros["mensajes"] está definido y es un array
      if (isset($parametros["mensajes"]) && is_array($parametros["mensajes"])) : 
        foreach ($parametros["mensajes"] as $mensaje) : ?> 
          <!-- Mostramos los mensajes de alerta -->
          <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
      <?php 
        endforeach; 
      endif;
      ?>
      <form action="index.php?accion=anadirEntrada" method="post" enctype="multipart/form-data">
        <!-- Campo oculto para almacenar el ID del usuario -->
        <input type="hidden" name="idusuario" value="<?php echo $_COOKIE['id_usuario']; ?>">
        <div class="form-group">
          <label for="titulo">Título:</label>
          <input type="text" class="form-control" name="titulo" required 
            value="<?= isset($parametros["datos"]["titulo"]) ? $parametros["datos"]["titulo"] : '' ?>">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción:</label>
          <textarea id="descripcion" name="descripcion" class="form-control" style="min-height: 100px;"><?= isset($parametros["datos"]["descripcion"]) ? $parametros["datos"]["descripcion"] : '' ?></textarea>
        </div>
        <div class="form-group">
          <label for="categoria">Categoría:</label>
          <select name="categoria" class="form-control" required>
            <option value="">Seleccione una categoría</option>
            <?php 
            // Verifica si $parametros["categorias"] está definido y es un array
            if (isset($parametros["categorias"]) && is_array($parametros["categorias"])) :
              foreach ($parametros["categorias"] as $categoria) : ?>
                <option value="<?= $categoria["IDCAT"] ?>" <?= (isset($parametros["datos"]["categoria"]) && $parametros["datos"]["categoria"] == $categoria["IDCAT"]) ? 'selected' : '' ?>><?= $categoria["NOMBRECAT"] ?></option>
            <?php 
              endforeach; 
            endif;
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="imagen">Imagen:</label>
          <input type="file" name="imagen" class="form-control" value="<?= isset($parametros["datos"]["imagen"]) ? $parametros["datos"]["imagen"] : '' ?>">
        </div>
        <button type="submit" class="btn btn-dark btn-block">Guardar</button>
      </form>
    </div>
  </div>
  <script>
    // CKEditor
    ClassicEditor
      .create(document.querySelector('#descripcion'))
      .catch(error => {
          console.error(error);
    });
  </script>
</body>
</html>
