document.addEventListener('DOMContentLoaded', function(){

})
async function mostrarDetallesAlumno(id){
    
    console.log("Prueba"+id)
    const respuesta = await fetch("http://localhost:8080/api/registro/"+id);
    if(!respuesta.ok){
        throw new Error(`Response status: ${response.status}`);
    }
    const json = await respuesta.json();
    const modal = document.querySelector("#modal-consultar #modal-contenido")
    
    const pId = document.createElement("P") 
    pId.textContent = "ID: "+json.id
    modal.appendChild(pId)

    const pNombre = document.createElement("P") 
    pNombre.textContent = "Tarea: "+json.idTarea.nombre
    modal.appendChild(pNombre)

    const pAlum = document.createElement("P") 
    pAlum.textContent = "Alumno: "+json.idAlumno.nombre
    modal.appendChild(pAlum)

    const pProgreso = document.createElement("P") 
    pProgreso.textContent = "Progreso: "+json.progreso +"%"
    modal.appendChild(pProgreso);

    const pDesc = document.createElement("P") 
    pDesc.textContent = "Descripcion: "+json.descripcion 
    modal.appendChild(pDesc)

    const pFecha = document.createElement("P") 
    pFecha.textContent = "Fecha creacion: "+json.fecha_creacion 
    modal.appendChild(pFecha)

    
    const contenedor = document.querySelector("#modal-consultar")
    contenedor.classList.add("modal")
    contenedor.classList.remove("hide")

}
function cerrarModal(cerrar){
    console.log(cerrar)
    const modalCerrar = document.querySelector(cerrar)
    const detalles_borrar = modalCerrar.querySelectorAll('P')
    detalles_borrar.forEach(p => {
        p.remove()
    });
    modalCerrar.classList.remove('modal')
    modalCerrar.classList.add('hide')
}
async function editarAlumno(id){
   const form = document.querySelector("#formulario-editar")
   form.setAttribute("onsubmit","editAlumno("+id+")")
   const contenedor = document.querySelector("#modal-editar")
   contenedor.classList.add("modal")
   contenedor.classList.remove("hide")
   const respuesta = await fetch("http://localhost:8080/api/registro/"+id);
    if(!respuesta.ok){
        throw new Error(`Response status: ${response.status}`);
    }
    const json = await respuesta.json();
    console.log(json.progreso)
    document.querySelector("#tareaRegistro").value = json.idTarea.id;
    document.querySelector("#alumnoRegistro").value = json.idAlumno.id;
    document.querySelector("#progresoRegistro").value = json.progreso;
    document.querySelector("#descripcionRegistro").value = json.descripcion;
    const fecha =  json.fecha_creacion.split('T')[0]
    document.querySelector("#fechaActividadRegistro").value = fecha ;

}
async function editAlumno(id){

    const tarea = document.querySelector("#tareaRegistro").value;
    const respuestaTarea = await fetch("http://localhost:8080/api/tareas/"+id);
    const tareaJson = respuestaTarea.json();

    const alumno = document.querySelector("#alumnoRegistro").value;
    const respuestaAlumno = await fetch("http://localhost:8080/api/alumnos/"+id);
    const alumnoJson = respuestaAlumno.json();

    const progreso = document.querySelector("#progresoRegistro").value;
    const desc = document.querySelector("#descripcionRegistro").value;
    const fecha = document.querySelector("#fechaActividadRegistro").value;
    
    event.preventDefault();

    const fecha_cre =  json.fecha_creacion.split('T')[0]
    const response = await fetch("http://localhost:8080/api/registro/"+id,{
        method:"PUT",
        headers: {
            "Content-Type": "application/json",
          },
        body:JSON.stringify({
            "idTarea":tareaJson,
            "idAlumno":respuestaAlumno,
            "progreso":progreso,
            "descripcion":desc,
            "fecha_creacion":fecha_cre
        })
    });
    
    if(!response.ok){
        throw new Error(`Response status: ${response.status}`);
    }

    location.reload()
    
    
    
}
async function eliminarAlumno(id){
    
    const response = await fetch("http://localhost:8080/api/registro/"+id,{
        method:"DELETE"
    });

    if (!response.ok) {
        throw new Error(`Error: ${response.status}`);
    }

    location.reload()
}