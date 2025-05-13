<?php
    require 'funciones.php';
    $registros = getRegistros();
    $tareas = getTareas();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $params = getParams();
    }
    
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
                <li><a href="alumnos.php" >Tareas</a></li>
                <li><a href="registro.php">Registro</a></li>
                <li><a href="#informe" class="active">Informe</a></li>
            </ul>
        </nav>

        <section id="informe" class="content-section" >
            <h2>Informe Diario <i class="fas fa-chart-bar"></i></h2>
            <form method = "POST">
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
                        <?php  
                            
                            while($servicio2 = mysqli_fetch_assoc($tareas)){?>
                                
                                <option value = <?php echo $servicio2['id'] ?> > <?php echo $servicio2['nombre']?> </option>
                        
                                    
                                <?php
                            
                            }
                            ?>
                    </select>
                    <span id="error-tarea-informe" class="error-message"></span>
                </div>
                </form>
                <button type="submit" onclick="cargarInforme()">Cargar Informe</button>
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
</body>
</html>
