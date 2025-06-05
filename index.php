

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
            <p id="errorMensaje" style="color: red;"></p>
            <form id="loginForm">
                <input id="email" type="email" name="email" placeholder="Email" required>
                <input id="clave" type="password" name="clave" placeholder="Contraseña" required>
                <button type="submit">Entrar</button>
            </form>
            <div class ="label-container">
                <span class ="register-label">¿No tienes cuenta? <a href ="register.php">Registrate<a></span>
            </div>
        </div>
        
    </body>
    <script src="loginsession.js"></script>
    <script src="login.js"></script>

    </html>
