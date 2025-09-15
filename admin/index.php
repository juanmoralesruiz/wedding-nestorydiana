<?php include("../bd/conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <title>¡Nos casamos! N&D</title>
</head>
<body>
  <div class="container">
    <h1>Panel de Administración</h1>
    <h2>Invitados</h2>

    <div class="filters">
      <input type="text" placeholder="🔍 Buscar" id="buscar" onkeyup="filtrar()">
      <select id="estadoFiltro" onchange="filtrar()">
        <option value="">Estado</option>
        <option value="asistira">Asistirá</option>
        <option value="pendiente">Pendiente</option>
        <option value="no-asistira">No asistirá</option>
      </select>
    </div>

    <!-- MOBILE FIRST: CARDS -->
    <div class="cards-container" id="cardsContainer">
      <?php
      $sql = "SELECT * FROM bod_nestor_diana ORDER BY id ASC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $estadoTexto = "";
          $claseEstado = "";

          if ($row["estado"] == "asistira") {
            $estadoTexto = "Asistirá";
            $claseEstado = "asistira";
          } elseif ($row["estado"] == "pendiente") {
            $estadoTexto = "Pendiente";
            $claseEstado = "pendiente";
          } else {
            $estadoTexto = "No asistirá";
            $claseEstado = "no-asistira";
          }

          $linkPersonal = "https://nestorydiana.site/?id=" . $row['id'];

          // Armar mensaje con saltos de línea "\n"
          $mensaje = "¡Nos casamos! 💍✨\n".
            "Queremos que nos acompañen en este día tan especial para nosotros…\n".
            "Por eso hemos separado {$row['pases']} pase(s) para ti".
            ($row['ninos'] > 0 ? " y {$row['ninos']} para tu(s) niño(s)" : "") . ", ".
            "nos emociona pensar que estarán a nuestro lado en este capítulo tan hermoso que apenas comienza.\n".
            "Por favor, confírmanos tu asistencia en el siguiente enlace, en el que también encontrarás los detalles de nuestra boda.\n".
            $linkPersonal."\n".
            "¡Los queremos!💗";

          // Codificar para WhatsApp con rawurlencode (mejor que urlencode)
          $mensaje = rawurlencode($mensaje);

          // Link final de WhatsApp
          $linkWhatsapp = "https://wa.me/51{$row['telefono']}?text=$mensaje";


          echo "<div class='card' data-nombre='".strtolower($row['nombres'])."' data-estado='$claseEstado'>
                  <p><strong>Nombre:</strong> {$row['nombres']}</p>
                  <p><strong>Teléfono:</strong> {$row['telefono']}</p>
                  <p><strong>Pases:</strong> {$row['pases']}</p>
                  <p><strong>Niños:</strong> {$row['ninos']}</p>
                  <p><strong>Estado:</strong> <span class='badge $claseEstado'>$estadoTexto</span></p>
                  <button class='btn-enviar' onclick=\"window.open('$linkWhatsapp','_blank')\">Enviar invitación</button>
                </div>";
        }
      } else {
        echo "<p>No hay invitados registrados</p>";
      }
      ?>
    </div>

    <!-- DESKTOP: TABLA -->
    <table id="tablaInvitados">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Pases</th>
          <th>Niños</th>
          <th>Estado</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = $conn->query("SELECT * FROM bod_nestor_diana ORDER BY id ASC");
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $estadoTexto = "";
            $claseEstado = "";

            if ($row["estado"] == "asistira") {
              $estadoTexto = "Asistirá";
              $claseEstado = "asistira";
            } elseif ($row["estado"] == "pendiente") {
              $estadoTexto = "Pendiente";
              $claseEstado = "pendiente";
            } else {
              $estadoTexto = "No asistirá";
              $claseEstado = "no-asistira";
            }

            $linkPersonal = "https://nestorydiana.site/?id=" . $row['id'];

            // Armar mensaje con saltos de línea "\n"
            $mensaje = "¡Nos casamos! 💍✨\n".
            "Queremos que nos acompañen en este día tan especial para nosotros…\n".
            "Por eso hemos separado {$row['pases']} pase(s) para ti".
            ($row['ninos'] > 0 ? " y {$row['ninos']} para tu(s) niño(s)" : "") . ", ".
            "nos emociona pensar que estarán a nuestro lado en este capítulo tan hermoso que apenas comienza.\n".
            "Por favor, confírmanos tu asistencia en el siguiente enlace, en el que también encontrarás los detalles de nuestra boda.\n".
            $linkPersonal."\n".
            "¡Los queremos!💗";

            // Codificar para WhatsApp con rawurlencode (mejor que urlencode)
            $mensaje = rawurlencode($mensaje);

            // Link final de WhatsApp
            $linkWhatsapp = "https://wa.me/51{$row['telefono']}?text=$mensaje";


            echo "<tr data-nombre='".strtolower($row['nombres'])."' data-estado='$claseEstado'>
                    <td>{$row['nombres']}</td>
                    <td>{$row['telefono']}</td>
                    <td>{$row['pases']}</td>
                    <td>{$row['ninos']}</td>
                    <td><span class='badge $claseEstado'>$estadoTexto</span></td>
                    <td><button class='btn-enviar' onclick=\"window.open('$linkWhatsapp','_blank')\">Enviar</button></td>
                  </tr>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="../assets/js/admin.js"></script>
</body>
</html>