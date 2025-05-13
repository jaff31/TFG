<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $clave = $_POST["clave"];
    $clave2 = $_POST["clave2"];
    require 'conexion.php';
    if($clave === $clave2){
        $stmt = mysqli_prepare($db, "INSERT INTO  usuarios(email,clave) values(?,?)");
        mysqli_stmt_bind_param($stmt, "ss", $email, $clave);
        mysqli_stmt_execute($stmt);
        
    }
    else{
        $error = "Las contraseñas no coinciden";
    }
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Registrarse</h2>
        <span class="info">Para conseguir el rol "Admin", contacte con un administrador</span>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <input type="password" name="clave2" placeholder="Confirmar Contraseña" required>
            <button type="submit">Registrarse</button>
            <div class ="label-container">
                <span class ="register-label">¿Ya estas registrado? <a href ="index.php">Iniciar Sesión<a></span>
            </div>
        </form>
    </div>
</body>
</html>
