async function cargarInforme(){

    borrarListas()

    const tarea = document.querySelector("#tarea-informe").value.trim();
    const fecha = document.querySelector("#fecha-informe").value.trim();

    if (!fecha || !tarea) {
        // Puedes usar alert o inyectar texto en un <span> de error
        alert("Por favor, selecciona fecha y tarea antes de cargar el informe.");
        return; // Salir sin ejecutar el fetch
    }

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