<?php
     session_start();
     if (empty($_SESSION['email'])) {
         header("Location: ../index.php");  
         exit();                         
     }
    require 'funciones.php';
    $registros = getRegistros();
    $tareas = getTareas();
    $alumnos = getAlumnos();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        addRegistro();
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="container">
    <div>
        <div class="perfil-usuario">
                <img src="../Tareas/img/default-pp.jpg" alt="Foto de perfil">
                <span><?php echo $_SESSION["email"]; ?></span>
                <button onclick="logout()" class="logout-btn">
                    <span class="material-icons">logout</span>
                </button>
        </div>
        <nav>
            <ul>
                <li><a href="#tareas" >Tareas</a></li>
                <li><a href="registro.php" class="active">Registro</a></li>
                <li><a href="informe.php">Informe</a></li>
            </ul>
        </nav>
        </div>

        <section id="registro" class="content-section">
            <h2>Registro de Progreso <i class="fas fa-edit"></i></h2>
            <form method="POST" id="form-registro">
                <div class="form-group">
                    <label for="tarea">Selecciona una tarea:</label>
                    <select name = "tarea" id="tareas-list"  required>
                        <option  disabled selected value="" >Seleccionar Tarea</option>
                        <?php  
                            
                            while($servicio2 = mysqli_fetch_assoc($tareas)){?>
                                
                                <option value = <?php echo $servicio2['id'] ?> > <?php echo $servicio2['nombre']?> </option>
                        
                                    
                                <?php
                            
                            }
                            ?>
                    </select>
                    <span id="error-tarea" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="alumno">Selecciona un alumno:</label>
                    <select id="alumnos-list" name = "alumno" required>
                        <option disabled selected value="">Seleccionar Alumno</option>
                        <?php  
                            while($servicio3 = mysqli_fetch_assoc($alumnos)){?>
                                
                                <option value = <?php echo $servicio3['id'] ?> > <?php echo $servicio3['nombre']?> </option>
                        
                                    
                                <?php
                            
                            }
                            ?>
                </select>
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

        
    </div>

    <script src="javascript.js"></script>
    <script src="../session.js"></script>

</body>
</html>
