document.addEventListener("DOMContentLoaded", function () {
    const selectEditoras = document.getElementById("select-editoras");
    const selectSituacao = document.getElementById("tabela-obras");
    const selectGenero = document.getElementById("select-generos"); // Adicionado o novo select
    const tabelaObras = document.querySelector("table tbody");

    selectEditoras.addEventListener("change", filtrarTabela);
    selectSituacao.addEventListener("change", filtrarTabela);
    selectGenero.addEventListener("change", filtrarTabela); // Adicionado o novo select

    function filtrarTabela() {
        const editoraSelecionada = selectEditoras.value;
        const situacaoSelecionada = selectSituacao.value;
        const generoSelecionado = selectGenero.value; // Adicionado o novo select
        const linhas = tabelaObras.querySelectorAll("tr");

        linhas.forEach(function (linha) {
            const colunaGenero = linha.querySelector("td:nth-child(10)"); // Coluna do Gênero (alterado para 10)
            const colunaEditora = linha.querySelector("td:nth-child(11)"); // Coluna da Editora
            const colunaSituacao = linha.querySelector("td:nth-child(12)"); // Coluna da Situação

            if (colunaEditora && colunaSituacao && colunaGenero) {
                const editora = colunaEditora.textContent;
                const situacao = colunaSituacao.textContent;
                const genero = colunaGenero.textContent; // Adicionado o novo select

                const atendeFiltroEditora = !editoraSelecionada || editora === editoraSelecionada;
                const atendeFiltroSituacao = !situacaoSelecionada || situacao === situacaoSelecionada;
                const atendeFiltroGenero = !generoSelecionado || genero === generoSelecionado; // Adicionado o novo select

                if (atendeFiltroEditora && atendeFiltroSituacao && atendeFiltroGenero) {
                    linha.style.display = "";
                } else {
                    linha.style.display = "none";
                }
            }
        });
    }
});
