<?php

include("../bd/conexion.php");

// 🔹 Consulta
$sql = "SELECT nombres, mensaje FROM bod_nestor_diana WHERE mensaje IS NOT NULL AND mensaje <> '' ORDER BY id ASC";
$result = $conn->query($sql);

// Evitar que el navegador guarde caché
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/message.css?v=2">
    <link rel="shortcut icon" href="../assets/icons/ico_jp.ico" type="image/x-icon">
    <title>¡Nos casamos! N&D</title>
</head>
<body>

    <header>
        <h1>Bandeja de mensajes<br>Néstor & Dianna</h1>
        <p>Estas son las palabras y buenos deseos de nuestros seres queridos</p>
    </header>
    
    <section class="mensajes-container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="mensaje-card">';
                echo '<div class="mensaje-nombre">' . htmlspecialchars($row["nombres"]) . '</div>';
                echo '<div class="mensaje-texto">' . htmlspecialchars($row["mensaje"]) . '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No hay mensajes todavía. 💌</p>";
        }
        $conn->close();
        ?>
    </section>
    
    <footer>
        <div class="decor-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#A67C52" viewBox="0 0 24 24">
                <path d="M12 2l2 4h4l-3 3 2 4-5-3-5 3 2-4-3-3h4l2-4z"/>
                <circle cx="12" cy="16" r="6" stroke="#A67C52" stroke-width="2" fill="none"/>
            </svg>
        </div>

        El amor se multiplica cuando se comparte

        <!-- SVG Corazón pequeño -->
        <div class="decor-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#A67C52" viewBox="0 0 24 24">
                <path d="M12 2l2 4h4l-3 3 2 4-5-3-5 3 2-4-3-3h4l2-4z"/>
                <circle cx="12" cy="16" r="6" stroke="#A67C52" stroke-width="2" fill="none"/>
            </svg>
        </div>
    </footer>

    <!-- Forzar URL única para evitar caché pegado -->
    <script>
    (function() {
        if (!window.location.href.includes("nocache")) {
            var sep = window.location.href.includes("?") ? "&" : "?";
            window.location.replace(window.location.href + sep + "nocache=" + new Date().getTime());
        }
    })();
    </script>
</body>
</html>
