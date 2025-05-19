document.addEventListener('DOMContentLoaded', function(){

})
async function mostrarDetallesRegistro(id){
    
    document.body.classList.add("modal-abierto");

    const respuesta = await fetch("http://localhost:8080/api/registro/"+id);
    if(!respuesta.ok){
        throw new Error(`Response status: ${response.status}`);
    }
    const json = await respuesta.json();
    const modal = document.querySelector("#modal-consultar #modal-contenido")
    
    const pId = document.createElement("P") 
    pId.innerHTML = "<strong>ID: </strong>"+json.id
    modal.appendChild(pId)

    const pNombre = document.createElement("P") 
    pNombre.innerHTML = "<strong>Tarea: </strong>"+json.idTarea.nombre
    modal.appendChild(pNombre)

    const pAlum = document.createElement("P") 
    pAlum.innerHTML = "<strong>Alumno:</strong> "+json.idAlumno.nombre
    modal.appendChild(pAlum)

    const pProgreso = document.createElement("P") 
    pProgreso.innerHTML = "<strong>Progreso:</strong> "+json.progreso +"%"
    modal.appendChild(pProgreso);

    const pDesc = document.createElement("P") 
    pDesc.innerHTML = "<strong>Descripcion: </strong>"+json.descripcion 
    modal.appendChild(pDesc)

    const pFecha = document.createElement("P") 
    
    const fecha = new Date(json.fecha_creacion);
    const dia = fecha.getDate().toString().padStart(2, '0');
    const mes = (fecha.getMonth() + 1).toString().padStart(2, '0'); // Meses van de 0 a 11
    const anio = fecha.getFullYear();

    const fechaFormateada = `${dia}-${mes}-${anio}`;

    pFecha.innerHTML = "<strong>Fecha creacion: </strong>"+fechaFormateada;
    modal.appendChild(pFecha)

    
    const contenedor = document.querySelector("#modal-consultar")
    contenedor.classList.add("modal")
    contenedor.classList.remove("hide")

}
function cerrarModal(cerrar){

    const modalCerrar = document.querySelector(cerrar)
    const detalles_borrar = modalCerrar.querySelectorAll('P')
    detalles_borrar.forEach(p => {
        p.remove()
    });
    modalCerrar.classList.remove('modal')
    modalCerrar.classList.add('hide')
    document.body.classList.add("modal-abierto");
}
async function editarRegistro(id){

   const form = document.querySelector("#formulario-editar")
   form.setAttribute("onsubmit","editRegistro("+id+")")
   const contenedor = document.querySelector("#modal-editar")
   contenedor.classList.add("modal")
   contenedor.classList.remove("hide")
   const respuesta = await fetch("http://localhost:8080/api/registro/"+id);
    if(!respuesta.ok){
        throw new Error(`Response status: ${response.status}`);
    }
    const json = await respuesta.json();
    document.querySelector("#tareaRegistro").value = json.idTarea.id;
    document.querySelector("#alumnoRegistro").value = json.idAlumno.id;
    document.querySelector("#progresoRegistro").value = json.progreso;
    document.querySelector("#descripcionRegistro").value = json.descripcion;
    const fecha =  json.fecha_creacion.split('T')[0];
    document.querySelector("#fechaActividadRegistro").value = fecha ;

}
async function editRegistro(id){
    document.body.classList.add("modal-abierto");
    event.preventDefault();

    const tarea = document.querySelector("#tareaRegistro").value;
    console.log(tarea)
    const respuestaTarea = await fetch("http://localhost:8080/api/tareas/"+tarea);
    const tareaJson = await  respuestaTarea.json();

    const alumno = document.querySelector("#alumnoRegistro").value;
    const respuestaAlumno = await fetch("http://localhost:8080/api/alumnos/"+alumno);
    const alumnoJson = await  respuestaAlumno.json();

    const progreso = document.querySelector("#progresoRegistro").value;
    const desc = document.querySelector("#descripcionRegistro").value;
    const fecha = document.querySelector("#fechaActividadRegistro").value;
    console.log(progreso)
    
    const fecha_cre =  fecha.split('T')[0]
    const response = await fetch("http://localhost:8080/api/registro/"+id,{
        method:"PUT",
        headers: {
            "Content-Type": "application/json",
          },
        body:JSON.stringify({
            "idTarea":tareaJson,
            "idAlumno":alumnoJson,
            "progreso":progreso,
            "descripcion":desc,
            "fecha_creacion":fecha_cre
        })
    });
    
    if(!response.ok){
        throw new Error(`Response status: ${response.status}`);
    }

    location.reload();
    
    
    
}
async function eliminarRegistro(id){
    
    const response = await fetch("http://localhost:8080/api/registro/"+id,{
        method:"DELETE"
    });

    if (!response.ok) {
        throw new Error(`Error: ${response.status}`);
    }

    location.reload()
}