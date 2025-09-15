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


// Popup ventana emergente mapa
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


// Funcionalidad de los radio buttons
const radioBox = document.getElementById("radioBox");
const radios = radioBox.querySelectorAll("input[type='radio']");
const allInputs = document.querySelectorAll("input, textarea");

// Cuando selecciono un radio → activar borde
radios.forEach(radio => {
    radio.addEventListener("change", () => {
        radioBox.classList.add("active");
    });
});

// Cuando hago focus en otro input/textarea → quitar borde
allInputs.forEach(inp => {
    if (inp.type !== "radio") {
        inp.addEventListener("focus", () => {
            radioBox.classList.remove("active");
        });
    }
});

// Si hago clic en cualquier parte del documento → verificar
document.addEventListener("click", (e) => {
  // Si el clic NO fue dentro del contenedor de radios, quitar borde
    if (!radioBox.contains(e.target)) {
        radioBox.classList.remove("active");
    }
});


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
