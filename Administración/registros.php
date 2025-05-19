<?php
    require 'funciones.php';
    $registros = getRegistros();
    $registros2 = getTareas();
    $registros3 = getAlumnos();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        addRegistro();
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
                <li><a href="alumnos.php" onclick="mostrarSeccion('alumnos')">Alumnos</a></li>
                <li><a href="#" onclick="mostrarSeccion('registro')">Registro</a></li>
                <li><a href="resumen.php" onclick="mostrarSeccion('resumen')">Resumen</a></li>
            </ul>
        </nav>
    </header>

    <main>


        <section id="registro">
            <h2>Registro <i class="fas fa-file-alt"></i></h2>
            <div class="lista-registros">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Tarea</th>
                            <th>Nombre Alumno</th>
                            <th>Fecha Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while($servicio = mysqli_fetch_assoc($registros)){?>
                                <tr>
                                    <td><?php echo $servicio['id']?></td>
                                    <td><?php echo $servicio['nombreTarea']?></td>
                                    <td><?php echo $servicio['nombreAlumno']?></td>
                                    <td><?php echo $servicio['fecha_creacion']?></td>
                                    <td>
                                        <button class="btn-consultar" onclick="mostrarDetallesRegistro(<?php echo $servicio['id']?>)">Consultar</button>
                                        <button class="btn-editar" onclick="editarRegistro(<?php echo $servicio['id']?>)">Editar</button>
                                        <button class="btn-eliminar" onclick="eliminarRegistro(<?php echo $servicio['id']?>)">Eliminar</button>
                                    </td>
                                </tr>


                            <?php
                         } 
                        ?>
                    </tbody>
                </table>
            </div>
            <form class="formulario-crear" method="POST">
                <h3>Crear Registro</h3>
                <select name = "tarea"  required>
                    <option  disabled selected value="" >Seleccionar Tarea</option>
                    <?php  
                        
                        while($servicio2 = mysqli_fetch_assoc($registros2)){?>
                            
                            <option value = <?php echo $servicio2['id'] ?> > <?php echo $servicio2['nombre']?> </option>
                    
                                
                            <?php
                          
                         }
                        ?>
                </select>
                <select name = "alumno" required>
                    <option disabled selected value="">Seleccionar Alumno</option>
                    <?php  
                        $i = 1;
                        while($servicio3 = mysqli_fetch_assoc($registros3)){?>
                            
                            <option value = <?php echo $servicio3['id'] ?> > <?php echo $servicio3['nombre']?> </option>
                    
                                
                            <?php
                           $i = $i +1;
                         }
                        ?>
                </select>
                <input name="progreso" type="number"  placeholder="Progreso" required>
                <textarea name ="descripcion"  placeholder="Descripción" required></textarea>
                <input name="fecha" type="date"  required>
                <button type="submit">Crear</button>
            </form>
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
            <form class ="form-edit" id="formulario-editar" method='PUT'>
            <label>Seleccionar Tarea</label>           
            <select name = "tarea" id="tareaRegistro" required>
                    <option  disabled selected value="" >Seleccionar Tarea</option>
                    <?php  
                        $registros2 = getTareas();
                        while($servicio2 = mysqli_fetch_assoc($registros2)){?>
                            
                            <option value = <?php echo $servicio2['id'] ?> > <?php echo $servicio2['nombre']?> </option>
                    
                                
                            <?php
                         }
                        ?>
                </select>
                <label>Seleccionar Alumno</label> 
                <select name = "alumno" id="alumnoRegistro" required>
                    <option disabled selected value="">Seleccionar Alumno</option>
                    <?php  
                        $registros3 = getAlumnos();
                        while($servicio3 = mysqli_fetch_assoc($registros3)){?>
                            
                            <option value = <?php echo $servicio3['id'] ?> > <?php echo $servicio3['nombre']?> </option>
                    
                                
                            <?php
                           
                         }
                        ?>
                </select>
                <label>Progreso</label> 
                <input name="progreso" type="number" id="progresoRegistro" placeholder="Progreso" required>
                <label>Descripcion de la tarea</label> 
                <textarea name ="descripcion" id="descripcionRegistro" placeholder="Descripción"></textarea>
                <label>Fecha</label> 
                <input name="fecha" type="date" id="fechaActividadRegistro" required>
                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>

    <script src="javascriptRegistros.js"></script>
    <script src="validacion.js"></script>
</body>
</html>