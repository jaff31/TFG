document.addEventListener('DOMContentLoaded', function(){

})
/*
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
*/
async function mostrarDetallesAlumno(id){
    
    const respuesta = await fetch("http://localhost:8080/api/alumnos/"+id);
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

    const pEmail = document.createElement("P") 
    pEmail.innerHTML = "<strong>email: </strong>"+json.email
    modal.appendChild(pEmail);

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
async function editarAlumno(id){
   console.log(id)
   const form = document.querySelector("#formulario-editar")
   form.setAttribute("onsubmit","editAlumno("+id+")")
   const contenedor = document.querySelector("#modal-editar")
   
   const respuesta = await fetch("http://localhost:8080/api/alumnos/"+id);

    

   if(!respuesta.ok){
       throw new Error(`Response status: ${response.status}`);
   }
   const json = await respuesta.json();
    document.querySelector("#nom").value = json.nombre.split(" ")[0];
    document.querySelector("#ape").value = json.nombre.split(" ")[1];
    document.querySelector("#emailA").value = json.email;

   contenedor.classList.add("modal")
   contenedor.classList.remove("hide")
}
async function editAlumno(id){

    const nombre = document.querySelector("#nom").value;
    const apellido = document.querySelector("#ape").value;
    const email = document.querySelector("#emailA").value;
    
    const NomCompleto = nombre +" " +apellido;
    console.log(NomCompleto)
    event.preventDefault()
    const response = await fetch("http://localhost:8080/api/alumnos/"+id,{
        method:"PUT",
        headers: {
            "Content-Type": "application/json",
          },
        body:JSON.stringify({
            "nombre":NomCompleto,
            "email":email
        })
    });
    
    if(!response.ok){
        throw new Error(`Response status: ${response.status}`);
    }

    location.reload()
    
    
    
}
async function eliminarAlumno(id){
    
    const response = await fetch("http://localhost:8080/api/alumnos/"+id,{
        method:"DELETE"
    });

    if (!response.ok) {
        throw new Error(`Error: ${response.status}`);
    }

    location.reload()
}