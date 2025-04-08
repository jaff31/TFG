<?php

function getTareas(){
    try{
        require 'conexion.php';

        $query = 'Select * from tareas';
        
        $consulta = mysqli_query($db,$query);

        return $consulta;

    }catch(\Throwable $e){
        var_dump($e);

    }
}
function getAlumnos(){
    try{
        require 'conexion.php';

        $query = 'Select * from alumno';
        
        $consulta = mysqli_query($db,$query);

        return $consulta;

    }catch(\Throwable $e){
        var_dump($e);

    }
}
function getRegistros(){
    try{
        require 'conexion.php';

        $query = 'Select id,(Select nombre from tareas t where r.id_tarea = t.id) as nombreTarea,(Select nombre from alumno a where r.id_alumno = a.id) as nombreAlumno,progreso,fecha_creacion from registros r';
        
        $consulta = mysqli_query($db,$query);

        return $consulta;

    }catch(\Throwable $e){
        var_dump($e);

    }
}
function addTarea(){
    

    try{
        require 'conexion.php';
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        if(empty(trim($nombre))){
            header("Location: error.php?mensaje=El campo nombre no puede estar vacio");
            return;
        }
        $fecha = date('y-m-d');
        $sql = "Insert INTO tareas(nombre,descripcion,fecha_creacion) values('$nombre','$descripcion','$fecha')";
        
        if(mysqli_query($db,$sql)){
            header("Location:index.php");
        }

        
    }catch(\Throwable $e){
        echo 'Error ';
        echo $e;
    }
}
function addRegistro(){
    

        try{
            require 'conexion.php';
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
                header("Location:registros.php");
            }
        
        
    }catch(\Throwable $e){
        echo 'Error ';
        echo $fecha;
        echo $e;
    }
}
function addAlumno(){
    
    
    try{
        require 'conexion.php';
        $nombre = $_POST['nombreAlumno'];
        $apellido =$_POST['apellidoAlumno'];
        $email = $_POST['emailAlumno'];
        
        $nomCompleto = "$nombre $apellido";

        if(empty(trim($nombre)) || empty(trim($apellido)) ) {
            header("Location: error.php?mensaje=Los campos nombre y apellido no pueden estar vacio");
            return;
        }
        $fecha = date('y-m-d');
        $sql = "Insert INTO alumno(nombre,email,fecha_creacion) values('$nomCompleto','$email','$fecha')";
        
        if(mysqli_query($db,$sql)){
            header("Location:alumnos.php");
         }

        
    }catch(\Throwable $e){
        echo 'Error ';
        echo $e;
    }
}
?>