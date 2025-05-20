<?php
    session_start();
    if (empty($_SESSION['email'])) {
        header("Location: ../index.php");  // o a la ruta de tu formulario de login
        exit();                         // Importante: detiene la ejecución
    }
    require 'funciones.php';
    $registros = getRegistros();
    $tareas = getTareas();
    $alumnos = getAlumnos();
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas y Alumnos</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <header>
    <div class ="header-container">
        <div class="perfil-usuario">
                <img src="../Tareas/img/default-pp.jpg" alt="Foto de perfil">
                <span><?php echo $_SESSION["email"]; ?></span>
                <button onclick="logout()" class="logout-btn">
                    <span class="material-icons">logout</span>
                </button>
            </div>
            <h1>Gestión de Tareas y Alumnos <i class="fas fa-tasks"></i></h1>
    </div>
        <nav>
            <ul>
                <li><a href="tareas.php" onclick="mostrarSeccion('tareas')">Tareas</a></li>
                <li><a href="alumnos.php" onclick="mostrarSeccion('alumnos')">Alumnos</a></li>
                <li><a href="registros.php" onclick="mostrarSeccion('registro')">Registro</a></li>
                <li><a href="#" onclick="mostrarSeccion('resumen')">Resumen</a></li>
            </ul>
        </nav>
    </header>

    <main>
            
        <section id="resumen" >
        <div class="resumen-cards">
            <div class="card">
                <h3><i class="fas fa-clipboard-list"></i> Tareas</h3>
                <p><?php echo mysqli_num_rows($tareas); ?></p>
            </div>
            <div class="card">
                <h3><i class="fas fa-user-graduate"></i> Alumnos</h3>
                <p><?php echo mysqli_num_rows($alumnos); ?></p>
            </div>
            <div class="card">
                <h3><i class="fas fa-file-alt"></i> Registros</h3>
                <p><?php echo mysqli_num_rows($registros); ?></p>
            </div>
</div>

        </section>
    </main>

    <script src="javascriptRegistros.js"></script>
    <script src="../session.js"></script>
</body>
</html>