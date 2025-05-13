<?php
    require './funciones.php';
    $registros = getRegistros();
    $tareas = getTareas();
    $alumnos = getAlumnos();
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Tareas</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#tareas" class="active">Tareas</a></li>
                <li><a href="registro.php">Registro</a></li>
                <li><a href="informe.php">Informe</a></li>
            </ul>
        </nav>

        <section id="tareas" class="content-section">
            <h2>Tareas y Alumnos <i class="fas fa-tasks"></i></h2>
            <div class="columnas">
                <div class="columna">
                    <div class="imagen-titulo">
                        <img src="./img/tareas.jpg" alt="Tareas">
                        <h3>Tareas Disponibles</h3>
                    </div>
                    <ul id="lista-tareas">
                    <?php 
                            while($servicio = mysqli_fetch_assoc($tareas)){?>
                                <li>
                                    <?php echo $servicio['nombre']?>                        
                                </li>


                            <?php
                         } 
                        ?>
                    </ul>
                </div>
                <div class="columna">
                    <div class="imagen-titulo">
                        <img src="./img/alumnos.jpg" alt="Alumnos">
                        <h3>Alumnos Registrados</h3>
                    </div>
                    <div id="lista-alumnos" class="cuadricula-alumnos">
                    <?php 
                            while($servicio = mysqli_fetch_assoc($alumnos)){?>
                                <p class="alumno">
                                    <?php echo $servicio['nombre']?>                        
                                </p>


                            <?php
                         } 
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="registro" class="content-section" style="display: none;">
            <h2>Registro de Progreso <i class="fas fa-edit"></i></h2>
            <form id="form-registro">
                <div class="form-group">
                    <label for="tarea">Selecciona una tarea:</label>
                    <input list="tareas-list" id="tarea" name="tarea" required>
                    <datalist id="tareas-list"></datalist>
                    <span id="error-tarea" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="alumno">Selecciona un alumno:</label>
                    <input list="alumnos-list" id="alumno" name="alumno" required>
                    <datalist id="alumnos-list"></datalist>
                    <span id="error-alumno" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="progreso">Progreso (%):</label>
                    <input type="number" id="progreso" name="progreso" min="0" max="100" required>
                    <span id="error-progreso" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="3" required></textarea>
                    <span id="error-descripcion" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" required>
                    <span id="error-fecha" class="error-message"></span>
                </div>
                <button type="submit">Registrar Progreso</button>
            </form>
        </section>

        <section id="informe" class="content-section" style="display: none;">
            <h2>Informe Diario <i class="fas fa-chart-bar"></i></h2>
            <div class="filtros">
                <div class="form-group">
                    <label for="fecha-informe">Selecciona un día:</label>
                    <input type="date" id="fecha-informe" name="fecha-informe" required>
                    <span id="error-fecha-informe" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="tarea-informe">Selecciona una tarea:</label>
                    <select id="tarea-informe" name="tarea-informe" required>
                        <option value="">-- Selecciona una tarea --</option>
                    </select>
                    <span id="error-tarea-informe" class="error-message"></span>
                </div>
                <button type="button" onclick="cargarInforme()">Cargar Informe</button>
            </div>
            <div id="resultado-informe">
                <div id="superados">
                    <h3>Superados (≥ 50%)</h3>
                    <ul id="lista-superados"></ul>
                </div>
                <div id="no-superados">
                    <h3>No Superados (< 50%)</h3>
                    <ul id="lista-no-superados"></ul>
                </div>
            </div>
        </section>
    </div>

    <script src="javascript.js"></script>
    <script src="validacion.js"></script>
</body>
</html>
