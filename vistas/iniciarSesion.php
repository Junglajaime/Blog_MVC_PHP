<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once 'cabecera.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .cuerpo h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group input[type="checkbox"] {
            margin-right: 10px;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .alert {
            color: #fff;
            background-color: #dc3545;
            border-radius: 4px;
            padding: 10px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cuerpo text-center">
            <h2>Iniciar Sesión</h2>
        </div>
        <form action="index.php?accion=iniciarSesion" method="post">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required value="<?php echo $usuario; ?>">
            </div>
            <div class="form-group">
                <label for="contrasenia">Contraseña:</label>
                <input type="password" id="contrasenia" name="contrasenia" required value="<?php echo $contrasenia; ?>">
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="recuerdo" <?php echo isset($_COOKIE['recuerdo']) ? 'checked' : ''; ?>> Recuérdame</label>
            </div>
            <?php
            // Mostramos un mensaje de error si las credenciales son incorrectas
            if(isset($_GET['error']) && $_GET['error'] == "credenciales") {
                echo '<div class="alert">' . "Nombre de usuario o contraseña incorrectos." . '</div>';          
            }     
            // Mostramos un mensaje de error si se intenta acceder directamente sin iniciar sesión
            if (isset($_GET['error']) && $_GET['error'] == "fuera") {
                echo '<div class="alert">' . "No puedes acceder directamente en esta página sin loguearte." . '</div>';          
            }
            ?> 
            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
