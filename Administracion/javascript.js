document.addEventListener('DOMContentLoaded', function(){

})
function authHeaders(contentType = "application/json") {
    const token = sessionStorage.getItem("token");
    return token
      ? { "Content-Type": contentType, "Authorization": `Bearer ${token}` }
      : { "Content-Type": contentType };
  }
async function mostrarDetallesTarea(id){
    
    const respuesta = await fetch("http://52.201.50.4:8080/api/tareas/"+id,{
        headers:authHeaders()
    });
    if(!respuesta.ok){
        throw new Error(`Response status: ${response.status}`);
    }
    const json = await respuesta.json();
    
    const modal = document.querySelector("#modal-consultar #modal-contenido")
    
    const pId = document.createElement("P") 
    pId.innerHTML = "<strong>ID: </strong>"+json.id
    modal.appendChild(pId)  


    const pNombre = document.createElement("P") 
    pNombre.innerHTML = "<strong>Nombre: </strong>"+json.nombre
    modal.appendChild(pNombre)

    const pDesc = document.createElement("P") 
    pDesc.innerHTML = "<strong>Descripcion: </strong>"+json.descripcion
    modal.appendChild(pDesc);

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
    
    const respuesta = await fetch("http://52.201.50.4:8080/api/tareas/"+id,{
        headers:authHeaders()
    });

    

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
    const response = await fetch("http://52.201.50.4:8080/api/tareas/"+id,{
        method:"PUT",
        headers: {
            ...authHeaders(),
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
    
    const response = await fetch("http://52.201.50.4:8080/api/tareas/"+id,{
        method:"DELETE",
        headers:authHeaders(),
    });

    if (!response.ok) {
        throw new Error(`Error: ${response.status}`);
    }

    location.reload()
}