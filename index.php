<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $clave = $_POST["clave"];
    require 'conexion.php';
    
    $stmt = mysqli_prepare($db, "SELECT email, admin FROM usuarios WHERE email = ? AND clave = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "ss", $email, $clave);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado) {
        
        $fila = mysqli_fetch_assoc($resultado);
        if($fila){
            $_SESSION["email"] = $fila["email"];
            $_SESSION["rol"] = $fila["admin"] ? "admin" : "usuario";
            $isAdmin = $fila['admin'];

            if($isAdmin){
                header("Location: Administración/tareas.php");
            
                exit;
            }
            else if(!$isAdmin){
                header("Location: Tareas/alumnos.php");
            
                exit;
            }
            
        }
            else {
                $error = "Usuario o contraseña incorrectos.";
            }
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <div class ="label-container">
            <span class ="register-label">¿No tienes cuenta? <a href ="register.php">Registrate<a></span>
        </div>
    </div>
</body>
</html>
