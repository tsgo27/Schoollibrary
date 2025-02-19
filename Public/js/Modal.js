document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".visualizarObra").forEach(function(btn) {
        btn.addEventListener("click", function(event) {
            event.preventDefault(); // Evita que a página role para o topo
            $('#detalhesObraModal').modal('show'); // Exibe o modal
        });
    });
});