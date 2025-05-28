document.addEventListener("DOMContentLoaded", () => {
    setUserEmailFromSession();
    
});

function logout() {
    window.location.href = '../logout.php';
}
async function saveToken(email, clave) {
    try {
        const response = await fetch("http://localhost:8080/api/auth/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ email, clave })
        });

        const errorP = document.getElementById("errorMensaje");

        if (!response.ok) {
            const errorText = await response.text();
            errorP.textContent = errorText;
            return;
        }


        const data = await response.json();
        console.log("LOGIN RES:", data);

        const token = data.token;
        const rol = data.usuario.rol;
        const correo = data.usuario.email;
        if (token && rol) {
            sessionStorage.setItem("token", token);
            sessionStorage.setItem("email",correo);
            if (rol === "admin") {
                console.log("admin")
                window.location.href = "Administración/tareas.php";
            } else {
                window.location.href = "Tareas/alumnos.php";
            }
        } else {
            console.error("Token o rol no recibido");
        }

    } catch (error) {
        console.error("Error en el login:", error.message);
    }
}



function setUserEmailFromSession() {
    const email = sessionStorage.getItem("email");
    if (!email) return; 

  
    const elements = document.querySelectorAll(".user-email");

    
    elements.forEach(el => {
        if ("value" in el) {
            el.value = email;
        } else {
            el.textContent = email;
        }
    });
}


