<?php
    require 'funciones.php';
    $alumnos = getAlumnos();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        addAlumno();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas y Alumnos</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <h1>Gestión de Tareas y Alumnos <i class="fas fa-tasks"></i></h1>
        <nav>
            <ul>
                <li><a href="tareas.php" onclick="mostrarSeccion('tareas')">Tareas</a></li>
                <li><a href="#" onclick="mostrarSeccion('alumnos')">Alumnos</a></li>
                <li><a href="registros.php" onclick="mostrarSeccion('registro')">Registro</a></li>
                <li><a href="resumen.php" onclick="mostrarSeccion('resumen')">Resumen</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <section id="alumnos">
            <h2>Alumnos <i class="fas fa-users"></i></h2>
            <div class="lista-alumnos">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while($servicio = mysqli_fetch_assoc($alumnos)){?>
                                <tr>
                                    <td><?php echo $servicio['id']?></td>
                                    <td><?php echo $servicio['nombre']?></td>
                                    <td><?php echo $servicio['email']?></td>
                                    <td><?php echo $servicio['fecha_creacion']?></td>
                                    <td>
                                        <button class="btn-consultar" onclick="mostrarDetallesAlumno(<?php echo $servicio['id']?>)">Consultar</button>
                                        <button class="btn-editar" onclick="editarAlumno(<?php echo $servicio['id']?>)">Editar</button>
                                        <button class="btn-eliminar" onclick="eliminarAlumno(<?php echo $servicio['id']?>)">Eliminar</button>
                                    </td>
                                </tr>


                            <?php
                         } 
                        ?>
                    </tbody>
                </table>
            </div>
            <form class="formulario-crear" method ="POST">
                <h3>Crear Alumno</h3>
                <input type="text" name="nombreAlumno" id="nombreAlumno" placeholder="Nombre" required>
                <input type="text" name="apellidoAlumno" id="apellidoAlumno" placeholder="Apellido" required>
                <input type="email" name="emailAlumno" id="emailAlumno" placeholder="Email" required>
                <button type="submit">Crear</button>
            </form>
        </section>

        <section id="resumen" class="seccion-oculta">
            <h2>Resumen <i class="fas fa-chart-bar"></i></h2>
            <div class="resumen-datos">
                <p>Total Tareas: <span id="totalTareas">3</span></p>
                <p>Total Alumnos: <span id="totalAlumnos">3</span></p>
                <p>Total Registros: <span id="totalRegistros">3</span></p>
            </div>
        </section>
    </main>

    <!-- Modales -->
    <div id="modal-consultar" class="hide">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('#modal-consultar')">&times;</span>
            <h2>Detalles</h2>
            <div id="modal-contenido"></div>
        </div>
    </div>

    <div id="modal-editar" class="hide" >
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('#modal-editar')">&times;</span>
            <h2>Editar</h2>
            <form id="formulario-editar" method='PUT'>           
               <input type="text" name="nombreAlumno" id="nom" placeholder="Nombre" >
                <input type="text" name="apellidoAlumno" id="ape" placeholder="Apellido" >
                <input type="email" name="emailAlumno" id="emailA" placeholder="Email" >
                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>

    <script src="javascriptAlumno.js"></script>
    <script src="validacion.js"></script>
</body>
</html>