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



    document.addEventListener("DOMContentLoaded", function() {
        var btn = document.getElementById("toggleAddUser");
        var container = document.getElementById("addUserContainer");
        if (btn && container) {
          btn.addEventListener("click", function() {
            if (container.style.display === "none") {
              container.style.display = "block";
              btn.textContent = "Nascondi form";
              btn.innerHTML += '<i class="bi bi-x-lg"></i>';
            } else {
              container.style.display = "none";
              btn.textContent = "Aggiungi Nuovo Utente";
            }
          });
        }
      });

      
    new DataTable("#usersTable");
    