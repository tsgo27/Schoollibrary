document.addEventListener("DOMContentLoaded", function () {
    // Obtém a referência do campo de pesquisa
    const inputPesquisar = document.getElementById("pesquisar");

    // Obtém todas as linhas da tabela de editoras
    const linhasEditoras = document.querySelectorAll("tbody tr");

    // Adiciona um ouvinte de eventos de input ao campo de pesquisa
    inputPesquisar.addEventListener("input", function () {
      const termoPesquisa = inputPesquisar.value.toLowerCase();

      // Itera sobre as linhas da tabela e exibe ou oculta com base no termo de pesquisa
      linhasEditoras.forEach((linha) => {
        const nomeEditora = linha.querySelector("td:nth-child(2)");

        if (nomeEditora) {
          const nomeEditoraTexto = nomeEditora.textContent.toLowerCase();
          
          if (nomeEditoraTexto.includes(termoPesquisa)) {
            linha.style.display = "table-row";
          } else {
            linha.style.display = "none";
          }
        }
      });
    });
  });