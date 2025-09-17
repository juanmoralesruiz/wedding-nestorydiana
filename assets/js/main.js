// Variables globales
const body = document.querySelector("body");

// Canción de fondo en la invitación
function playAudio() {
    document.getElementById("bg-music").play();
}

// Quitar popup de la canción de fondo
const wtAudioPopup = document.getElementById("wt-audio-popup");
const woAudioPopup = document.getElementById("wo-audio-popup");
const musicWindow = document.getElementById("music");

function closeMusicModal(withMusic = false) {
    if (withMusic) {
        playAudio(); // 👈 sigue funcionando tu música
    }

    // 1) activa la animación
    musicWindow.classList.add("closing");

    // 2) espera que termine (400ms) y oculta del todo
    setTimeout(() => {
        musicWindow.classList.remove("closing");   // limpia
        musicWindow.classList.add("close-window"); // display:none
        body.classList.remove("block-scroll");
    }, 400); // mismo tiempo que pusimos en el CSS
}

// Botones
wtAudioPopup.addEventListener("click", () => closeMusicModal(true));
woAudioPopup.addEventListener("click", () => closeMusicModal(false));


// Funcionalidad Cuenta regresiva
const targetDate = new Date("Nov 08, 2025 00:00:00").getTime();

function pad(n) {
    return n.toString().padStart(2, "0");
}

const countdown = setInterval(() => {
    const now = new Date().getTime();
    const distance = targetDate - now;

    if (distance <= 0) {
        document.getElementById("days").innerText = "00";
        document.getElementById("hours").innerText = "00";
        document.getElementById("minutes").innerText = "00";
        document.getElementById("seconds").innerText = "00";
        clearInterval(countdown);
    } else {
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerText = pad(days);
        document.getElementById("hours").innerText = pad(hours);
        document.getElementById("minutes").innerText = pad(minutes);
        document.getElementById("seconds").innerText = pad(seconds);
    }
}, 1000);

// Popup ventana emergente mapa
const map = document.getElementById("map");
const openMap = document.getElementById("open-map");
const closeMap = document.getElementById("close-map");

openMap.addEventListener("click", () => {
    map.style.display = 'flex';
    body.classList.add("block-scroll");
});
closeMap.addEventListener("click", () => {
    map.style.display = 'none';
    body.classList.remove("block-scroll");
});


// Popup ventana emergente asistencia
const atten = document.getElementById("atten");
const openAtten = document.getElementById("open-atten");
const closeAtten = document.getElementById("close-atten");

openAtten.addEventListener("click", () => {
    atten.style.display = 'flex';
    body.classList.add("block-scroll");
});
closeAtten.addEventListener("click", () => {
    atten.style.display = 'none';
    body.classList.remove("block-scroll");
});


// === 🔹 NUEVA LÓGICA PARA EL FORMULARIO DE ASISTENCIA ===

// Variables
const radioAsistencia = document.querySelectorAll("input[name='asistencia']");
const boxPases = document.getElementById("boxPases");
const pasesInput = document.getElementById("pases_confirmados");
const boxNinos = document.getElementById("boxNinos");

// Función para limitar valores
function clamp(val, min, max) {
    return Math.max(min, Math.min(max, val));
}

function updateRSVPUI() {
    const asistira =
        document.querySelector("input[name='asistencia']:checked")?.value === "asistira";

    if (asistira) {
        // --- Campo "¿Cuántos asistirán?"
        if (pasesAsignados <= 1) {
            // Si solo tiene 1 pase → no mostrar campo, fijar valor en 1
            if (boxPases) boxPases.style.display = "none";
            if (pasesInput) {
                pasesInput.disabled = false;   // debe enviarse
                pasesInput.required = false;   // no es obligatorio porque ya está fijo
                pasesInput.min = 1;
                pasesInput.max = 1;
                pasesInput.value = 1;
            }
        } else {
            // Si tiene >1 pase → mostrar el input
            if (boxPases) boxPases.style.display = "block";
            if (pasesInput) {
                pasesInput.disabled = false;
                pasesInput.required = true;
                pasesInput.min = 1;
                pasesInput.max = pasesAsignados;
                const current = parseInt(pasesInput.value, 10);
                pasesInput.value = isNaN(current) ? 1 : clamp(current, 1, pasesAsignados);
            }
        }

        // --- Campo "¿Asistirás con tus niños?"
        if (boxNinos) {
            const showKids = typeof ninosAsignados !== "undefined" && ninosAsignados > 0;
            boxNinos.style.display = showKids ? "block" : "none";
            const kidsRadios = boxNinos.querySelectorAll("input[name='lleva_ninos']");
            kidsRadios.forEach(r => (r.disabled = !showKids));
        }
    } else {
        // NO asistirá → ocultar/limpiar campos
        if (boxPases) boxPases.style.display = "none";
        if (pasesInput) {
            pasesInput.required = false;
            pasesInput.disabled = true; // navegador lo ignora
            pasesInput.value = "";      // limpiar
        }
        if (boxNinos) {
            boxNinos.style.display = "none";
            const kidsRadios = boxNinos.querySelectorAll("input[name='lleva_ninos']");
            kidsRadios.forEach(r => {
                r.checked = false;
                r.disabled = true;
            });
        }
    }
}

// Eventos
radioAsistencia.forEach(r => r.addEventListener("change", updateRSVPUI));
window.addEventListener("DOMContentLoaded", updateRSVPUI);


// --- Animaciones reveal on scroll ---
function revealOnScroll() {
    const reveals = document.querySelectorAll(".reveal");
    reveals.forEach(el => {
        const windowHeight = window.innerHeight;
        const elementTop = el.getBoundingClientRect().top;
        if (elementTop < windowHeight - 100) {
            el.classList.add("active");
        }
    });

    // Especial para countdown (animación escalonada)
    const counts = document.querySelectorAll(".count__number");
    counts.forEach((el, i) => {
        const windowHeight = window.innerHeight;
        const elementTop = el.getBoundingClientRect().top;
        if (elementTop < windowHeight - 80) {
            setTimeout(() => el.classList.add("active"), i * 200);
        }
    });
}

window.addEventListener("scroll", revealOnScroll);
window.addEventListener("load", revealOnScroll);
