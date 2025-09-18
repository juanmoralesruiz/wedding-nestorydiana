<?php
include("bd/conexion.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM bod_nestor_diana WHERE id = $id LIMIT 1";
$result = $conn->query($sql);
$invitado = $result->fetch_assoc();

if (!$invitado) {
  die("Invitado no encontrado.");
}

// Guardar cambios cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $estado = $_POST['asistencia'];
    $mensaje = $_POST['txtMensaje'];

    // 🔹 Nuevos campos para guardar también
    $pases_confirmados = isset($_POST['pases_confirmados']) ? intval($_POST['pases_confirmados']) : 0;
    $lleva_ninos = isset($_POST['lleva_ninos']) ? $_POST['lleva_ninos'] : null;

    $sqlUpdate = "UPDATE bod_nestor_diana 
                  SET estado='$estado', mensaje='$mensaje',
                      pases_confirmados=$pases_confirmados, 
                      lleva_ninos=" . ($lleva_ninos ? "'$lleva_ninos'" : "NULL") . "
                  WHERE id=$id";
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "<script>alert('¡Gracias! Hemos registrado tu respuesta.'); window.location='?id=$id';</script>";
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="shortcut icon" href="assets/icons/ico_jp.ico" type="image/x-icon">
  <title>¡Nos casamos! N&D</title>
</head>
<body class="block-scroll">

  <!-- Popup sección música -->
  <div class="music" id="music">
    <img class="music-left" src="assets/img/top-left.png" alt="">
    <img class="icon" src="assets/icons/icon-ring.png" alt="">
    <p>¡Nos casamos!</p>
    <img class="music-names" src="assets/img/names.png" alt="">
    <div class="box--buttons">
      <button id="wt-audio-popup" class="box--btn" onclick="playAudio()">
        <img src="assets/icons/icon-music.png" alt="">
        Con música
      </button>
      <button id="wo-audio-popup" class="box--btn">
        <img src="assets/icons/icon-no-music.png" alt="">
        Sin música
      </button>
    </div>
    <img class="music-right" src="assets/img/bottom-right.png" alt="">
  </div>
  
  <!-- Borde superior de hojas -->
  <section class="top">
    <img class="top__left" src="assets/img/top-left.png" alt="">
    <img class="top__right" src="assets/img/top-right.png" alt="">
  </section>

  <!-- Título -->
  <section class="title reveal">
    <img src="assets/img/names.png" alt="">
  </section>

  <!-- Imagen portada -->
  <section class="cover-image reveal reveal-zoom">
    <img src="assets/img/1.jpg" alt="">
  </section>

  <!-- Versículo -->
  <section class="verse reveal reveal-left">
    <div class="verse__text">
      <p>"Ponme como un sello sobre tu corazón, como una marca sobre tu brazo porque fuerte como la muerte es el amor"<br>Cantares 8:6</p>
    </div>
    <div class="verse__sep">
      <img src="assets/img/verse-sep.png" alt="">
    </div>
  </section>

  <!-- Padres -->
  <section class="parents reveal">
    <p>Con la bendición de Dios y el<br>amor de nuestros padres</p>
    <div class="parents-group">
      <div class="parents-group-m">
        <div class="special-text">
          <p>Padres del Novio</p>
          <hr>
        </div>
        <p class="name-text">Néstor Toisse Morales</p>
        <p class="name-text">Alida Rosa Brito</p>
      </div>
      <div class="parents-group-m">
        <div class="special-text">
          <p>Padres de la Novia</p>
          <hr>
        </div>
        <p class="name-text">Eladio Zavala Mercado</p>
        <p class="name-text">Rosa Castillo Ramos</p>
      </div>
    </div>
    <div class="parents__separator">
      <img class="parents__left" src="assets/img/tablet/name-left.png" alt="">
      <img class="parents__center" src="assets/img/name-center.png" alt="">
      <img class="parents__right" src="assets/img/tablet/name-right.png" alt="">
    </div>
    <p class="parents__alone">y el cariño de nuestros</p>
    <div class="padrino-group">
      <img src="assets/img/name-left.png" alt="">
      <div class="padrino">
        <div class="special-text">
          <p>Padrinos</p>
          <hr>
        </div>
        <p class="name-text">Fernando Loyola Vergel</p>
        <p class="name-text">Ana Agreda Valverde</p>
      </div>
      <img src="assets/img/name-right.png" alt="">
    </div>
  </section>

  <!-- Imagen portada -->
  <section class="cover-image reveal reveal-zoom">
    <img src="assets/img/5.jpg" alt="">
  </section>

  <!-- Fecha y hora -->
  <section class="date reveal reveal-right">
    <div class="date__text">
      <p>Nuestro día no estaría completo sin tu presencia, y nos encantaría que nos acompañes a celebrar el amor y la promesa de un " <span>para siempre</span> "</p>
    </div>
    <div class="date__big">
      <img src="assets/img/date-left.png" alt="">
      <div class="date__big--center">
        <p>08</p>
        <p>Nov.</p>
      </div>
      <img src="assets/img/date-right.png" alt="">
    </div>
    <p class="date__hour">Hora: 3:00 pm</p>
  </section>
  
  <!-- Cuenta regresiva -->
  <section class="countdown reveal">
    <div class="countdown-container">
      <div class="count__number">
        <span id="days">00</span>
        <p>días</p>
      </div>
      <hr>
      <div class="count__number">
        <span id="hours">00</span>
        <p>horas</p>
      </div>
      <hr>
      <div class="count__number">
        <span id="minutes">00</span>
        <p>minutos</p>
      </div>
      <hr>
      <div class="count__number">
        <span id="seconds">00</span>
        <p>segundos</p>
      </div>
    </div>
  </section>

  <!-- Borde superior de hojas -->
  <section class="top">
    <img class="top__left" src="assets/img/top-left.png" alt="">
    <img class="top__right" src="assets/img/top-right.png" alt="">
  </section>

  <!-- Ubicación -->
  <section class="ubication reveal reveal-left">
    <img class="icon" src="assets/icons/icon-church.png" alt="">
    <button id="open-map">Ubicación</button>
    <p>Los Pinos Casa de Campo</p>
    <div class="ubi__place">
      <hr>
      <p>Laredo</p>
      <hr>
    </div>
  </section>

  <div class="map" id="map">
    <img class="music-left" src="assets/img/top-left.png" alt="">
    <img class="icon-close" id="close-map" src="assets/icons/icon-close.png" alt="">
    <div class="modal-title">
      <img src="assets/icons/icon-church.png" alt="">
      <p class="map-title">Ubicación</p>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.181169383248!2d-78.98031282407922!3d-8.082998280813467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ad16633abbec39%3A0x4f62c9da60907975!2sLOS%20PINOS%20CASA%20DE%20CAMPO!5e0!3m2!1ses-419!2spe!4v1757720606096!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <p class="map-name">Los Pinos Casa de Campo</p>
    <img class="music-right" src="assets/img/bottom-right.png" alt="">
  </div>

  <!-- Código de vestimenta -->
  <section class="dress reveal">
    <img class="icon" src="assets/icons/icon-dress.png" alt="">
    <p class="dress-title">Dress Code</p>
    <p class="dress-code">Formal - Elegante</p>
    <div class="dress-text">
      <p>Queremos que todos luzcan increíbles, pero que los novios brillen aún más, por eso agradecemos que eviten vestir en colores blancos, beige o similares</p>
    </div>
  </section>

  <!-- Imagen portada -->
  <section class="cover-image reveal reveal-zoom">
    <img src="assets/img/3.jpg" alt="">
  </section>

  <!-- Regalos -->
  <section class="gift reveal reveal-right">
    <div class="gift-title">
      <img class="icon" src="assets/icons/icon-gift.png" alt="">
      <p>Regalos</p>
    </div>
    <div class="gift-text">
      <p>Tu presencia es lo más importante para nosotros, pero si gustas hacernos un regalo agradeceríamos que sea por este medio:</p>
    </div>
    <div class="gift-container">
      <div class="gift-transf">
        <img src="assets/img/bcp.png" alt="">
        <div class="gift-number">
          <p>CC: 57001545232094</p>
          <p>CCI: 0025700154523209405</p>
        </div>
      </div>
      <div class="gift-transf">
        <img src="assets/img/yape.png" alt="">
        <div class="gift-number">
          <p>961844583</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Confirmación de asistencia -->
  <section class="confirmation reveal">
    <img class="icon" src="assets/icons/icon-list.png" alt="">
    <p class="confirm-text">Confirmar asistencia hasta el</p>
    <div class="confirm-date">
      <p>18</p>
      <p>Oct.</p>
    </div>
    <button id="open-atten">Regístrate</button>
  </section>

  <div class="atten" id="atten">
    <img class="music-left" src="assets/img/top-left.png" alt="">
    <img class="icon-close" id="close-atten" src="assets/icons/icon-close.png" alt="">
  
    <div class="modal-title">
      <img src="assets/icons/icon-list.png" alt="">
      <p class="map-title">Asistencia</p>
    </div>

    <form method="POST">
      <!-- Nombre precargado y bloqueado -->
      <input type="text" name="txtName" value="<?php echo $invitado['nombres']; ?>" readonly>

      <div class="radiobtn-container" id="radioBox">
        <p>Confirma tu asistencia</p>
        <label>
          <input class="radiobtn" type="radio" name="asistencia" value="asistira" required
            <?php echo ($invitado['estado']=='asistira')?'checked':''; ?>>
            Sí asistiré
        </label>
        <label>
          <input class="radiobtn" type="radio" name="asistencia" value="no-asistira" required
            <?php echo ($invitado['estado']=='no-asistira')?'checked':''; ?>>
            No podré asistir
        </label>
      </div>

      <!-- 🔹 NUEVO: Campo cantidad de asistentes (solo si marca 'Sí') -->
      <div class="radiobtn-container" id="boxPases" style="display:none;">
        <p>¿Cuántos asistirán? (máx <?php echo $invitado['pases']; ?>)</p>
        <input type="number" name="pases_confirmados" id="pases_confirmados"min="1" max="<?php echo $invitado['pases']; ?>" value="<?php echo $invitado['pases_confirmados']; ?>">
      </div>

      <!-- 🔹 NUEVO: Campo '¿Asistirás con tus niños?' (solo si ninos > 0) -->
      <?php if ($invitado['ninos'] > 0): ?>
      <div class="radiobtn-container" id="boxNinos" style="display:none;">
        <p>¿Asistirás con tus niños?</p>
        <label>
          <input class="radiobtn" type="radio" name="lleva_ninos" value="sí"
            <?php echo ($invitado['lleva_ninos']=='sí')?'checked':''; ?>>
            Sí
        </label>
        <label>
          <input class="radiobtn" type="radio" name="lleva_ninos" value="no"
            <?php echo ($invitado['lleva_ninos']=='no')?'checked':''; ?>>
            No
        </label>
      </div>
      <?php endif; ?>

      <!-- Mensaje -->
      <textarea name="txtMensaje" placeholder="Déjanos un consejo o mensaje de ánimo"><?php echo $invitado['mensaje']; ?></textarea>

      <button class="ubi-btn atten-btn" type="submit" name="action" value="enviar">ENVIAR DATOS</button>
    </form>

    <img class="music-right" src="assets/img/bottom-right.png" alt="">
  </div>

  <!-- Borde inferior de hojas -->
  <section class="bottom">
    <img class="bottom__left" src="assets/img/bottom-left.png" alt="">
    <img class="bottom__right" src="assets/img/bottom-right.png" alt="">
  </section>

  <!-- Pie de página -->
  <footer class="footer">
    <p>© 2025 Todos los derechos reservados</p>
    <p>MR Studio | Diseño & Desarrollo</p>
    <div class="footer-social">
      <a href="https://wa.link/37cpyg" target="_blank"><span class="ic--baseline-whatsapp"></span></a>
      <a href="https://www.instagram.com/mr.studio.dev/" target="_blank"><span class="mdi--instagram"></span></a>
    </div>
  </footer>

  <!-- Variables de PHP hacia JS para la lógica -->
  <script>
    const pasesAsignados = <?php echo $invitado['pases']; ?>;
    const ninosAsignados = <?php echo $invitado['ninos']; ?>;
  </script>

  <!-- Script y música de fondo -->
  <script src="assets/js/main.js"></script>
  <audio src="assets/audio/Victor Muñoz-Tu guardian.mp3" id="bg-music" loop></audio>

</body>
</html>
