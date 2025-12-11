document.addEventListener("DOMContentLoaded", () => {
    const container = document.createElement("div");
    container.id = "modalContainer";
    document.body.appendChild(container);

    fetch("modal/modal_segnalazione.html")
        .then(response => response.text())
        .then(html => {
            container.innerHTML = html;
        })
        .catch(err => console.error("Errore nel caricamento della modal:", err));
});
