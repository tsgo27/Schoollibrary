document.addEventListener("DOMContentLoaded", function () {
    const pesquisarInput = document.getElementById("pesquisar");
    const table = document.querySelector("table");
    const rows = table.getElementsByTagName("tr");

    pesquisarInput.addEventListener("input", function () {
        const filtro = pesquisarInput.value.toUpperCase();

        for (let i = 0; i < rows.length; i++) {
            const tdNomeAutor = rows[i].getElementsByTagName("td")[1]; // Coluna "Autor"

            if (tdNomeAutor) {
                const textoNomeAutor = tdNomeAutor.textContent || tdNomeAutor.innerText;

                if (textoNomeAutor.toUpperCase().includes(filtro)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    });
});

