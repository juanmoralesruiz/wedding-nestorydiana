function filtrar() {
    var input = document.getElementById("buscar").value.toLowerCase();
    var estado = document.getElementById("estadoFiltro").value;

    document.querySelectorAll(".cards-container .card").forEach(function(card) {
        var nombre = card.getAttribute("data-nombre");
        var estadoCard = card.getAttribute("data-estado");
        card.style.display = (nombre.includes(input) && (estadoCard === estado || estado === "")) ? "block" : "none";
    });

    document.querySelectorAll("#tablaInvitados tbody tr").forEach(function(fila) {
        var nombre = fila.getAttribute("data-nombre");
        var estadoFila = fila.getAttribute("data-estado");
        fila.style.display = (nombre.includes(input) && (estadoFila === estado || estado === "")) ? "" : "none";
    });
}