<?php

function getTareas(){
    try{
        require '../conexion.php';

        $query = 'Select * from tareas';
        
        $consulta = mysqli_query($db,$query);

        return $consulta;

    }catch(\Throwable $e){
        var_dump($e);

    }
}
function getAlumnos(){
    try{
        require '../conexion.php';

        $query = 'Select * from alumno';
        
        $consulta = mysqli_query($db,$query);

        return $consulta;

    }catch(\Throwable $e){
        var_dump($e);

    }
}
function getRegistros(){
    try{
        require '../conexion.php';

        $query = 'Select id,(Select nombre from tareas t where r.id_tarea = t.id) as nombreTarea,(Select nombre from alumno a where r.id_alumno = a.id) as nombreAlumno,progreso,fecha_creacion from registros r';
        
        $consulta = mysqli_query($db,$query);

        return $consulta;

    }catch(\Throwable $e){
        var_dump($e);

    }
}
function addRegistro(){
    

        try{
            require '../conexion.php';
            $tarea = $_POST['tarea'];
            $alumno = $_POST['alumno'];
            $descripcion = $_POST['descripcion'];
            $progreso = $_POST['progreso'];
            $fecha = $_POST['fecha'];

            if(empty(trim($progreso))){
                header("Location: error.php?mensaje=El campo progreso no puede estar vacio");
                return;
            }
            // $fecha_partes = explode('-', $fecha);
            // $fecha_conv = $fecha_partes[2] . "-" . $fecha_partes[1] . "-" . $fecha_partes[0];
            $sql = "Insert INTO registros(id_tarea,id_alumno,progreso,descripcion,fecha_creacion) 
                    values('$tarea','$alumno','$progreso','$descripcion','$fecha')";
            
            if(mysqli_query($db,$sql)){
                header("Location:registro.php");
            }
        
        
    }catch(\Throwable $e){
        echo 'Error ';
        echo $fecha;
        echo $e;
    }
}
function getParams(){
    
    $fecha = $_POST['fecha-informe'];
    $tarea = $_POST['tarea-informe'];

    return [$fecha,$tarea];

}
?>