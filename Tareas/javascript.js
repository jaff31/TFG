async function cargarInforme(){

    borrarListas()

    const tarea = document.querySelector("#tarea-informe").value;
    const fecha = document.querySelector("#fecha-informe").value;

    console.log(tarea)

    event.preventDefault();

    const response = await fetch("http://localhost:8080/api/registro/filtro/"+tarea+"/"+fecha);
    if(response.ok ){
        const json = await  response.json();
        const aprobado = document.querySelector("#lista-superados")
        const suspenso = document.querySelector("#lista-no-superados")
        json.forEach(element => {
            const li = document.createElement('LI');
            const p = document.createElement('p');
            p.textContent = element.idAlumno.nombre;

            const Contprogre = document.createElement('div');
            Contprogre.classList.add('barra-progreso');

            const progre = document.createElement('div');
            progre.classList.add('barra-progreso-llenado');
            progre.textContent = element.progreso + "%";
            progre.style.width = element.progreso + "%";

            Contprogre.appendChild(progre);

            li.appendChild(p);
            li.appendChild(Contprogre);

            if(element.progreso >= 50){
                aprobado.appendChild(li)

            }
            else{
                suspenso.appendChild(li)
            }
        });
        
        
    }
}
function borrarListas(){
    const listaSuperados = document.querySelector("#lista-superados");
    const listaNoSuperados = document.querySelector("#lista-no-superados");

    // Borrar todos los <li> dentro de las listas específicas
    listaSuperados.innerHTML = '';
    listaNoSuperados.innerHTML = '';
}