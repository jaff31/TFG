<?php
    require 'funciones.php';
    
    session_start();
    if (empty($_SESSION['email'])) {
        header("Location: ../index.php");  
        exit();                         
    }
    $tareas = getTareas();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        addTarea();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas y Alumnos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
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
                <li><a href="#" onclick="mostrarSeccion('tareas')">Tareas</a></li>
                <li><a href="alumnos.php" onclick="mostrarSeccion('alumnos')">Alumnos</a></li>
                <li><a href="registros.php" onclick="mostrarSeccion('registro')">Registro</a></li>
                <li><a href="resumen.php" onclick="mostrarSeccion('resumen')">Resumen</a></li>
            </ul>
        </nav>
        
    </header>

    <main>
        <section id="tareas" class="seccion-activa">
            <h2>Tareas <i class="fas fa-clipboard-list"></i></h2>
            <div class="lista-tareas">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while($servicio = mysqli_fetch_assoc($tareas)){?>
                                <tr>
                                    <td><?php echo $servicio['id']?></td>
                                    <td><?php echo $servicio['nombre']?></td>
                                    <td><?php echo $servicio['fecha_creacion']?></td>
                                    <td>
                                        <button class="btn-consultar" onclick="mostrarDetallesTarea(<?php echo $servicio['id']?>)">Consultar</button>
                                        <button class="btn-editar" onclick="editarTarea(<?php echo $servicio['id']?>)">Editar</button>
                                        <button class="btn-eliminar" onclick="eliminarTarea(<?php echo $servicio['id']?>)">Eliminar</button>
                                    </td>
                                </tr>


                            <?php
                         } 
                        ?>
                    </tbody>
                </table>
            </div>
            <form class="formulario-crear" method = 'POST'>
                <h3>Crear Tarea</h3>
                <input type="text" name = "nombre" id="nombreTarea" placeholder="Nombre" required>
                <textarea id="descripcionTarea" name="descripcion" placeholder="Descripción" required></textarea>
                <button type="submit">Crear</button>
            </form>
        </section>

       

    <!-- Modales -->
    <div id="modal-consultar" class="hide">
        <div class="modal-contenido detalles-contenido">
            <span class="cerrar" onclick="cerrarModal('#modal-consultar')">&times;</span>
            <h2>Detalles</h2>
            <div id="modal-contenido"></div>
        </div>
    </div>

    <div id="modal-editar" class="hide" >
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('#modal-editar')">&times;</span>
            <h2>Editar</h2>
            <form class ="form-edit" id="formulario-editar" method='PUT'>
                <label for="editNombre">Nombre de la Tarea</label>           
                <input type="text" name = "nombre" id="editNombre" placeholder="Nombre" required>
                <label for="editNombre">Descripcion de la Tarea</label>
                <textarea id="editDescripcion" placeholder="Descripción" required></textarea>
                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>

    <script src="javascript.js"></script>
    <script src="../session.js"></script>
</body>
</html>