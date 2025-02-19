document.addEventListener("DOMContentLoaded", function () {
    const selectEditoras = document.getElementById("select-editoras");
    const selectSituacao = document.getElementById("tabela-obras");
    const selectGenero = document.getElementById("select-generos");
    const tabelaObras = document.querySelector("table tbody");

    selectEditoras.addEventListener("change", filtrarTabela);
    selectSituacao.addEventListener("change", filtrarTabela);
    selectGenero.addEventListener("change", filtrarTabela);

    function filtrarTabela() {
        const editoraSelecionada = selectEditoras.value;
        const situacaoSelecionada = selectSituacao.value;
        const generoSelecionado = selectGenero.value;
        const linhas = tabelaObras.querySelectorAll("tr");

        linhas.forEach(function (linha) {
            const colunaGenero = linha.querySelector("td:nth-child(9)"); // Coluna Gênero
            const colunaEditora = linha.querySelector("td:nth-child(10)"); // Coluna Editora
            const colunaSituacao = linha.querySelector("td:nth-child(11)"); // Coluna Situação

            if (colunaEditora && colunaSituacao && colunaGenero) {
                const editora = colunaEditora.textContent.trim();
                const situacao = colunaSituacao.textContent.trim();
                const genero = colunaGenero.textContent.trim();

                const atendeFiltroEditora = !editoraSelecionada || editora === editoraSelecionada;
                const atendeFiltroSituacao = !situacaoSelecionada || situacao === situacaoSelecionada;
                const atendeFiltroGenero = !generoSelecionado || genero === generoSelecionado;

                if (atendeFiltroEditora && atendeFiltroSituacao && atendeFiltroGenero) {
                    linha.style.display = "";
                } else {
                    linha.style.display = "none";
                }
            }
        });
    }
});
