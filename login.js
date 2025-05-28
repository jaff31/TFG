document.getElementById("loginForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const clave = document.getElementById("clave").value;

    await saveToken(email, clave);
});