document.addEventListener("DOMContentLoaded", () => {
    let container = document.getElementById("modalContainer");
    if (!container) {
        container = document.createElement("div");
        container.id = "modalContainer";
        document.body.appendChild(container);
    } else if (container.parentNode !== document.body) {
        document.body.appendChild(container);
    }

    // Il file esistente nel progetto è modal_segnalazione.php (non .html)
    fetch("./modal/modal_segnalazione.php")
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok: " + response.status);
            return response.text();
        })
        .then(html => {
            console.log('[modal] fetched html length =', html.length);
            container.innerHTML = html;
            const modalEl = container.querySelector('#modalSegnalazione');
            if (modalEl) {
                console.log('[modal] element found #modalSegnalazione, innerHTML length =', modalEl.innerHTML.length);
            } else {
                console.warn('[modal] #modalSegnalazione non trovato nel contenuto');
            }
        })
        .catch(err => console.error("Errore nel caricamento della modal:", err));
});
