<!DOCTYPE html>
<html>
<head>
    <?php require_once 'cabecera.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .espacio-superior {
            margin-top: 50px;
        }
    </style>
</head>
<body class="cuerpo">
    <div class="container centrar">
        <div class="text-right mb-3">
            <a href="index.php?accion=cerrarSesion" class="btn btn-danger">Cerrar sesión</a>
        </div>
        <div class="container cuerpo text-center">    
            <h2>Gestión de Entradas</h2>
        </div>
        <div class="row justify-content-center espacio-superior">
            <div class="col-md-6">
                <a href="index.php?accion=listado" class="btn btn-primary btn-block mb-3">Listar entradas</a>
                <a href="index.php?accion=anadirEntrada" class="btn btn-success btn-block">Añadir entrada</a>
            </div>
        </div>
    </div>
</body>
</html>
