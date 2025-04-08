document.addEventListener('DOMContentLoaded', function(){

})
function crearTarea(event){
    
    event.preventDefault();

    const nombre = document.querySelector('#nombreTarea').value;
    const descripcion = document.querySelector('#descripcionTarea').value;
    const id = document.querySelectorAll('tr').length ;

    const table = document.querySelector('table')
    
    const tr = document.createElement('TR')
    const tdId = document.createElement('TD')
    tdId.textContent = id
    tr.appendChild(tdId)

    const tdNombre = document.createElement('TD')
    tdNombre.textContent = nombre
    tr.appendChild(tdNombre)


    const tdFecha = document.createElement('TD')
    tdFecha.textContent = new Date().toLocaleDateString('en-CA')
    tr.appendChild(tdFecha)

    const tdBotones = document.createElement('TD')

    table.appendChild(tr)
}
async function mostrarDetallesTarea(id){
    
    console.log("Prueba"+id)
    const respuesta = await fetch("http://localhost:8080/api/tareas/"+id);
    if(!respuesta.ok){
        throw new Error(`Response status: ${response.status}`);
    }
    const json = await respuesta.json();
    
    const modal = document.querySelector("#modal-consultar #modal-contenido")
    
    const pId = document.createElement("P") 
    pId.textContent = "ID: "+json.id
    modal.appendChild(pId)

    const pNombre = document.createElement("P") 
    pNombre.textContent = "Nombre: "+json.nombre
    modal.appendChild(pNombre)

    const pDesc = document.createElement("P") 
    pDesc.textContent = "Descripcion: "+json.descripcion
    modal.appendChild(pDesc);

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
async function editarTarea(id){
   const form = document.querySelector("#formulario-editar")
    form.setAttribute("onsubmit","editTarea("+id+")")
    
    const respuesta = await fetch("http://localhost:8080/api/tareas/"+id);

    

   if(!respuesta.ok){
       throw new Error(`Response status: ${response.status}`);
   }
   const json = await respuesta.json();
  document.querySelector("#editNombre").value = json.nombre;
  document.querySelector("#editDescripcion").value = json.descripcion;

   const contenedor = document.querySelector("#modal-editar")
   contenedor.classList.add("modal")
   contenedor.classList.remove("hide")
}
async function editTarea(id){

    const nombre = document.querySelector("#editNombre").value;
    const desc = document.querySelector("#editDescripcion").value;
    
    event.preventDefault()
    const response = await fetch("http://localhost:8080/api/tareas/"+id,{
        method:"PUT",
        headers: {
            "Content-Type": "application/json",
          },
        body:JSON.stringify({
            "nombre":nombre,
            "descripcion":desc
        })
    });
    
    if(!response.ok){
        throw new Error(`Response status: ${response.status}`);
    }

    location.reload()
    
    
    
}
async function eliminarTarea(id){
    
    const response = await fetch("http://localhost:8080/api/tareas/"+id,{
        method:"DELETE"
    });

    if (!response.ok) {
        throw new Error(`Error: ${response.status}`);
    }

    location.reload()
}